<?php

declare(strict_types=1);

namespace MapUx\Model;

/**
 * Interface Map
 *
 * @package MapUx\Model
 * @experimental
 *
 * @property string $controller
 * @property string $background
 * @property float $latitude
 * @property float $longitude
 * @property int $zoom
 */
interface MapInterface
{
    public const LEAFLET_CONTROLLER = 'mapux--leaflet--map';
    public const OPEN_LAYER_CONTROLLER = 'mapux--open-layer--map';

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
     * @return float[] eg. [center, zoom]
     */
    public function createView(): array;

    /**
     * Get the center of the map
     *
     * @return array [latitude, longitude] || [longitude, latitude]
     */
    public function getCenter(): array;

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
     * Get the background tile
     *
     * @return string
     */
    public function getBackground(): string;

    /**
     * Set the background tile url
     *
     * @param string $background
     */
    public function setBackground(string $background): void;

}
