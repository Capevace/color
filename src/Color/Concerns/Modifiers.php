<?php

namespace Mateffy\Color\Concerns;

trait Modifiers
{
    /**
     * Set or add the alpha value of the color.
     *
     * @example $color->alpha(0.5)
     * @example $color->alpha(0.2, add: true)
     *
     * @param float $alpha Opacity value between 0.0 and 1.0
     * @param bool $add Whether to add the value or set it, defaults to false
     */
	public function alpha(float $alpha, bool $add = false): static
	{
        if ($add) {
            $alpha += $this->alpha;
        }

        $alpha = max(0, min(1, $alpha));

		return new static($this->red, $this->green, $this->blue, $alpha);
	}

    /**
     * Set or add the opacity of the color. Alias for `alpha`.
     *
     * @example $color->opacity(0.5)
     * @example $color->opacity(0.2, add: true)
     *
     * @param float $opacity Opacity value between 0.0 and 1.0
     * @param bool $add Whether to add the value or set it, defaults to false
     */
	public function opacity(float $opacity, bool $add = false): static
	{
		return $this->alpha($opacity, add: $add);
	}

    /**
     * Invert the color.
     *
     * @return static
     */
    public function invert(): static
    {
        return new static(
            255 - $this->red,
            255 - $this->green,
            255 - $this->blue,
            $this->alpha
        );
    }

    /**
     * Adjust the brightness of the color.
     *
     * @param float $amount Amount to adjust brightness, between -1 and 1
     * @return static
     */
    public function adjustBrightness(float $amount): static
    {
        $amount = max(-1, min(1, $amount));
        $adjustment = $amount > 0 
            ? (255 - max($this->red, $this->green, $this->blue)) * $amount 
            : max($this->red, $this->green, $this->blue) * $amount;

        return new static(
            max(0, min(255, $this->red + $adjustment)),
            max(0, min(255, $this->green + $adjustment)),
            max(0, min(255, $this->blue + $adjustment)),
            $this->alpha
        );
    }

    /**
     * Lighten the color.
     *
     * @param float $amount Amount to lighten, between 0 and 1
     * @return static
     */
    public function lighten(float $amount): static
    {
        return $this->adjustBrightness(abs($amount));
    }

    /**
     * Darken the color.
     *
     * @param float $amount Amount to darken, between 0 and 1
     * @return static
     */
    public function darken(float $amount): static
    {
        return $this->adjustBrightness(-abs($amount));
    }

    /**
     * Create the complementary color.
     *
     * @return static
     */
    public function complementary(): static
    {
        [$h, $s, $l] = $this->toHsl();
        $newHue = ($h + 180) % 360;
        return static::hsl($newHue, $s, $l, $this->alpha);
    }
}
