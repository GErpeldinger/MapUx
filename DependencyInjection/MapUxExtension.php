<?php

declare(strict_types=1);

namespace MapUx\DependencyInjection;

use Exception;
use MapUx\Builder\Leaflet\MapBuilder as LeafletMapBuilder;
use MapUx\Builder\OpenLayer\MapBuilder as OpenLayerMapBuilder;
use MapUx\Builder\MapBuilderInterface;
use MapUx\Twig\MapExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Twig\Environment;

class MapUxExtension extends Extension
{
    private const LEAFLET = 'leaflet';
    private const OPEN_LAYER = 'open_layer';

    /** @var ContainerBuilder */
    private $container;

    /** @var array */
    private $configs;

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $this->container = $container;
        $this->configs = $configs;

        $this->selectMapLibrary();

        if (class_exists(Environment::class)) {
            $this->addTwigExtension();
        }
    }

    /**
     * @throws Exception
     */
    private function selectMapLibrary(): void
    {
        switch ($this->configs[0]['library']) {
            case self::LEAFLET:
                $this->container
                    ->setDefinition('mapux.builder', new Definition(LeafletMapBuilder::class))
                    ->setPublic(false);
                break;
            case self::OPEN_LAYER:
                $this->container
                    ->setDefinition('mapux.builder', new Definition(OpenLayerMapBuilder::class))
                    ->setPublic(false);
                break;
            default:
                throw new Exception('Library is not correctly configured in config file.');
        }

        $this->container
            ->setAlias(MapBuilderInterface::class, 'mapux.builder')
            ->setPublic(false);
    }

    private function addTwigExtension(): void
    {
        $this->container
            ->setDefinition('mapux.twig_extension', new Definition(MapExtension::class))
            ->addTag('twig.extension')
            ->setPublic(false);
    }
}
