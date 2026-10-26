# Gotime navbar composition review

## Scope Reviewed

- Component review of Gotime dev-main, linked from `../nk_packages/gotime`, with Laravel 13.38.0.
- Traced the navbar partial, Nav renderer, navigation DTOs, dropdown/collapse views, child links, icon-label, chevron, sidebar, and application layout integration.
- Source review only. Browser behaviour, authentication flows, the full import system, and package-wide documentation coverage have not been verified. No implementation or status entries changed.

## Findings

### Medium — The default navbar partial requests a missing view

- **Impact:** A page using the application layout's default navbar partial cannot render unless the application supplies an override.
- **Evidence:** [navbar.blade.php:2](C:/Users/natha/sites/nk_packages/gotime/resources/views/components/layouts/partials/navbar.blade.php:2) passes `layout="navbar"`; [Nav.php:63](C:/Users/natha/sites/nk_packages/gotime/src/Components/Nav.php:63) resolves this to `components.navbar` or `gotime::components.nav.navbar`. Neither exists in the current application/package. The package supplies `collapse` and `dropdown`. The current home page uses the base layout directly, so it does not exercise this failing partial.
- **Fix:** Compose the navbar shell using an existing supported navigation layout, or deliberately provide the missing navbar view.

### Medium — Child navigation links bypass their permissions

- **Impact:** When a visible parent contains restricted children, those links are displayed regardless of each child's permissions; route authorization must still independently protect access.
- **Evidence:** [dropdown.blade.php:10](C:/Users/natha/sites/nk_packages/gotime/resources/views/components/nav/dropdown.blade.php:10) checks the parent, while [children.blade.php:1](C:/Users/natha/sites/nk_packages/gotime/resources/views/components/nav/partials/children.blade.php:1) renders every child without a permission check. The collapse layout uses the same child partial, and NavItemDTO builds each child's permission data.
- **Fix:** Apply the established navigation permission check to each child before rendering it.

### Medium — Closing the sidebar leaves its controls available to keyboard focus

- **Impact:** Users can tab into visually hidden sidebar links and controls after Alpine initializes.
- **Evidence:** [sidebar.blade.php:7](C:/Users/natha/sites/nk_packages/gotime/resources/views/components/sidebar.blade.php:7) hides the panel through translation and opacity only. It has no state-bound `inert`, `hidden`, or `x-show`; the outer `x-cloak` only handles initialization. The default close button and slotted links remain focusable.
- **Fix:** Make the closed panel inert or hidden, and explicitly manage focus when opening and closing it.

## Composition and next step

The existing navbar partial is a navigation-menu wrapper, not the complete
branding/menu/account composition shown in JTB. It hides below `md` without
providing a replacement toggle or sidebar.

Reusable pieces already include the Nav renderer, dropdown/collapse variants,
sidebar with toggle/header/footer slots, icon-label, and chevron. Branding,
guest/account actions, and the burger/sidebar connection still need composing
for this site. Their absence from this partial does not imply they are absent
from the wider package.

Start by resolving the navbar shell and supported menu layout. Review and
integrate the sidebar when adding the burger behaviour. Restricted child-link
handling matters when permission-controlled links enter the composition.
Do not treat this review as requiring completion of every menu capability.

## Maintainability Risk

Moderate. The pieces are modular, but the navbar entry point and available menu
layouts have drifted apart.

## Cross-Boundary Coupling Risk

Moderate. The composition depends on JTB styles, Gotime's Blade/Alpine behaviour,
and application navigation data and routes. Integration still needs browser
verification against the installed assets.
