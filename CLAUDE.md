# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Digitree Assets is a Laravel 11 web application for managing digital assets (primarily trees/plants) with location-based tracking, QR code generation, and review systems. Built with PHP 8.2+, TailwindCSS, DaisyUI, and Leaflet.js for mapping.

## Common Commands

```bash
# Install dependencies
composer install
npm install

# Run development servers (both needed)
php artisan serve
npm run dev

# Build for production
npm run build

# Database
php artisan migrate --seed
php artisan storage:link

# Run tests
php artisan test
./vendor/bin/phpunit

# Code formatting
./vendor/bin/pint
```

## Architecture

### Core Domain Models

The application manages assets (trees/plants) with a hierarchical data structure:

- **Assets** (`app/Models/Assets.php`) - Individual assets with location, age, value, code_asset
- **IndexAssets** - Asset type definitions (jenis_aset, nama_lokal)
- **ContentAssets** - Rich content (history, description, benefit, fact, images, videos) linked to IndexAssets
- **Villages** - Location hierarchy (name, kecamatan, kab_kota, province) with soft deletes
- **Reviews** - User reviews with ratings linked by code_asset
- **RecordScans** - QR code scan tracking by code_asset

### Authorization

Uses Laravel Gates defined in `AppServiceProvider`:
- `superadmin` gate checks `user->role === 'Super Admin'`
- Dashboard routes protected by `['auth', 'superadmin']` middleware

### Route Structure

- `/` - Login page
- `/aset` - Public frontend asset resource
- `/dashboard/*` - Admin dashboard (protected)
  - `/dashboard/semua-lokasi` - All locations overview
  - `/dashboard/perlokasi/{id}` - Per-location dashboard
  - `/dashboard/asset/*` - Asset CRUD
  - `/dashboard/lokasi/*` - Location CRUD
  - `/dashboard/statistik/*` - Statistics and reviews
  - `/dashboard/user-role/*` - User management
  - `/dashboard/pemetaan/*` - Mapping
  - `/dashboard/ads/*` - Advertisements
- `/embed-maps` - Embeddable map view
- `/get-embed-token` - Signed URL generation for embeds

### Frontend Stack

- TailwindCSS + DaisyUI for styling
- Alpine.js for interactivity
- Leaflet.js for maps
- jQuery for legacy components
- Vite for bundling

### Key Packages

- `maatwebsite/excel` - Excel import/export
- `phpoffice/phpspreadsheet` - Spreadsheet handling
- `laravel/breeze` - Authentication scaffolding

## Git Workflow

1. Pull from main before pushing
2. Push to your own branch
3. Create PR to merge into main
