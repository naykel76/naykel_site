# Nav Design Guide (review)

<p class="lead">Build up a nav from scratch, one concern at a time. Each step
adds exactly one thing so you can see what each feature contributes.</p>

These are templates to create, not installed demo views. To run the examples,
provide `resources/navs/nav-demo.json` with a `main` menu and create each view
under `resources/views/components/examples/` using the corresponding markup.

-------------------------------------------------------------------------------

## Step 1 — Flat List (review)

Loop `$menuItems` and output a link with an active class. Icons are included via
`<x-gotime::icon-label>` — if no icon is set in the JSON, it renders as
text-only, so there is no cost to including it here.

```html +code
<x-gt-nav filename="nav-demo" layout="examples.nav-minimal" withIcons />
```

```html +code
<nav>
    <ul>
        @foreach ($menuItems as $item)
            @php
                $icon = $withIcons && $item->icon ? $item->icon : null;
                $iconType = $withIcons && $item->iconType ? $item->iconType : null;
            @endphp
            <li>
                <a href="{{ $item->url }}" @class(['active' => $isActive($item->url)])>
                    <x-gotime::icon-label :label="$item->name" :$icon :$iconType />
                </a>
            </li>
        @endforeach
    </ul>
</nav>
```

-------------------------------------------------------------------------------

## Step 2 — Permissions (review)

Wrap each item in `@canany` to hide links the current user cannot access. Items
with no `permissions` key in the JSON are always visible.

```html +code
<x-gt-nav filename="nav-demo" layout="examples.nav-permissions" withIcons />
```

```html +code
<nav>
    <ul>
        @foreach ($menuItems as $item)
            @php
                $icon = $withIcons && $item->icon ? $item->icon : null;
                $iconType = $withIcons && $item->iconType ? $item->iconType : null;
            @endphp
            @canany($item->permissions)
                <li>
                    <a href="{{ $item->url }}" @class(['active' => $isActive($item->url)])>
                        <x-gotime::icon-label :label="$item->name" :$icon :$iconType />
                    </a>
                </li>
            @endcanany
        @endforeach
    </ul>
</nav>
```

-------------------------------------------------------------------------------

## Step 3 — Nesting (review)

Add the `hasChildren` branch. Parent items get an Alpine toggle,
`parent-button`, and a `children` partial. Leaf items use the same link as
before. `$order` lets JSON control item sequence independently of array order.

```html +code
<x-gt-nav filename="nav-demo" layout="examples.nav-nesting" withIcons />
```

```html +code
<nav>
    <ul>
        @foreach ($menuItems as $item)
            @php
                $active = $isActive($item->url);
                $order = $item->order ?? $loop->index;
                $icon = $withIcons && $item->icon ? $item->icon : null;
                $iconType = $withIcons && $item->iconType ? $item->iconType : null;
            @endphp
            @canany($item->permissions)
                @if ($item->hasChildren)
                    <li x-data="{ open: @js($open) }" class="order-{{ $order }}">
                        <x-gotime::nav.partials.parent-button :label="$item->name" :$active :$icon :$iconType />
                        <ul x-show="open" x-collapse>
                            @include('gotime::components.nav.partials.children', ['children' => $item->children])
                        </ul>
                    </li>
                @else
                    @include('gotime::components.nav.partials.item-link')
                @endif
            @endcanany
        @endforeach
    </ul>
</nav>
```

This follows the loop used in `collapse.blade.php`. The built-in layouts are
`collapse` and `dropdown`; there is no built-in `navbar` layout. The dropdown
layout adds an overlay wrapper and outside-click/Escape handling.

The shared child-link partial renders one level of links. It currently omits
child permission checks, icons, and further nested menus. Those capabilities
need separate review before relying on them.
