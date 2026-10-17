# Drago Gravatar

Simple and customizable Gravatar integration for PHP applications.

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://github.com/drago-ex/gravatar/blob/main/license)
[![PHP version](https://badge.fury.io/ph/drago-ex%2Fgravatar.svg)](https://badge.fury.io/ph/drago-ex%2Fgravatar)
[![Tests](https://github.com/drago-ex/gravatar/actions/workflows/tests.yml/badge.svg)](https://github.com/drago-ex/gravatar/actions/workflows/tests.yml)
[![Coding Style](https://github.com/drago-ex/gravatar/actions/workflows/coding-style.yml/badge.svg)](https://github.com/drago-ex/gravatar/actions/workflows/coding-style.yml)

## Requirements

- PHP >= 8.3, < 9
- Nette Framework
- Composer

## Installation

```
composer require drago-ex/gravatar
```

## Extension Registration

After installation, register the extension in your Nette configuration (`neon` file):
```neon
extensions:
	gravatar: Drago\Gravatar\DI\GravatarExtension
```

## Optional configuration

```neon
gravatar:
	size: 80
	defaultImage: "mm"
	rating: "g"
```

You can adjust the size, `defaultImage`, and rating parameters based on your needs.

## Overview

Drago Gravatar generates Gravatar image URLs from user email addresses, with a configurable size,
default image and rating.

## Usage in Services and Templates

Inject `Drago\Gravatar\Gravatar` and call `getUrl()`. It does not change the state of the shared
service, so it is safe for lists of several users:

```php
$url = $this->gravatar->getUrl(someone@somewhere.com);
$small = $this->gravatar->getUrl(someone@somewhere.com, 40);
```

## Using Gravatar in Presenters

The `GravatarAdapter` trait passes the URL to the template as `$gravatar` when the presenter sets an email:

```php
use Drago\Gravatar\GravatarAdapter;
use Nette\Application\UI\Presenter;

final class ProfilePresenter extends Presenter
{
	use GravatarAdapter;

	protected function beforeRender(): void
	{
		parent::beforeRender();
		$this->gravatar->setEmail($this->getUser()->getIdentity()->email);
	}
}
```

When no email is set, the variable is not passed and rendering continues normally. With a typed
template class, declare the property:

```php
public string $gravatar;
```

## In Template

```latte
<img n:if="isset($gravatar)" src="{$gravatar}" alt="">
```

## Options

- `size`: image size in pixels, 1 to 2048. Default is `80`. `setSize()` changes it only for the service, not the configuration.
- `defaultImage`: image used when the user has no Gravatar, for example `mm`, `identicon`, `monsterid`, `wavatar`, or a URL of your own image. Default is `mm`. Values are URL-encoded.
- `rating`: maximum rating, one of `g`, `pg`, `r`, `x`. Default is `g`. Other values throw `InvalidArgumentException`.

Invalid emails throw `Drago\Gravatar\EmailException`, invalid sizes `Drago\Gravatar\SizeException`.
`getGravatar()` throws `EmailException` when `setEmail()` has not been called.
