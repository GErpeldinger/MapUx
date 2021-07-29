<?php

declare(strict_types=1);

namespace MapUx\Model;

/**
 * @experimental
 *
 * @property string|null $url
 * @property int|null $minZoom
 * @property int|null $maxZoom
 * @property string|array|null $attribution
 */
interface LayerInterface
{
    /**
     * Get the url
     *
     * @return string|null
     */
    public function getUrl(): ?string;

    /**
     * Set the url
     *
     * @param string|null $url
     */
    public function setUrl(?string $url): void;

    /**
     * Get the minimum zoom
     *
     * @return int|null
     */
    public function getMinZoom(): ?int;

    /**
     * Set the minimum zoom
     *
     * @param int|null $minZoom
     */
    public function setMinZoom(?int $minZoom): void;

    /**
     * Get the maximum zoom
     *
     * @return int
     */
    public function getMaxZoom(): ?int;

    /**
     * Set the maximum zoom
     *
     * @param int|null $maxZoom
     */
    public function setMaxZoom(?int $maxZoom): void;

    /**
     * Get the attribution(s)
     *
     * @return string|array|null
     */
    public function getAttribution();

    /**
     * Set the attribution(s)
     *
     * @param string|array|null $attribution
     */
    public function setAttribution($attribution): void;
}
