<?php

namespace Mateffy\Color\Concerns;

trait Modifiers
{
	public function alpha(float $alpha, bool $add = false): static
	{
        if ($add) {
            $alpha += $this->alpha;
        }

        $alpha = max(0, min(1, $alpha));

		return new static($this->red, $this->green, $this->blue, $alpha);
	}

	public function opacity(float $opacity, bool $add = false): static
	{
		return $this->alpha($opacity, add: $add);
	}
}
