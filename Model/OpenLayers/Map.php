<?php

declare(strict_types=1);

namespace MapUx\Model\OpenLayers;

use MapUx\Model\MapInterface;

class Map implements MapInterface
{
    public const DEFAULT_CONTROLLER = 'mapux--open-layers--map';

    /**
     * World Geodetic System 1984, used in GPS
     */
    public const PROJECTION_WGS84 = 'EPSG:4326';

    /** @var string */
    private $controller = self::DEFAULT_CONTROLLER;

    /** @var Background */
    private $background;

    /** @var float */
    private $latitude;

    /** @var float */
    private $longitude;

    /** @var int */
    private $zoom;

    /**
     * @var string
     */
    private $projection = self::PROJECTION_WGS84;

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
            'center'     => $this->getCenter(),
            'zoom'       => $this->getZoom(),
            'projection' => $this->getProjection()
        ];
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
     * @return Background
     */
    public function getBackground(): Background
    {
        return $this->background;
    }

    /**
     * Set the background tile url
     *
     * @param Background $background
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

    /**
     * Get the projection
     *
     * @return string
     */
    public function getProjection(): string
    {
        return $this->projection;
    }

    /**
     * Set the projection
     *
     * @param string $projection
     */
    public function setProjection(string $projection): void
    {
        $this->projection = $projection;
    }
}
