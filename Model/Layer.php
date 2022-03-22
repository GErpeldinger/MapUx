<?php

declare(strict_types=1);

namespace MapUx\Model;

/**
 * @experimental
 */
final class Layer implements LayerInterface
{
    /** @var string|null */
    private ?string $url = null;

    /** @var array|null  */
    private ?array $options = null;

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
    public function getOptions(): ?array
    {
        return $this->options;
    }

    /**
     * @inheritDoc
     */
    public function setOptions(?array $options): void
    {
        $this->options = $options;
    }

    /**
     * @inheritDoc
     */
    public function addOption(string $key, $value): void
    {
        $this->options[$key] = $value;
    }
}
