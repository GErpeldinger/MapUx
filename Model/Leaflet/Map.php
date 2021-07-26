<?php

declare(strict_types=1);

namespace MapUx\Model\Leaflet;

use MapUx\Model\MapInterface;

class Map implements MapInterface
{
    /** @var string */
    private $controller = MapInterface::LEAFLET_CONTROLLER;

    /** @var float */
    private $latitude;

    /** @var float */
    private $longitude;

    /** @var int */
    private $zoom;

    /**
     * @inheritDoc
     */
    public function __construct(float $latitude, float $longitude, int $zoom)
    {
        $this->latitude  = $latitude;
        $this->longitude = $longitude;
        $this->zoom      = $zoom;
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
