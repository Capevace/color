<?php

namespace Mateffy\Color\Concerns;

use InvalidArgumentException;

trait Hex
{
	/*
	 * Exporters
	 */

	public function toHexString(bool $alpha = false, bool $uppercase = false, bool $hash = true): string
	{
		$hex = sprintf(
			'%02x%02x%02x',
			$this->red,
			$this->green,
			$this->blue,
		);

		if ($alpha) {
			$hex .= sprintf('%02x', $this->alpha * 255);
		}

		if ($uppercase) {
			$hex = strtoupper($hex);
		}

		if ($hash) {
			$hex = '#' . $hex;
		}

		return $hex;
	}



	/*
	 * Factories
	 */

	public static function hex(string $hex): static
	{
		[$r, $g, $b, $a] = static::hexToRgba($hex);

		return new static($r, $g, $b, $a);
	}



	/*
	 * Converters
	 */

	protected static function hexToRgba(string $hex): array
	{
        // Remove the "#" if it exists
        $hex = ltrim($hex, '#');

        // Depending on the length of the hex string, process differently
        switch (strlen($hex)) {
            case 3: // Short format: RGB
                $r = hexdec(str_repeat(substr($hex, 0, 1), 2));
                $g = hexdec(str_repeat(substr($hex, 1, 1), 2));
                $b = hexdec(str_repeat(substr($hex, 2, 1), 2));
                return [$r, $g, $b, 1.0];

            case 4: // Short format with alpha: RGBA
                $r = hexdec(str_repeat(substr($hex, 0, 1), 2));
                $g = hexdec(str_repeat(substr($hex, 1, 1), 2));
                $b = hexdec(str_repeat(substr($hex, 2, 1), 2));
                $a = hexdec(str_repeat(substr($hex, 3, 1), 2)) / 255;
                return [$r, $g, $b, $a];

            case 6: // Standard format: RRGGBB
                $r = hexdec(substr($hex, 0, 2));
                $g = hexdec(substr($hex, 2, 2));
                $b = hexdec(substr($hex, 4, 2));
                return [$r, $g, $b, 1.0];

            case 8: // Standard format with alpha: RRGGBBAA
                $r = hexdec(substr($hex, 0, 2));
                $g = hexdec(substr($hex, 2, 2));
                $b = hexdec(substr($hex, 4, 2));
                $a = hexdec(substr($hex, 6, 2)) / 255;
                return [$r, $g, $b, $a];

            default:
                throw new InvalidArgumentException('Invalid hex color format.');
        }
    }

	public static function isValidHexString(string $hex): bool
	{
		return preg_match('/^#?([a-fA-F0-9]{3}){1,2}$/', $hex) === 1;
	}
}
