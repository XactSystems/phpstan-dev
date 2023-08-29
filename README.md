# xactsystems/phpstan-dev

A package to extract and provide PHPStan source code for developing custom rules.

PHPStan does not provide a method to load the source code via a package manager. Instead it needs extracting from the .phar archive.

If you use PHPStorm of PHP Tools by DEVSENSE then this issue is covered, but not everyone does!

Personally I think this whole approach goes against the ethos of a package manager, it should just be a package!

So, I've created this composer plugin that requires phpstan as a dependency, extracts the source code, and links the PHPStan namespace to it.

## Installation
To use this extension, require it in Composer:

```bash
composer require --dev xactsystems/phpstan-dev
```

Authorise the plugin, please answer y to the following prompt:
xactsystems/phpstan-dev contains a Composer plugin which is currently not in your allow-plugins config. See https://getcomposer.org/allow-plugins
Do you trust "xactsystems/phpstan-dev" to execute code and wish to enable it now? (writes "allow-plugins" to composer.json) [y,n,d,?] y

## Usage

This plugin will expose the \PHPStan namespace so that you can create your custom rules and collectors.

See the following pages for more details:
https://phpstan.org/developing-extensions/rules
https://phpstan.org/developing-extensions/collectors

## Why a plugin?
Although there are events within the Composer ecosystem, none of these fire for the packages being managed, they fire only for the top level package that is requiring them. Composer plugins on the other hand fire within the package being required.

In this situation we simply use the Activate method to check and see if the PHPStan source code has been extracted. If it's not we do so.
