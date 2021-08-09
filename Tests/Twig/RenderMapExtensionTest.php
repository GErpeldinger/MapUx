<?php

namespace MapUx\Tests\Twig;

use MapUx\tests\Kernel\TwigAppKernel;
use PHPUnit\Framework\TestCase;
use Twig\Environment;

class RenderMapExtensionTest extends TestCase
{

    public function testRenderMap()
    {
        $kernel = new TwigAppKernel('test', true);
        $kernel->boot();
        $container = $kernel->getContainer()->get('test.service_container');

        /** @var ChartBuilderInterface $builder */
        $builder = $container->get('test.mapux.builder');

        $map = $builder->createMap(44, 0, 10);

        $rendered = $container->get('test.mapux.twig_extension')->renderMap(
            $container->get(Environment::class),
            $map,
            []
        );

        $mapHtml = '<div 
            data-controller="mapux--mapux--leaflet" 
            data-background="{\"url\":\"https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png\",\"options\":{}}" 
            data-view="{\"center\":{\"latitude\":44,\"longitude\":0},\"zoom\":10}"></div>';

        return $this->assertEquals(stripslashes($mapHtml), stripslashes(urldecode(html_entity_decode($rendered))));
    }

}
