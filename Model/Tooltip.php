<?php


namespace MapUx\Model;


class Tooltip
{

    /** @var string */
    protected string $content;

    /** @var array */
    protected array $options = [];

    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return array
     */
    public function getOptions(): ?array
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options): void
    {
        $this->options = $options;
    }

    public function makeTooltip()
    {
        return [
            'content' => $this->getContent(),
            'options' => $this->getOptions()
        ];
    }



}
