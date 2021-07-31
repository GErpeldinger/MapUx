<?php

namespace MapUx\Builder;

use MapUx\Model\Layer;
use MapUx\Model\Map;

class MapBuilder implements MapBuilderInterface
{
    const controllers = [
        'google-maps'  => Map::GOOGLE_MAP_CONTROLLER,
        'leaflet'     => Map::LEAFLET_CONTROLLER,
        'mapbox'      => Map::MAPBOX_CONTROLLER,
        'open-layers' => Map::OPEN_LAYERS_CONTROLLER
    ];

    const URLS = [
        'google-maps'  => '',
        'leaflet'     => 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        'mapbox'      => 'mapbox://styles/mapbox/streets-v11',
        'open-layers' => 'https://{a-c}.tile.openstreetmap.org/{z}/{x}/{y}.png'
    ];

    /** @var string */
    private $library;

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
        $map->setStimulusController(self::controllers[$this->library]);

        $background = new Layer();
        $background->setUrl(self::URLS[$this->library]);

        $map->setBackground($background);

        return $map;
    }
}
