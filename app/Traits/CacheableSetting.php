<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

trait CacheableSetting
{
    /**
     * Tiempo de caché por defecto en minutos
     */
    protected static $cacheTime = 60;

    /**
     * Prefijo para las claves de caché
     */
    protected static $cachePrefix = 'site_settings_';

    /**
     * Obtener una configuración del caché o la base de datos
     */
    public static function getCached($key, $default = null)
    {
        $cacheKey = static::getCacheKey($key);
        
        return Cache::remember($cacheKey, static::$cacheTime, function () use ($key, $default) {
            Log::info("Cache miss for setting: {$key}");
            return static::get($key, $default);
        });
    }

    /**
     * Obtener todas las configuraciones de un grupo del caché o la base de datos
     */
    public static function getGroupCached($group)
    {
        $cacheKey = static::getCacheKey("group_{$group}");
        
        return Cache::remember($cacheKey, static::$cacheTime, function () use ($group) {
            Log::info("Cache miss for setting group: {$group}");
            return static::where('group', $group)->get();
        });
    }

    /**
     * Establecer un valor y actualizar el caché
     */
    public static function setCached($key, $value)
    {
        $setting = static::set($key, $value);
        
        if ($setting) {
            $cacheKey = static::getCacheKey($key);
            Cache::put($cacheKey, $value, static::$cacheTime);
            
            // También invalidamos el caché del grupo
            $groupCacheKey = static::getCacheKey("group_{$setting->group}");
            Cache::forget($groupCacheKey);
            
            Log::info("Cache updated for setting: {$key}");
        }
        
        return $setting;
    }

    /**
     * Limpiar todo el caché de configuraciones
     */
    public static function clearCache()
    {
        $pattern = static::$cachePrefix . '*';
        $keys = Cache::get($pattern);
        
        if ($keys) {
            foreach ($keys as $key) {
                Cache::forget($key);
            }
        }
        
        Log::info('Settings cache cleared');
    }

    /**
     * Generar una clave de caché única
     */
    protected static function getCacheKey($key)
    {
        return static::$cachePrefix . $key;
    }
}
