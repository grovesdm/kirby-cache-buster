<?php

/**
 * Kirby Cache Buster Plugin
 *
 * Automatically adds a timestamp or hash to CSS and JS files to prevent browser caching
 * when files are updated.
 */

@include_once __DIR__ . '/vendor/autoload.php';

Kirby::plugin('slyfox/cache-buster', [
    'options' => [
        'enabled' => true,
        'method' => 'timestamp', // 'timestamp' or 'hash'
    ],
    'components' => [
        'css' => function (Kirby $kirby, string $url, $options = null): string {
            // Check if the plugin is enabled in config
            if (option('slyfox.cache-buster.enabled') === false) {
                return $url;
            }

            // Get the relative path
            $relativePath = Url::path($url, false);
            $fileRoot = $kirby->root('index') . DIRECTORY_SEPARATOR . $relativePath;

            // Only process files that exist in our project
            if (F::exists($fileRoot)) {
                // Choose the caching method
                $method = option('slyfox.cache-buster.method', 'timestamp');

                if ($method === 'hash' && is_readable($fileRoot)) {
                    // Use MD5 hash of file contents
                    $param = md5_file($fileRoot);
                } else {
                    // Use file modification timestamp
                    $param = F::modified($fileRoot);
                }

                // Add parameter for cache busting
                return url($relativePath . '?' . $param);
            }

            return $url;
        },
        'js' => function (Kirby $kirby, string $url, $options = null): string {
            // Check if the plugin is enabled in config
            if (option('slyfox.cache-buster.enabled') === false) {
                return $url;
            }

            // Get the relative path
            $relativePath = Url::path($url, false);
            $fileRoot = $kirby->root('index') . DIRECTORY_SEPARATOR . $relativePath;

            // Only process files that exist in our project
            if (F::exists($fileRoot)) {
                // Choose the caching method
                $method = option('slyfox.cache-buster.method', 'timestamp');

                if ($method === 'hash' && is_readable($fileRoot)) {
                    // Use MD5 hash of file contents
                    $param = md5_file($fileRoot);
                } else {
                    // Use file modification timestamp
                    $param = F::modified($fileRoot);
                }

                // Add parameter for cache busting
                return url($relativePath . '?' . $param);
            }

            return $url;
        }
    ]
]);