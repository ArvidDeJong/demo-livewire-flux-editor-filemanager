# Demo Livewire Flux Editor Filemanager

Demo project using Laravel 12, Livewire 4, Flux Editor, and UniSharp Laravel Filemanager.

## Features

- Flux editor component: `x-flux-filemanager-editor`
- Laravel Filemanager integration (`/filemanager`)
- Insert, resize, and align images
- Insert file links from the filemanager

## Requirements

- PHP 8.2+
- Composer
- Node.js + npm

## Installation

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run build
```

## Development

```bash
composer run dev
```

Or run services separately:

```bash
php artisan serve
npm run dev
```

## Testing

```bash
composer test
```

## Production Deployment

Run the following commands during deployment:

```bash
composer install --no-dev --optimize-autoloader
npm ci
npm run build
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

If you changed filemanager-related configuration, clear and rebuild caches:

```bash
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Troubleshooting

- **`/filemanager` returns 404**
    - Confirm `config/lfm.php` uses `url_prefix => 'filemanager'`
    - Run: `php artisan config:clear`
    - Check routes: `php artisan route:list | grep -i filemanager`
- **Editor still opens `/laravel-filemanager`**
    - Ensure `config/flux-filemanager.php` uses `url => '/filemanager'`
    - Rebuild assets: `npm run build`
    - Hard refresh browser cache (`Cmd + Shift + R` on macOS)
- **Changes do not appear in Blade/views**
    - Run: `php artisan view:clear && php artisan config:clear`

## Author

Created by **Arvid de Jong**  
Email: info@arvid.nl

## Contributors

- Arvid de Jong (info@arvid.nl)

## Community

- Contribution guidelines: [CONTRIBUTING.md](CONTRIBUTING.md)
- Code of conduct: [CODE_OF_CONDUCT.md](CODE_OF_CONDUCT.md)

## License

This project is licensed under the MIT License. See [LICENSE](LICENSE).
