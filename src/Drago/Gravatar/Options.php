<?php

declare(strict_types=1);

namespace Drago\Gravatar;


/** Configuration options for the Gravatar service. */
final class Options
{
	/** Gravatar image size in pixels. */
	public int $size = 80;

	/** Default image type when no Gravatar exists. */
	public string $defaultImage = 'mm';

	/** Maximum allowed Gravatar rating. */
	public string $rating = 'g';
}
