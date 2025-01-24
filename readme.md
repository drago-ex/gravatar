## Drago Gravatar
Simple and customizable Gravatar integration for PHP applications.

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://raw.githubusercontent.com/drago-ex/gravatar/master/license.md)
[![PHP version](https://badge.fury.io/ph/drago-ex%2Fgravatar.svg)](https://badge.fury.io/ph/drago-ex%2Fgravatar)
[![Tests](https://github.com/drago-ex/gravatar/actions/workflows/tests.yml/badge.svg)](https://github.com/drago-ex/gravatar/actions/workflows/tests.yml)
[![Coding Style](https://github.com/drago-ex/gravatar/actions/workflows/coding-style.yml/badge.svg)](https://github.com/drago-ex/gravatar/actions/workflows/coding-style.yml)
[![CodeFactor](https://www.codefactor.io/repository/github/drago-ex/gravatar/badge)](https://www.codefactor.io/repository/github/drago-ex/gravatar)
[![Coverage Status](https://coveralls.io/repos/github/drago-ex/gravatar/badge.svg?branch=master)](https://coveralls.io/github/drago-ex/gravatar?branch=master)

## Technology
- PHP 8.3 or higher
- composer

## Installation
```
composer require drago-ex/gravatar
```

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

## Extension registration
After installation, register the extension in your Nette configuration (`neon` file):
```neon
extensions:
	- Drago\User\DI\GravatarExtension(size: 80, defaultImage: 'mm', rating: 'g')
```
You can adjust the size, `defaultImage`, and rating parameters based on your needs.

## Usage
Once the extension is registered, you can use the Gravatar functionality in your presenters and templates.

## In Presenter
In your presenter, you can access the Gravatar service, set the user's email, and pass
the generated Gravatar URL to the template:
```php
$gravatar = $this->gravatar;
$gravatar->setEmail('someone@somewhere.com');
$this->template->gravatar = $gravatar->getGravatar();
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
