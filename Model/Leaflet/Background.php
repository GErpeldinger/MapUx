<?php

declare(strict_types=1);

namespace MapUx\Model\Leaflet;

use MapUx\Model\BackgroundInterface;

class Background implements BackgroundInterface
{
    /** @var string */
    private $url;

    /** @var int */
    private $maxZoom;

    /** @var string|null */
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
        return [
            $this->getUrl(),
            $this->getOptions()
        ];
    }

    /**
     * Get the options
     *
     * @return array
     */
    public function getOptions(): array
    {
        $options = ['maxZoom' => $this->getMaxZoom()];

        if (null !== $this->getAttribution()) {
            $options['attribution'] = $this->getAttribution();
        }

        return $options;
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
    public function getAttribution(): ?string
    {
        return $this->attribution;
    }

    /**
     * @inheritDoc
     */
    public function setAttribution(?string $attribution): void
    {
        $this->attribution = $attribution;
    }
}
