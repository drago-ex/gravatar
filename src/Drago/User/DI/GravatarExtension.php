<?php

declare(strict_types = 1);

/**
 * Drago Extension
 * Package built on Nette Framework
 */

namespace Drago\User\DI;

use Drago;
use Nette;


/**
 * Register services.
 */
class GravatarExtension extends Nette\DI\CompilerExtension
{
	/** @var array */
	private $defaults = [];


	public function __construct(string $image, string $size, string $rating)
	{
		$this->defaults = [
			'image' => $image,
			'size' => $size,
			'rating' => $rating
		];
	}


	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();
		$builder->addDefinition($this->prefix('gravatar'))
			->setFactory(Drago\User\Gravatar::class, [$this->defaults]);
	}
}
