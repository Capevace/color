<?php

namespace Mateffy\Color\Concerns;

trait HSL
{
	/*
	 * Modifiers
	 */

	public function hue(float $hue, bool $add = false): static
	{
		[$oldHue, $saturation, $lightness, $alpha] = static::rgbaToHsla($this->red, $this->green, $this->blue, $this->alpha);

        if ($add) {
            $hue += $oldHue;
        }

		return static::hsl($hue, $saturation, $lightness, $alpha);
	}

	public function saturation(float $saturation, bool $add = false): static
	{
		[$hue, $oldSaturation, $lightness, $alpha] = static::rgbaToHsla($this->red, $this->green, $this->blue, $this->alpha);

        if ($add) {
            $saturation += $oldSaturation;
        }

		return static::hsl($hue, $saturation, $lightness, $alpha);
	}

	public function lightness(float $lightness, bool $add = false): static
	{
		[$hue, $saturation, $oldLightness, $alpha] = static::rgbaToHsla($this->red, $this->green, $this->blue, $this->alpha);

        if ($add) {
            $lightness += $oldLightness;
        }

		return static::hsl($hue, $saturation, $lightness, $alpha);
	}



	/*
	 * Exporters
	 */

	public function toHsl(): array
	{
		[$h, $s, $l] = static::rgbaToHsla($this->red, $this->green, $this->blue, $this->alpha);

		return [$h, $s, $l];
	}

	public function toHsla(): array
	{
		[$h, $s, $l, $a] = static::rgbaToHsla($this->red, $this->green, $this->blue, $this->alpha);

		return [$h, $s, $l, $a];
	}

	public function toHslString(): string
	{
		[$hue, $saturation, $lightness, $_] = static::rgbaToHsla($this->red, $this->green, $this->blue, $this->alpha);

		return sprintf(
			'hsl(%d, %d%%, %d%%)',
			$hue,
			$saturation,
			$lightness,
		);
	}

	public function toHslaString(): string
	{
		[$hue, $saturation, $lightness, $alpha] = static::rgbaToHsla($this->red, $this->green, $this->blue, $this->alpha);

		return sprintf(
			'hsla(%d, %d%%, %d%%, %s)',
			$hue,
			$saturation,
			$lightness,
			rtrim(rtrim(sprintf('%f', $this->alpha), '0'), '.')
		);
	}



	/*
	 * Factories
	 */

	public static function hsl(float $hue, float $saturation, float $lightness, float $alpha = 1.0): static
	{
		[$r, $g, $b, $a] = static::hslaToRgba($hue, $saturation, $lightness, $alpha);

		return new static($r, $g, $b, $a);
	}



	/*
	 * Converters
	 */

	protected static function hslaToRgba(float $hue, float $saturation, float $lightness, float $alpha = 1.0): array
	{
        $saturation /= 100;
        $lightness /= 100;

        $c = (1 - abs(2 * $lightness - 1)) * $saturation;
        $x = $c * (1 - abs(fmod(($hue / 60), 2) - 1));
        $m = $lightness - ($c / 2);

        if ($hue < 60) {
            $r = $c;
			$g = $x;
			$b = 0;
        } elseif ($hue < 120) {
            $r = $x;
			$g = $c;
			$b = 0;
        } elseif ($hue < 180) {
            $r = 0;
			$g = $c;
			$b = $x;
        } elseif ($hue < 240) {
            $r = 0;
			$g = $x;
			$b = $c;
        } elseif ($hue < 300) {
            $r = $x;
			$g = 0;
			$b = $c;
        } else {
            $r = $c;
			$g = 0;
			$b = $x;
        }

        $r = round(($r + $m) * 255);
        $g = round(($g + $m) * 255);
        $b = round(($b + $m) * 255);

        return [$r, $g, $b, $alpha];
    }

	protected static function rgbaToHsla(int $r, int $g, int $b, float $a = 1.0): array
	{
        $r /= 255;
        $g /= 255;
        $b /= 255;

        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
        $l = ($max + $min) / 2;
        $d = $max - $min;

        if ($d == 0) {
            $h = $s = 0; // achromatic
        } else {
            $s = $l > 0.5 ? $d / (2 - $max - $min) : $d / ($max + $min);

            switch ($max) {
                case $r:
                    $h = ($g - $b) / $d + ($g < $b ? 6 : 0);
                    break;
                case $g:
                    $h = ($b - $r) / $d + 2;
                    break;
                case $b:
                    $h = ($r - $g) / $d + 4;
                    break;
            }
            $h /= 6;
        }

        return [round($h * 360), round($s * 100), round($l * 100), $a];
    }
}
