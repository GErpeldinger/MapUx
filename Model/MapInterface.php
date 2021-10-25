<?php

declare(strict_types=1);

namespace MapUx\Model;

/**
 * @experimental
 *
 * @property string $controller
 * @property LayerInterface|null $background
 * @property LayerInterface[]|null $layers
 * @property MarkerInterface[]|null $markers
 * @property float $latitude
 * @property float $longitude
 * @property int $zoom
 */
interface MapInterface
{
    /**
     * Map constructor.
     *
     * @param float $latitude
     * @param float $longitude
     * @param int $zoom
     */
    public function __construct(float $latitude, float $longitude, int $zoom);

    /**
     * Return name of the library used
     *
     * @return string
     */
    public function getLibrary(): string;

    /**
     * Set name of the library used<br>
     * Can only take constants :
     *  - \Map::LEAFLET     ('leaflet')
     *  - \Map::OPEN_LAYERS ('open-layers')
     *  - \Map::MAPBOX      ('mapbox')
     *  - \Map::GOOGLE_MAPS ('google-maps')
     */
    public function setLibrary(string $library): void;

    /**
     * Return name of the stimulus controller
     *
     * @return string
     */
    public function getStimulusController(): string;

    /**
     * Set name of the stimulus controller
     * Can take a custom controller
     *
     * @param string $controller
     */
    public function setStimulusController(string $controller): void;

    /**
     * Create the data that will be sent to the data-attribute View
     *
     * @return array eg. [center, zoom]
     */
    public function createDataView(): array;

    /**
     * Create the data that will be sent to the data-attribute Background
     *
     * @return array|null eg. [url, maxZoom, attribution]
     */
    public function createDataBackground(): ?array;

    /**
     * Create the data that will be sent to the data-attribute Layers
     *
     * @return array|null eg. [Layer1, Layer2...]
     */
    public function createDataLayers(): ?array;

    /**
     * Create the data that will be sent to the data-attribute Markers
     *
     * @return array|null eg. [Marker1, Marker2...]
     */
    public function createDataMarkers(): ?array;

    /**
     * Get the center of the map
     *
     * @return float[] [latitude, longitude]
     */
    public function getCenter(): array;


    /**
     * Get the background tile
     *
     * @return LayerInterface
     */
    public function getBackground(): LayerInterface;

    /**
     * Set the background tile
     *
     * @param LayerInterface $background
     */
    public function setBackground(LayerInterface $background): void;

    /**
     * Get the latitude
     *
     * @return float
     */
    public function getLatitude(): float;

    /**
     * Set the latitude
     *
     * @param float $latitude
     */
    public function setLatitude(float $latitude): void;

    /**
     * Get the longitude
     *
     * @return float
     */
    public function getLongitude(): float;

    /**
     * Set the longitude
     *
     * @param float $longitude
     */
    public function setLongitude(float $longitude): void;

    /**
     * Get the zoom level
     *
     * @return int
     */
    public function getZoom(): int;

    /**
     * Set the zoom level
     *
     * @param int $zoom
     */
    public function setZoom(int $zoom): void;

    /**
     * Get all the layers
     *
     * @return LayerInterface[]
     */
    public function getLayers(): ?array;

    /**
     * Set a array of Layer
     *
     * @param LayerInterface[]|null $layers
     */
    public function setLayers(?array $layers): void;

    /**
     * Add layer to the map
     *
     * @param LayerInterface|null $layer
     */
    public function addLayer(LayerInterface $layer): void;

    /**
     * Get all the markers
     *
     * @return MarkerInterface[]
     */
    public function getMarkers(): ?array;

    /**
     * Set a array of Marker
     *
     * @param MarkerInterface[]|null $markers
     */
    public function setMarkers(?array $markers): void;

    /**
     * Add marker to the map
     *
     * @param MarkerInterface|null $marker
     */
    public function addMarker(MarkerInterface $marker): void;
}
