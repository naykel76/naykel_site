# Gotime Status

<p class="lead">What Gotime covers, at a glance.</p>

## Status Key

| Label    | Meaning                                |
| -------- | -------------------------------------- |
| `✅`     | Confirmed against source and documented |
| `review` | Documented, not yet confirmed           |
| `n/a`    | Not needed                             |
| blank    | Not started                            |

Status tracks review and documentation coverage. A blank does not mean the
component has not been implemented.

## Navigation

| Component or composition | Status |
| ------------------------ | ------ |
| Navbar                   |        |
| Menu                     | review |
| Dropdown menu            | review |
| Collapsible menu         |        |
| Sidebar                  |        |
| Sidebar toggle           |        |

## Supporting Components

| Component     | Status |
| ------------- | ------ |
| Button        |        |
| Icon label    |        |
| Chevron toggle |       |

## Documentation Files

Tracks each Gotime doc in this application. A doc is confirmed when all its
`(review)` headings are cleared.

| File                                      | Status | Notes                                                        |
| ----------------------------------------- | ------ | ------------------------------------------------------------ |
| `installation.md`                          |        | Carried over with the install; not reviewed here             |
| `core-concepts/component-architecture.md`  | ✅     | Pattern, example, file structure and registration confirmed against the button source |
| [Nav component](components/nav.md) | ✅ | Documentation confirmed, including dropdown navbar composition, publishing and local layout selection. |
| [Nav JSON configuration](core-concepts/nav-json-configuration.md) | ✅     | Properties, nesting and import behaviour confirmed against NavDTO, NavItemDTO, RouteDTO, RouteBuilder and the nav templates. |
| [Nav design guide](guides/nav-design-guide.md) | ✅ | Custom layout walkthrough, child menus, dropdown navbar composition, icons and permissions confirmed. |
