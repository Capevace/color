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
}
