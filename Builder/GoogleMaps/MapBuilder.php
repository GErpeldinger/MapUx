<?php

declare(strict_types=1);

namespace MapUx\Builder\GoogleMaps;

use MapUx\Builder\MapBuilderInterface;
use MapUx\Model\GoogleMaps\Map;

class MapBuilder implements MapBuilderInterface
{
    /**
     * @inheritDoc
     */
    public function createMap(float $latitude, float $longitude, int $zoom): Map
    {
        $map = new Map($latitude, $longitude, $zoom);
        $map->setDefaultBackground();
        return $map;
    }
}
