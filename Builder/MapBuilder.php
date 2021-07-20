<?php

declare(strict_types=1);

namespace MapUx\Builder;

use MapUx\Model\Map;

class MapBuilder implements MapBuilderInterface
{
    public function createMap(float $latitude, float $longitude, int $zoom): Map
    {
        return new Map($latitude, $longitude, $zoom);
    }
}
