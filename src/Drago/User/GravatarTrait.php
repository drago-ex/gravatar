<?php

declare(strict_types = 1);

/**
 * Drago Extension
 * Package built on Nette Framework
 */

namespace Drago\User;


/**
 * Simple gravatar.
 */
trait GravatarTrait
{
	private Gravatar $gravatar;


	public function injectGravatar(Gravatar $gravatar): void
	{
		$this->gravatar = $gravatar;
	}
}
