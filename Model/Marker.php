<?php


namespace MapUx\Model;


class Marker implements MarkerInterface
{

    public function __construct(float $latitude, float $longitude)
    {
        $this->latitude  = $latitude;
        $this->longitude = $longitude;
    }

    public function getPosition(): array
    {
        return [
            'latitude'  => $this->latitude,
            'longitude' => $this->longitude
        ];
    }

    /**
     * @var float
     */
    protected float $latitude;

    /**
     * @var float
     */
    protected float $longitude;

    /**
     * @var array
     */
    protected array $attributes;

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

}
