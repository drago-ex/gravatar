<?php

declare(strict_types=1);

namespace Drago\Gravatar;

use Nette\Utils\Strings;
use Nette\Utils\Validators;


/** Generates a Gravatar URL based on email, size, default image, and rating. */
class Gravatar
{
	private string $url = 'https://www.gravatar.com/avatar/';
	private string $email;


	/** @throws SizeException */
	public function __construct(
		private readonly Options $options,
	) {
		$this->setSize($this->options->size);
	}


	/**
	 * Sets the size of the Gravatar image (1-2048 pixels).
	 * @throws SizeException
	 */
	public function setSize(int $size): void
	{
		if ($size > 2048 || $size < 1) {
			throw new SizeException('Size must be between 1 and 2048 pixels.');
		}
		$this->options->size = $size;
	}


	/**
	 * Sets and validates the email address for the Gravatar.
	 * @throws EmailException
	 */
	public function setEmail(string $email): void
	{
		if (!Validators::isEmail($email)) {
			throw new EmailException('Email address is not valid.');
		}

		$hash = Strings::lower(Strings::trim($email));
		$this->email = hash('md5', $hash);
	}


	/** Returns the complete Gravatar image URL. */
	public function getGravatar(): string
	{
		$options = $this->options;
		return $this->url . $this->email
			. '?s=' . $options->size
			. '&d=' . $options->defaultImage
			. '&r=' . $options->rating;
	}
}
