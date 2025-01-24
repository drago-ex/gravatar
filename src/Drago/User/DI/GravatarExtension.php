<?php

/**
 * Drago Extension
 * Package built on Nette Framework
 */

declare(strict_types=1);

namespace Drago\User\DI;

use Drago\User\Gravatar;
use Nette\DI\CompilerExtension;


/**
 * Registers the Gravatar service in the DI container.
 * This extension allows the configuration of Gravatar settings such as size, default image, and rating.
 */
class GravatarExtension extends CompilerExtension
{
	private array $defaults;


	/**
	 * @param int $size The size of the Gravatar image.
	 * @param string $defaultImage The default image to use if no Gravatar is available.
	 * @param string $rating The rating of the Gravatar image (e.g., "g", "pg", "r", "x").
	 */
	public function __construct(int $size, string $defaultImage, string $rating)
	{
		$this->defaults = [
			'size' => $size,
			'defaultImage' => $defaultImage,
			'rating' => $rating,
		];
	}


	/**
	 * Registers the Gravatar service in the DI container.
	 * Uses the provided configuration values to instantiate the Gravatar class.
	 */
	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('gravatar'))
			->setFactory(Gravatar::class, $this->defaults);
	}
}
