<?php

declare(strict_types=1);

namespace MapUx\Model;

/**
 * @experimental
 * 
 * @property string $url
 * @property int $maxZoom
 * @property ?string $attribution
 */
interface BackgroundInterface
{
    /**
     * BackgroundInterface constructor
     *
     * @param string $url
     * @param int $maxZoom
     */
    public function __construct(string $url, int $maxZoom);

    /**
     * Create the background that will be given to the controller
     *
     * @return array
     */
    public function createBackground(): array;

    /**
     * Get the url
     *
     * @return string
     */
    public function getUrl(): string;

    /**
     * Set the url
     *
     * @param string $url
     */
    public function setUrl(string $url): void;

    /**
     * Get the maximum zoom
     *
     * @return int
     */
    public function getMaxZoom(): int;

    /**
     * Set the maximum zoom
     *
     * @param int $maxZoom
     */
    public function setMaxZoom(int $maxZoom): void;

    /**
     * Set the attribution
     *
     * @return string
     */
    public function getAttribution(): ?string;

    /**
     * Set the attribution
     *
     * @param string $attribution
     */
    public function setAttribution(string $attribution): void;
}
