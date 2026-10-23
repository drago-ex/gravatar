# Agent Guide

Use this file as package-specific guidance when working in this repository. Keep changes aligned with the existing public API, project conventions, and supported PHP range.

## Package Overview
- **Package**: `drago-ex/gravatar`
- **Type**: library
- **Purpose**: Simple and customizable Gravatar integration for PHP applications, allowing easy Gravatar image generation based on user email with options for size, default image, and rating.
- **PHP**: >=8.3 <9
- **Runtime dependencies**: nette/di (^3.2.1), nette/schema (^1.2), nette/utils (^4.0), nette/application (^3.2)
- **License**: MIT

## Repository Layout
- `src/`: package source code.
- `tests/`: automated tests.
- `.github/`: CI workflows; keep their PHP versions and commands consistent with Composer and the package scripts.
- `composer.json`: package metadata, dependency constraints, autoloading, and available Composer scripts.

## Key Parts
- `Drago\Gravatar\Gravatar`: `getUrl($email, $size)` is stateless and preferred; `setEmail()` with `getGravatar()` keeps per-service state. Options are validated (size 1-2048, rating g/pg/r/x) and query parameters are URL-encoded. The email is trimmed, lowercased and hashed with SHA-256 (the hash Gravatar documents; MD5 was used before 2026-10-23).
- `GravatarAdapter` passes `$gravatar` to the template only when an email is set; typed templates must declare the property.

## Dependencies

Composer constraints describe the package contract. Before changing integration behavior, inspect the source and the actual call sites in this package; do not infer runtime usage solely from dependency declarations.
Development dependencies include nette/tester (^2.5), phpstan/phpstan-nette (^2.0), latte/latte (^3.0).

## Essential Commands

```bash
composer tester                 # tester tests -s -C
composer phpstan                # phpstan analyse
```

## Conventions & Rules

- Preserve backward compatibility unless the task explicitly permits a breaking change. Check callers and public signatures before changing behavior.
- Follow the existing PHP style: strict types, explicit parameter and return types, tabs for indentation, and single-quoted strings where practical. Match nearby code when a convention is unclear.
- Keep package-specific configuration, resources, and migrations in their established directories. Do not edit generated or consuming-project files without confirming they are part of this repository’s intended output.
- Add or update focused tests for behavioral changes when this package has a runnable test setup. Do not invent test commands; use only the scripts and configuration present here.
- Update README examples and Composer metadata when a public API or supported requirement changes.
