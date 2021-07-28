<?php

declare(strict_types=1);

namespace MapUx\Model\OpenLayers;

use MapUx\Model\BackgroundInterface;

class Background implements BackgroundInterface
{
    /** @var string */
    private $url;

    /** @var int */
    private $maxZoom;

    /** @var array|null */
    private $attribution;

    /**
     * @inheritDoc
     */
    public function __construct(string $url, int $maxZoom)
    {
        $this->url = $url;
        $this->maxZoom = $maxZoom;
    }

    /**
     * @inheritDoc
     */
    public function createBackground(): array
    {
        $background = [
            'url' => $this->getUrl(),
            'maxZoom' => $this->getMaxZoom()
        ];

        if (null !== $this->getAttribution()) {
            $background['attributions'] = $this->getAttribution();
        }

        return $background;
    }

    /**
     * @inheritDoc
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @inheritDoc
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @inheritDoc
     */
    public function getMaxZoom(): int
    {
        return $this->maxZoom;
    }

    /**
     * @inheritDoc
     */
    public function setMaxZoom(int $maxZoom): void
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
