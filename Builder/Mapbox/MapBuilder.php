<?php

declare(strict_types=1);

namespace MapUx\Builder\Mapbox;

use MapUx\Builder\MapBuilderInterface;
use MapUx\Model\Mapbox\Map;

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
