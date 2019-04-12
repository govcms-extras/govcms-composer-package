<?php

namespace GovCMS\Composer\Package;

use Composer\Script\Event;
use Composer\Plugin\CommandEvent;
use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\Installer\PackageEvent;
use Composer\Installer\PackageEvents;
use Composer\IO\IOInterface;
use Composer\Plugin\Capable;
use Composer\Plugin\PluginEvents;
use Composer\Plugin\PluginInterface;
use Composer\Script\ScriptEvents;

/**
 * Composer plugin.
 */
class Plugin implements PluginInterface, EventSubscriberInterface, Capable
{
    protected $composer;
    protected $io;
    protected $handler;

    /**
     * {@inheritdoc}
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        $this->composer = $composer;
        $this->io = $io;
        $this->handler = new Handler($composer, $io);
    }

    /**
     * {@inheritdoc}
     */
    public function getCapabilities()
    {
        return array(
            'Composer\Plugin\Capability\CommandProvider' => 'GovCMS\Composer\Package\CommandProvider',
        );
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            PackageEvents::POST_PACKAGE_UPDATE => 'postPackage',
        ];
    }

    /**
     * Post package event behaviour.
     *
     * @param PackageEvent $event
     * @return void
     */
    public function postPackage(PackageEvent $event)
    {
        $this->handler->onPostPackageEvent($event);
    }
}
