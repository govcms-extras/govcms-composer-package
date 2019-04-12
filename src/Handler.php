<?php

namespace GovCMS\Composer\Package;

use Composer\Script\Event;
use Composer\Installer\PackageEvent;
use Composer\Plugin\CommandEvent;
use Composer\Composer;
use Composer\DependencyResolver\Operation\InstallOperation;
use Composer\DependencyResolver\Operation\UpdateOperation;
use Composer\EventDispatcher\EventDispatcher;
use Composer\IO\IOInterface;
use Composer\Package\PackageInterface;
use Composer\Util\Filesystem;
use Composer\Util\RemoteFilesystem;
use Symfony\Component\Filesystem\Filesystem as SymfonyFilesystem;

/**
 * Core class of the plugin.
 */
class Handler
{
    protected $composer;
    protected $io;

    /**
     * Handler constructor.
     *
     * @param Composer $composer
     * @param IOInterface $io
     */
    public function __construct(Composer $composer, IOInterface $io)
    {
        $this->composer = $composer;
        $this->io = $io;

        // Avoid problems in `composer update` operations.
        $this->manualLoad();
    }

    /**
     * Pre-load all of our sources.
     *
     * @return void
     */
    protected function manualLoad()
    {
        $src_dir = __DIR__;

        $classes = [
            'CommandProvider',
            'Package',
        ];

        foreach ($classes as $src) {
            if (!class_exists('\\GovCMS\\Composer\\Package\\' . $src)) {
                include "{$src_dir}/{$src}.php";
            }
        }
    }

    /**
     * Package the make file after an install or update command.
     *
     * @param PackageEvent $event
     * @return void
     */
    public function onPostPackageEvent(PackageEvent $event)
    {
        // Package.
    }
}
