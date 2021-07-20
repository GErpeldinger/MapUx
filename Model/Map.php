<?php

declare(strict_types=1);

namespace MapUx\Model;

class Map
{
    /** @var float */
    private $latitude;

    /** @var float */
    private $longitude;

    /** @var int */
    private $zoom;

    public function __construct(float $latitude, float $longitude, int $zoom)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->zoom = $zoom;
    }

    public function createView(): array
    {
        return [
            $this->getCenter(),
            $this->getZoom()
        ];
    }

    /**
     * @return float[]
     */
    public function getCenter(): array
    {
        return [
            $this->getLatitude(),
            $this->getLongitude()
        ];
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude(float $latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude(float $longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return int
     */
    public function getZoom(): int
    {
        return $this->zoom;
    }

    /**
     * @param int $zoom
     */
    public function setZoom(int $zoom): void
    {
        $this->zoom = $zoom;
    }
}
