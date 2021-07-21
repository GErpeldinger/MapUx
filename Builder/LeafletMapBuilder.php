<?php

declare(strict_types=1);

namespace MapUx\Builder;

use MapUx\Model\LeafletMap;

class LeafletMapBuilder implements MapBuilderInterface
{
    /**
     * @inheritDoc
     */
    public function createMap(float $latitude, float $longitude, int $zoom): LeafletMap
    {
        return new LeafletMap($latitude, $longitude, $zoom);
    }
}
