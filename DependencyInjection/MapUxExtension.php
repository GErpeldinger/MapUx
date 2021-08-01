<?php

declare(strict_types=1);

namespace MapUx\DependencyInjection;

use Exception;
use MapUx\Builder\MapBuilderInterface;
use MapUx\Builder\MapBuilder;
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
    public const LEAFLET     = 'leaflet';
    public const OPEN_LAYERS = 'open-layers';
    public const MAPBOX      = 'mapbox';
    public const GOOGLE_MAPS = 'google-maps';

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $container
            ->setDefinition('mapux.builder', new Definition(MapBuilder::class, [$configs[0]['library']]))
            ->setPublic(false);

        $container
            ->setAlias(MapBuilderInterface::class, 'mapux.builder')
            ->setPublic(false);

        if (class_exists(Environment::class)) {
            $container
                ->setDefinition('mapux.twig_extension', new Definition(RenderMapExtension::class))
                ->addTag('twig.extension')
                ->setPublic(false);
        }
    }
}
