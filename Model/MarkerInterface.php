<?php

declare(strict_types=1);

namespace MapUx\Model;

/**
 * @experimental
 *
 * @property float $latitude
 * @property float $longitude
 * @property TooltipInterface|null $tooltip
 */
interface MarkerInterface
{
    /**
     * MarkerInterface constructor.
     *
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct(float $latitude, float $longitude);

    /**
     * Return the position of the marker
     *
     * @return float[]
     */
    public function getPosition(): array;

    /**
     * Get the latitude of the marker
     *
     * @return float
     */
    public function getLatitude(): float;

    /**
     * Set the latitude of the marker
     *
     * @param float $latitude
     */
    public function setLatitude(float $latitude): void;

    /**
     * Get the longitude of the marker
     *
     * @return float
     */
    public function getLongitude(): float;

    /**
     * Set the longitude of the marker
     *
     * @param float $longitude
     */
    public function setLongitude(float $longitude): void;

    /**
     * Get the marker tooltip
     *
     * @return TooltipInterface|null $tooltip
     */
    public function getTooltip(): ?TooltipInterface;

    /**
     * Set a tooltip to the marker
     *
     * @param TooltipInterface|null $tooltip
     */
    public function setTooltip(?TooltipInterface $tooltip): void;

    /**
     * Personalize Icon with png picture
     *
     * @param Icon $icon
     */
    public function setIcon(Icon $icon): void;
}
