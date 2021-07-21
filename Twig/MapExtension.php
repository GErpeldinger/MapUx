<?php

namespace MapUx\Twig;

use MapUx\Model\MapInterface;
use Twig\Environment;
use Twig\Error\RuntimeError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

use function json_encode;
use function twig_escape_filter;

class MapExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                'render_map',
                [$this, 'renderMap'],
                ['needs_environment' => true, 'is_safe' => ['html']]
            ),
        ];
    }

    /**
     * @param Environment $env
     * @param MapInterface $map
     *
     * @return string
     *
     * @throws RuntimeError
     */
    public function renderMap(Environment $env, MapInterface $map): string
    {
        $view = twig_escape_filter($env, json_encode($map->createView()), 'html_attr');

        $html = '
            <div
                class="mapux-map"
                data-controller="' . $map->getController() . '"
                data-view="' . $view . '"
             ></div>
        ';

        return trim($html);
    }
}