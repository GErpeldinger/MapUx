<?php

declare(strict_types=1);

namespace MapUx\Builder\OpenLayers;

use MapUx\Builder\MapBuilderInterface;
use MapUx\Model\OpenLayers\Map;

class MapBuilder implements MapBuilderInterface
{
    /**
     * Create a open layers Map
     *
     * @param float $latitude
     * @param float $longitude
     * @param int $zoom
     *
     * @return Map
     */
    public function createMap(float $latitude, float $longitude, int $zoom): Map
    {
        return new Map($latitude, $longitude, $zoom);
    }
}
