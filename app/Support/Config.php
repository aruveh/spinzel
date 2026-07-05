<?php

declare(strict_types=1);

namespace App\Support;

final class Config
{
    /**
     * Loaded configuration files.
     *
     * @var array<string, array>
     */
    private static array $items = [];

    /**
     * Load a configuration file.
     */
    private static function load(string $file): array
    {
        if (!isset(self::$items[$file])) {

            $path = __DIR__
                . '/../Config/'
                . $file
                . '.php';

            if (!file_exists($path)) {

                throw new \RuntimeException(
                    "Configuration file [{$file}] not found."
                );
            }

            self::$items[$file] = require $path;
        }

        return self::$items[$file];
    }

    /**
     * Get configuration value.
     *
     * Example:
     *
     * Config::get('app.name');
     * Config::get('app.url');
     * Config::get('api.base_url');
     * Config::get('api.timeout');
     */
    public static function get(
        string $key,
        mixed $default = null
    ): mixed {

        $segments = explode('.', $key);

        $file = array_shift($segments);

        $config = self::load($file);

        foreach ($segments as $segment) {

            if (
                !is_array($config) ||
                !array_key_exists($segment, $config)
            ) {
                return $default;
            }

            $config = $config[$segment];
        }

        return $config;
    }

    /**
     * Determine whether a config value exists.
     */
    public static function has(string $key): bool
    {
        return self::get($key) !== null;
    }

    /**
     * Clear cached configuration.
     * Useful during development.
     */
    public static function clear(): void
    {
        self::$items = [];
    }
}