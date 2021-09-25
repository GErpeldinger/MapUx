<?php

declare(strict_types=1);

namespace MapUx\Builder;

use MapUx\DependencyInjection\MapUxExtension;
use MapUx\Model\Layer;
use MapUx\Model\Map;

/**
 * @experimental
 */
class MapBuilder implements MapBuilderInterface
{
    private const CONTROLLERS = [
        MapUxExtension::GOOGLE_MAPS => Map::GOOGLE_MAPS_CONTROLLER,
        MapUxExtension::LEAFLET     => Map::LEAFLET_CONTROLLER,
        MapUxExtension::MAPBOX      => Map::MAPBOX_CONTROLLER,
        MapUxExtension::OPEN_LAYERS => Map::OPEN_LAYERS_CONTROLLER
    ];

    private const URLS = [
        MapUxExtension::GOOGLE_MAPS => '',
        MapUxExtension::LEAFLET     => 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        MapUxExtension::MAPBOX      => 'mapbox://styles/mapbox/streets-v11',
        MapUxExtension::OPEN_LAYERS => 'https://{a-c}.tile.openstreetmap.org/{z}/{x}/{y}.png'
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
        $map = new Map($latitude, $longitude, $zoom);
        $map->setStimulusController(self::CONTROLLERS[$this->library]);

        $background = new Layer();
        $background->setUrl(self::URLS[$this->library]);

        $map->setBackground($background);

        return $map;
    }
}
