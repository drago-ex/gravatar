<?php

declare(strict_types=1);

namespace Drago\Gravatar;

use InvalidArgumentException;
use Nette\Utils\Strings;
use Nette\Utils\Validators;


class Gravatar
{
	private const array Ratings = ['g', 'pg', 'r', 'x'];

	private string $url = 'https://www.gravatar.com/avatar/';
	private ?string $email = null;
	private int $size;


	/**
	 * @throws SizeException
	 * @throws InvalidArgumentException When the rating is not one of g, pg, r, x.
	 */
	public function __construct(
		private readonly Options $options,
	) {
		if (!in_array($this->options->rating, self::Ratings, true)) {
			throw new InvalidArgumentException(sprintf(
				"Gravatar rating must be one of %s, '%s' given.",
				implode(', ', self::Ratings),
				$this->options->rating,
			));
		}

		$this->setSize($this->options->size);
	}


	/**
	 * Sets the size of the Gravatar image (1-2048 pixels) for this service only;
	 * the configured options are not changed.
	 * @throws SizeException
	 */
	public function setSize(int $size): void
	{
		$this->size = $this->validateSize($size);
	}


	/**
	 * Sets and validates the email address for the Gravatar.
	 * @throws EmailException
	 */
	public function setEmail(string $email): void
	{
		$this->email = $this->hashEmail($email);
	}


	public function hasEmail(): bool
	{
		return $this->email !== null;
	}


	/**
	 * Returns the URL for the email set by setEmail().
	 * @throws EmailException When no email has been set.
	 */
	public function getGravatar(): string
	{
		if ($this->email === null) {
			throw new EmailException('Email address is not set, call setEmail() first.');
		}

		return $this->buildUrl($this->email, $this->size);
	}


	/**
	 * Returns the URL for the given email without changing the state of the service,
	 * so it is safe to use for several users, e.g. in a list.
	 * @throws EmailException
	 * @throws SizeException
	 */
	public function getUrl(string $email, ?int $size = null): string
	{
		$size = $size === null ? $this->size : $this->validateSize($size);
		return $this->buildUrl($this->hashEmail($email), $size);
	}


	private function buildUrl(string $hash, int $size): string
	{
		return $this->url . $hash . '?' . http_build_query([
			's' => $size,
			'd' => $this->options->defaultImage,
			'r' => $this->options->rating,
		], encoding_type: PHP_QUERY_RFC3986);
	}


	/** @throws EmailException */
	private function hashEmail(string $email): string
	{
		$email = Strings::lower(Strings::trim($email));
		if (!Validators::isEmail($email)) {
			throw new EmailException('Email address is not valid.');
		}

		return hash('sha256', $email); // the hash Gravatar documents (MD5 is legacy)
	}


	/** @throws SizeException */
	private function validateSize(int $size): int
	{
		if ($size > 2048 || $size < 1) {
			throw new SizeException('Size must be between 1 and 2048 pixels.');
		}

		return $size;
	}
}
