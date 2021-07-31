<?php

declare(strict_types=1);

namespace MapUx\Model;

/**
 * @experimental
 *
 * @property string|null $url
 * @property array|null $options
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
     * Get the options of the layer
     *
     * @return array|null
     */
    public function getOptions(): ?array;

    /**
     * Set options to the layer
     *
     * @param array|null $options
     */
    public function setOptions(?array $options): void;

    /**
     * Add an option to the options of the layer
     *
     * @param string $key
     * @param mixed $value
     */
    public function addOption(string $key, $value): void;
}
