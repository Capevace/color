<?php

namespace Mateffy\Color;

use Filament\Support\Facades\FilamentColor;
use InvalidArgumentException;
use Mateffy\Color;
use Mateffy\Color\Exceptions\ColorNotFound;
use Mateffy\Color\Exceptions\ShadesAreImmutable;
use RuntimeException;
use Traversable;

readonly class Shades implements \JsonSerializable, \ArrayAccess, \IteratorAggregate, \Countable
{
	public const ValidShades = ['50', '100', '200', '300', '400', '500', '600', '700', '800', '900', '950'];

	public function __construct(
		public Color $shade50,
		public Color $shade100,
		public Color $shade200,
		public Color $shade300,
		public Color $shade400,
		public Color $shade500,
		public Color $shade600,
		public Color $shade700,
		public Color $shade800,
		public Color $shade900,
		public Color $shade950,
	)
	{
	}

	/**
	 * @return array<string, Color>
	 */
	public function toArray(): array
	{
		return [
			'50' => $this->shade50,
			'100' => $this->shade100,
			'200' => $this->shade200,
			'300' => $this->shade300,
			'400' => $this->shade400,
			'500' => $this->shade500,
			'600' => $this->shade600,
			'700' => $this->shade700,
			'800' => $this->shade800,
			'900' => $this->shade900,
			'950' => $this->shade950,
		];
	}

	/**
     * Get an array of RGB values for each shade.
     *
     * @example
     *  $shades->toRgbValueStringArray() // ['50' => [255, 255, 255], '100' => [255, 255, 255], ...]
     *
	 * @return array<string, Color>
	 */
	public function toRgbValueStringArray(): array
	{
		return [
			'50' => $this->shade50->toRgbValueString(),
			'100' => $this->shade100->toRgbValueString(),
			'200' => $this->shade200->toRgbValueString(),
			'300' => $this->shade300->toRgbValueString(),
			'400' => $this->shade400->toRgbValueString(),
			'500' => $this->shade500->toRgbValueString(),
			'600' => $this->shade600->toRgbValueString(),
			'700' => $this->shade700->toRgbValueString(),
			'800' => $this->shade800->toRgbValueString(),
			'900' => $this->shade900->toRgbValueString(),
			'950' => $this->shade950->toRgbValueString(),
		];
	}

    /**
     * Get an array of hex values for each shade.
     *
     * @example
     *  $shades->toHexArray() // ['50' => '#ffffff', '100' => '#ffffff', '200' => '#ffffff', ...]
     *
	 * @return array<string, Color>
	 */
	public function toHexArray(bool $hash = true, bool $alpha = false): array
	{
		return [
			'50' => $this->shade50->toHexString(alpha: $alpha, hash: $hash),
			'100' => $this->shade100->toHexString(alpha: $alpha, hash: $hash),
			'200' => $this->shade200->toHexString(alpha: $alpha, hash: $hash),
			'300' => $this->shade300->toHexString(alpha: $alpha, hash: $hash),
			'400' => $this->shade400->toHexString(alpha: $alpha, hash: $hash),
			'500' => $this->shade500->toHexString(alpha: $alpha, hash: $hash),
			'600' => $this->shade600->toHexString(alpha: $alpha, hash: $hash),
			'700' => $this->shade700->toHexString(alpha: $alpha, hash: $hash),
			'800' => $this->shade800->toHexString(alpha: $alpha, hash: $hash),
			'900' => $this->shade900->toHexString(alpha: $alpha, hash: $hash),
			'950' => $this->shade950->toHexString(alpha: $alpha, hash: $hash),
		];
	}

	/**
     * Create a `Shades` instance from an array of `Color` objects.
     *
     * @example
     *  Shades::fromColors([
     *      '50' => Color::rgb(248, 250, 252),
     *      '100' => Color::rgb(241, 245, 249),
     *      '200' => Color::rgb(226, 232, 240),
     *      '300' => Color::rgb(203, 213, 225),
     *      '400' => Color::rgb(148, 163, 184),
     *      '500' => Color::rgb(100, 116, 139),
     *      '600' => Color::rgb(71, 85, 105),
     *      '700' => Color::rgb(51, 65, 85),
     *      '800' => Color::rgb(30, 41, 59),
     *      '900' => Color::rgb(15, 23, 42),
     *      '950' => Color::rgb(2, 6, 23),
     *  ])
     *
	 * @param array<string, Color> $shades
	 */
	protected static function fromColors(array $shades): static
	{
		return new Shades(
			shade50: $shades['50'],
			shade100: $shades['100'],
			shade200: $shades['200'],
			shade300: $shades['300'],
			shade400: $shades['400'],
			shade500: $shades['500'],
			shade600: $shades['600'],
			shade700: $shades['700'],
			shade800: $shades['800'],
			shade900: $shades['900'],
			shade950: $shades['950'],
		);
	}

	/**
     * Creates a shades object from an array of RGB values, which is the format used by Tailwind.
     * Works with both strings and arrays as input values.
     *
     * @example
     *  Shades::fromRgbValues([
     *      '50' => [248, 250, 252],
     *      '100' => [241, 245, 249],
     *      '200' => [226, 232, 240],
     *      '300' => [203, 213, 225],
     *      '400' => [148, 163, 184],
     *      '500' => [100, 116, 139],
     *      '600' => [71, 85, 105],
     *      '700' => [51, 65, 85],
     *      '800' => [30, 41, 59],
     *      '900' => [15, 23, 42],
     *      '950' => [2, 6, 23],
     *  ])
     *
     * @example
     *  Shades::fromRgbValues([
     *      '50' => '248, 250, 252',
     *      '100' => '241, 245, 249',
     *      '200' => '226, 232, 240',
     *      '300' => '203, 213, 225',
     *      '400' => '148, 163, 184',
     *      '500' => '100, 116, 139',
     *      '600' => '71, 85, 105',
     *      '700' => '51, 65, 85',
     *      '800' => '30, 41, 59',
     *      '900' => '15, 23, 42',
     *      '950' => '2, 6, 23',
     *  ])
     *
     * @param array<string, array|string> $shades
	 */
	public static function fromRgbValues(array $shades): static
	{
		$shades = collect($shades)
			->map(fn (string|array|int $color) =>
                collect(
                    is_array($color)
                        ? $color
                        : str($color)
                            ->replace(' ', '')
                            ->explode(',')
                )
                    ->map(fn (string|int $value) => (int) $value)
			)
			->map(fn ($color) => Color::rgb(...$color))
			->toArray();

		return static::fromColors($shades);
	}

    /**
     * Create a Shades object from the Tailwind color palette.
     * These are the original Tailwind colors from v3.
     *
     * The tailwind color palette is Copyright (c) Tailwind Labs, Inc. and released under the MIT License.
     *
     * @param string $name
     * @return static
     */
	public static function tailwind(string $name): static
	{
		$tailwindShades = TailwindColor::all();
        $shades = $tailwindShades[$name] ?? null;

		if (!isset($shades)) {
			throw new InvalidArgumentException("Color {$name} not found");
		}

		return static::fromRgbValues($shades);
	}

    /**
     * Create a Shades object from your configured Filament panel colors.
     * Only works if Filament is installed!
     *
     * @example Shades::filament('primary')
     * @example Shades::filament('danger')
     * @param string $name The name of the color to use
     *
     * @throws RuntimeException If Filament is not installed
     * @throws ColorNotFound If the color name is not found
     */
	public static function filament(string $name): static
	{
        $filamentColor = '\\Filament\\Support\\Facades\\FilamentColor';

        if (!class_exists($filamentColor)) {
            throw new \RuntimeException("Class \\Filament\\Support\\Facades\\FilamentColor doesn't exist, is Filament installed?");
        }

        $colors = $filamentColor::getColors();
        $color = $colors[$name] ?? null;

        if ($color === null) {
            throw new ColorNotFound("Color {$name} not found");
        }

		return static::fromRgbValues($color);
	}

    /**
     * Create shades from a single color. Useful to create tailwind-like shades from a single color.
     * The color will be used as the '500' shade.
     *
     * @example Shades::color(Color::hex('#ff0000'))
     *
     * @param Color $color The color to use
     */
	public static function color(Color $color): static
    {
        $colors = [];

        $intensityMap = [
            50 => 0.95,
            100 => 0.9,
            200 => 0.75,
            300 => 0.6,
            400 => 0.3,
            500 => 1.0,
            600 => 0.9,
            700 => 0.75,
            800 => 0.6,
            900 => 0.49,
            950 => 0.3,
        ];

        foreach ($intensityMap as $shade => $intensity) {
            if ($shade < 500) {
                $red = ((255 - $color->red) * $intensity) + $color->red;
                $green = ((255 - $color->green) * $intensity) + $color->green;
                $blue = ((255 - $color->blue) * $intensity) + $color->blue;
            } else {
                $red = $color->red * $intensity;
                $green = $color->green * $intensity;
                $blue = $color->blue * $intensity;
            }

            $colors[$shade] = Color::rgb($red, $green, $blue);
        }

        return Shades::fromColors($colors);
    }

    /**
     * Create a Shades object from an array of colors.
     *
     * @example
     *  Shades::colors([
     *      '50' => Color::rgb(255, 255, 255),
     *      '100' => Color::rgb(255, 255, 255),
     *      '200' => Color::rgb(255, 255, 255),
     *      '300' => Color::rgb(255, 255, 255),
     *      '400' => Color::rgb(255, 255, 255),
     *      '500' => Color::rgb(255, 255, 255),
     *      '600' => Color::rgb(255, 255, 255),
     *      '700' => Color::rgb(255, 255, 255),
     *      '800' => Color::rgb(255, 255, 255),
     *      '900' => Color::rgb(255, 255, 255),
     *      '950' => Color::rgb(255, 255, 255),
     *  ])
     *
     * @param array<string, Color> $colors
     * @throws InvalidArgumentException If a shade is not valid (50, 100, 200, ..., 900, 950)
     * @throws InvalidArgumentException If a shade is missing
     */
	public static function colors(array $colors): static
	{
		$hasInvalidShade = collect($colors)
			->keys()
			->first(fn ($shade) => !in_array($shade, static::ValidShades));

		if ($hasInvalidShade) {
			throw new InvalidArgumentException("Invalid shade {$hasInvalidShade}");
		}

		$hasMissingShade = collect(static::ValidShades)
			->first(fn ($shade) => !isset($colors[$shade]));

		if ($hasMissingShade) {
			throw new InvalidArgumentException("Missing shade {$hasMissingShade}");
		}

		return Shades::fromColors($colors);
	}

	public function getIterator(): Traversable
	{
		return new \ArrayIterator($this->toArray());
	}

	public function count(): int
	{
		return count($this->toArray());
	}

	public function offsetExists($offset): bool
	{
		return isset($this->toArray()[$offset]);
	}

	public function offsetGet($offset): ?Color
	{
		return $this->toArray()[$offset] ?? null;
	}

    /**
     * @throws ShadesAreImmutable
     */
    public function offsetSet($offset, $value): void
	{
		throw new ShadesAreImmutable('Shades are immutable');
	}

    /**
     * @throws ShadesAreImmutable
     */
    public function offsetUnset($offset): void
	{
		throw new ShadesAreImmutable('Shades are immutable');
	}

	public function jsonSerialize(): array
	{
		return $this->toArray();
	}
}
