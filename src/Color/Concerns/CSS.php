<?php

namespace Mateffy\Color\Concerns;

trait CSS
{
	/*
	 * Exporters
	 */

	public function toDynamicRgbaString(string $alphaVariableName, float $defaultAlpha = 1.0): string
	{
		return "rgba({$this->toRgbValueString()}, var(--{$alphaVariableName}, {$defaultAlpha}))";
	}
}
