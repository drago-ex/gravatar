# Drago Gravatar

[English](readme.md) | Čeština

Jednoduché a přizpůsobitelné zapojení Gravataru do PHP aplikací.

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://github.com/drago-ex/gravatar/blob/main/license)
[![PHP version](https://badge.fury.io/ph/drago-ex%2Fgravatar.svg)](https://badge.fury.io/ph/drago-ex%2Fgravatar)
[![Tests](https://github.com/drago-ex/gravatar/actions/workflows/tests.yml/badge.svg)](https://github.com/drago-ex/gravatar/actions/workflows/tests.yml)
[![Coding Style](https://github.com/drago-ex/gravatar/actions/workflows/coding-style.yml/badge.svg)](https://github.com/drago-ex/gravatar/actions/workflows/coding-style.yml)

## Požadavky

- PHP >= 8.3, < 9
- Nette Framework
- Composer

## Instalace

```
composer require drago-ex/gravatar
```

## Registrace rozšíření

Po instalaci zaregistrujte rozšíření v konfiguraci Nette (soubor `neon`):
```neon
extensions:
	gravatar: Drago\Gravatar\DI\GravatarExtension
```

## Volitelná konfigurace

```neon
gravatar:
	size: 80
	defaultImage: "mm"
	rating: "g"
```

Velikost, `defaultImage` a hodnocení můžete nastavit podle svých potřeb.

## Přehled

Drago Gravatar vytváří URL obrázků Gravataru z e-mailových adres uživatelů s nastavitelnou velikostí,
výchozím obrázkem a hodnocením.

## Použití ve službách a šablonách

Nechte si předat `Drago\Gravatar\Gravatar` a volejte `getUrl()`. Nemění stav sdílené
služby, takže je bezpečná i pro seznamy více uživatelů:

```php
$url = $this->gravatar->getUrl('someone@somewhere.com');
$small = $this->gravatar->getUrl('someone@somewhere.com', 40);
```

## Gravatar v presenterech

Trait `GravatarAdapter` předá URL do šablony jako `$gravatar`, když presenter nastaví e-mail:

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

Když e-mail nastavený není, proměnná se nepředá a vykreslení pokračuje normálně. U typované
třídy šablony deklarujte vlastnost:

```php
public string $gravatar;
```

## V šabloně

```latte
<img n:if="isset($gravatar)" src="{$gravatar}" alt="">
```

## Volby

- `size`: velikost obrázku v pixelech, 1 až 2048. Výchozí je `80`. `setSize()` ji změní jen pro službu, ne v konfiguraci.
- `defaultImage`: obrázek pro uživatele bez Gravataru, například `mm`, `identicon`, `monsterid`, `wavatar` nebo URL vlastního obrázku. Výchozí je `mm`. Hodnoty se kódují do URL.
- `rating`: nejvyšší hodnocení, jedno z `g`, `pg`, `r`, `x`. Výchozí je `g`. Jiné hodnoty vyhodí `InvalidArgumentException`.

E-mail se ořízne, převede na malá písmena a zahashuje přes SHA-256, jak uvádí dokumentace Gravataru.
Neplatné e-maily vyhodí `Drago\Gravatar\EmailException`, neplatné velikosti `Drago\Gravatar\SizeException`.
`getGravatar()` vyhodí `EmailException`, když nebylo zavoláno `setEmail()`.
