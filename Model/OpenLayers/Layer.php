<?php

declare(strict_types=1);

namespace MapUx\Model\OpenLayers;

use MapUx\Model\AbstractLayer;

/**
 * @final
 * @experimental
 */
class Layer extends AbstractLayer
{
    /**
     * @var string
     */
    protected $url = 'https://{a-c}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png';

    /**
     * @var string
     */
    protected $layerSource = 'XYZ';

    /**
     * @return string
     */
    public function getLayerSource(): string
    {
        return $this->layerSource;
    }

    /**
     * @param string $layerSource
     */
    public function setLayerSource(string $layerSource): void
    {
        $this->layerSource = $layerSource;
    }

}
