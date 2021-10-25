<?php

declare(strict_types=1);

namespace MapUx\Twig;

use MapUx\Exception\NotDefinedTokenException;
use MapUx\Model\Map;
use MapUx\Model\MapInterface;
use Twig\Environment;
use Twig\Error\RuntimeError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

use function json_encode;
use function trim;
use function twig_escape_filter;

class RenderMapExtension extends AbstractExtension
{
    /**
     * @inheritDoc
     */
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
     * @throws RuntimeError|NotDefinedTokenException
     */
    public function renderMap(Environment $env, MapInterface $map, ?array $attributes = null): string
    {
        $view       = twig_escape_filter($env, json_encode($map->createDataView()), 'html_attr');
        $background = twig_escape_filter($env, json_encode($map->createDataBackground()), 'html_attr');
        $markers    = twig_escape_filter($env, json_encode($map->createDataMarkers()), 'html_attr');

        $html = '<div 
            data-controller="' . $map->getStimulusController() . '" 
            data-background="' . $background . '" 
            data-view="' . $view . '"';

        $html = $this->checkToken($map, $html);

        if ($map->getMarkers()) {
            $html .= ' data-markers="' . $markers . '"';
        }

        if (null !== $attributes) {
            foreach ($attributes as $key => $value) {
                $html .= ' ' . $key . '="' . $value . '"';
            }
        }

        $html .= '></div>';

        return trim($html);
    }

    /**
     * @throws NotDefinedTokenException
     */
    private function checkToken(MapInterface $map, string $html): string
    {
        if ($map->getLibrary() === Map::GOOGLE_MAPS) {
            if (isset($_ENV['GOOGLE_MAPS_TOKEN'])) {
                $html .= ' data-key="' . $_ENV['GOOGLE_MAPS_TOKEN'] . '"';
            } else {
                throw new NotDefinedTokenException('GOOGLE_MAPS_TOKEN');
            }
        }

        if ($map->getLibrary() === Map::MAPBOX) {
            if (isset($_ENV['MAPBOX_TOKEN'])) {
                $html .= ' data-key="' . $_ENV['MAPBOX_TOKEN'] . '"';
            } else {
                throw new NotDefinedTokenException('MAPBOX_TOKEN');
            }
        }

        return $html;
    }
}
