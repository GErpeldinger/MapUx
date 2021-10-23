<?php

namespace MapUx\Model;

class Icon implements IconInterface
{
    private array $parameters;


    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @param array $parameters
     * @return mixed|void
     */
    public function setIconParameters(array $parameters): void
    {
        $this->parameters = $parameters;
    }

    /**
     * @return array
     */
    public function getIconParameters(): array
    {
        return $this->parameters;
    }
}