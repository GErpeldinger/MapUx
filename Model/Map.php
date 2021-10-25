<?php

declare(strict_types=1);

namespace MapUx\Model;

use MapUx\Exception\InvalidLibraryException;

use function in_array;

/**
 * @experimental
 */
class Map implements MapInterface
{
    public const LEAFLET     = 'leaflet';
    public const OPEN_LAYERS = 'open-layers';
    public const MAPBOX      = 'mapbox';
    public const GOOGLE_MAPS = 'google-maps';

    public const LEAFLET_CONTROLLER     = 'gerpeldinger--mapux--leaflet';
    public const OPEN_LAYERS_CONTROLLER = 'gerpeldinger--mapux--open-layers';
    public const MAPBOX_CONTROLLER      = 'gerpeldinger--mapux--mapbox';
    public const GOOGLE_MAPS_CONTROLLER = 'gerpeldinger--mapux--google-maps';

    private string $library;

    /** @var string */
    private string $controller;

    /** @var LayerInterface|null */
    private ?LayerInterface $background = null;

    /** @var LayerInterface[]|null */
    private ?array $layers = null;

    /** @var MarkerInterface[]|null */
    private ?array $markers = null;

    /** @var float */
    private float $latitude;

    /** @var float */
    private float $longitude;

    /** @var int */
    private int $zoom;

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
    public function getLibrary(): string
    {
        return $this->library;
    }

    /**
     * @inheritDoc
     *
     * @throws InvalidLibraryException
     */
    public function setLibrary(string $library): void
    {
        if (!in_array($library, [self::LEAFLET, self::OPEN_LAYERS, self::MAPBOX, self::GOOGLE_MAPS])) {
            throw new InvalidLibraryException($library);
        }

        $this->library = $library;
    }

    /**
     * @inheritDoc
     */
    public function getStimulusController(): string
    {
        return $this->controller;
    }

    /**
     * @inheritDoc
     */
    public function setStimulusController(string $controller): void
    {
        $this->controller = $controller;
    }

    /**
     * @inheritDoc
     */
    public function createDataView(): array
    {
        return [
            'center' => $this->getCenter(),
            'zoom'   => $this->getZoom()
        ];
    }

    /**
     * @inheritDoc
     */
    public function createDataBackground(): ?array
    {
        return [
            'url'     => $this->getBackground()->getUrl(),
            'options' => $this->getBackground()
        ];
    }

    /**
     * @inheritDoc
     */
    public function createDataLayers(): ?array
    {
        if (null === $this->getLayers()) {
            return [];
        }
        $layers = [];
        foreach ($this->getLayers() as $layer) {
            $layers[] = $layer;
        }
        return $layers;
    }

    /**
     * @inheritDoc
     */
    public function createDataMarkers(): ?array
    {
        $markersPositions = [];
        if (!$this->markers) {
            return null;
        }

        foreach ($this->markers as $marker) {
            $tooltip = $marker->getTooltip();
            $markersPositions[] = [
                'position' => $marker->getPosition(),
                'tooltip'  => $tooltip
                    ? ['content' => $tooltip->getContent(), 'options' => $tooltip->getOptions()]
                    : null
            ];
        }

        return $markersPositions;
    }

    /**
     * @inheritDoc
     */
    public function getCenter(): array
    {
        return [
            'latitude'  => $this->latitude,
            'longitude' => $this->longitude
        ];
    }

    /**
     * @inheritDoc
     */
    public function getBackground(): LayerInterface
    {
        return $this->background;
    }

    /**
     * @inheritDoc
     */
    public function setBackground(LayerInterface $background): void
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

    /**
     * @inheritDoc
     */
    public function getLayers(): ?array
    {
        return $this->layers;
    }

    /**
     * @inheritDoc
     */
    public function setLayers(?array $layers): void
    {
        $this->layers = $layers;
    }

    /**
     * @inheritDoc
     */
    public function addLayer(LayerInterface $layer): void
    {
        $this->layers[] = $layer;
    }

    /**
     * @inheritDoc
     */
    public function getMarkers(): ?array
    {
        return $this->markers;
    }

    /**
     * @inheritDoc
     */
    public function setMarkers(?array $markers): void
    {
        $this->markers = $markers;
    }

    /**
     * @inheritDoc
     */
    public function addMarker(MarkerInterface $marker): void
    {
        $this->markers[] = $marker;
    }
}
