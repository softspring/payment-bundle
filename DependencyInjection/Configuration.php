<?php

namespace Softspring\PaymentBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('sfs_payment');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->scalarNode('entity_manager')
                    ->defaultValue('default')
                ->end()

                ->arrayNode('adapter')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->enumNode('driver')
                            ->defaultValue('stripe')
                            ->values(['stripe'])
                        ->end()
                        ->variableNode('options')->defaultValue([])->end()
                    ->end()
                ->end()

                ->arrayNode('model')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('payment')->defaultValue('App\Entity\Payment')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}