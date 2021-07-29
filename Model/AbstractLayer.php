<?php

declare(strict_types=1);

namespace MapUx\Model;

/**
 * @experimental
 */
abstract class AbstractLayer implements LayerInterface
{
    /** @var string|null */
    protected $url;

    /** @var int|null */
    protected $minZoom;

    /** @var int|null */
    protected $maxZoom;

    /** @var array|null */
    protected $attribution;

    /**
     * @inheritDoc
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @inheritDoc
     */
    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    /**
     * @inheritDoc
     */
    public function getMinZoom(): ?int
    {
        return $this->minZoom;
    }

    /**
     * @inheritDoc
     */
    public function setMinZoom(?int $minZoom): void
    {
        $this->minZoom = $minZoom;
    }

    /**
     * @inheritDoc
     */
    public function getMaxZoom(): ?int
    {
        return $this->maxZoom;
    }

    /**
     * @inheritDoc
     */
    public function setMaxZoom(?int $maxZoom): void
    {
        $this->maxZoom = $maxZoom;
    }

    /**
     * @inheritDoc
     */
    public function getAttribution()
    {
        return $this->attribution;
    }

    /**
     * @inheritDoc
     */
    public function setAttribution($attribution): void
    {
        $this->attribution = $attribution;
    }
}
