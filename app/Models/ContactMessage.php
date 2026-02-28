<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'is_spam',
        'ip_address',
        'user_agent',
        'is_read'
    ];

    protected $casts = [
        'is_spam' => 'boolean',
        'is_read' => 'boolean',
        'created_at' => 'datetime',
    ];

     /**
     * Scope untuk pesan yang bukan spam
     */
    public function scopeNotSpam($query) {
        return $query->where('is_spam', false);
    }

    /**
     * Scope untuk pesan spam
     */
    public function scopeSpam($query)
    {
        return $query->where('is_spam', true);
    }

    /**
     * Scope untuk pesan belum dibaca
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope untuk pesan dari IP tertentu
     */
    public function scopeFromIp($query, $ipAddress)
    {
        return $query->where('ip_address', $ipAddress);
    }

    /**
     * Cek apakah pesan dianggap spam otomatis
     */
    public function markAsSpam()
    {
        $this->update(['is_spam' => true, 'is_read' => true]);
    }

    /**
     * Tandai sebagai bukan spam
     */
    public function markAsNotSpam()
    {
        $this->update(['is_spam' => false]);
    }

    /**
     * Tandai sebagai dibaca
     */
    public function markAsRead()
    {
        $this->update(['is_read' => true]);
    }

    /**
     * Get message excerpt (tambahan)
     */
    public function getExcerptAttribute($length = 100)
    {
        if (strlen($this->message) <= $length) {
            return $this->message;
        }
        
        return substr($this->message, 0, $length) . '...';
    }

    /**
     * Get status badge (tambahan)
     */
    public function getStatusBadgeAttribute()
    {
        if ($this->is_spam) {
            return '<span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">Spam</span>';
        }
        
        if ($this->is_read) {
            return '<span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Read</span>';
        }
        
        return '<span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Unread</span>';
    }

    /**
     * Get formatted date (tambahan)
     */
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('M d, Y h:i A');
    }
}
