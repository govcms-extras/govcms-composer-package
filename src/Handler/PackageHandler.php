<?php

namespace GovCMS\Composer\Package\Handler;

use Composer\Package\RootPackageInterface;
use Composer\Package\Locker;

/**
 * PackageHandler class.
 */
class PackageHandler
{
    /**
     * The root Composer package (i.e., this composer.json).
     *
     * @var \Composer\Package\RootPackageInterface
     */
    protected $rootPackage;

    /**
     * The locker.
     *
     * @var \Composer\Package\Locker
     */
    protected $locker;

    /**
     * Package constructor.
     *
     * @param RootPackageInterface $root_package
     * @param Locker $locker
     */
    public function __construct(RootPackageInterface $root_package, Locker $locker)
    {
        $this->rootPackage = $root_package;
        $this->locker = $locker;
    }
}
