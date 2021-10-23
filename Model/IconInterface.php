<?php

namespace MapUx\Model;

interface IconInterface
{

    /**
     * @param array $parameters
     * @return mixed
     */
    public function setIconParameters(array $parameters): void;

    /**
     * @return array
     */
    public function getIconParameters(): array;


}