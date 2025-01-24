<?php

/**
 * Drago Extension
 * Package built on Nette Framework
 */

declare(strict_types=1);

namespace Drago\User;

use Nette\Utils\Strings;
use Nette\Utils\Validators;


/**
 * Simple Gravatar service.
 * Generates a Gravatar URL based on the provided email, size, default image, and rating.
 */
class Gravatar
{
	private string $url = 'https://www.gravatar.com/avatar/';
	private string $email;


	/**
	 * Initializes the Gravatar instance with size, default image, and rating.
	 *
	 * @param int $size The size of the Gravatar image (1-2048 pixels).
	 * @param string $defaultImage The default image to use if the user doesn't have a Gravatar.
	 * @param string $rating The rating of the Gravatar image (g, pg, r, x).
	 *
	 * @throws SizeException If the size is out of range.
	 */
	public function __construct(
		private int $size,
		private readonly string $defaultImage,
		private readonly string $rating,
	) {
		$this->setSize($this->size);
	}


	/**
	 * Sets the size of the Gravatar image.
	 * Throws an exception if the size is not within the valid range (1-2048 pixels).
	 *
	 * @param int $size The size of the Gravatar image.
	 *
	 * @throws SizeException If the size is out of range.
	 */
	public function setSize(int $size): void
	{
		if ($size > 2048 || $size < 1) {
			throw new SizeException('Size must be between 1 and 2048 pixels.');
		}
		$this->size = $size;
	}


	/**
	 * Sets the email address for the Gravatar.
	 * The email is validated, normalized (trimmed and lowercased), and hashed.
	 *
	 * @param string $email The email address.
	 *
	 * @throws EmailException If the email address is invalid.
	 */
	public function setEmail(string $email): void
	{
		if (!Validators::isEmail($email)) {
			throw new EmailException('Email address is not valid.');
		}

		// Normalize email (trim and convert to lowercase) and hash it
		$hash = Strings::lower(Strings::trim($email));
		$this->email = hash('md5', $hash);
	}


	/**
	 * Gets the Gravatar URL.
	 * Returns the complete URL for the Gravatar image based on the provided email, size, default image, and rating.
	 *
	 * @return string The Gravatar image URL.
	 */
	public function getGravatar(): string
	{
		return $this->url . $this->email
			. '?s=' . $this->size
			. '&d=' . $this->defaultImage
			. '&r=' . $this->rating;
	}
}
