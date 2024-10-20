<?php

namespace Mateffy\Color\Concerns;

trait Presets
{
	public static function black(): static
	{
		return new static(0, 0, 0);
	}

	public static function white(): static
	{
		return new static(255, 255, 255);
	}
}
