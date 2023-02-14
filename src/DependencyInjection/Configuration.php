<?php

namespace kzorluoglu\ChameleonBash\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('psysh');

        $treeBuilder->getRootNode()
            ->children()
            ->arrayNode('variables')
            ->info('Define additional variables to be exposed in Psysh')
            ->useAttributeAsKey('variable_name')
            ->example([
                'debug' => '%kernel.debug%',
                'my_service' => '@my.service',
                'os' => ['linux', 'macos', 'losedows'],
            ])
            ->prototype('variable')->end()
            ->end()
            ->end();

        return $treeBuilder;
    }
}
