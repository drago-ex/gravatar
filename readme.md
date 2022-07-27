## Drago Gravatar
Simple Gravatar.

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://raw.githubusercontent.com/drago-ex/gravatar/master/license.md)
[![PHP version](https://badge.fury.io/ph/drago-ex%2Fgravatar.svg)](https://badge.fury.io/ph/drago-ex%2Fgravatar)
[![Tests](https://github.com/drago-ex/gravatar/actions/workflows/tests.yml/badge.svg)](https://github.com/drago-ex/gravatar/actions/workflows/tests.yml)
[![CodeFactor](https://www.codefactor.io/repository/github/drago-ex/gravatar/badge)](https://www.codefactor.io/repository/github/drago-ex/gravatar)
[![Coverage Status](https://coveralls.io/repos/github/drago-ex/gravatar/badge.svg?branch=master)](https://coveralls.io/github/drago-ex/gravatar?branch=master)

## Technology
- PHP 8.0 or higher
- composer

## Installation
```
composer require drago-ex/gravatar
```

## Extension registration
```neon
extensions:
	- Drago\User\DI\GravatarExtension(size: 80, defaultImage: 'mm', rating: 'g')
```

## Use
```php
$gravatar = $this->gravatar;
$gravatar->setEmail('someone@somewhere.com');
$this->template->gravatar = $gravatar->getGravatar();
```

## Template
```latte
<img src="{$gravatar}" alt="">
```
