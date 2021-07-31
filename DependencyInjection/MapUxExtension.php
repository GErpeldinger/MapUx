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
    private const LEAFLET     = 'leaflet';
    private const OPEN_LAYERS = 'open-layers';
    private const MAPBOX      = 'mapbox';
    private const GOOGLE_MAPS = 'google-maps';

    /** @var ContainerBuilder */
    private ContainerBuilder $container;

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $this->container = $container;

        $this->selectMapLibrary($configs[0]['library']);

        if (class_exists(Environment::class)) {
            $this->addTwigExtension();
        }
    }

    /**
     * @param string $library
     *
     * @throws Exception
     */
    private function selectMapLibrary(string $library): void
    {

        $this->container
            ->setDefinition('mapux.builder', new Definition(MapBuilder::class, [$library]))
            ->setPublic(false);

        $this->container
            ->setAlias(MapBuilderInterface::class, 'mapux.builder')
            ->setPublic(false);
    }

    private function addTwigExtension(): void
    {
        $this->container
            ->setDefinition('mapux.twig_extension', new Definition(RenderMapExtension::class))
            ->addTag('twig.extension')
            ->setPublic(false);
    }
}
