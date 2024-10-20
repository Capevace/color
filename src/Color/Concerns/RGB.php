<?php

namespace Mateffy\Color\Concerns;

trait RGB
{
	/*
	 * Modifiers
	 */

    /**
     * Set or add the red value
     *
     * @param int $red Integer between 0 and 255
     * @param bool $add Whether to add the value or set it, defaults to false
     */
	public function red(int $red, bool $add = false): static
	{
        if ($add) {
            $red = $this->red + $red;
        }

        $red = max(0, min(255, $red));

		return new static($red, $this->green, $this->blue, $this->alpha);
	}

    /**
     * Set or add the green value
     *
     * @param int $green Integer between 0 and 255
     * @param bool $add Whether to add the value or set it, defaults to false
     */
	public function green(int $green, bool $add = false): static
	{
        if ($add) {
            $green = $this->green + $green;
        }

        $green = max(0, min(255, $green));

		return new static($this->red, $green, $this->blue, $this->alpha);
	}

    /**
     * Set or add the blue value
     *
     * @param int $blue Integer between 0 and 255
     * @param bool $add Whether to add the value or set it, defaults to false
     */
	public function blue(int $blue, bool $add = false): static
	{
        if ($add) {
            $blue = $this->blue + $blue;
        }

        $blue = max(0, min(255, $blue));

		return new static($this->red, $this->green, $blue, $this->alpha);
	}



	/*
	 * Exporters
	 */

    /**
     * Get the RGB values as an array ([0..255, 0..255, 0..255])
     *
     * @example [255, 0, 0]
     * @example [0, 255, 0]
     *
     * @return array{0: int, 1: int, 2: int}
     */
	public function toRgb(): array
	{
		return [$this->red, $this->green, $this->blue];
	}

    /**
     * Get the RGBA values as an array ([0..255, 0..255, 0..255, 0.0..1.0])
     *
     * @example [255, 0, 0, 0.5]
     * @example [0, 255, 0, 0.5]
     *
     * @return array{0: int, 1: int, 2: int, 3: float}
     */
	public function toRgba(): array
	{
		return [$this->red, $this->green, $this->blue, $this->alpha];
	}

    /**
     * Get the RGB values as a string (`rgb(0..255, 0..255, 0..255)`)
     *
     * @example 'rgb(255, 0, 0)'
     * @example 'rgb(0, 255, 0)'
     */
	public function toRgbString(): string
	{
		return "rgb({$this->toRgbValueString()})";
	}

    /*
     * Get the RGBA values as a string (`rgba(0..255, 0..255, 0..255, 0.0..1.0)`)
     *
     * @example 'rgba(255, 0, 0, 0.5)'
     * @example 'rgba(0, 255, 0, 0.5)'
     */
	public function toRgbaString(): string
	{
		return sprintf(
			'rgba(%d, %d, %d, %s)',
			$this->red,
			$this->green,
			$this->blue,
			rtrim(rtrim(sprintf('%f', $this->alpha), '0'), '.')
		);
	}

    /**
     * Get the RGB values as a string without the CSS function (`0..255, 0..255, 0..255`)
     *
     * @example '255, 0, 0'
     * @example '0, 255, 0'
     */
	public function toRgbValueString(): string
	{
		return sprintf(
			'%d, %d, %d',
			$this->red,
			$this->green,
			$this->blue,
		);
	}


	/*
	 * Factories
	 */

    /**
     * Create a `Color` instance form RGB values. An optional alpha value can be passed.
     *
     * @param int $red Integer between 0 and 255
     * @param int $green Integer between 0 and 255
     * @param int $blue Integer between 0 and 255
     * @param float $alpha Float between 0.0 and 1.0
     */
	public static function rgb(int $red, int $green, int $blue, float $alpha = 1.0): static
	{
		return new static($red, $green, $blue, $alpha);
	}
}
