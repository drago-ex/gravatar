<?php

declare(strict_types = 1);

/**
 * Drago Extension
 * Package built on Nette Framework
 */

namespace Drago\User;

use Nette;


/**
 * Simple gravatar.
 */
trait GravatarTrait
{
	/** @var Gravatar */
	private $gravatar;


	public function injectGravatar(Gravatar $gravatar, Nette\Application\UI\Presenter $presenter): void
	{
		$this->gravatar = $gravatar;
		$presenter->onRender[] = function () use ($presenter) {
			$presenter->template->gravatar = $this->gravatar;
		};
	}
}
