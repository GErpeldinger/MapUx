<?php

declare(strict_types = 1);

namespace MapUx\Model\Leaflet;

use MapUx\Model\Layer;

class IgnLayer extends Layer
{
    /**
     * Array of free available resources
     */
    const IGN_LAYERS = [
        'CADASTRALPARCELS.PARCELLAIRE_EXPRESS' => [
            'style'  => 'PCI vecteur',
            'format' => 'image/png'
        ],
        'ELEVATION.SLOPES' => [
            'style'  => 'normal',
            'format' => 'image/jpeg'
        ],
        'GEOGRAPHICALGRIDSYSTEMS.PLANIGNV2' => [
            'style'  => 'normal',
            'format' => 'image/png'
        ],
        'LIMITES_ADMINISTRATIVES_EXPRESS.LATEST' => [
            'style'  => 'normal',
            'format' => 'image/png'
        ],
        'ORTHOIMAGERY.ORTHOPHOTOS' => [
            'style'  => 'normal',
            'format' => 'image/jpeg'
        ]
    ];

    /**
     * base URL to build url for IGN geo service resource
     */
    const GEOSERVICE_API_LINK =
        'https://wxs.ign.fr/%s/geoportail/wmts?SERVICE=WMTS&REQUEST=GetTile' .
        '&VERSION=1.0.0&LAYER=%s&TILEMATRIXSET=PM&TILEMATRIX={z}&TILECOL={x}&TILEROW={y}&STYLE=%s&FORMAT=%s';

    /**
     * @var string API KEY for GeoServices
     */
    private string $key;

    /**
     * @var array
     */
    private array $additionnaleResources;

    public function __construct()
    {
        if(!isset($_ENV['MAP_TOKEN']) || $_ENV['MAP_TOKEN'] === '') {
            throw new \Exception('
                You need a Geoservice Api Key to use IgnLayer. 
                Get your key at : https://www.sphinxonline.com/SurveyServer/s/etudesmk/Geoservices/questionnaire.htm 
                and set it in your .env.local file as MAP_TOKEN=Your_API_Key'
            );
        }
        $this->key = $_ENV['MAP_TOKEN'];
        $this->additionnaleResources = [];
    }

    public function addNewResource(string $resourceName, string $style, string $format)
    {
        $this->additionnaleResources[$resourceName] = [
            'style'  => $style,
            'format' => $format
        ];
    }

    public function setUrl(?string $resourceName): void
    {
        parent::setUrl($this->generateUrl($resourceName));
    }

    private function generateUrl(string $resourceName): string
    {
        $availableResources = empty($this->additionalResources)
            ? self::IGN_LAYERS
            : array_merge(self::IGN_LAYERS, $this->additionalResources);

        if (!isset($availableResources[$resourceName])) {
            throw new \Exception(
                'This layer resource doesn\'t exist in Mapux IgnLayer. Available resources are ' .
                implode(', ', array_keys(self::IGN_LAYERS)) .
                ' Feel free to add your own resources with the addNewResource() method');
        }

        return
            sprintf(self::GEOSERVICE_API_LINK,
                $this->key,
                $resourceName,
                $availableResources[$resourceName]['style'],
                $availableResources[$resourceName]['format']
        );
    }
}
