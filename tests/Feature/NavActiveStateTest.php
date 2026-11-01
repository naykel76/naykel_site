<?php

use Dom\HTMLDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Naykel\Gotime\Components\Nav;

test('matches active links without activating empty parent URLs', function (string $path, string $url, bool $expected) {
    app()->instance('request', Request::create($path));

    expect((new Nav)->isActive($url))->toBe($expected);
})->with([
    'Home on homepage' => ['/', '/', true],
    'Home on another page' => ['/about', '/', false],
    'empty parent on homepage' => ['/', '', false],
    'empty parent on another page' => ['/about', '', false],
    'matching path' => ['/about/team', '/about/team', true],
    'nonmatching path' => ['/about/team', '/contact', false],
    'path without leading slash' => ['/about/team', 'about/team', true],
]);

test('renders a parent toggle with a usable active class and button type', function (bool $active) {
    $html = Blade::render(
        '<form><x-gotime::nav.partials.parent-button label="Courses" :active="$active" :icon="null" :iconType="null" iconClass="" /></form>',
        ['active' => $active],
    );

    $document = HTMLDocument::createFromString('<!DOCTYPE html><html><head><title>Nav</title></head><body>' . $html . '</body></html>');
    $button = $document->getElementsByTagName('button')->item(0);

    expect($button->getAttribute('type'))->toBe('button');
    expect($button->getAttribute('class'))->toBe($active ? 'active' : '');
    expect($button->getAttribute('x-on:click'))->toBe('open = !open');
    expect($button->getAttribute(':aria-expanded'))->toBe('open');
    expect(trim($button->textContent))->toBe('Courses');
})->with([true, false]);

test('renders the parent icon and chevron without duplication', function () {
    $html = Blade::render('<x-gotime::nav.partials.parent-button label="Courses" :active="false" icon="home" :iconType="null" iconClass="" />');

    $document = HTMLDocument::createFromString('<!DOCTYPE html><html><head><title>Nav</title></head><body>' . $html . '</body></html>');

    expect($document->getElementsByTagName('svg')->length)->toBe(2);
});
