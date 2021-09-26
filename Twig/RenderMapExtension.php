<?php

declare(strict_types=1);

namespace MapUx\Twig;

use MapUx\Exception\InvalidTokenException;
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
     * @throws RuntimeError|InvalidTokenException
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
     * @throws InvalidTokenException
     */
    private function checkToken(MapInterface $map, string $html): string
    {
        if (false !== strpos($map->getStimulusController(), 'google-maps')) {
            if (isset($_ENV['GOOGLE_MAPS_TOKEN'])) {
                $html .= ' data-key="' . $_ENV['GOOGLE_MAPS_TOKEN'] . '"';
            } else {
                throw new InvalidTokenException('GOOGLE_MAPS_TOKEN');
            }
        }

        if (false !== strpos($map->getStimulusController(), 'mapbox')) {
            if (isset($_ENV['MAP_BOX_TOKEN'])) {
                $html .= ' data-key="' . $_ENV['MAP_BOX_TOKEN'] . '"';
            } else {
                throw new InvalidTokenException('MAP_BOX_TOKEN');
            }
        }

        return $html;
    }
}
