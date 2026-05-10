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

require __DIR__ . '/../../bootstrap.php';


class TestGravatarExtension extends TestCase
{
	private function createContainer(): Container
	{
		$tempDir = __DIR__ . '/temp';
		@mkdir($tempDir);

		$loader = new ContainerLoader($tempDir, true);

		$class = $loader->load(function (Compiler $compiler): void {
			$compiler->loadConfig(Tester\FileMock::create('
			gravatar:
				size: 80
				defaultImage: "mm"
				rating: "g"
			', 'neon'));

			$compiler->addExtension(
				'gravatar',
				new GravatarExtension,
			);
		});

		return new $class;
	}


	private function getClassByType(): Gravatar
	{
		return $this->createContainer()
			->getByType(Gravatar::class);
	}


	public function test01(): void
	{
		Assert::type(
			Gravatar::class,
			$this->getClassByType(),
		);
	}


	public function test02(): void
	{
		$gravatar = $this->getClassByType();
		$gravatar->setEmail('someone@somewhere.com');

		Assert::type(
			'string',
			$gravatar->getGravatar(),
		);
	}
}


(new TestGravatarExtension)->run();
