# xactsystems/phpstan-dev

Package to extract and provide PHPStan source code for developing custom rules.
Author: Ian Foulds.

PHPStan does not provide a method to load the source code via a package manager. Instead it needs extracting from the .phar archive.

If you use PHPStorm of PHP Tools by DEVSENSE then this issue is covered, but not everyone does!

Personally I think this whole approach goes against the ethos of a package manager, it should just be a package!

So, I've created this composer plugin that required phpstan as a dependency, extracts the source code, and links the PHPStan namespace to it.

## Installation
To use this extension, require it in Composer:

```bash
composer require --dev xactsystems/phpstan-dev
```

## Usage

This plugin will expose the \PHPStan namespace so that you can create your custom rules and collectors.

See the following pages for more details:
https://phpstan.org/developing-extensions/rules
https://phpstan.org/developing-extensions/collectors
