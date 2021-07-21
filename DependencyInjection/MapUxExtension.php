<?php

declare(strict_types=1);

namespace MapUx\DependencyInjection;

use MapUx\Builder\LeafletMapBuilder;
use MapUx\Builder\MapBuilderInterface;
use MapUx\Builder\OpenLayerMapBuilder;
use MapUx\Twig\MapExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Twig\Environment;

class MapUxExtension extends Extension
{
    /**
     * @inheritDoc
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $container
            ->register('mapux-leaflet.builder', LeafletMapBuilder::class)
        ;

        $container->setAliases();

        if (class_exists(Environment::class)) {
            $container
                ->setDefinition('mapux.twig_extension', new Definition(MapExtension::class))
                ->addTag('twig.extension')
                ->setPublic(false);
        }
    }
}
