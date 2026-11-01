# Nav Design Guide

<p class="lead">Build a navigation layout with Gotime's <a href="/docs/gotime/components/nav">Nav component</a>,
starting with its structure and then connecting menu data. Add child menus,
icons or permission filtering as needed.</p>

This guide builds a separate layout. To edit a supplied package layout instead,
see [Customising an Existing Layout](/docs/gotime/components/nav).

## Create the Menu Structure

Create a Blade view for your navigation layout, for example
`resources/views/components/nav-custom.blade.php`. Start with one hardcoded link:

```html +code-blade
<x-gotime::nav.base :class="$navClass">
    <ul {{ $attributes->merge(['class' => 'menu']) }}>
        <li>
            <a href="#">Home</a>
        </li>
    </ul>
</x-gotime::nav.base>
```

- `nav.base` provides the outer navigation wrapper.
- `<ul>` contains the menu items. JTB's `menu` class styles the list.
- `<li>` contains one item. Its `<a>` supplies the destination and label.

Add this call where you want to display the menu:

```html +code-blade
<x-gt-nav filename="nav-demo" layout="nav-custom" />
```

`layout="nav-custom"` selects your view under `components/`. At this point,
the Home link comes directly from your markup; it is not using the JSON items.
Keep this component call as you develop the layout. The previews below use
sample data to show each change.

## Render the Menu Data

Nav gives your layout access to all items in the selected menu through
`$menuItems`. Replace the hardcoded `<li>...</li>` inside your `<ul>` with:

```html +code-blade
@foreach ($menuItems as $item)
    <li>
        <a href="{{ $item->url }}">{{ $item->name }}</a>
    </li>
@endforeach
```

`@foreach` renders the enclosed markup once for each item. `$item` is the
current item; its `url` supplies the destination and its `name` supplies the label.
Keep the existing `nav.base` and `<ul>` around the loop.

Your layout now displays the links from `nav-demo.json`:

```html +preview preview-class="bx"
<x-gt-nav filename="nav-demo" layout="simple" />
```

## Customise Your Menu

Each option below builds on the data-driven menu. Choose only the features you
need. Keep the wrapper and list container; replace the indicated markup inside.
Continue building your custom layout.

### Child Menus

Use collapse for a vertical menu: child links expand within the list. Dropdowns
open over the page and are primarily used in a navbar.

To display child menus, add a `children` array to your menu's JSON data; see
[Nav JSON Configuration](/docs/gotime/core-concepts/nav-json-configuration).

#### Collapse

In your custom layout, replace the entire `@foreach ... @endforeach` block with:

```html +code-blade
@foreach ($menuItems as $item)
    @if ($item->hasChildren)
        <li x-data="{ open: @js($open) }">
            <x-gotime::nav.partials.parent-button :label="$item->name" :active="false" />
            <ul x-show="open" x-collapse>
                @include('gotime::components.nav.partials.children', ['children' => $item->children])
            </ul>
        </li>
    @else
        <li>
            <a href="{{ $item->url }}">{{ $item->name }}</a>
        </li>
    @endif
@endforeach
```

`hasChildren` chooses between a parent button and a normal link. The parent
button opens its child list. This reuses Gotime's parent-button and child-link
pieces; icons and permission filtering are independent options.

Your custom layout now supports expandable child menus:

```html +preview preview-class="bx"
<x-gt-nav filename="nav-demo" menuname="nested" layout="nav-custom" />
```

Alpine and its collapse plugin handle opening and closing. Add `open` to start
with the children visible. The shared child-link partial renders one level of
children and uses Nav's active-link helper.

Collapse is also Gotime's default layout. See
[Nav](/docs/gotime/components/nav) for the supplied layout's options.

#### Dropdown

For a navbar, Gotime's supplied `dropdown` layout opens child links in a floating
panel below the parent. Use `excludeWrapper` because the navbar already provides
the outer `<nav>`:

```html +code-blade
<nav class="navbar">
    <x-gt-nav layout="dropdown" excludeWrapper />
</nav>
```

**Example output**

```html +preview preview-class="bx"
<nav class="navbar">
    <x-gt-nav filename="nav-demo" menuname="nested" layout="dropdown" excludeWrapper />
</nav>
```

### Icons

In your custom layout, replace the link's `<a>...</a>` element with:

```html +code-blade
<a href="{{ $item->url }}">
    <x-gotime::icon-label
        :label="$item->name"
        :icon="$withIcons ? $item->icon : null"
        :icon-type="$withIcons ? $item->iconType : null"
        :class="$iconClass" />
</a>
```

The icon-label component shows the item's name and, when `withIcons` is enabled,
its icon. Add `withIcons` to your component call to enable it. The loop and `<li>`
remain unchanged.

```html +preview preview-class="bx"
<x-gt-nav filename="nav-demo" layout="icons" withIcons />
```

### Permissions

In your custom layout, wrap the link's `<li>...</li>` element in a permission check:

```html +code-blade
@canany($item->permissions)
    <li>
        <a href="{{ $item->url }}">{{ $item->name }}</a>
    </li>
@endcanany
```

The loop still visits every item; `@canany` decides whether to display it.

```html +preview preview-class="bx"
<x-gt-nav filename="nav-demo" layout="permissions" />
```

To try filtering, temporarily add `"permissions": "access-admin"` to the About
item in `nav-demo.json`. It should be hidden from a guest. Remove the temporary
property afterward.

Checking the permitted state needs an authenticated user whose existing rules
grant the ability. Menu filtering does not protect the destination's route.

To combine these options, use the relevant parts in the same layout. Gotime's
built-in `collapse` and `dropdown` layouts already combine child menus,
optional icons, top-level permission checks and active styling. See
[Nav](/docs/gotime/components/nav) for their behaviour and current limits.
