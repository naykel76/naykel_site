<?php

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Storage;
use Naykel\Gotime\Components\Nav;

beforeEach(function () {
    $disk = Storage::fake('nav-layouts-' . md5($this->name()));
    Storage::set('nav-layouts', $disk);
    view()->getFinder()->setPaths([$disk->path('views')]);
});

test('uses layouts from the local nav folder', function (string $layout) {
    Storage::disk('nav-layouts')->put("views/components/nav/{$layout}.blade.php", '<p>Local nav layout</p>');

    $html = Blade::render('<x-gt-nav :layout="$layout" />', ['layout' => $layout]);

    expect($html)->toContain('Local nav layout');
})->with(['simple', 'custom']);

test('falls back to the package nav layout when no local layout exists', function () {
    $nav = new Nav(layout: 'simple');

    expect($nav->render()->name())->toBe('gotime::components.nav.simple');
});

test('supports a custom layout directly under components', function () {
    Storage::disk('nav-layouts')->put('views/components/nav-custom.blade.php', '<p>Standalone nav layout</p>');

    $html = Blade::render('<x-gt-nav layout="nav-custom" />');

    expect($html)->toContain('Standalone nav layout');
});

test('prefers the local nav folder over a general component with the same name', function () {
    Storage::disk('nav-layouts')->put('views/components/nav/simple.blade.php', '<p>Local nav override</p>');
    Storage::disk('nav-layouts')->put('views/components/simple.blade.php', '<p>General component</p>');

    $html = Blade::render('<x-gt-nav layout="simple" />');

    expect($html)->toContain('Local nav override')->not->toContain('General component');
});
