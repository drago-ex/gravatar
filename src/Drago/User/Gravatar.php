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
class Gravatar
{
	use Nette\SmartObject;

	/** @var string */
	private const URL = 'https://www.gravatar.com/avatar/';

	/** @var string */
	private $image;

	/** @var string */
	private $size;

	/** @var string */
	private $rating;


	public function setEmail(string $email): void
	{

	}


	public function setSize(int $size = null): void
	{

	}


	public function getGravatar(): string
	{

	}
}
