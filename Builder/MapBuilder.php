<?php

declare(strict_types=1);

namespace MapUx\Builder;

use MapUx\Builder\Leaflet\MapBuilderInterface as LeafletMapBuilderInterface;
use MapUx\Builder\GoogleMaps\MapBuilderInterface as GoogleMapsMapBuilderInterface;
use MapUx\Builder\OpenLayers\MapBuilderInterface as OpenLayersMapBuilderInterface;
use MapUx\Builder\MapBox\MapBuilderInterface as MapBoxMapBuilderInterface;
use MapUx\Exception\InvalidLibraryException;
use MapUx\Model\Layer;
use MapUx\Model\Map;

/**
 * @experimental
 */
class MapBuilder implements
    LeafletMapBuilderInterface,
    GoogleMapsMapBuilderInterface,
    OpenLayersMapBuilderInterface,
    MapBoxMapBuilderInterface
{
    private const CONTROLLERS = [
        Map::GOOGLE_MAPS => Map::GOOGLE_MAPS_CONTROLLER,
        Map::LEAFLET     => Map::LEAFLET_CONTROLLER,
        Map::MAPBOX      => Map::MAPBOX_CONTROLLER,
        Map::OPEN_LAYERS => Map::OPEN_LAYERS_CONTROLLER
    ];

    private const URLS = [
        Map::GOOGLE_MAPS => '',
        Map::LEAFLET     => 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        Map::MAPBOX      => 'mapbox://styles/mapbox/streets-v11',
        Map::OPEN_LAYERS => 'https://{a-c}.tile.openstreetmap.org/{z}/{x}/{y}.png'
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
     *
     * @throws InvalidLibraryException
     */
    public function createMap(float $latitude, float $longitude, int $zoom): Map
    {
        $map = new Map($latitude, $longitude, $zoom);
        $map->setLibrary($this->library);
        $map->setStimulusController(self::CONTROLLERS[$this->library]);

        $background = new Layer();
        $background->setUrl(self::URLS[$this->library]);

        $map->setBackground($background);

        return $map;
    }
}
