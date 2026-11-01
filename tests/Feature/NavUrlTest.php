<?php

use Illuminate\Support\Facades\Route;
use Illuminate\View\ComponentAttributeBag;
use Naykel\Gotime\DTO\NavDTO;
use Naykel\Gotime\DTO\NavItemDTO;

test('preserves explicit menu URLs', function (string $url) {
    $item = new NavItemDTO((object) ['name' => 'Link', 'url' => $url]);

    expect($item->url)->toBe($url);
})->with([
    'home' => '/',
    'root-relative path' => '/about',
    'root-relative anchor' => '/#jtb',
    'dotted path' => '/files/report.pdf',
    'query string' => '/search?q=version.2&sort=name',
    'fragment' => '#installation',
    'page-relative path' => 'about',
    'dot notation is not a route name' => 'about.team',
    'external URL' => 'https://example.com/docs/v1.2',
    'protocol-relative URL' => '//example.com/docs',
    'email link' => 'mailto:hello@example.com',
    'telephone link' => 'tel:+61123456789',
]);

test('renders root-relative links unchanged on a nested page', function () {
    Route::get('/navigation-test/nested/page', function () {
        $menu = new NavDTO((object) ['links' => [
            (object) ['name' => 'About', 'url' => '/about'],
            (object) ['name' => 'JTB', 'url' => '/#jtb'],
        ]], 'main');

        return view('gotime::components.nav.simple', [
            'menuItems' => $menu->menuItems,
            'navClass' => '',
            'attributes' => new ComponentAttributeBag,
        ]);
    });

    $this->get('/navigation-test/nested/page')
        ->assertOk()
        ->assertSee('href="/about"', false)
        ->assertSee('href="/#jtb"', false);
});

test('named routes still take precedence over local menu URLs', function () {
    Route::get('/navigation-test/team', fn() => 'Team')->name('navigation-test.team');
    Route::getRoutes()->refreshNameLookups();

    $item = new NavItemDTO((object) [
        'name' => 'Team',
        'route_name' => 'navigation-test.team',
        'url' => '/ignored',
    ]);

    expect($item->url)->toBe('/navigation-test/team');
});

test('external menu URLs still take precedence over route names', function () {
    $item = new NavItemDTO((object) [
        'name' => 'External docs',
        'route_name' => 'unregistered.external-docs',
        'url' => 'https://example.com/docs',
    ]);

    expect($item->url)->toBe('https://example.com/docs');
});
