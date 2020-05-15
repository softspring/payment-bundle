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

                ->arrayNode('model')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('concept')->defaultValue('App\Entity\Concept')->end()
                        ->scalarNode('discount')->defaultNull()->end()
                        ->scalarNode('discount_rule')->defaultNull()->end()
                        ->scalarNode('invoice')->defaultValue('App\Entity\Invoice')->end()
                        ->scalarNode('payment')->defaultValue('App\Entity\Payment')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}