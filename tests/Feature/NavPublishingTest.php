<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Naykel\Gotime\GotimeServiceProvider;

test('publishes only the main nav templates and preserves existing edits', function () {
    $disk = Storage::fake('nav-publishing');
    $publishes = ServiceProvider::$publishes;
    $groups = ServiceProvider::$publishGroups;

    try {
        foreach (ServiceProvider::pathsToPublish(GotimeServiceProvider::class, 'gotime-nav') as $source => $destination) {
            $relativePath = substr($destination, strlen(resource_path('views')) + 1);
            $isolatedDestination = $disk->path($relativePath);
            ServiceProvider::$publishes[GotimeServiceProvider::class][$source] = $isolatedDestination;
            ServiceProvider::$publishGroups['gotime-nav'][$source] = $isolatedDestination;
        }

        $this->artisan('vendor:publish', ['--tag' => 'gotime-nav', '--no-interaction' => true])
            ->assertSuccessful();

        $files = $disk->allFiles('components/nav');
        sort($files);

        expect($files)->toBe([
            'components/nav/collapse.blade.php',
            'components/nav/dropdown.blade.php',
            'components/nav/simple.blade.php',
        ]);

        $disk->put('components/nav/simple.blade.php', '<p>My customised menu</p>');

        $this->artisan('vendor:publish', ['--tag' => 'gotime-nav', '--no-interaction' => true])
            ->assertSuccessful();

        expect($disk->get('components/nav/simple.blade.php'))->toBe('<p>My customised menu</p>');
    } finally {
        ServiceProvider::$publishes = $publishes;
        ServiceProvider::$publishGroups = $groups;
    }
});
