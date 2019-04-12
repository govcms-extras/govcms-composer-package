<?php

namespace GovCMS\Composer\Package;

use GovCMS\Composer\Package\Handler\AbstractHandler;
use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Installer\PackageEvent;

/**
 * Core class of the plugin.
 */
class Handler extends AbstractHandler
{
    /**
     * Handler constructor.
     *
     * @param Composer $composer
     * @param IOInterface $io
     */
    public function __construct(Composer $composer, IOInterface $io)
    {
        parent::__construct($composer, $io);
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
