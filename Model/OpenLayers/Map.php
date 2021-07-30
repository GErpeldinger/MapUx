<?php

declare(strict_types=1);

namespace MapUx\Model\OpenLayers;

use MapUx\Model\AbstractMap;

/**
 * @final
 * @experimental
 */
class Map extends AbstractMap
{
    public const DEFAULT_CONTROLLER = 'mapux--open-layers--map';

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
            'center'     => $this->getCenter(),
            'zoom'       => $this->getZoom(),
        ];
    }

    public function createBackground(): array
    {
        $background = [
            'url'     => $this->getBackground()->getUrl(),
            'maxZoom' => $this->getBackground()->getMaxZoom()
        ];

        if (null !== $this->getBackground()->getAttribution()) {
            $background['attributions'] = $this->getBackground()->getAttribution();
        }

        return $background;
    }

    /**
     * @inheritDoc
     */
    public function getCenter(): array
    {
        return [
            $this->getLongitude(),
            $this->getLatitude()
        ];
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
