<?php

declare(strict_types=1);

namespace Drago\Gravatar;


use Nette\Application\UI\Presenter;

/** Trait providing Gravatar injection functionality. */
trait GravatarAdapter
{
	private Gravatar $gravatar;


	/** Injects a Gravatar instance into the class using this trait. */
	public function injectGravatar(Gravatar $gravatar, Presenter $presenter): void
	{
		$this->gravatar = $gravatar;
		$presenter->onRender[] = function () use ($presenter): void {
			$template = $presenter->getTemplate();
			if ($template instanceof GravatarTemplate) {
				$template->gravatar = $this->gravatar->getGravatar();
			}
		};
	}
}
