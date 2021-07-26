<?php

declare(strict_types=1);

namespace MapUx\DependencyInjection;

use MapUx\Builder\Leaflet\MapBuilder;
use MapUx\Builder\MapBuilderInterface;
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
            ->setDefinition('mapux.builder', new Definition(MapBuilder::class))
            ->setPublic(false);

        $container
            ->setAlias(MapBuilderInterface::class, 'mapux.builder')
            ->setPublic(false);

        if (class_exists(Environment::class)) {
            $container
                ->setDefinition('mapux.twig_extension', new Definition(MapExtension::class))
                ->addTag('twig.extension')
                ->setPublic(false);
        }
    }
}
