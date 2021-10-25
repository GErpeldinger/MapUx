<?php

declare(strict_types=1);

namespace MapUx\Builder;

use MapUx\DependencyInjection\MapUxExtension;
use MapUx\Model\Layer;
use MapUx\Model\Map;

/**
 * @experimental
 */
class MapBuilder implements
    MapBuilderInterface
{

    private const URLS = [
        'google' => '',
        'leaflet'     => 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        'mapbox'      => 'mapbox://styles/mapbox/streets-v11',
        'openLayers' => 'https://{a-c}.tile.openstreetmap.org/{z}/{x}/{y}.png'
    ];

    /** @var string */
    private string $library;

    public function __construct(string $library)
    {
        $this->library = $library;
    }

    /**
     * Create a Map
     *
     * @param float $latitude
     * @param float $longitude
     * @param int $zoom
     *
     * @return Map
     */
    public function createMap(float $latitude, float $longitude, int $zoom): Map
    {
        $className = 'MapUx\Model\\' . ucfirst($this->library) . 'Map';
        $map = new $className($latitude, $longitude, $zoom);


        $background = new Layer();
        $background->setUrl(self::URLS[$this->library]);
        $map->setBackground($background);

        return $map;
    }
}
