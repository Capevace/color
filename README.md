<p align="center">
    <img src="resources/images/icon.webp" alt="A rendering of a hacker mixing some colors, the icon for this package" width="350">
</p>

<h1 align="center"><code>mateffy/color</code></h1>
<h4 align="center">A powerful color manipulation library for PHP / Laravel with a focus on DX and simplicity with great support for Tailwind and Filament color definitions.</h4>


<br>

### Features
- 🎨 Manipulate your colors with `hue`, `lighten`, `alpha` and similar methods
- 💅 Format your colors as Hex, RGB, HSL and more
- 👨‍💻 Fully typed and documented, developer focused API
- ✨ Generate new `50` -> `950` color palettes from a single color
- 🔩 Natively supports [Tailwind](https://tailwindcss.com) and [Filament](https://filamentphp.com) color definitions

<br>

```php
/**
 * Color manipulation
 */
 
use Mateffy\Color;

$color = Color::fromHex('#ff0000')
    ->hue(25, add: true) // Adds 25 to the current hue
    ->saturation(0.5) // Sets the current saturation to 0.5
    ->alpha(0.5); // Sets the current alpha to 0.5

$rgb = $color->toRgb(); // [255, 0, 0]
$hsl = $color->toHsl(); // [1, 1, 0.5]
$hex1 = $color->toHex(); // '#ff0000'
$hex2 = $color->toHex(alpha: true); // '#ff0000ff'

/**
 * Shades functionality
 */

use Mateffy\Color\Shades;

$indigo = Shades::tailwind('indigo');
$indigo->shade500->toHex(); // '#6366f1' with typed color
$indigo['600']->toHex(); // '#4f46e5' with array syntax

// Quickly get the shades defined in your Filament panel provider
$primary = Shades::filament('primary');
$primary->shade500->toHex(); // Dynamic color, configured in Filament panel provider

// Or, generate a 50 -> 950 shades palette from a single color
$shadesFromSingleColor = Shades::color(Color::fromHex('#ff0000'));

// This is useful for configuring your Filament panel provider
// AppServiceProvider.php:
$provider
    ->colors([
        'primary' => Shades::color(Color::fromHex(config('app.primary_color'))),
    ])
```

<br>

## Installation

```bash
composer require mateffy/color
```

<br>

## Usage

To add the popups to your app, all you have to do is include the `pan-analytics::viewer` component in your blade template:

```blade
{{--    Make sure to verify who has access! 
        Including this component will expose your analytics data!    --}}

@if (auth()->user()?->email === 'admin@example.com')
    <x-pan-analytics::viewer />
@endif
```

The popups should now be appearing when hovering over elements that have a `[data-pan]` attribute.

### Options

You can pass options to the component to change the default behavior:

```blade
<x-pan-analytics::viewer
    :toggle="true"
    :events="['my-event-1', 'my-event-2']"
    :force-all="true"
/>
```

| Option      | Description                                                                                  | Default |
|-------------|----------------------------------------------------------------------------------------------|---------|
| `toggle`    | Whether to show a toggle button to show/hide the popups                                      | `false` |
| `events`    | Specify the events that should be fetched.                                                   | `null`  |
| `force‑all` | Force all events to get fetched, may be required when dynamically creating tracked elements. | `false` |

### Events

The package will automatically detect what events are being tracked on the current page by querying for `data-pan` attributes. If you are dynamically creating tracked elements after initial render, these may be missed and no popup will be shown.

To fix this, you can either specify the specific `events` you want to show on the page or use the `force-all` option to disable filtering and fetch all events.

<br>

## Security

The package registers a route for the client to be able to access the data. This route required a valid URL signature to be able to access it, which the `pan-analytics::viewer` component will automatically generate (signed URLs are valid for 1h). **If you include this component on a page that is publicly accessible and don't check the user before including the component, anyone can access the analytics data!**

So, make sure to only render this component for users with the necessary permissions.

```blade
@if (auth()->user()?->email === 'admin@example.com')
    <x-pan-analytics::viewer />
@endif

{{-- or --}}

@if (auth()->user()?->can('view-analytics'))
    <x-pan-analytics::viewer />
@endif
```

### Tippy.js

This package uses [Tippy.js](https://github.com/atomiks/tippyjs) to create the popups. `tippy.js` is included via `unpkg.com` like this, but only when the component is rendered:

```html
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>
```

<br>

## Configuration

You can publish the config file with:

```bash
php artisan vendor:publish --provider="Mateffy\PanAnalyticsViewer\PanAnalyticsViewerServiceProvider" --tag="config"
```

This is the default configuration:

```php
return [
    'endpoint' => env('PAN_ANALYTICS_ENDPOINT', '/pan/viewer')
];
```

### Endpoint

You can change the URL that the analytics are being exposed on by changing the `PAN_ANALYTICS_ENDPOINT` environment variable or customizing the `endpoint` config key. The default URL is `example.com/pan/viewer`.

<br>

## Changelog

- 1.0.2
  - Feature: added Livewire support, the `[data-pan]` search will now be re-run after Livewire `morph.updated` events are fired, to show the popups for newly created elements
- 1.0.1
  - Fix: removed livewire specific script inclusion
- 1.0.0 
  - Initial release
