<?php

declare(strict_types=1);

namespace MapUx\Model;

/**
 * @experimental
 */
class Marker implements MarkerInterface
{
    /** @var float */
    private float $latitude;

    /** @var float */
    private float $longitude;

    /** @var TooltipInterface|null */
    private ?TooltipInterface $tooltip = null;

    /** @var Icon|null */
    private ?Icon $icon = null;


    /**
     * @inheritDoc
     */
    public function __construct(float $latitude, float $longitude)
    {
        $this->latitude = $latitude;
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
     * @inheritDoc
     */
    public function getTooltip(): ?TooltipInterface
    {
        return $this->tooltip;
    }

    /**
     * @inheritDoc
     */
    public function setTooltip(?TooltipInterface $tooltip): void
    {
        $this->tooltip = $tooltip;
    }

    public function setIcon(Icon $icon): void
    {
        $this->icon = $icon;
    }

    public function getIcon(): ?Icon
    {
        return $this->icon;
    }
}
