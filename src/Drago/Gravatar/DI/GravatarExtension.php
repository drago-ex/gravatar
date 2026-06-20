<?php

declare(strict_types=1);

namespace Drago\Gravatar\DI;

use Drago\Gravatar\Gravatar;
use Drago\Gravatar\Options;
use Nette\DI\CompilerExtension;
use Nette\Schema\Expect;
use Nette\Schema\Processor;
use Nette\Schema\Schema;


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


	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();
		$options = (new Processor)->process(
			Expect::from(new Options),
			$this->config,
		);

		$builder->addDefinition($this->prefix('gravatar'))
			->setFactory(Gravatar::class, [$options]);
	}
}
