<?php

declare(strict_types=1);

namespace MapUx\Builder\Mapbox;

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
        $map->setStimulusController(Map::MAPBOX_CONTROLLER);

        $background = new Layer();
        $background->setUrl('mapbox://styles/mapbox/streets-v11');

        $map->setBackground($background);

        return $map;
    }
}
