<?php

declare(strict_types=1);

namespace Drago\Gravatar;

use Nette\Bridges\ApplicationLatte\Template;


/** Custom class template with Gravatar image URL property. */
class GravatarTemplate extends Template
{
	public string $gravatar;
}
