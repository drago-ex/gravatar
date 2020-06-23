<p align="center">
  <img src="https://avatars0.githubusercontent.com/u/11717487?s=400&u=40ecb522587ebbcfe67801ccb6f11497b259f84b&v=4" width="100" alt="logo">
</p>

<h3 align="center">Drago Extension</h3>
<p align="center">Extension for Nette Framework</p>

## Drago Gravatar
Simple Gravatar.

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://raw.githubusercontent.com/drago-ex/gravatar/master/license.md)
[![PHP version](https://badge.fury.io/ph/drago-ex%2Fgravatar.svg)](https://badge.fury.io/ph/drago-ex%2Fgravatar)
[![Build Status](https://travis-ci.org/drago-ex/gravatar.svg?branch=master)](https://travis-ci.org/drago-ex/gravatar)
[![CodeFactor](https://www.codefactor.io/repository/github/drago-ex/gravatar/badge)](https://www.codefactor.io/repository/github/drago-ex/gravatar)
[![Coverage Status](https://coveralls.io/repos/github/drago-ex/gravatar/badge.svg?branch=master)](https://coveralls.io/github/drago-ex/gravatar?branch=master)

## Technology
- PHP 7.4 or higher
- composer

## Installation
```
composer require drago-ex/gravatar
```

## Extension registration
```php
extensions:
	- Drago\User\DI\GravatarExtension(80, 'mm', 'g')
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
