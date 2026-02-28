<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'is_active',
        'avatar',
        'phone',
        'position',
        'bio',
        'social_links',
        'website',
        'last_login_at',
        'last_login_ip',
        'last_login_user_agent',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'is_active' => 'boolean',
            'social_links' => 'array',
            'last_login_at' => 'datetime',
        ];
    }
    /**
     * Relationship dengan Projects
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Relationship dengan ContactMessages
     */
    public function contactMessages()
    {
        return $this->hasMany(ContactMessage::class, 'email', 'email');
    }

    /**
     * Scope untuk admin users
     */
    public function scopeAdmin($query)
    {
        return $query->where('is_admin', true);
    }

    /**
     * Scope untuk active users
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get avatar URL
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            if (str_starts_with($this->avatar, 'http')) {
                return $this->avatar;
            }
            return asset('storage/' . $this->avatar);
        }
        
        // Generate avatar dengan inisial
        $name = urlencode($this->name);
        return "https://ui-avatars.com/api/?name={$name}&background=random&color=fff&size=128";
    }

    /**
     * Get initials
     */
    public function getInitialsAttribute()
    {
        $words = explode(' ', $this->name);
        $initials = '';
        
        foreach ($words as $word) {
            if (isset($word[0])) {
                $initials .= strtoupper($word[0]);
            }
        }
        
        return substr($initials, 0, 2);
    }

    /**
     * Get formatted social links
     */
    public function getFormattedSocialLinksAttribute()
    {
        if (empty($this->social_links)) {
            return [];
        }
        
        $formatted = [];
        $platformIcons = [
            'github' => 'fab fa-github',
            'linkedin' => 'fab fa-linkedin',
            'twitter' => 'fab fa-twitter',
            'facebook' => 'fab fa-facebook',
            'instagram' => 'fab fa-instagram',
            'youtube' => 'fab fa-youtube',
            'dribbble' => 'fab fa-dribbble',
            'behance' => 'fab fa-behance',
            'website' => 'fas fa-globe',
        ];
        
        foreach ($this->social_links as $platform => $url) {
            $formatted[] = [
                'platform' => $platform,
                'url' => $url,
                'icon' => $platformIcons[$platform] ?? 'fas fa-link',
            ];
        }
        
        return $formatted;
    }

    /**
     * Update last login information
     */
    public function updateLastLogin()
    {
        $this->update([
            'last_login_at' => now(),
            'last_login_ip' => request()->ip(),
            'last_login_user_agent' => request()->userAgent(),
        ]);
    }

    /**
     * Check if user is super admin
     */
    public function isSuperAdmin()
    {
        return $this->is_admin && $this->email === 'admin@example.com';
    }

    /**
     * Get user's full profile
     */
    public function getFullProfileAttribute()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'position' => $this->position,
            'avatar' => $this->avatar_url,
            'initials' => $this->initials,
            'bio' => $this->bio,
            'website' => $this->website,
            'phone' => $this->phone,
            'social_links' => $this->formatted_social_links,
            'is_admin' => $this->is_admin,
            'is_active' => $this->is_active,
            'last_login' => $this->last_login_at ? $this->last_login_at->diffForHumans() : 'Never',
            'created_at' => $this->created_at->format('d M Y'),
        ];
    }
}
