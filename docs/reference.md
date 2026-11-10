# Content Reveal Widget reference

<!-- prettier-ignore-start -->

Developer reference for `capell-app/widget-content-reveal`. Start with the [README](../README.md) for what the extension does and how to install it.

## Package Details

Content Reveal Widget is an **Available**, **No schema impact** Capell package in the **Capell Essentials** product group. It ships as `capell-app/widget-content-reveal` and extends these surfaces: admin, frontend.

- Status: Available
- Tier: free
- Bundle: foundation
- Composer package: `capell-app/widget-content-reveal`
- Namespace: `Capell\WidgetContentReveal`
- Theme key: not applicable

## Technical Shape

### Service providers

- `Capell\WidgetContentReveal\Providers\WidgetContentRevealServiceProvider`

### Filament classes

- `ContentRevealWidget`

### Actions

- `BuildRevealTargetOptionsAction`

### Data objects

- `ContentRevealInputData`
- `ContentRevealRenderData`
- `RevealCardData`

### Manifest contributions

- `asset: Capell\WidgetContentReveal\WidgetContentRevealContribution`
- `content-widget: Capell\WidgetContentReveal\WidgetContentRevealContribution`

### Health checks

- `Capell\WidgetContentReveal\Health\WidgetContentRevealHealthCheck`

### Blade views

- `packages/widget-content-reveal/resources/views/widget.blade.php`

### Cache tags

- `widget-content-reveal`


## Data Model

This package has no schema impact. It extends Capell through `asset` contributions and `content-widget` contributions instead of declaring package-owned tables.

<!-- prettier-ignore-end -->
