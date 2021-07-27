<?php

declare(strict_types=1);

namespace MapUx\Model\OpenLayer;

use MapUx\Model\MapInterface;

class Map implements MapInterface
{
    /**
     * World Geodetic System 1984, used in GPS
     */
    public const PROJECTION_WGS84 = 'EPSG:4326';

    /**
     * @var string
     */
    private $controller = MapInterface::OPEN_LAYER_CONTROLLER;

    /**
     * @var float
     */
    private $latitude;

    /**
     * @var float
     */
    private $longitude;

    /**
     * @var int
     */
    private $zoom;

    /**
     * @var string
     */
    private $projection = self::PROJECTION_WGS84;

    /**
     * @inheritDoc
     */
    public function __construct(float $latitude, float $longitude, int $zoom)
    {
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
     * @return string
     */
    public function getProjection(): string
    {
        return $this->projection;
    }

    /**
     * @param string $projection
     */
    public function setProjection(string $projection): void
    {
        $this->projection = $projection;
    }
}