# Nav JSON Configuration

<p class="lead">The JSON schema behind navigation menus and route generation,
and which properties each system reads.</p>

JSON files live in `resources/navs/`. The `Nav` component and `RouteBuilder`
both read from the same files.

## File Structure

Each file contains one or more named menu groups. Each group has a `links`
array:

```json +code
{
    "main": {
        "links": [
            { "name": "Home", "route_name": "home" },
            { "name": "About", "route_name": "about" }
        ]
    },
    "footer": {
        "links": [
            { "name": "Privacy", "route_name": "privacy" }
        ]
    }
}
```

## Link Properties

The same JSON file is used by both the Nav component and `RouteBuilder`, but
not every property is used by both.

### Shared Properties

These properties are understood by both systems:

| Property      | Purpose                                                                 |
| ------------- | ----------------------------------------------------------------------- |
| `route_name`  | Laravel route name; `RouteBuilder` also derives the URL path and default view path from it, e.g. `about.team` → `/about/team` and `about/team` |
| `url`         | Local path, or an external URL for menu rendering                        |
| `children`    | Nested items                                                            |

For external menu links, set `exclude_route: true` when the file is also read by
`RouteBuilder`. It generates local routes, not routes to external destinations.
When both `route_name` and `url` are supplied, `RouteBuilder` derives its local
path from `route_name`.

### Nav-Only Properties

These properties affect menu rendering and menu imports:

| Property      | Purpose                                                 |
| ------------- | ------------------------------------------------------- |
| `name`        | Display label for a link or parent item. Required for ordinary items; optional for import parents |
| `import`      | Import links from another nav JSON file or menu         |
| `include`     | Include only specific imported links                    |
| `exclude`     | Exclude specific imported links                         |
| `include_any` | Search other menus or the whole file for matching items |
| `other`       | Add manual links alongside an imported menu             |
| `icon`        | Icon name, optionally prefixed with its type, e.g. `brands:gotime` |
| `permissions` | Permission or permission array for top-level visibility |
| `order`       | Integer used for the top-level item's CSS order class   |

The current implementation derives the icon type from `icon`; a separate JSON
`iconType` property is not read. Child links currently render without icon or
permission handling. The built-in layouts render parents and children only.
Grandchildren can still get routes but do not appear in the menu.

### Route-Only Properties

These properties affect how `RouteBuilder` generates routes and resolves views:

| Property               | Purpose                                         |
| ---------------------- | ----------------------------------------------- |
| `exclude_route`        | Skip route creation for this item               |
| `exclude_child_routes` | Skip route creation for this item's descendants |
| `view`                 | Override the default resolved view              |
| `layout`               | Override the layout used for this item          |

`type` is read into the route DTO but is not currently used by `RouteBuilder`
to select content rendering.

`exclude_route` and `exclude_child_routes` work independently. Excluding the
parent's route does not exclude its children; set `exclude_child_routes: true`
to skip route generation for its descendants.

## Nested Items

Add a `children` array to create nested navigation. The parent item does not
need a route — set `exclude_route: true` to skip route generation for it:

```json +code
{
    "name": "Products",
    "exclude_route": true,
    "children": [
        { "name": "Laptops", "route_name": "products.laptops" },
        { "name": "Smartphones", "route_name": "products.smartphones" }
    ]
}
```

## Importing Menus

Import links from one menu file into another to avoid duplication and keep your
navigation DRY. Imports are resolved by the Nav component only — RouteBuilder
skips `import` entries.

**Format:** `"import": "filename.menuname"` or `"import": "filename"`

- **filename** — JSON file (without `.json` extension)
- **menuname** — Optional menu within that file. Without it, all menu groups'
  links are imported unless `include_any` selects matching items.

### Basic Import

```json +code
{
    "import": "nav-docs.components"
}
```

Creates a parent dropdown with all links from the `components` menu in
`nav-docs.json` as children.

**Notes:**

- If both `include` and `exclude` lists are present, `include` takes priority
  and `exclude` is ignored.
- When `include_any` is used alone (without a menu), it searches the entire
  file.
- When `include_any` is used with a menu (e.g., `nav-docs.components`), it
  imports the menu AND searches other menus for additional items.
- Matching is case-insensitive for all filtering operations.
- `include` and `exclude` only apply when a menu is named. They are ignored for
  `"import": "filename"`.
- Use `name` and `icon` on the import entry to set the parent item. Without
  `name`, the label is made from the menu name, e.g. `components` →
  "Components", or from the filename when no menu is named.

For more import patterns and worked examples, see
[Nav Design Guide](../guides/nav-design-guide).
