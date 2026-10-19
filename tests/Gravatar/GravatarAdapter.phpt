<?php

/**
 * Test: Drago\Gravatar\GravatarAdapter
 */

declare(strict_types=1);

use Drago\Gravatar\Gravatar;
use Drago\Gravatar\GravatarAdapter;
use Drago\Gravatar\Options;
use Nette\Application\UI\Presenter;
use Nette\Bridges\ApplicationLatte\Template;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';


class GravatarTemplate extends Template
{
	public string $gravatar;
}


class GravatarPresenter extends Presenter
{
	use GravatarAdapter;

	protected function createTemplate(?string $class = null): Template
	{
		return new GravatarTemplate(new Latte\Engine);
	}


	public function render(): void
	{
		$this->onRender($this);
	}
}


test('The template receives the URL once an email is set', function () {
	$presenter = new GravatarPresenter;
	$gravatar = new Gravatar(new Options);
	$presenter->injectGravatar($gravatar, $presenter);

	$gravatar->setEmail('someone@somewhere.com');
	$presenter->render();

	Assert::same($gravatar->getGravatar(), $presenter->getTemplate()->getParameters()['gravatar']);
});


test('The default template receives the URL as a parameter', function () {
	$template = new Nette\Bridges\ApplicationLatte\DefaultTemplate(new Latte\Engine);
	$presenter = new class ($template) extends Presenter {
		use GravatarAdapter;

		public function __construct(
			private Template $defaultTemplate,
		) {
			parent::__construct();
		}


		protected function createTemplate(?string $class = null): Template
		{
			return $this->defaultTemplate;
		}


		public function render(): void
		{
			$this->onRender($this);
		}
	};

	$gravatar = new Gravatar(new Options);
	$gravatar->setEmail('someone@somewhere.com');
	$presenter->injectGravatar($gravatar, $presenter);
	$presenter->render();

	Assert::same($gravatar->getGravatar(), $template->getParameters()['gravatar']);
});


test('Rendering without an email does not fail and leaves the variable unset', function () {
	$presenter = new GravatarPresenter;
	$presenter->injectGravatar(new Gravatar(new Options), $presenter);

	Assert::noError(fn() => $presenter->render());
	Assert::false(isset($presenter->getTemplate()->getParameters()['gravatar']));
});
