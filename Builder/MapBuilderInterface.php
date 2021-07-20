<?php

declare(strict_types=1);

namespace MapUx\Builder;

use MapUx\Model\Map;

interface MapBuilderInterface
{
    public function createMap(float $latitude, float $longitude, int $zoom): Map;
}
