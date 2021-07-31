<?php

declare(strict_types=1);

namespace MapUx\Model;

/**
 * @experimental
 */
class Tooltip implements TooltipInterface
{
    /** @var string */
    protected string $content;

    /** @var array|null */
    protected ?array $options = null;

    /**
     * @inheritDoc
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * @inheritDoc
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @inheritDoc
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
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
