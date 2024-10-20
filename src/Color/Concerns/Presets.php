<?php

namespace Mateffy\Color\Concerns;

trait Presets
{
    /**
     * A color preset as dark as night.
     */
	public static function black(): static
	{
		return new static(0, 0, 0);
	}

    /**
     * A color preset as light as day.
     */
	public static function white(): static
	{
		return new static(255, 255, 255);
	}
}
