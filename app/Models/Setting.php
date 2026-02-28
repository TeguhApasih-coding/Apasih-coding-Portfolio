<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'label',
        'description',
        'options',
    ];

    protected $casts = [
        'options' => 'array',
    ];

    const CACHE_KEY = 'app_settings';
    const CACHE_DURATION = 3600; // 1 jam

    /**
     * Get all settings from cache
     */
    public static function getAllSettings()
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_DURATION, function () {
            $settings = self::all()->keyBy('key');
            $result = [];
            
            foreach ($settings as $key => $setting) {
                $result[$key] = self::castValue($setting->value, $setting->type);
            }
            
            return $result;
        });
    }

    /**
     * Get setting value by key
     */
    public static function get($key, $default = null)
    {
        $settings = self::getAllSettings();
        return $settings[$key] ?? $default;
    }

    /**
     * Set setting value
     */
    public static function set($key, $value, $type = 'string', $attributes = [])
    {
        $setting = self::firstOrNew(['key' => $key]);
        
        $setting->value = self::prepareValue($value, $type);
        $setting->type = $type;
        
        foreach ($attributes as $attrKey => $attrValue) {
            if (in_array($attrKey, ['group', 'label', 'description', 'options'])) {
                $setting->$attrKey = $attrValue;
            }
        }
        
        $setting->save();
        Cache::forget(self::CACHE_KEY);
    }

    /**
     * Cast value based on type
     */
    private static function castValue($value, $type)
    {
        switch ($type) {
            case 'boolean':
                return (bool) $value;
            case 'integer':
                return (int) $value;
            case 'float':
                return (float) $value;
            case 'json':
                return json_decode($value, true);
            case 'array':
                return is_array($value) ? $value : explode(',', $value);
            default:
                return (string) $value;
        }
    }

    /**
     * Prepare value for storage
     */
    private static function prepareValue($value, $type)
    {
        switch ($type) {
            case 'boolean':
                return $value ? '1' : '0';
            case 'integer':
            case 'float':
                return (string) $value;
            case 'json':
            case 'array':
                return is_string($value) ? $value : json_encode($value);
            default:
                return (string) $value;
        }
    }

    /**
     * Update multiple settings
     */
    public static function updateMultiple($settings)
    {
        foreach ($settings as $key => $value) {
            if ($setting = self::where('key', $key)->first()) {
                $setting->value = self::prepareValue($value, $setting->type);
                $setting->save();
            }
        }
        
        Cache::forget(self::CACHE_KEY);
    }

    /**
     * Get settings by group
     */
    public static function getByGroup($group)
    {
        return self::where('group', $group)
            ->get()
            ->mapWithKeys(function ($setting) {
                return [$setting->key => self::castValue($setting->value, $setting->type)];
            })
            ->toArray();
    }

    /**
     * Helper methods for common settings
     */
    
    public static function siteName()
    {
        return self::get('site_name', config('app.name'));
    }
    
    public static function siteDescription()
    {
        return self::get('site_description', '');
    }
    
    public static function contactEmail()
    {
        return self::get('contact_email', '');
    }
    
    public static function contactPhone()
    {
        return self::get('contact_phone', '');
    }
    
    public static function socialLinks()
    {
        return self::get('social_links', []);
    }
    
    public static function aboutMe()
    {
        return self::get('about_me', '');
    }

}
