<?php

declare(strict_types = 1);

/**
 * Drago Extension
 * Package built on Nette Framework
 */

namespace Drago\User;

use Nette;
use Nette\Utils\Strings;


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

	/** @var string */
	private $email;


	public function __construct(int $size, string $defaultImage, string $rating)
	{
		$this->size = $size;
		$this->defaultImage = $defaultImage;
		$this->rating = $rating;
	}


	public function setSize(int $size): void
	{
		$this->size = $size;
	}


	/**
	 * @throws \Exception
	 */
	private function getSize(): int
	{
		if ($this->size > 2048 || $this->size < 1) {
			throw new \Exception('Size must be between 1 pixels and 2048 pixels.');
		}
		return $this->size;
	}


	/**
	 * @throws \Exception
	 */
	public function setEmail(string $email): void
	{
		if (!Nette\Utils\Validators::isEmail($email)) {
			throw new \Exception('Email address is not valid.');
		}

		$hash = Strings::lower(Strings::trim($email));
		$this->email = hash('md5', $hash);
	}


	private function getEmail(): string
	{
		return $this->email;
	}


	public function getGravatar(): string
	{
		$gravatar = self::URL;
		$gravatar .= $this->getEmail();
		$gravatar .= '?s=' . $this->getSize();
		$gravatar .= '&d=' . $this->defaultImage;
		$gravatar .= '&r=' . $this->rating;
		return $gravatar;
	}
}
