<?php

declare(strict_types=1);

namespace MapUx\Model\Leaflet;

use MapUx\Model\AbstractMap;

/**
 * @final
 * @experimental
 */
class Map extends AbstractMap
{
    public const DEFAULT_CONTROLLER = 'mapux--leaflet--map';

    /** @var string */
    protected $controller = self::DEFAULT_CONTROLLER;

    /** @var Layer */
    protected $background;

    /**
     * @inheritDoc
     */
    public function createView(): array
    {
        return [
            $this->getCenter(),
            $this->getZoom(),
        ];
    }

    public function createBackground(): array
    {
        return [
            $this->getBackground()->getUrl(),
            $this->getBackgroundOptions()
        ];
    }

    /**
     * @inheritDoc
     */
    public function getCenter(): array
    {
        return [
            'lat' => $this->getLatitude(),
            'lon' => $this->getLongitude(),
        ];
    }

    public function getBackgroundOptions(): array
    {
        $options = [
            'maxZoom' => $this->getBackground()->getMaxZoom()
        ];

        if (null !== $this->getBackground()->getAttribution()) {
            $options['attribution'] = $this->getBackground()->getAttribution();
        }

        return $options;
    }

    /**
     * Get the background tile
     *
     * @return Layer
     */
    public function getBackground(): Layer
    {
        return $this->background;
    }

    /**
     * Set the background tile url
     *
     * @param Layer $background
     */
    public function setBackground($background): void
    {
        $this->background = $background;
    }
}
