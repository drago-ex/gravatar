<?php

declare(strict_types = 1);

use Drago\User;
use Nette\DI;
use Tester\Assert;

$container = require __DIR__ . '/../../bootstrap.php';


class GravatarExtension extends TestContainer
{
	private function createContainer(): DI\Container
	{
		$params = $this->container->getParameters();
		$loader = new DI\ContainerLoader($params['tempDir'], true);
		$class = $loader->load(function (DI\Compiler $compiler): void {
			$compiler->addExtension('gravatar', new User\DI\GravatarExtension(80, 'mm', 'g'));
		});
		return new $class;
	}


	private function geClassByType(): User\Gravatar
	{
		return $this->createContainer()
			->getByType(User\Gravatar::class);
	}


	public function test01(): void
	{
		Assert::type(User\Gravatar::class, $this->geClassByType());
	}


	public function test02(): void
	{
		$gravatar = $this->geClassByType();
		$gravatar->setEmail('someone@somewhere.com');

		Assert::type('string', $gravatar->getGravatar());
	}
}

$extension = new GravatarExtension($container);
$extension->run();
