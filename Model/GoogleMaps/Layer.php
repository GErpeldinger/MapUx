<?php

declare(strict_types=1);

namespace MapUx\Model\GoogleMaps;

use MapUx\Model\AbstractLayer;

/**
 * @final
 * @experimental
 */
class Layer extends AbstractLayer
{
    /** @var string|null */
    protected $attribution;

    /**
     * @var string
     */
    protected $url = '';

    /**
     * Get the attribution
     *
     * @return string|null
     */
    public function getAttribution(): ?string
    {
        return $this->attribution;
    }

    /**
     * Set the attribution
     *
     * @param string|null $attribution
     */
    public function setAttribution($attribution): void
    {
        $this->attribution = $attribution;
    }
}
