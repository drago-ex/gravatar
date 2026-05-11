<?php

/**
 * Drago Extension
 * Package built on Nette Framework
 */

declare(strict_types=1);

namespace Drago\Gravatar\DI;

use Drago\Gravatar\Gravatar;
use Drago\Gravatar\Options;
use Nette\DI\CompilerExtension;
use Nette\Schema\Expect;
use Nette\Schema\Processor;
use Nette\Schema\Schema;


/**
 * Registers the Gravatar service in the DI container.
 * This extension allows the configuration of Gravatar settings such as size, default image, and rating.
 */
class GravatarExtension extends CompilerExtension
{
	public function getConfigSchema(): Schema
	{
		return Expect::structure([
			'size' => Expect::int(80),
			'defaultImage' => Expect::string('mm'),
			'rating' => Expect::string('g'),
		]);
	}


	/**
	 * Registers the Gravatar service in the DI container.
	 * Uses the provided configuration values to instantiate the Gravatar class.
	 */
	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();

		$options = (new Processor)->process(
			Expect::from(new Options),
			$this->config,
		);

		$builder->addDefinition($this->prefix('gravatar'))
			->setFactory(Gravatar::class, [
				$options->size,
				$options->defaultImage,
				$options->rating,
			]);
	}
}
