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

	/** @var int */
	private $size;

	/** @var string */
	private $defaultImage;

	/** @var string */
	private $rating;


	/**
	 * @throws \Exception
	 */
	public function setSize(int $size = null): void
	{
		if ($size > 2048 || $size < 0) {
			throw new \Exception('Size must be between 1 pixels and 2048 pixels.');
		}
	}


	/**
	 * @throws \Exception
	 */
	public function setEmail(string $email): void
	{
		if (!Nette\Utils\Validators::isEmail($email)) {
			throw new \Exception('Email address is not valid.');
		}
	}


	public function getGravatar(): string
	{

	}
}
