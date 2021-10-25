<?php

declare(strict_types=1);

namespace MapUx\DependencyInjection;

use Exception;
use MapUx\Builder\GoogleMaps\MapBuilderInterface as GoogleMapsMapBuilderInterface;
use MapUx\Builder\Leaflet\MapBuilderInterface as LeafletMapBuilderInterface;
use MapUx\Builder\MapBox\MapBuilderInterface as MapBoxMapBuilderInterface;
use MapUx\Builder\MapBuilder;
use MapUx\Builder\MapBuilderInterface;
use MapUx\Builder\OpenLayers\MapBuilderInterface as OpenLayersMapBuilderInterface;
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


    private const INTERFACE = MapBuilderInterface::class;

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
            $this->addDefinitionOfMapBuilder($container,  self::INTERFACE);


        if (class_exists(Environment::class)) {
            $container
                ->setDefinition('mapux.twig_extension', new Definition(RenderMapExtension::class))
                ->addTag('twig.extension')
                ->setPublic(false);
        }
    }

    private function addDefinitionOfMapBuilder(ContainerBuilder $container, string $interface): void
    {
        $container
            ->setDefinition('mapux.builder', new Definition(MapBuilder::class, []))
            ->setPublic(false);

        $container
            ->setAlias($interface, 'mapux.builder')
            ->setPublic(false);
    }
}
