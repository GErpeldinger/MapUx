<?php

namespace MapUx\Model;

/**
 * @experimental
 *
 * @property float $latitude
 * @property float $longitude
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
}
