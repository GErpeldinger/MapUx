<?php

declare(strict_types=1);

namespace MapUx\Exception;

use Exception;
use MapUx\Model\Map;
use Throwable;

class InvalidLibraryException extends Exception
{
    public function __construct(string $library, int $code = 0, Throwable $previous = null)
    {
        $constants = [
            'leaflet'     => Map::LEAFLET,
            'open-layers' => Map::OPEN_LAYERS,
            'mapbox'      => Map::MAPBOX,
            'google-maps' => Map::GOOGLE_MAPS
        ];

        $message = <<<ERROR
            The "$library" library is not valid.
            Please use one of the Map constants or corresponding values :
                - \Map::LEAFLET === '{$constants['leaflet']}'
                - \Map::OPEN_LAYERS === '{$constants['open-layers']}'
                - \Map::MAPBOX === '{$constants['mapbox']}'
                - \Map::GOOGLE_MAPS === '{$constants['google-maps']}'
ERROR;

        parent::__construct($message, $code, $previous);
    }
}
