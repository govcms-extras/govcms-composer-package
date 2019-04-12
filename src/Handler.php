<?php

namespace GovCMS\Composer\Package;

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
            if (!class_exists('\\GovCMS\\Composer\\Package\\Plugin\\' . $src)) {
                include "{$src_dir}/{$src}.php";
            }
        }
    }
}
