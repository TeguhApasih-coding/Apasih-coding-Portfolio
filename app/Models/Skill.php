<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Skill extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'icon',
        'color',
        'level',
        'display_order',
        'is_featured',
        'is_active',
        'description',
    ];

    protected $casts = [
        'level' => 'integer',
        'display_order' => 'integer',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($skill) {
            if (empty($skill->slug)) {
                $skill->slug = Str::slug($skill->name);
            }
        });

        static::updating(function ($skill) {
            if ($skill->isDirty('name')) {
                $skill->slug = Str::slug($skill->name);
            }
        });
    }

    /**
     * Relationship dengan Category
     */
    public function category()
    {
        return $this->belongsTo(SkillCategory::class, 'category_id', 'id');
    }

    /**
     * Relationship dengan Projects (Many-to-Many)
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_skill')
                    ->withPivot('display_order')
                    ->withTimestamps();
    }

    /**
     * Scope untuk skills aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk skills featured
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope untuk mengurutkan
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order')->orderBy('name');
    }

    /**
     * Get level percentage
     */
    public function getLevelPercentageAttribute()
    {
        return min($this->level, 100);
    }

    /**
     * Get level text
     */
    public function getLevelTextAttribute()
    {
        $percentage = $this->level_percentage;
        
        if ($percentage <= 25) return 'Beginner';
        if ($percentage <= 50) return 'Intermediate';
        if ($percentage <= 75) return 'Advanced';
        return 'Expert';
    }

    /**
     * Get icon HTML
     */
    public function getIconHtmlAttribute()
    {
        if (!$this->icon) {
            return '<div class="w-6 h-6 rounded flex items-center justify-center text-white" style="background-color: ' . $this->color . '">'
                 . strtoupper(substr($this->name, 0, 1))
                 . '</div>';
        }
        
        if (str_starts_with($this->icon, '<svg')) {
            return $this->icon;
        }
        
        return '<img src="' . asset($this->icon) . '" alt="' . $this->name . '" class="w-6 h-6">';
    }

}

