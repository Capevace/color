<?php

namespace Mateffy\Color;

use Mateffy\Color;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class ColorCast implements CastsAttributes
{
	public function get(Model $model, string $key, mixed $value, array $attributes)
	{
		if ($value === null) {
			return null;
		}

		return Color::hex($value);
	}

	/**
	 * @param Color|null $value
	 */
	public function set(Model $model, string $key, mixed $value, array $attributes)
	{
		if ($value === null) {
			return null;
		}

		return is_string($value)
			? Color::hex($value)->toHexString(hash: true)
			: $value->toHexString(hash: true);
	}
}
