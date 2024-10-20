<?php

namespace Mateffy;

use JsonSerializable;

/**
 * The `Color` class is registered as \Mateffy\Color for convenience and as a shorthand.
 * Everything else is correctly namespaced under `Mateffy\Color\[etc]`.
 */
readonly class Color implements JsonSerializable
{
	use Color\Concerns\ContrastPerception;
    use Color\Concerns\CSS;
    use Color\Concerns\Hex;
    use Color\Concerns\HSL;
    use Color\Concerns\Modifiers;
    use Color\Concerns\Presets;
    use Color\Concerns\RGB;

	public int $red;
	public int $green;
	public int $blue;
	public float $alpha;

	/**
	 * @param int $red 0-255
	 * @param int $green 0-255
	 * @param int $blue 0-255
	 * @param float $alpha 0-1
	 */
	protected function __construct(
		int $red,
		int $green,
		int $blue,
		float $alpha = 1,
	)
	{
		$this->red = min(max($red, 0), 255);
		$this->green = min(max($green, 0), 255);
		$this->blue = min(max($blue, 0), 255);
		$this->alpha = min(max($alpha, 0), 1);
	}

	public function jsonSerialize(): mixed
	{
		return $this->toHexString(alpha: true, hash: true);
	}
}
