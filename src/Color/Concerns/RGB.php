<?php

namespace Mateffy\Color\Concerns;

trait RGB
{
	/*
	 * Modifiers
	 */

	public function red(int $red): static
	{
		return new static($red, $this->green, $this->blue, $this->alpha);
	}

	public function green(int $green): static
	{
		return new static($this->red, $green, $this->blue, $this->alpha);
	}

	public function blue(int $blue): static
	{
		return new static($this->red, $this->green, $blue, $this->alpha);
	}



	/*
	 * Exporters
	 */

	public function toRgb(): array
	{
		return [$this->red, $this->green, $this->blue];
	}

	public function toRgba(): array
	{
		return [$this->red, $this->green, $this->blue, $this->alpha];
	}

	public function toRgbString(): string
	{
		return "rgb({$this->toRgbValueString()})";
	}

	public function toRgbValueString(): string
	{
		return sprintf(
			'%d, %d, %d',
			$this->red,
			$this->green,
			$this->blue,
		);
	}

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



	/*
	 * Factories
	 */

	public static function rgb(int $red, int $green, int $blue, float $alpha = 1.0): static
	{
		return new static($red, $green, $blue, $alpha);
	}
}
