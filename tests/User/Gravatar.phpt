<?php

/**
 * Test: Drago\User\Gravatar
 */

declare(strict_types=1);

use Drago\User\EmailException;
use Drago\User\Gravatar;
use Drago\User\SizeException;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';


function gravatar(): Gravatar
{
	return new Gravatar(80, 'mm', 'g');
}


test('Email validation', function () {
	Assert::exception(function () {
		gravatar()->setEmail('someone@somewhere');
		gravatar()->getGravatar();
	}, EmailException::class, 'Email address is not valid.');
});


test('Size validation', function () {
	$gravatar = gravatar();
	$gravatar->setEmail('someone@somewhere.com');

	Assert::exception(function () use ($gravatar) {
		$gravatar->setSize(0);
	}, SizeException::class, 'Size must be between 1 and 2048 pixels.');
});
