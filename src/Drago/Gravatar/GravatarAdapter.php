<?php

declare(strict_types=1);

namespace Drago\Gravatar;

use Nette\Application\UI\Presenter;
use Nette\Bridges\ApplicationLatte\Template;


trait GravatarAdapter
{
	private Gravatar $gravatar;


	public function injectGravatar(Gravatar $gravatar, Presenter $presenter): void
	{
		$this->gravatar = $gravatar;
		$presenter->onRender[] = function () use ($presenter): void {
			$template = $presenter->getTemplate();
			if ($template instanceof Template) {
				$template->gravatar = $this->gravatar->getGravatar();
			}
		};
	}
}
