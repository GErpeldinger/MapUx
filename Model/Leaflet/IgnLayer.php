<?php

declare(strict_types=1);

namespace MapUx\Model\Leaflet;

use Exception;
use MapUx\Model\Layer;

use function array_merge;
use function compact;
use function sprintf;

class IgnLayer extends Layer
{
    /**
     * Base URL to build url for IGN geo service resource
     */
    public const GEOSERVICE_API_LINK =
        'https://wxs.ign.fr/%s/geoportail/wmts?SERVICE=WMTS&REQUEST=GetTile' .
        '&VERSION=1.0.0&LAYER=%s&TILEMATRIXSET=PM&TILEMATRIX={z}&TILECOL={x}&TILEROW={y}&STYLE=%s&FORMAT=%s';

    /**
     * Array of free available resources
     */
    public const IGN_LAYERS = [
        'CADASTRALPARCELS.PARCELLAIRE_EXPRESS'   => [
            'style'  => 'PCI vecteur',
            'format' => 'image/png'
        ],
        'ELEVATION.SLOPES'                       => [
            'style'  => 'normal',
            'format' => 'image/jpeg'
        ],
        'GEOGRAPHICALGRIDSYSTEMS.PLANIGNV2'      => [
            'style'  => 'normal',
            'format' => 'image/png'
        ],
        'LIMITES_ADMINISTRATIVES_EXPRESS.LATEST' => [
            'style'  => 'normal',
            'format' => 'image/png'
        ],
        'ORTHOIMAGERY.ORTHOPHOTOS'               => [
            'style'  => 'normal',
            'format' => 'image/jpeg'
        ]
    ];

    /** @var array */
    private array $additionalResources = [];

    /**
     * IgnLayer constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        if ('' === $_ENV['MAP_TOKEN'] || !isset($_ENV['MAP_TOKEN'])) {
            throw new Exception(
                'You need a Geoservice Api Key to use IgnLayer.
                Get your key at : https://www.sphinxonline.com/SurveyServer/s/etudesmk/Geoservices/questionnaire.html
                and set it in your .env.local file as MAP_TOKEN=Your_API_Key'
            );
        }
    }

    /**
     * Add an IGN resource to those available
     *
     * @param string $resourceName
     * @param string $style
     * @param string $format
     */
    public function addNewResource(string $resourceName, string $style, string $format): void
    {
        $this->additionalResources[$resourceName] = compact('style', 'format');
    }

    /**
     * Set the url from the resource name
     *
     * @param string|null $resourceName
     *
     * @throws Exception
     */
    public function setUrl(?string $resourceName): void
    {
        parent::setUrl($this->generateUrl($resourceName));
    }

    /**
     * Generate a complete IGN url from a resource name
     *
     * @param string $resourceName
     *
     * @return string
     *
     * @throws Exception
     */
    private function generateUrl(string $resourceName): string
    {
        $availableResources = empty($this->additionalResources)
            ? self::IGN_LAYERS
            : array_merge(self::IGN_LAYERS, $this->additionalResources);

        if (!isset($availableResources[$resourceName])) {
            throw new Exception(
                'This layer resource doesn\'t exist in Mapux IgnLayer. Available resources are ' . PHP_EOL
                . implode(PHP_EOL, array_keys(self::IGN_LAYERS)) . PHP_EOL
                . 'Feel free to add your own resources with the addNewResource() method');
        }

        return sprintf(self::GEOSERVICE_API_LINK,
            $_ENV['MAP_TOKEN'],
            $resourceName,
            $availableResources[$resourceName]['style'],
            $availableResources[$resourceName]['format']
        );
    }
}
