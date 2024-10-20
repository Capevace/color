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

### Working with Colors

#### Creating Colors

You can create color instances using various methods:

```php
use Mateffy\Color;

// From hexadecimal string
$color = Color::hex('#ff0000');

// From RGB values
$color = Color::rgb(255, 0, 0);

// From RGBA values (including alpha)
$color = Color::rgb(red: 255, green: 0, blue: 0, alpha: 0.5);

// From HSL values
$color = Color::hsl(0, 1, 0.5);
$color = Color::hsl(hue: 0, saturation: 1, lightness: 0.5, alpha: 0.5);
```

#### Modifying Colors

Once you have a color instance, you can modify it using various methods:

```php
// Adjust hue (0-360 degrees)
$newColor = $color->hue(30); // Set hue to 30 degrees
$newColor = $color->hue(30, add: true); // Add 30 degrees to current hue

// Adjust saturation (0-1)
$newColor = $color->saturation(0.5); // Set saturation to 50%

// Adjust lightness (0-1)
$newColor = $color->lightness(0.7); // Set lightness to 70%

// Adjust alpha (0-1)
$newColor = $color->alpha(0.5); // Set alpha to 50%

// Invert the color
$invertedColor = $color->invert();

// Get complementary color
$complementaryColor = $color->complementary();
```

#### Outputting Colors

You can output colors in various formats:

```php
// As hexadecimal string
echo $color->toHexString(); // '#ff0000'
echo $color->toHexString(alpha: true); // '#ff0000ff'

// As RGB array
print_r($color->toRgb()); // [255, 0, 0]

// As RGBA array
print_r($color->toRgba()); // [255, 0, 0, 1]

// As RGB string
echo $color->toRgbString(); // 'rgb(255, 0, 0)'

// As RGBA string
echo $color->toRgbaString(); // 'rgba(255, 0, 0, 1)'

// As HSL array
print_r($color->toHsl()); // [0, 1, 0.5]

// As HSLA array
print_r($color->toHsla()); // [0, 1, 0.5, 1]

// As HSL string
echo $color->toHslString(); // 'hsl(0, 100%, 50%)'

// As HSLA string
echo $color->toHslaString(); // 'hsla(0, 100%, 50%, 1)'
```

### Working with Shades

#### Creating Shades

You can create shades using predefined color palettes or generate them from a single color:

```php
use Mateffy\Color\Shades;

// From Tailwind color palette
$indigo = Shades::tailwind('indigo');

// Generate shades from a single color
$redShades = Shades::color(Color::hex('#ff0000'));

// From Filament color palette (requires Filament to be installed)
$primary = Shades::filament('primary');
```

#### Accessing Shades

You can access individual shades using either object properties or array syntax:

```php
// Using object properties (returns a `Mateffy\Color` instance)
$shade500 = $indigo->shade500;

// Using array syntax
$shade600 = $indigo['600'];
```

#### Outputting Shades

You can output all shades or individual shades in various formats:

```php
// Output all shades as an array
$shadesArray = $indigo->toArray();

// Output a specific shade as hex
echo $indigo->shade500->toHexString(); // '#6366f1'

// Output a specific shade as RGB
echo $indigo['600']->toRgbString(); // 'rgb(79, 70, 229)'
```

## Changelog

- 1.0.0 
  - Initial release
