<?php declare(strict_types=1);

use Drago\Gravatar\GravatarAdapter;


/** Lets PHPStan analyse the GravatarAdapter trait, which no class in the package uses. */
class TraitStub
{
	use GravatarAdapter;
}
