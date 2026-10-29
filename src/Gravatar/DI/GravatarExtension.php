<?php declare(strict_types=1);

namespace Drago\Gravatar\DI;

use Drago\Gravatar\Gravatar;
use Drago\Gravatar\Options;
use Nette\DI\CompilerExtension;
use Nette\Schema\Expect;
use Nette\Schema\Schema;


/** @property-read Options $config */
class GravatarExtension extends CompilerExtension
{
	public function getConfigSchema(): Schema
	{
		return Expect::from(new Options);
	}


	public function loadConfiguration(): void
	{
		$this->getContainerBuilder()
			->addDefinition($this->prefix('gravatar'))
			->setFactory(Gravatar::class, [$this->config]);
	}
}
