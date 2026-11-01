# Nav Component

```html +preview
<x-gt-nav layout="simple" />
```

<p class="lead">Render JSON navigation data using a built-in menu layout or
custom Blade markup.</p>

## Basic Usage

Add this where you want the menu to appear. It displays your main navigation
links from `resources/navs/nav-main.json` as a vertical list.

```html +code-blade
<x-gt-nav />
```

**Example output**

```html +preview preview-class="bx"
<x-gt-nav filename="nav-demo" />
```

To change the links, see
[Nav JSON Configuration](/docs/gotime/core-concepts/nav-json-configuration).

## Customising the Menu

### Choose a Navigation File

Use `filename` to load a different navigation file. Leave off the `.json`
extension. For example, this reads the `main` menu from your
`resources/navs/nav-admin.json` file:

```html +code-blade
<x-gt-nav filename="nav-admin" />
```

### Choose a Menu

A navigation file can contain several named menus. Add `menuname` to choose
one instead of the default `main` menu. Keeping the same file, this selects
its `reports` menu:

```html +code-blade
<x-gt-nav filename="nav-admin" menuname="reports" />
```

### Icons

Add `withIcons` to display the icons defined in your navigation file.

```html +code-blade
<x-gt-nav withIcons />
```

**Example output**

```html +preview preview-class="bx"
<x-gt-nav filename="nav-demo" withIcons />
```

### Child Menus

A menu item can contain child links. By default, clicking the parent expands
those links beneath it. Define the links using `children` in your
[navigation JSON](/docs/gotime/core-concepts/nav-json-configuration).

#### Collapse (Default)

No extra property is needed. Child links expand within the list, making this
suited to vertical navigation.

```html +code-blade
<x-gt-nav />
```

**Example output**

```html +preview preview-class="bx"
<x-gt-nav filename="nav-demo" menuname="nested" />
```

#### Dropdown

Add `layout="dropdown"` to display child links in an overlay below their parent.
This is primarily used in a navbar; use collapse for a vertical menu.

```html +code-blade
<x-gt-nav layout="dropdown" />
```

**Example output**

```html +preview preview-class="bx"
<nav class="navbar">
    <x-gt-nav filename="nav-demo" menuname="nested" layout="dropdown" excludeWrapper />
</nav>
```

Both options use Alpine for opening and closing child menus. Collapse also
requires Alpine's collapse plugin. Dropdown closes on an outside click or
Escape. For the navbar composition and `excludeWrapper`, see the
[Nav Design Guide](/docs/gotime/guides/nav-design-guide).

### Menu Title

Add `menuTitle` to display a heading above the menu.

```html +code-blade
<x-gt-nav menuTitle="Main Menu" />
```

**Example output**

```html +preview preview-class="bx"
<x-gt-nav filename="nav-demo" menuTitle="Main Menu" />
```

## Properties

| Property         | Type   | Default    | Purpose                                                 |
| ---------------- | ------ | ---------- | ------------------------------------------------------- |
| `filename`       | string | `nav-main` | JSON filename in `resources/navs/`, without `.json`     |
| `menuname`       | string | `main`     | Menu group within the JSON file                         |
| `layout`         | string | `collapse` | Built-in layout or local layout view                    |
| `navClass`       | string | `''`       | Classes for the outer `<nav>`                           |
| `open`           | bool   | `false`    | Initial open state for child menus                      |
| `withIcons`      | bool   | `false`    | Display icons on top-level items                        |
| `iconClass`      | string | `''`       | Classes for the icon-label wrapper when an icon renders |
| `menuTitle`      | string | `''`       | Title displayed above the menu                          |
| `excludeWrapper` | bool   | `false`    | Omit the outer `<nav>`, retaining the title and content |

The rendering props describe the built-in layouts. Custom layouts must implement
support for the props they use.

Other attributes, including `class`, are merged onto the built-in layout's
`<ul class="menu">`. Use `navClass` to style its outer `<nav>`; it has no effect
when `excludeWrapper` is enabled.

## How It Works

1. Nav loads the selected JSON file and menu group.
2. Gotime prepares the items, resolving URLs and normalizing fields such as
   icons, permissions and children.
3. Nav passes the resulting `$menuItems` collection, its props and callable
   methods such as `$isActive($url)` to the selected Blade layout.
4. The layout renders the items and composes any supporting components it needs.

Nav renders menus; it does not register routes. Named routes must already exist,
through Laravel routes or Gotime's `RouteBuilder`.

The built-in layouts are `simple` for a flat text list, `collapse` for expanding
child menus, and `dropdown` for child-menu overlays.

`layout` selects a view. For `layout="simple"`, Nav first looks for
`resources/views/components/nav/simple.blade.php`, then uses Gotime's supplied
layout if no local copy exists. The component call stays the same in both cases.

Custom layouts can live anywhere under `components`. For example,
`layout="nav-custom"` selects `resources/views/components/nav-custom.blade.php`.
Nav checks `components.nav.{layout}`, then `components.{layout}`, then the
package nav layout. Use descriptive names to avoid selecting an unrelated view.
No additional component registration is needed.

## Customising an Existing Layout

To edit a supplied layout, publish Gotime's three menu templates into your
application:

```bash +code
php artisan vendor:publish --tag=gotime-nav --no-interaction
```

This copies `simple.blade.php`, `collapse.blade.php` and `dropdown.blade.php`
to `resources/views/components/nav/`. The shared base and partials stay in
Gotime. To change one of those pieces, replace its call in your local template
with your own markup or component.

For the simple layout, edit
`resources/views/components/nav/simple.blade.php`. Keep the same
component call:

```html +code-blade
<x-gt-nav layout="simple" />
```

Nav uses your local copy instead of the package layout. Existing files
are kept when publishing again; package updates do not automatically update
your copies.

This replaces a supplied layout locally. A separately named view such as
`resources/views/components/nav-custom.blade.php`, selected with
`layout="nav-custom"`, creates a different layout instead.

## Building a Custom Layout

Use the built-in layouts for normal use. When you need a custom layout,
`nav.base` is available as an extension point so you can reuse the shared
wrapper behaviour. You can also supply your own markup.

This follows the approach described in
[Component Architecture](/docs/gotime/core-concepts/component-architecture).

### Shared Wrapper

`<x-gotime::nav.base>` is Gotime's shared navigation wrapper. It renders the
outer `<nav>`, an optional title, and the content supplied through its slot.
It reads `menuTitle` and `excludeWrapper` from the parent Nav component.

The layout passes `navClass` to the base's `class` attribute. For example,
a flat layout can compose the base like this:

```html +code-blade
<x-gotime::nav.base :class="$navClass">
    <ul {{ $attributes->merge(['class' => 'menu']) }}>
        @foreach ($menuItems as $item)
            <li>
                <a href="{{ $item->url }}">{{ $item->name }}</a>
            </li>
        @endforeach
    </ul>
</x-gotime::nav.base>
```

The base handles the wrapper; the layout handles the list and its items.
JTB's `menu` class supplies list styling. This flat example does not implement
icons, permission filtering or child menus.

### Supporting Pieces

The built-in layouts reuse these pieces:

| Piece                        | Responsibility                                          |
| ---------------------------- | ------------------------------------------------------- |
| `nav.base`                   | Outer wrapper and optional menu title                   |
| `nav.partials.item-link`     | A top-level link with active styling and optional icon  |
| `nav.partials.parent-button` | A parent toggle with its label and chevron              |
| `nav.partials.children`      | One level of child links                                |
| `icon-label`                 | Label text with an optional icon                        |
| `chevron-toggle`             | Chevron paths controlled by the parent's Alpine state   |

The layout provides the loop, permission checks and Alpine state. The base
wrapper does not supply those behaviours.

### Using an Existing Container

Use `excludeWrapper` when your page already provides a navigation container,
such as a navbar. It removes Nav's outer `<nav>`, leaving the menu list inside
your existing container.

```html +code-blade
<nav class="navbar">
    <x-gt-nav excludeWrapper />
</nav>
```

### Using Your Own Wrapper

`nav.base` is optional. A custom layout can render its own `<nav>`, another
container, or just a list while still using Nav's prepared data.

If you replace the base, your layout must handle any wrapper behaviour you
need, including `menuTitle`, `navClass` and `excludeWrapper`. Those props do not
change your markup automatically.

To build a custom layout progressively using `nav.base`, follow the
[Nav Design Guide](/docs/gotime/guides/nav-design-guide).

## Important Limits

`simple` renders top-level text links only. It does not apply permission checks,
icons, active styling or child-menu controls. It still supports the base wrapper,
title and list attributes.

The following limits apply to `collapse` and `dropdown`:

- Parents toggle their children; their own URLs are not clickable links.
- Only parents and one level of children render.
- Icons and permission checks apply to top-level items only. Protect destination
  routes separately.
- A matching child does not activate its parent.

For permissions, nesting, imports and manual links, see
[Nav JSON Configuration](/docs/gotime/core-concepts/nav-json-configuration)
for configuration details.

<!-- adding links manually? -->
