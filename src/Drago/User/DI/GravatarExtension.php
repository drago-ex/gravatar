<?php

declare(strict_types=1);

/**
 * Drago Extension
 * Package built on Nette Framework
 */

namespace Drago\User\DI;

use Drago\User\Gravatar;
use Nette\DI\CompilerExtension;


/**
 * Register services.
 */
class GravatarExtension extends CompilerExtension
{
	private array $defaults = [];


	public function __construct(int $size, string $defaultImage, string $rating)
	{
		$this->defaults = [
			'size' => $size,
			'defaultImage' => $defaultImage,
			'rating' => $rating,
		];
	}


	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();
		$builder->addDefinition($this->prefix('gravatar'))
			->setFactory(Gravatar::class, $this->defaults);
	}
}
