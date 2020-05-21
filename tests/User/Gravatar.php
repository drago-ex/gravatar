<?php

declare(strict_types = 1);

use Drago\User;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';


function gravatar(): User\Gravatar
{
	return new User\Gravatar(80, 'mm', 'g');
}


test(function () {
	Assert::exception(function () {
		$gravatar = gravatar();
		$gravatar->setEmail('someone@somewhere');
		$gravatar->getGravatar();
	}, Exception::class, 'Email address is not valid.');
});
