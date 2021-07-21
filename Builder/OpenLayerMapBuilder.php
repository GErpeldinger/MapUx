<?php

declare(strict_types=1);

namespace MapUx\Builder;

use MapUx\Model\OpenLayerMap;

class OpenLayerMapBuilder implements MapBuilderInterface
{
    /**
     * @inheritDoc
     */
    public function createMap(float $latitude, float $longitude, int $zoom): OpenLayerMap
    {
        return new OpenLayerMap($latitude, $longitude, $zoom);
    }
}
