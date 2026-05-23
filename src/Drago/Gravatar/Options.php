<?php

declare(strict_types=1);

namespace Drago\Gravatar;


/**
 * Configuration options for the Gravatar service.
 */
final class Options
{
	public int $size = 80;

	public string $defaultImage = 'mm';

	public string $rating = 'g';
}
