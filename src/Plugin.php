<?php

declare(strict_types=1);

namespace Xact\Phpstan\Dev;

use Composer\Composer;
use Composer\InstalledVersions;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Exception;
use Phar;

class Plugin implements PluginInterface
{
    protected Composer $composer;
    protected IOInterface $io;

    public function activate(Composer $composer, IOInterface $io): void
    {
        $this->composer = $composer;
        $this->io = $io;
        $this->extractPHPStan();
    }

    // phpcs:ignore SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
    public function deactivate(Composer $composer, IOInterface $io): void
    {
    }

    // phpcs:ignore SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
    public function uninstall(Composer $composer, IOInterface $io): void
    {
    }

    public function extractPHPStan(): void
    {
        if (InstalledVersions::isInstalled('phpstan/phpstan') === false) {
            throw new Exception("Could not find phpstan/phpstan, this should have been installed along with this package.");
        }

        $phpStanPath = (string)InstalledVersions::getInstallPath('phpstan/phpstan');
        $pharPath = "{$phpStanPath}/phpstan.phar";
        $extractPath = dirname(__DIR__) . "/phpstan";

        if (!is_file($pharPath)) {
            throw new Exception("phpstan/phpstan seems to be installed but could not find phpstan.phar.");
        }

        if (!file_exists($extractPath)) {
            $phar = new Phar($pharPath);
            $phar->extractTo($extractPath);
        }

        if (!file_exists($extractPath) || !file_exists("{$extractPath}/src")) {
            throw new Exception("Could not find phpstan/src after extracting the .phar file.");
        }
    }
}
