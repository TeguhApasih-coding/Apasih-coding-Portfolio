<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        // Basic Information
        'title',
        'slug',
        'image',
        'thumbnail',
        'short_description',
        'description',
        'full_description',
        'conclusion',
        
        // Project Status & Visibility
        'status',
        'is_published',
        'is_featured',
        'sort_order',
        'view_count',
        
        // Project Timeline
        'start_date',
        'end_date',
        'published_at',
        
        // Technologies & Skills
        'technologies',
        'categories',
        'client',
        'client_url',
        
        // Links & Resources
        'live_url',
        'github_url',
        'demo_url',
        'documentation_url',
        
        // SEO & Meta
        'meta_title',
        'meta_description',
        'meta_keywords',
        
        // Media Gallery
        'gallery',
        
        // Statistics
        'likes_count',
        'shares_count',
        'comments_count',
        
        // Project Complexity & Details
        'estimated_hours',
        'budget',
        'budget_currency',
        'complexity',
        
        // Team & Collaboration
        'user_id',
        'team_members',
        'collaborators',
        
        // Project Challenges & Solutions
        'challenges',
        'solutions',
        'lessons_learned',
    ];

    protected $casts = [
        'technologies' => 'array',
        'categories' => 'array',
        'meta_keywords' => 'array',
        'gallery' => 'array',
        'team_members' => 'array',
        'collaborators' => 'array',
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'published_at' => 'date',
        'view_count' => 'integer',
        'likes_count' => 'integer',
        'shares_count' => 'integer',
        'comments_count' => 'integer',
        'estimated_hours' => 'integer',
        'budget' => 'decimal:2',
        'sort_order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });

        static::updating(function ($project) {
            if ($project->isDirty('title')) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

     /**
     * Relationship dengan User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship dengan Tags (Many-to-Many)
     */
    public function tags()
    {
        return $this->belongsToMany(ProjectTag::class, 'project_project_tag');
    }

    /**
     * Relationship dengan Testimonials
     */
    public function testimonials()
    {
        return $this->hasMany(ProjectTestimonial::class);
    }

    /**
     * Relationship dengan Skills (melalui pivot table yang sudah ada)
     */
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'project_skill')
                    ->withPivot('display_order')
                    ->withTimestamps();
    }

    public function scopeSearch($query, $searchTerm)
    {
        return $query->where(function($q) use ($searchTerm) {
            $q->where('title', 'like', '%' . $searchTerm . '%')
              ->orWhere('short_description', 'like', '%' . $searchTerm . '%')
              ->orWhere('description', 'like', '%' . $searchTerm . '%')
              ->orWhere('client', 'like', '%' . $searchTerm . '%');
        });
    }

    /**
     * Scope untuk project yang dipublikasi
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope untuk project featured
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope untuk project aktif
     */
    public function scopeActive($query)
    {
        return $query->published();
    }

    /**
     * Scope untuk mengurutkan
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }

    /**
     * Get cover image URL
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return asset('images/default-project.jpg');
        }
        
        if (str_starts_with($this->image, 'http') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }
        
        // return asset('storage/' . $this->image);
        // return Storage::url($this->image);

        // Path relatif ke public folder
        return asset($this->image);
    }

    /**
     * Get thumbnail URL
     */
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            if (str_starts_with($this->thumbnail, 'http') || str_starts_with($this->thumbnail, 'https://')) {
                return $this->thumbnail;
            }
            // return asset('storage/' . $this->thumbnail);
            // return Storage::url($this->thumbnail);

            return asset($this->thumbnail);
        }
        
        // Fallback ke image utama
        return $this->image_url;
    }

    /**
     * Get gallery images URLs
     */
    // public function getGalleryUrlsAttribute()
    // {
    //     if (!$this->gallery) {
    //         return [];
    //     }
        
    //     return array_map(function ($image) {
    //         if (str_starts_with($image, 'http')) {
    //             return $image;
    //         }
    //         return asset('storage/' . $image);
    //     }, $this->gallery);
    // }
    public function getGalleryUrlsAttribute()
    {
        $gallery = $this->gallery;
        // Jika gallery kosong, kembalikan array kosong
        if (empty($gallery)) {
            return [];
        }

        // Jika gallery sudah dalam bentuk array
        if (is_array($gallery)) {
            return array_map(function ($image) {
                if (empty($image)) {
                    return null;
                }

                if (str_starts_with($image, 'http') || str_starts_with($image, 'https://')) {
                    return $image;
                }
                // return asset('storage/' . $image);
                return asset($image);
            }, array_filter($gallery));
        }

        // Jika gallery dalam bentuk string JSON
        // if (is_string($gallery)) {
        //     $decoded = json_decode($gallery, true);
        //     if (is_array($decoded)) {
        //         return array_map(function ($image) {
        //             if (empty($image)) {
        //                 return null;
        //             }

        //             if (str_starts_with($image, 'http')) {
        //                 return $image;
        //             }
        //             return asset('storage/' . $image);
        //         }, array_filter($decoded));
        //     }
        // }

        if (is_string($gallery)) {
            $decoded = json_decode($gallery, true);
            if (is_array($decoded)) {
                return array_map(function ($image) {
                    if (empty($image)) return null;
                    if (str_starts_with($image, 'http')) return $image;
                    return asset($image);
                }, array_filter($decoded));
            }
        }

        return [];

        // Jika gallery dalam bentuk string biasa (misalnya path file tunggal)
        // if (is_string($gallery) && !empty($gallery)) {
        //     if (str_starts_with($gallery, 'http')) {
        //         return [$gallery];
        //     }
        //     return [asset('storage/' . $gallery)];
        // }
        // return [];
    }

    /**
     * Get project duration
     */
    public function getDurationAttribute()
    {
        if ($this->status === 'in_progress') {
            return $this->start_date?->format('M Y') . ' - Present';
        }
        
        if ($this->start_date && $this->end_date) {
            return $this->start_date->format('M Y') . ' - ' . $this->end_date->format('M Y');
        }
        
        if ($this->start_date) {
            return $this->start_date->format('M Y');
        }
        
        return 'N/A';
    }

    /**
     * Get status badge
     */
    public function getStatusBadgeAttribute()
    {
        $statusColors = [
            'completed' => 'bg-green-100 text-green-800',
            'in_progress' => 'bg-blue-100 text-blue-800',
            'planned' => 'bg-yellow-100 text-yellow-800',
            'on_hold' => 'bg-red-100 text-red-800',
        ];
        
        $statusLabels = [
            'completed' => 'Completed',
            'in_progress' => 'In Progress',
            'planned' => 'Planned',
            'on_hold' => 'On Hold',
        ];
        
        $color = $statusColors[$this->status] ?? 'bg-gray-100 text-gray-800';
        $label = $statusLabels[$this->status] ?? ucfirst($this->status);
        
        return "<span class='px-2 py-1 text-xs font-medium rounded-full {$color}'>{$label}</span>";
    }

    /**
     * Get complexity badge
     */
    public function getComplexityBadgeAttribute()
    {
        $complexityColors = [
            'beginner' => 'bg-green-100 text-green-800',
            'intermediate' => 'bg-blue-100 text-blue-800',
            'advanced' => 'bg-purple-100 text-purple-800',
            'expert' => 'bg-red-100 text-red-800',
        ];
        
        $label = ucfirst($this->complexity);
        $color = $complexityColors[$this->complexity] ?? 'bg-gray-100 text-gray-800';
        
        return "<span class='px-2 py-1 text-xs font-medium rounded-full {$color}'>{$label}</span>";
    }

    /**
     * Get formatted budget
     */
    public function getFormattedBudgetAttribute()
    {
        if (!$this->budget) {
            return 'Not specified';
        }
        
        $currencySymbols = [
            'USD' => '$',
            'EUR' => '€',
            'GBP' => '£',
            'IDR' => 'Rp',
        ];
        
        $symbol = $currencySymbols[$this->budget_currency] ?? $this->budget_currency;
        
        return number_format($this->budget, 0, ',', '.') . ' ' . $symbol;
    }

    /**
     * Get technologies as string
     */
    public function getTechnologiesStringAttribute()
    {
        return $this->technologies ? implode(', ', $this->technologies) : '';
    }

    /**
     * Increment view count
     */
    public function incrementViewCount()
    {
        $this->increment('view_count');
    }

    /**
     * Get the route key for the model.
     * Menggunakan slug sebagai route key
     */
    public function getRouteKeyName()
    {
        return 'id';
    }

    /**
     * Scope untuk project yang bisa dilihat
     */
    public function scopeVisible($query, $user = null)
    {
        if ($user && $this->isAdminUser($user)) {
            return $query;
        }
        
        return $query->where('is_published', true);
    }

    /**
     * Cek apakah user adalah admin
     */
    private function isAdminUser($user)
    {
        // Cek jika user memiliki property is_admin
        if (property_exists($user, 'is_admin') && $user->is_admin === true) {
            return true;
        }
        // Cek berdasarkan email (contoh sederhana)
        $adminEmails = [
            'admin@example.com',
            'administrator@example.com',
            // tambahkan email admin lainnya
        ];
        
        return in_array($user->email, $adminEmails);
        
        // Jika menggunakan spatie/laravel-permission:
        // return $user->hasRole('admin');
    }

    /**
 * Get technologies as array
 */
public function getTechnologiesAttribute($value)
{
    if (is_array($value)) {
        return $value;
    }
    
    $decoded = json_decode($value, true);
    return is_array($decoded) ? $decoded : [];
}
// public function getTechnologiesAttribute($value) {
//     return $this->ensureArray($value);
// }

/**
 * Set technologies attribute
 */
public function setTechnologiesAttribute($value)
{
    if (is_array($value)) {
        $this->attributes['technologies'] = json_encode(array_filter($value));
    } elseif (is_string($value)) {
        $this->attributes['technologies'] = $value;
    } else {
        $this->attributes['technologies'] = json_encode([]);
    }
}

// Do the same for categories, meta_keywords, gallery, team_members, collaborators
public function getCategoriesAttribute($value)
{
    if (is_array($value)) {
        return $value;
    }
    
    $decoded = json_decode($value, true);
    return is_array($decoded) ? $decoded : [];
}

public function setCategoriesAttribute($value)
{
    if (is_array($value)) {
        $this->attributes['categories'] = json_encode(array_filter($value));
    } elseif (is_string($value)) {
        $this->attributes['categories'] = $value;
    } else {
        $this->attributes['categories'] = json_encode([]);
    }
}

public function getMetaKeywordsAttribute($value)
{
    if (is_array($value)) {
        return $value;
    }
    
    $decoded = json_decode($value, true);
    return is_array($decoded) ? $decoded : [];
}

public function setMetaKeywordsAttribute($value)
{
    if (is_array($value)) {
        $this->attributes['meta_keywords'] = json_encode($value);
    } elseif (is_string($value)) {
        $this->attributes['meta_keywords'] = json_encode(array_map('trim', explode(',', $value)));
    } else {
        $this->attributes['meta_keywords'] = json_encode([]);
    }
}
}
