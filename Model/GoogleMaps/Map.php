<?php

declare(strict_types=1);

namespace MapUx\Model\GoogleMaps;

use MapUx\Model\AbstractMap;
use MapUx\Model\GoogleMaps\Layer as GoogleMapsLayer;

class Map extends AbstractMap
{
    public const DEFAULT_CONTROLLER = 'mapux--google-maps--map';

    /** @var string */
    protected $controller = self::DEFAULT_CONTROLLER;

    /**
     * @inheritDoc
     */
    public function createView(): array
    {
        return [
            'center' => $this->getCenter(),
            'zoom'   => $this->getZoom(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function createBackground(): ?array
    {
        if (!$this->getBackground()) {
            return null;
        }

        return [
            'url'     => $this->getBackground()->getUrl(),
            'options' => $this->getBackgroundOptions()
        ];
    }

    /**
     * @inheritDoc
     */
    public function getCenter(): array
    {
        return [
            'latitude'  => $this->getLatitude(),
            'longitude' => $this->getLongitude(),
        ];
    }

    public function getBackgroundOptions(): ?array
    {
        if(null !== $this->getBackground()->getMaxZoom()) {
            $options = [
                'maxZoom' => $this->getBackground()->getMaxZoom()
            ];
        }

        if (null !== $this->getBackground()->getAttribution()) {
            $options['attribution'] = $this->getBackground()->getAttribution();
        }

        return $options ?? [];
    }

    /**
     * Get the background tile
     *
     * @return Layer
     */
    public function getBackground(): ?Layer
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

    /**
     * @inheritDoc
     */
    public function setDefaultBackground(): void
    {
        $background = new GoogleMapsLayer();
        $this->background = $background;
    }

}
