<p align="center">
    <img src="resources/images/icon.webp" alt="A rendering of a hacker mixing some colors, the icon for this package" width="350">
</p>

<h1 align="center"><code>mateffy/color</code></h1>
<h3 align="center">A powerful color manipulation library for PHP / Laravel with a focus on DX and simplicity with great support for Tailwind and Filament color definitions.</h3>

<p align="center">
    <img src="https://github.com/Capevace/color/actions/workflows/tests.yml/badge.svg" alt="Test status">
</p>


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

$color = Color::hex('#ff0000')
    ->hue(25, add: true) // Adds 25 to the current hue
    ->saturation(0.5) // Sets the current saturation to 0.5
    ->alpha(0.5); // Sets the current alpha to 0.5

/* Hex */
$hex1 = $color->toHex(); // '#ff0000'
$hex2 = $color->toHex(alpha: true); // '#ff0000ff'

/* RGB */
$rgb = $color->toRgb(); // [255, 0, 0]
$rgba = $color->toRgba(); // [255, 0, 0, 0.5]
$rgbString = $color->toRgbString(); // 'rgb(255, 0, 0)'
$rgbValueString = $color->toRgbValueString(); // '255, 0, 0' for Tailwind and Filament

/* HSL */
$hsl = $color->toHsl(); // [1, 1, 0.5]
$hsla = $color->toHsla(); // [1, 1, 0.5, 0.5]
$hslString = $color->toHslString(); // 'hsl(1, 1%, 50%)'
$hslValueString = $color->toHslaString(); // 'hsla(1, 1%, 50%, 0.5)' 

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

TODO: Complete documentation

## Changelog

- 1.0.0 
  - Initial release
