<?php

namespace Mateffy\Color\Concerns;

trait ContrastPerception
{
	public function luminance(): float
	{
		return 0.2126 * $this->red + 0.7152 * $this->green + 0.0722 * $this->blue;
	}

	public function humanLuminance(): float
	{
		// Counting the perceptive luminance
		// human eye favors green color...
		return 1 - (0.299 * $this->red + 0.587 * $this->green + 0.114 * $this->blue) / 255;
	}

	public function needsLightForeground(): bool
	{
		return $this->humanLuminance() >= 0.5;
	}
}
