<?php

declare(strict_types=1);

namespace MapUx\Model\Leaflet;

use MapUx\Model\MapInterface;

class Map implements MapInterface
{
    public const DEFAULT_CONTROLLER = 'mapux--leaflet--map';

    /** @var string */
    private $controller = self::DEFAULT_CONTROLLER;

    /** @var float */
    private $latitude;

    /** @var float */
    private $longitude;

    /** @var int */
    private $zoom;

    /** @var Background */
    private $background;

    /**
     * Map constructor
     *
     * @param Background $background
     * @param float $latitude
     * @param float $longitude
     * @param int $zoom
     */
    public function __construct($background, float $latitude, float $longitude, int $zoom)
    {
        $this->background = $background;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->zoom = $zoom;
    }

    /**
     * @inheritDoc
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @inheritDoc
     */
    public function setController(string $controller): void
    {
        $this->controller = $controller;
    }

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

    /**
     * @inheritDoc
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @inheritDoc
     */
    public function setLatitude(float $latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @inheritDoc
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @inheritDoc
     */
    public function setLongitude(float $longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @inheritDoc
     */
    public function getZoom(): int
    {
        return $this->zoom;
    }

    /**
     * @inheritDoc
     */
    public function setZoom(int $zoom): void
    {
        $this->zoom = $zoom;
    }
}
