<?php

namespace App\Core;

class Cache
{
    public static function remember(string $key, int $seconds, callable $callback)
    {
        // Absolute path to cache directory
        $cacheDir = dirname(__DIR__, 2) . '/storage/cache';

        // Ensure cache directory exists
        if (!is_dir($cacheDir)) {
            mkdir($cacheDir, 0775, true);
        }

        $file = $cacheDir . "/{$key}.cache";

        // Return cached value if valid
        if (file_exists($file) && (time() - filemtime($file)) < $seconds) {
            return unserialize(file_get_contents($file));
        }

        // Otherwise compute & cache
        $data = $callback();
        file_put_contents($file, serialize($data));

        return $data;
    }
}
