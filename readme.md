# Drago Gravatar

Simple and customizable Gravatar integration for PHP applications.

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://github.com/drago-ex/gravatar/blob/master/license)
[![PHP version](https://badge.fury.io/ph/drago-ex%2Fgravatar.svg)](https://badge.fury.io/ph/drago-ex%2Fgravatar)
[![Tests](https://github.com/drago-ex/gravatar/actions/workflows/tests.yml/badge.svg)](https://github.com/drago-ex/gravatar/actions/workflows/tests.yml)
[![Coding Style](https://github.com/drago-ex/gravatar/actions/workflows/coding-style.yml/badge.svg)](https://github.com/drago-ex/gravatar/actions/workflows/coding-style.yml)

## Requirements
- PHP >= 8.3
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
	gravatar: Drago\User\DI\GravatarExtension
```

## Optional configuration
```neon
gravatar:
	size: 80
	defaultImage: "mm"
	rating: "g"
```

You can adjust the size, `defaultImage`, and rating parameters based on your needs.

## Examples
Once the extension is registered, you can use the Gravatar functionality in your presenters and templates.

## Overview
Drago Gravatar is a simple, customizable solution for integrating Gravatar images into your PHP
application. With this package, you can easily generate and display Gravatar images based
on user email addresses, allowing you to customize their size, default image, and rating.

## Features
- Generate Gravatar images based on user email.
- Customizable image size (from 1 to 2048 pixels).
- Choose a default image if the user has no Gravatar.
- Set image rating (g, pg, r, x).
- Easy integration into your Nette-based application.

## Using Gravatar in Presenters
Add the GravatarAdapter trait to your presenter:
```php
use Drago\Localization\TranslatorAdapter;

protected function beforeRender(): void
{
	parent::beforeRender();
	$this->gravatar->setEmail($this->getUser()->getIdentity()->email);
	$this->template->gravatar = $this->gravatar->getGravatar();
}
```

## In Template
In your Latte template, simply output the Gravatar image by using the URL provided by the presenter:
```latte
<img src="{$gravatar}" alt="">
```

## Customizing Gravatar
You can customize the Gravatar by changing the size, defaultImage, and rating parameters in the configuration:

`size`: The size of the Gravatar image in pixels (1 to 2048). Default is 80.
`defaultImage`: The default image used when the user doesn't have a Gravatar (e.g., `mm`, `identicon`, `monsterid`, `wavatar`, etc.). Default is `mm`.
`rating`: The rating of the Gravatar image (`g`, `pg`, `r`, `x`). Default is g.
