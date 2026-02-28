<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProjectTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'color',
        'description'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tag) {
            if (empty($tag->slug)) {
                $tag->slug = Str::slug($tag->name);
            }
        });

        static::updating(function ($tag) {
            if ($tag->isDirty('name') && empty($tag->slug)) {
                $tag->slug = Str::slug($tag->name);
            }
        });
    }

    // Relationships
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_project_tag');
    }

    // Scopes
    public function scopePopular($query, $limit = 10)
    {
        return $query->withCount('projects')
                    ->orderBy('projects_count', 'desc')
                    ->limit($limit);
    }

    public function scopeActive($query)
    {
        return $query->whereHas('projects', function ($q) {
            $q->published();
        });
    }

    // Accessors
    public function getProjectsCountAttribute()
    {
        if (!$this->relationLoaded('projects')) {
            return $this->projects()->count();
        }
        
        return $this->projects->count();
    }

    public function getPublishedProjectsCountAttribute()
    {
        return $this->projects()->published()->count();
    }

    public function getColorWithOpacityAttribute()
    {
        return $this->color . '20'; // Add 20% opacity (hex: 20 = 12% opacity)
    }

    public function getTextColorAttribute()
    {
        // Determine if color is light or dark for contrast
        $hex = str_replace('#', '', $this->color);
        
        if (strlen($hex) == 3) {
            $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
        }
        
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        
        // Calculate brightness
        $brightness = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;
        
        return $brightness > 128 ? '#000000' : '#FFFFFF';
    }

    // Methods
    public function syncProjects(array $projectIds)
    {
        $this->projects()->sync($projectIds);
    }

    public function addProject($projectId)
    {
        $this->projects()->syncWithoutDetaching([$projectId]);
    }

    public function removeProject($projectId)
    {
        $this->projects()->detach($projectId);
    }
}
