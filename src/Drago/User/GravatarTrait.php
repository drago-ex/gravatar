<?php

/**
 * Drago Extension
 * Package built on Nette Framework
 */

declare(strict_types=1);

namespace Drago\User;


/**
 * Trait providing Gravatar functionality.
 * This trait can be used to inject and utilize a Gravatar instance.
 */
trait GravatarTrait
{
	private Gravatar $gravatar;


	/**
	 * Injects a Gravatar instance into the class using this trait.
	 * This method allows setting up the Gravatar object to be used later for generating avatars.
	 *
	 * @param Gravatar $gravatar The Gravatar instance to inject.
	 */
	public function injectGravatar(Gravatar $gravatar): void
	{
		$this->gravatar = $gravatar;
	}
}
