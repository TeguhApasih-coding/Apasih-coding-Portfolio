<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTestimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'client_name',
        'client_position',
        'client_company',
        'client_avatar',
        'testimonial',
        'rating',
        'is_approved',
        'is_featured'
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'is_featured' => 'boolean',
        'rating' => 'integer'
    ];

    // Relationships
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Scopes
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeWithRating($query, $minRating = 4)
    {
        return $query->where('rating', '>=', $minRating);
    }

    public function scopeRecent($query, $limit = 5)
    {
        return $query->orderBy('created_at', 'desc')->limit($limit);
    }

    // Accessors
    public function getRatingStarsAttribute()
    {
        $stars = '';
        $fullStars = $this->rating;
        $emptyStars = 5 - $fullStars;
        
        for ($i = 0; $i < $fullStars; $i++) {
            $stars .= '★';
        }
        
        for ($i = 0; $i < $emptyStars; $i++) {
            $stars .= '☆';
        }
        
        return $stars;
    }

    public function getRatingStarsHtmlAttribute()
    {
        $html = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $this->rating) {
                $html .= '<svg class="w-5 h-5 text-yellow-400 fill-current" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                          </svg>';
            } else {
                $html .= '<svg class="w-5 h-5 text-gray-300 fill-current" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                          </svg>';
            }
        }
        return $html;
    }

    public function getClientInfoAttribute()
    {
        $info = [];
        
        if ($this->client_name) {
            $info[] = $this->client_name;
        }
        
        if ($this->client_position) {
            $info[] = $this->client_position;
        }
        
        if ($this->client_company) {
            $info[] = 'at ' . $this->client_company;
        }
        
        return implode(', ', $info);
    }

    public function getShortTestimonialAttribute($length = 150)
    {
        if (strlen($this->testimonial) <= $length) {
            return $this->testimonial;
        }
        
        return substr($this->testimonial, 0, $length) . '...';
    }

    public function getAvatarUrlAttribute()
    {
        if ($this->client_avatar) {
            return asset('storage/' . $this->client_avatar);
        }
        
        // Generate default avatar based on client name
        $name = $this->client_name ?: 'Client';
        $initials = strtoupper(substr($name, 0, 2));
        
        return 'https://ui-avatars.com/api/?name=' . urlencode($name) . 
               '&background=' . substr($this->project->tags->first()->color ?? '3b82f6', 1) . 
               '&color=fff&size=128&bold=true&length=2&font-size=0.5&name=' . $initials;
    }

    // Methods
    public function approve()
    {
        $this->update(['is_approved' => true]);
    }

    public function reject()
    {
        $this->update(['is_approved' => false]);
    }

    public function toggleFeatured()
    {
        $this->update(['is_featured' => !$this->is_featured]);
    }

    public function isApproved()
    {
        return $this->is_approved;
    }

    public function isFeatured()
    {
        return $this->is_featured;
    }

}
