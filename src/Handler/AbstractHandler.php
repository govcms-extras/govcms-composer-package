<?php

namespace GovCMS\Composer\Package\Handler;

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
 * AbstractHandler class.
 */
abstract class AbstractHandler
{
    protected $composer;
    protected $io;

    /**
     *  Pre-load classes.
     *
     * @var array
     */
    private $_classes = [
        'CommandProvider',
        'Package',
    ];

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
        if (empty($this->_classes)) {
            return;
        }

        $src_dir = __DIR__;
        foreach ($this->_classes as $src) {
            if (!class_exists('\\GovCMS\\Composer\\Package\\' . $src)) {
                include "{$src_dir}/{$src}.php";
            }
        }
    }
}
