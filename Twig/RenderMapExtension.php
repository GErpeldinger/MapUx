<?php

declare(strict_types=1);

namespace MapUx\Twig;

use MapUx\Model\MapInterface;
use Twig\Environment;
use Twig\Error\RuntimeError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

use function json_encode;
use function twig_escape_filter;

class RenderMapExtension extends AbstractExtension
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
     * @param array|null $attributes
     *
     * @return string
     *
     * @throws RuntimeError
     */
    public function renderMap(Environment $env, MapInterface $map, ?array $attributes = null): string
    {
        $view = twig_escape_filter($env, json_encode($map->createView()), 'html_attr');

        $background = twig_escape_filter($env, json_encode($map->createBackground()), 'html_attr');

        $html = '<div class="mapux-map" 
            data-controller="' . $map->getController() . '" 
            data-background="' . $map->getBackground()->getUrl() . '"
            data-view="' . $view . '"
            data-key="' . $_ENV['MAP_SECRET'] . '"' ;

        if (null !== $attributes) {
            foreach ($attributes as $key => $value) {
                $html .= ' ' . $key . '="' . $value . '"';
            }
        }

        $html .= '></div>';

        return trim($html);
    }
}
