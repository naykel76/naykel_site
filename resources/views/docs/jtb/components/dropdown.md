# Dropdown

<p class="lead">A trigger that opens a floating panel below it, on click or hover with Alpine.js. The panel holds any content, such as text, forms, lists or a <a href="/docs/jtb/components/menu">menu</a>.</p>

## Basic Usage

- `dd` goes on the wrapper. It shrinks to the trigger, so hover and click
  outside only count on the trigger and panel
- `dd-content` goes on the panel. It sits below the trigger, at least as wide
  as the trigger and growing with its content up to a max width
- The panel has a box look by default, with a deeper shadow. Add `pxy-0` for
  content that sets its own padding, like a menu
- Alpine.js opens and closes the panel. It closes on an outside click or
  `Escape`, and `x-cloak` hides it until Alpine starts

```html +demo-folded class="bx example-jtb"
<div class="dd" x-data="{ open: false }" x-on:click.outside="open = false" x-on:keydown.escape="open = false">
    <button class="btn" x-on:click="open = ! open" x-bind:aria-expanded="open">
        Options
        <svg class="wh-1" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path x-show="open" d="m6 15 6-6 6 6" />
            <path x-show="!open" d="m6 9 6 6 6-6" />
        </svg>
    </button>
    <div x-show="open" x-transition x-cloak class="dd-content">
        <p class="font-semibold">Dropdown content</p>
        <p class="txt-muted">The panel holds anything. Text, forms, lists or a menu.</p>
    </div>
</div>
```

## Quick Reference

### Open on Hover

Add `mouseenter` and `mouseleave` to the wrapper. Keep the button's click and
the outside click so keyboard and touch users can still open and close it.

```html +demo-folded class="bx example-jtb"
<div class="dd" x-data="{ open: false }" x-on:mouseenter="open = true" x-on:mouseleave="open = false" x-on:click.outside="open = false" x-on:keydown.escape="open = false">
    <button class="btn" x-on:click="open = ! open" x-bind:aria-expanded="open">
        Options
        <svg class="wh-1" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path x-show="open" d="m6 15 6-6 6 6" />
            <path x-show="!open" d="m6 9 6 6 6-6" />
        </svg>
    </button>
    <div x-show="open" x-transition x-cloak class="dd-content">
        <p class="font-semibold">Dropdown content</p>
        <p class="txt-muted">The panel holds anything. Text, forms, lists or a menu.</p>
    </div>
</div>
```

## SCSS Variables

| Variable                  | Default         | Description         |
| ------------------------- | --------------- | ------------------- |
| `$dropdown-bg`            | `$bx-bg`        | Panel background    |
| `$dropdown-border-color`  | `$border-color` | Panel border colour |
| `$dropdown-border-radius` | `$radius-lg`    | Panel corner radius |
| `$dropdown-padding`       | `$bx-padding`   | Panel padding       |
| `$dropdown-max-width`     | `20rem`         | Panel max width     |

See [Variable System](/docs/jtb/variable-system) for override instructions.

## Utility Examples

- `relative` on the wrapper anchors the panel to the trigger
- `absolute top-full left-0` places the panel below the trigger, aligned to its
  start edge
- `z-high` lifts the panel above surrounding content
- The toggle uses Alpine.js. It closes on an outside click or `Escape`

```html +demo-folded class="bx example-utils"
<div class="relative inline-flex" x-data="{ open: false }" x-on:click.outside="open = false" x-on:keydown.escape="open = false">
    <button class="btn" x-on:click="open = ! open" x-bind:aria-expanded="open">
        Options
        <svg class="wh-1" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path x-show="open" d="m6 15 6-6 6 6" />
            <path x-show="!open" d="m6 9 6 6 6-6" />
        </svg>
    </button>
    <div x-show="open" x-transition class="absolute top-full left-0 mt-025 z-high min-w-16 bg-white bdr rounded-lg shadow-lg pxy-1 txt-sm">
        <p class="font-semibold">Dropdown content</p>
        <p class="txt-muted">The panel holds anything. Text, forms, lists or a menu.</p>
    </div>
</div>
```
