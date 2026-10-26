<header class="site-header" x-data="{ drawerOpen: false }"
    x-on:resize.window="if (window.matchMedia('(min-width: 768px)').matches) $refs.drawer.close()">
    <a class="site-skip" href="#main-content">Skip to content</a>
    <div class="navbar">
        <div class="container">
            <a class="site-brand" href="{{ route('home') }}" aria-label="Naykel home">NAYKEL<span aria-hidden="true">.</span></a>
            <x-gt-nav layout="dropdown" nav-class="to-md:hidden site-navigation" />
            <div class="site-actions">
                <div class="to-md:hidden">
                    @include('components.layouts.partials.account-actions')
                </div>
                <x-gt-button class="md:hidden" aria-label="Open navigation" aria-controls="site-drawer"
                    x-bind:aria-expanded="drawerOpen" x-on:click="$refs.drawer.showModal(); drawerOpen = true">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </x-gt-button>
            </div>
        </div>
    </div>
    <dialog id="site-drawer" x-ref="drawer" class="site-drawer" aria-labelledby="drawer-title"
        x-on:close="drawerOpen = false"
        x-on:click="if ($event.target === $el && ($event.clientX < $el.getBoundingClientRect().left || $event.clientX > $el.getBoundingClientRect().right)) $el.close()">
        <div class="site-drawer-heading">
            <strong id="drawer-title">Navigation</strong>
            <x-gt-button aria-label="Close navigation" x-on:click="$refs.drawer.close()" autofocus>Close</x-gt-button>
        </div>
        <x-gt-nav layout="collapse" :open="true" nav-class="site-drawer-navigation" />
        <div class="site-drawer-actions">
            @include('components.layouts.partials.account-actions')
        </div>
    </dialog>
</header>
