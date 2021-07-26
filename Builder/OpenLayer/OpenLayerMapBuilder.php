<?php

declare(strict_types=1);

namespace MapUx\Builder\OpenLayer;

use MapUx\Builder\MapBuilderInterface;
use MapUx\Model\OpenLayer\Map;

class OpenLayerMapBuilder implements MapBuilderInterface
{
    /**
     * @inheritDoc
     */
    public function createMap(float $latitude, float $longitude, int $zoom): Map
    {
        return new Map($latitude, $longitude, $zoom);
    }
}
