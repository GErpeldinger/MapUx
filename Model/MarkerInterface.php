<?php


namespace MapUx\Model;


/**
 * Interface MarkerInterface
 * @package MapUx\Model
 * @property float $latitude
 * @property float $longitude
 */
interface MarkerInterface
{

    /**
     * MarkerInterface constructor.
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct(float $latitude, float $longitude);

    public function getPosition(): array;

}
