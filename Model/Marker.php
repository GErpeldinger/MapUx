<?php

namespace MapUx\Model;

/**
 * @experimental
 *
 * todo Manage $attributes
 */
class Marker implements MarkerInterface
{
    /** @var float */
    protected $latitude;

    /** @var float */
    protected $longitude;

    /** @var array */
    protected $attributes;

    /** @var Tooltip */
    protected $tooltip;

    public function __construct(float $latitude, float $longitude)
    {
        $this->latitude  = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * @inheritDoc
     */
    public function getPosition(): array
    {
        return [
            'latitude'  => $this->latitude,
            'longitude' => $this->longitude
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
     * @return Tooltip
     */
    public function getTooltip(): ?Tooltip
    {
        return $this->tooltip;
    }

    /**
     * @param Tooltip $tooltip
     */
    public function setTooltip(Tooltip $tooltip): void
    {
        $this->tooltip = $tooltip;
    }
}
