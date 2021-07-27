<?php

declare(strict_types=1);

namespace MapUx\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * @final
 * @experimental
 */
class MapUxExtension extends Extension
{
    /**
     * @inheritDoc
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        // TODO: Implement load() method.
    }
}
