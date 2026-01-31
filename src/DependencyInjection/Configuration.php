<?php

declare(strict_types=1);

namespace Syeedalireza\ServiceMeshBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('service_mesh');

        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('grpc')
                    ->children()
                        ->booleanNode('enabled')->defaultTrue()->end()
                        ->integerNode('port')->defaultValue(50051)->end()
                    ->end()
                ->end()
                ->arrayNode('discovery')
                    ->children()
                        ->scalarNode('provider')->defaultValue('consul')->end()
                        ->arrayNode('consul')
                            ->children()
                                ->scalarNode('host')->defaultValue('consul')->end()
                                ->integerNode('port')->defaultValue(8500)->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('resilience')
                    ->children()
                        ->arrayNode('circuit_breaker')
                            ->children()
                                ->integerNode('threshold')->defaultValue(5)->end()
                                ->integerNode('timeout')->defaultValue(60)->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
