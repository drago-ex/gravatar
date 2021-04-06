<?php

declare(strict_types=1);

/**
 * Drago Extension
 * Package built on Nette Framework
 */

namespace Drago\User;

use Exception;
use Nette\SmartObject;
use Nette\Utils\Strings;
use Nette\Utils\Validators;


/**
 * Simple gravatar.
 */
class Gravatar
{
	use SmartObject;

	private string $url = 'https://www.gravatar.com/avatar/';
	private string $email;


	public function __construct(
		private int $size,
		private string $defaultImage,
		private string $rating,
	) {
		$this->setSize($this->size);
	}


	/**
	 * @throws Exception
	 */
	public function setSize(int $size): void
	{
		if ($size > 2048 || $size < 1) {
			throw new Exception('Size must be between 1 pixels and 2048 pixels.');
		}
		$this->size = $size;
	}


	/**
	 * @throws Exception
	 */
	public function setEmail(string $email): void
	{
		if (!Validators::isEmail($email)) {
			throw new Exception('Email address is not valid.');
		}

		$hash = Strings::lower(Strings::trim($email));
		$this->email = hash('md5', $hash);
	}


	public function getGravatar(): string
	{
		return $this->url . $this->email
			. '?s=' . $this->size
			. '&d=' . $this->defaultImage
			. '&r=' . $this->rating;
	}
}
