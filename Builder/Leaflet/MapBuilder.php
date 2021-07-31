<?php

declare(strict_types=1);

namespace MapUx\Builder\Leaflet;

use MapUx\Builder\MapBuilderInterface;
use MapUx\Model\Leaflet\Map;

class MapBuilder implements MapBuilderInterface
{
    /**
     * Create a leaflet Map
     *
     * @param float $latitude
     * @param float $longitude
     * @param int $zoom
     *
     * @return Map
     */
    public function createMap(float $latitude, float $longitude, int $zoom): Map
    {
        $map = new Map($latitude, $longitude, $zoom);
        $map->setDefaultBackground();
        return $map;
    }
}
