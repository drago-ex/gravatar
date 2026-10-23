<?php

/**
 * Test: Drago\Gravatar\Gravatar
 */

declare(strict_types=1);

use Drago\Gravatar\EmailException;
use Drago\Gravatar\Gravatar;
use Drago\Gravatar\Options;
use Drago\Gravatar\SizeException;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';


function createOptions(int $size = 80, string $defaultImage = 'mm', string $rating = 'g'): Options
{
	$options = new Options;
	$options->size = $size;
	$options->defaultImage = $defaultImage;
	$options->rating = $rating;
	return $options;
}


test('The URL contains the hash of the normalized email and the options', function () {
	$gravatar = new Gravatar(createOptions());
	$gravatar->setEmail(' Someone@Somewhere.com ');

	Assert::same(
		'https://www.gravatar.com/avatar/' . hash('sha256', 'someone@somewhere.com') . '?s=80&d=mm&r=g',
		$gravatar->getGravatar(),
	);
});


test('A custom default image URL is encoded', function () {
	$gravatar = new Gravatar(createOptions(defaultImage: 'https://example.com/a b.png?x=1&y=2'));
	$gravatar->setEmail('someone@somewhere.com');

	Assert::same(
		'https://www.gravatar.com/avatar/' . hash('sha256', 'someone@somewhere.com')
			. '?s=80&d=https%3A%2F%2Fexample.com%2Fa%20b.png%3Fx%3D1%26y%3D2&r=g',
		$gravatar->getGravatar(),
	);
});


test('getUrl() builds the URL without changing the state of the service', function () {
	$gravatar = new Gravatar(createOptions());

	Assert::match('%a%?s=200&d=mm&r=g', $gravatar->getUrl('someone@somewhere.com', 200));
	Assert::match('%a%?s=80&d=mm&r=g', $gravatar->getUrl('someone@somewhere.com'));
	Assert::false($gravatar->hasEmail());
});


test('Changing the size does not change the shared options', function () {
	$options = createOptions();
	$gravatar = new Gravatar($options);
	$gravatar->setSize(120);
	$gravatar->setEmail('someone@somewhere.com');

	Assert::match('%a%?s=120&%a%', $gravatar->getGravatar());
	Assert::same(80, $options->size);
});


test('The size must be between 1 and 2048 pixels', function () {
	$gravatar = new Gravatar(createOptions());
	Assert::exception(fn() => $gravatar->setSize(0), SizeException::class);
	Assert::exception(fn() => $gravatar->setSize(2049), SizeException::class);
	Assert::exception(fn() => new Gravatar(createOptions(size: 5000)), SizeException::class);
});


test('Only known ratings are accepted', function () {
	Assert::exception(
		fn() => new Gravatar(createOptions(rating: 'xxx')),
		InvalidArgumentException::class,
		"Gravatar rating must be one of g, pg, r, x, 'xxx' given.",
	);
});


test('An invalid email is rejected', function () {
	$gravatar = new Gravatar(createOptions());
	Assert::exception(fn() => $gravatar->setEmail('not-an-email'), EmailException::class);
	Assert::exception(fn() => $gravatar->getUrl('not-an-email'), EmailException::class);
});


test('Reading the URL before setting the email throws a descriptive exception', function () {
	$gravatar = new Gravatar(createOptions());
	Assert::false($gravatar->hasEmail());
	Assert::exception(
		fn() => $gravatar->getGravatar(),
		EmailException::class,
		'Email address is not set, call setEmail() first.',
	);
});
