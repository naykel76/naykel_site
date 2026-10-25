# Installation

Install Gotime, run the installer, then complete app setup in the relevant docs.

## Install the package

To get started, install Gotime using the Composer package manager:

```bash +code
composer require naykel/gotime
```

Next, install Gotime resources by executing the `gotime:install` command:

```bash +code
php artisan gotime:install
```

The installer scaffolds the app for Gotime defaults, including frontend
dependencies, starter files, package stubs, formatting config, and basic project
cleanup.

## Publish Gotime Config (optional)

```bash +code
php artisan gotime:config
```

## Install Frontend Dependencies

After the installer updates `package.json`, install frontend dependencies and
build assets:

```bash +code
npm install
npm run build
```

For local development, use:

```bash +code
npm run dev
```

## Livewire and Alpine

Gotime uses Livewire components for interactive elements and requires Alpine
plugins for collapsible sections and sortable lists.

### Application bundling

Livewire serves its scripts through application routes by default. Gotime's
installer instead configures Livewire and Alpine to load through the application
bundle in `resources/js/app.js`.

The installer provides the following Livewire, Alpine and plugin setup:

```javascript +code
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import collapse from '@alpinejs/collapse';
import sort from '@alpinejs/sort';

Alpine.plugin(collapse);
Alpine.plugin(sort);

Livewire.start();
```

The generated layout uses `@livewireScriptConfig` instead of `@livewireScripts`
to supply configuration while the application bundle loads the scripts:

```html +code-blade
@livewireScriptConfig
```

This prevents Livewire from automatically injecting its scripts while still
providing the necessary configuration.

## Configure Remaining Services

- register RouteBuilder routes in your app routes/bootstrap flow
- configure storage in [Storage](storage.md)
- configure Torchlight on this page
