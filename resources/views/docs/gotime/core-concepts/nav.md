# Nav Component

<p class="lead">Render navigation menus from your JSON configuration.</p>

## Basic Usage

By default, the component looks for `nav-main.json` in `resources/navs/` and
renders the `main` menu.

The examples use this application's `nav-demo.json`. Nav renders the
menu; it does not register routes. Any named routes in the file must already
exist, either through Laravel routes or Gotime's `RouteBuilder`.

See [Nav JSON Configuration](nav-json-configuration) for the file structure,
required item properties and route-generation settings.

Set `filename` to render a different file or `menuname` to render a different
menu from the same file.

```html +demo preview-class="bx"
<x-gt-nav filename="nav-demo" />
```

## Customization

Use props to change how the menu is rendered.

### Icons

Enable top-level icons from the JSON configuration with `withIcons`:

```html +demo-folded class="bx"
<x-gt-nav filename="nav-demo" withIcons />
```

### Layout Context

The built-in `collapse` layout is the default choice for stacked or sidebar-style
menus.

Use the built-in `dropdown` layout for navbar-style menus where child items
should overlay nearby content instead of pushing it down.

### Navbar Dropdown

Inside an existing `<nav class="navbar">`, replace the hardcoded menu list with:

```html +code-blade
<x-gt-nav filename="nav-demo" layout="dropdown" excludeWrapper class="to-md:hidden" />
```

`excludeWrapper` avoids a second `<nav>` inside the navbar. `class` is merged
onto the top-level `<ul class="menu">`, so `to-md:hidden` preserves the current
desktop-only menu. It does not provide mobile navigation.

Parents with `children` render as toggle buttons, even when they also have a URL.
The layout provides Alpine click, outside-click and Escape bindings, and binds
`aria-expanded` to the open state. This application loads the Alpine collapse
plugin required by `x-collapse`.

The JSON data and rendered markup have been checked. Dropdown appearance,
interaction and keyboard behaviour still need browser verification in the navbar.

### Wrapper and Title

Add a title above the menu or render the list without the outer `<nav>` wrapper:

```html +demo-folded class="bx"
<x-gt-nav filename="nav-demo" menuTitle="Docs" excludeWrapper />
```

### Custom Layouts

`layout` selects a Blade view rather than a named component variant. Nav first
looks for a local `components.{layout}` view, then
`gotime::components.nav.{layout}`. The built-in choices are `collapse` and
`dropdown`.

## Properties

| Property         | Type   | Default    | Description                                    |
| ---------------- | ------ | ---------- | ---------------------------------------------- |
| `filename`       | string | `nav-main` | Name of JSON file in navs directory            |
| `menuname`       | string | `main`     | Specific menu from JSON file                   |
| `layout`         | string | `collapse` | Built-in layouts are `collapse` and `dropdown` |
| `navClass`       | string | `''`       | CSS classes for `<nav>` element                |
| `open`           | bool   | `false`    | Default state for child menus                  |
| `withIcons`      | bool   | `false`    | Whether to display icons from JSON             |
| `iconClass`      | string | `''`       | CSS class applied to the icon wrapper span     |
| `menuTitle`      | string | `''`       | Optional title displayed above menu            |
| `excludeWrapper` | bool   | `false`    | Render without the `<nav>` wrapper element     |

Other attributes, including `class`, are passed to the menu's top-level `<ul>`.
Use `navClass` for the outer `<nav>`; it has no effect when `excludeWrapper` is
enabled.

## Active Links

Links compare their resolved URL with the current request path. Parent buttons
check their own URL; they do not become active because a child matches.

Two current defects affect active styling. The root URL `/` never matches after
its leading slash is removed, and active parent buttons output an escaped class
attribute. The current Documentation parent has no URL, so the parent-class
defect is not triggered by this application's menu.

## Permissions

Control link visibility with the `permissions` key. It accepts either a single
permission or an array of permissions. Items with no `permissions` key are
always visible.

When a link defines multiple permissions, it renders if the current user has any
of them.

The built-in layouts currently check permissions on top-level items only.
Their shared child-link partial does not check each child's permissions.

> **WARNING:** This only controls whether a link is shown in the menu. Protect the
> underlying routes and actions separately.

For example, these entries can be used in a menu's `links` array:

```json +code
[
    {
        "name": "Admin",
        "url": "#",
        "permissions": "access-admin"
    },
    {
        "name": "Webinars",
        "url": "#",
        "permissions": ["access-admin", "view-webinars"]
    }
]
```

## Nested Navigation

The Nav component supports nested items through `children`. See
[Nav JSON Configuration](nav-json-configuration) for the full JSON schema
including nested items and importing menus.

The built-in layouts render one level of child links. They do not recursively
render further nested menus.

```json +code
{
    "main": {
        "links": [
            {
                "name": "Products",
                "exclude_route": true,
                "children": [
                    {
                        "name": "Laptops",
                        "route_name": "products.laptops"
                    },
                    {
                        "name": "Smartphones",
                        "route_name": "products.smartphones"
                    }
                ]
            }
        ]
    }
}
```

## Importing Menus

See [Nav JSON Configuration](nav-json-configuration) for the full import syntax
including filtering, searching, and adding manual links.

<!-- adding links manually? -->
