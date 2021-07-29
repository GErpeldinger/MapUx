<?php

declare(strict_types=1);

namespace MapUx\Model;

/**
 * @experimental
 */
abstract class AbstractMap implements MapInterface
{
    /** @var string */
    protected $controller;

    /** @var LayerInterface */
    protected $background;

    /** @var float */
    protected $latitude;

    /** @var float */
    protected $longitude;

    /** @var int */
    protected $zoom;


    /**
     * @inheritDoc
     */
    public function __construct(float $latitude, float $longitude, int $zoom)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->zoom = $zoom;
    }

    /**
     * @inheritDoc
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @inheritDoc
     */
    public function setController(string $controller): void
    {
        $this->controller = $controller;
    }

    /**
     * @inheritDoc
     */
    abstract public function createView(): array;

    /**
     * @inheritDoc
     */
    abstract public function createBackground(): array;

    /**
     * @inheritDoc
     */
    abstract public function getCenter(): array;


    /**
     * @inheritDoc
     */
    public function getBackground()
    {
        return $this->background;
    }

    /**
     * @inheritDoc
     */
    public function setBackground($background): void
    {
        $this->background = $background;
    }

    /**
     * @inheritDoc
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @inheritDoc
     */
    public function setLatitude(float $latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @inheritDoc
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @inheritDoc
     */
    public function setLongitude(float $longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @inheritDoc
     */
    public function getZoom(): int
    {
        return $this->zoom;
    }

    /**
     * @inheritDoc
     */
    public function setZoom(int $zoom): void
    {
        $this->zoom = $zoom;
    }
}