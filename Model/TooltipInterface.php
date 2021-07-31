<?php

declare(strict_types=1);

namespace MapUx\Model;

/**
 * @experimental
 *
 * @property string $content
 * @property array|null $options
 */
interface TooltipInterface
{
    /**
     * TooltipInterface constructor.
     *
     * @param string $content
     */
    public function __construct(string $content);

    /**
     * Get the content of the tooltip
     *
     * @return string
     */
    public function getContent(): string;

    /**
     * Set the content of the tooltip
     *
     * @param string $content
     */
    public function setContent(string $content): void;

    /**
     * Get the options of the tooltip
     *
     * @return array|null
     */
    public function getOptions(): ?array;

    /**
     * Set the options of tooltip
     *
     * @param array|null $options
     */
    public function setOptions(?array $options): void;

    /**
     * Add an option to the tooltip options
     *
     * @param string $key
     * @param mixed $value
     */
    public function addOption(string $key, $value): void;
}
