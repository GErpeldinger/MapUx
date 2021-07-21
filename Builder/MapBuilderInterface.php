<?php

declare(strict_types=1);

namespace MapUx\Builder;

use MapUx\Model\MapInterface;

interface MapBuilderInterface
{
    /**
     * @param float $latitude
     * @param float $longitude
     * @param int $zoom
     *
     * @return MapInterface
     */
    public function createMap(float $latitude, float $longitude, int $zoom);
}
