<?php

namespace MapUx\Model;

use MapUx\Exception\NotDefinedTokenException;
use MapUx\Model\Layer;

class IgnLayer extends Layer
{

    const CADASTRAL = [
        'name'   => 'CADASTRALPARCELS.PARCELLAIRE_EXPRESS',
        'style'  => 'PCI vecteur',
        'format' => 'image/png'
    ];

    const ELEVATION = [
        'name'   => 'ELEVATION.SLOPES',
        'style'  => 'normal',
        'format' => 'image/jpeg'
    ];

    const GEOGRAPHICAL = [
        'name'   => 'GEOGRAPHICALGRIDSYSTEMS.PLANIGNV2',
        'style'  => 'normal',
        'format' => 'image/png'
    ];

    const ADMINISTRATIVES = [
        'name'   => 'LIMITES_ADMINISTRATIVES_EXPRESS.LATEST',
        'style'  => 'normal',
        'format' => 'image/png'
    ];

    const ORTHOIMAGES = [
        'name'   => 'ORTHOIMAGERY.ORTHOPHOTOS',
        'style'  => 'normal',
        'format' => 'image/jpeg'
    ];

    const GEOSERVICE_API_LINK =
        'https://wxs.ign.fr/%s/geoportail/wmts?SERVICE=WMTS&REQUEST=GetTile' .
        '&VERSION=1.0.0&LAYER=%s&TILEMATRIXSET=PM&TILEMATRIX={z}&TILECOL={x}&TILEROW={y}&STYLE=%s&FORMAT=%s';
    /**
     * @var array|false|string
     */
    private string $key;

    /**
     * @var array
     */
    private array $resource;

    public function __construct(array $resource)
    {
        $checkArray = [self::ORTHOIMAGES, self::ADMINISTRATIVES, self::CADASTRAL, self::ELEVATION, self::GEOGRAPHICAL];
        if(!$_ENV['IGN_MAP_TOKEN']) {
            throw new NotDefinedTokenException('IGN_MAP_TOKEN');
        }
        if(!in_array($resource, $checkArray )) {
            throw new \Exception('You must define a resource name in defined constants of IgnLayer');
        }
        $this->key = $_ENV['IGN_MAP_TOKEN'];
        $this->resource = $resource;

        $this->setUrl(
            sprintf(self::GEOSERVICE_API_LINK,
                $this->key,
                $this->resource['name'],
                $this->resource['style'],
                $this->resource['format']
            )
        );
    }

}