<?php

/**
 * Test: Drago\User\DI\GravatarExtension
 */

declare(strict_types=1);

use Drago\User\DI\GravatarExtension;
use Drago\User\Gravatar;
use Nette\DI\Compiler;
use Nette\DI\Container;
use Nette\DI\ContainerLoader;
use Tester\Assert;
use Tester\TestCase;

$container = require __DIR__ . '/../../bootstrap.php';


class TestGravatarExtension extends TestCase
{
	protected Container $container;


	public function __construct(Container $container)
	{
		$this->container = $container;
	}


	private function createContainer(): Container
	{
		$loader = new ContainerLoader(TempDir, true);
		$class = $loader->load(function (Compiler $compiler): void {
			$compiler->loadConfig(Tester\FileMock::create('
			services:
				- Nette\Http\UrlScript
				- Nette\Http\Request(@Nette\Http\UrlScript)
				- Nette\Http\Response
				- Nette\Http\Session(@Nette\Http\Request, @Nette\Http\Response)
			', 'neon'));
			$compiler->addExtension('gravatar', new GravatarExtension(80, 'mm', 'g'));
		});
		return new $class;
	}


	private function geClassByType(): Gravatar
	{
		return $this->createContainer()
			->getByType(Gravatar::class);
	}


	public function test01(): void
	{
		Assert::type(Gravatar::class, $this->geClassByType());
	}


	public function test02(): void
	{
		$gravatar = $this->geClassByType();
		$gravatar->setEmail('someone@somewhere.com');

		Assert::type('string', $gravatar->getGravatar());
	}
}

(new TestGravatarExtension($container))->run();
