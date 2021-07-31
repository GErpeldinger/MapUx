<?php

declare(strict_types=1);

namespace MapUx\Builder\GoogleMaps;

use MapUx\Builder\MapBuilderInterface;
use MapUx\Model\Map;
use MapUx\Model\Layer;

class MapBuilder implements MapBuilderInterface
{
    /**
     * @inheritDoc
     */
    public function createMap(float $latitude, float $longitude, int $zoom): Map
    {
        $map = new Map($latitude, $longitude, $zoom);
        $map->setStimulusController(Map::GOOGLE_MAP_CONTROLLER);

        $map->setBackground(new Layer());

        return $map;
    }
}
