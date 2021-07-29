<?php

declare(strict_types=1);

namespace MapUx\Model;

/**
<<<<<<< HEAD
 * Interface Map
 *
 * @package MapUx\Model
 * @experimental
 *
 * @property string $controller
=======
 * @experimental
 *
 * @property string $controller
 * @property LayerInterface $background
>>>>>>> 9f4fa7c2396d406aefd94d2f218afd15d8718ac7
 * @property float $latitude
 * @property float $longitude
 * @property int $zoom
 */
interface MapInterface
{
<<<<<<< HEAD
    public const LEAFLET_CONTROLLER = 'mapux--leaflet--map';
    public const OPEN_LAYER_CONTROLLER = 'mapux--open-layer--map';

=======
>>>>>>> 9f4fa7c2396d406aefd94d2f218afd15d8718ac7
    /**
     * Map constructor.
     *
     * @param float $latitude
     * @param float $longitude
     * @param int $zoom
     */
    public function __construct(float $latitude, float $longitude, int $zoom);

    /**
     * Return name of the stimulus controller
     *
     * @return string
     */
    public function getController(): string;

    /**
     * Set name of the stimulus controller
     * Can take a custom controller
     *
     * @param string $controller
     */
    public function setController(string $controller): void;

    /**
     * Create the view that will be given to the controller
     *
<<<<<<< HEAD
     * @return float[] eg. [center, zoom]
=======
     * @return array eg. [center, zoom]
>>>>>>> 9f4fa7c2396d406aefd94d2f218afd15d8718ac7
     */
    public function createView(): array;

    /**
<<<<<<< HEAD
     * Get the center of the map
     *
     * @return array [latitude, longitude] || [longitude, latitude]
     */
    public function getCenter(): array;

=======
     * Create the background layer that will be given to the controller
     *
     * @return array eg. [url, maxZoom, attribution]
     */
    public function createBackground(): array;

    /**
     * Get the center of the map
     *
     * @return float[] [latitude, longitude] || [longitude, latitude]
     */
    public function getCenter(): array;


    /**
     * Get the background tile
     *
     * @return LayerInterface
     */
    public function getBackground();

    /**
     * Set the background tile
     *
     * @param LayerInterface $background
     */
    public function setBackground($background): void;

>>>>>>> 9f4fa7c2396d406aefd94d2f218afd15d8718ac7
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
}
