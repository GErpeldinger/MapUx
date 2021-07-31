<?php

declare(strict_types=1);

namespace MapUx\Builder;

use MapUx\Model\MapInterface;

/**
 * @experimental
 */
interface MapBuilderInterface
{
    /**
     * Create a Map
     *
     * @param float $latitude
     * @param float $longitude
     * @param int $zoom
     *
     * @return MapInterface
     */
    public function createMap(float $latitude, float $longitude, int $zoom): MapInterface;
}
