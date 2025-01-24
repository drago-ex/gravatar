<?php

/**
 * Drago Extension
 * Package built on Nette Framework
 */

declare(strict_types=1);

namespace Drago\User;

use Exception;


/**
 * Custom exception for handling errors related to Gravatar size.
 * This exception is thrown when an invalid size is provided for Gravatar.
 */
class SizeException extends Exception
{
}
