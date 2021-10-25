<?php

declare(strict_types=1);

namespace MapUx\DependencyInjection;

use Exception;
use MapUx\Builder\GoogleMaps\MapBuilderInterface as GoogleMapsMapBuilderInterface;
use MapUx\Builder\Leaflet\MapBuilderInterface as LeafletMapBuilderInterface;
use MapUx\Builder\MapBox\MapBuilderInterface as MapBoxMapBuilderInterface;
use MapUx\Builder\MapBuilder;
use MapUx\Builder\OpenLayers\MapBuilderInterface as OpenLayersMapBuilderInterface;
use MapUx\Model\Map;
use MapUx\Twig\RenderMapExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Twig\Environment;

/**
 * @final
 * @experimental
 */
class MapUxExtension extends Extension
{
    private const LIBRARIES = [
        Map::LEAFLET     => LeafletMapBuilderInterface::class,
        Map::OPEN_LAYERS => OpenLayersMapBuilderInterface::class,
        Map::MAPBOX      => MapBoxMapBuilderInterface::class,
        Map::GOOGLE_MAPS => GoogleMapsMapBuilderInterface::class
    ];

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        foreach (self::LIBRARIES as $library => $interface) {
            $this->addDefinitionOfMapBuilder($container, $library, $interface);
        }

        if (class_exists(Environment::class)) {
            $container
                ->setDefinition('mapux.twig_extension', new Definition(RenderMapExtension::class))
                ->addTag('twig.extension')
                ->setPublic(false);
        }
    }

    private function addDefinitionOfMapBuilder(ContainerBuilder $container, string $library, string $interface): void
    {
        $container
            ->setDefinition('mapux.' . $library . '.builder', new Definition(MapBuilder::class, [$library]))
            ->setPublic(false);

        $container
            ->setAlias($interface, 'mapux.' . $library . '.builder')
            ->setPublic(false);
    }
}
