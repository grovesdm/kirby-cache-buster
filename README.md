# Kirby Cache Buster

A simple Kirby CMS plugin that adds cache busting parameters to your CSS and JS files so style and script changes are immediately visible on deployment.

## Installation

### Manual

1. Download the ZIP file and extract it to `/site/plugins/kirby-cache-buster`
2. Rename the folder if needed

### Git Submodule

```
git submodule add git@github.com:grovesdm/kirby-cache-buster.git src/site/site/plugins/kirby-cache-buster
```

## Configuration

You can configure the plugin in your `config.php` file:

```php
return [
    'slyfox.cache-buster' => [
        'enabled' => true,
        'method' => 'timestamp' // 'timestamp' or 'hash'
    ]
];
```

### Options

- `enabled`: Turn the cache buster on or off (default: `true`)
- `method`: Choose between `timestamp` (file modification time) or `hash` (MD5 hash of file contents)

### Disable in Development

To disable cache busting in your local environment, you can use environment detection:

```php
return [
    'slyfox.cache-buster' => [
        'enabled' => environment() !== 'local'
    ]
];
```

## How It Works

The plugin automatically adds a query parameter to your CSS and JS files:

- For the timestamp method: `style.css?1647288123`
- For the hash method: `script.js?a1b2c3d4e5f6g7h8i9j0`

This forces browsers to download the new version of the file when it changes instead of using the cached version.

## License

MIT

## Author

Daniel and Claude AI