# Component Architecture

<p class="lead">How Gotime names, structures, and registers its components, and
when to reach for a base component or a variant.</p>

## Pattern and Naming Convention

Gotime uses a dot-notation naming pattern with a base/variant structure. This
keeps related components grouped under a shared namespace, makes variants
discoverable by name, and separates reusable logic (base) from opinionated
presentation (variants).

When a component family follows this pattern, it usually exposes three roles:

- a default component for normal use
- a base component for shared structure and behaviour
- one or more named variants for specific use cases

```html +code-blade
<x-gt-button>Save</x-gt-button>                   <!-- Default -->
<x-gt-button.base>Save</x-gt-button.base>         <!-- Base (for composition) -->
<x-gt-button.primary>Save</x-gt-button.primary>   <!-- Variant -->
```

## Base Components

Base components hold the shared markup, structure, and behaviour for a
component family. They are usually not the component most people call
directly. Instead, default components and named variants build on them so
shared logic only lives in one place.

Use a base component when:

- several components need the same underlying structure
- behaviour should stay consistent across variants
- styling or content should change without rewriting the core markup

## Variant Components

Variant components build on a base component for a specific use case. They keep
the shared structure, then add the styling, props, slots, or behaviour that
make that version distinct.

Use a variant when:

- the component needs a named public API
- the variant represents a specific presentation or workflow
- the variation should be reusable across the package or app

## Example

The primary button variant adds styling to the shared base and forwards its slot.

```html +code-blade
{{-- components/button/primary.blade.php --}}
<x-gt-button.base {{ $attributes->merge(['class' => 'btn primary']) }}>
    {{ $slot }}
</x-gt-button.base>
```

## File Structure

```bash +code
components/button/
├── base.blade.php
├── default.blade.php
└── primary.blade.php
```

## Registration

Gotime registers Blade component aliases in the package service provider using
`registerComponent()`. Pass the view path on its own when the component is
addressed by that same name, and add a second argument only when the alias
differs from the path.

```php +code
$this->registerComponent('button.base');
$this->registerComponent('button.default', 'button');
$this->registerComponent('button.primary');
```

The default uses the shorter alias `<x-gt-button>`. The base and primary variant
retain their dot-notation names shown above.
