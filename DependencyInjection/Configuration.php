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
                        ->arrayNode('discount_rule')
                            ->treatNullLike([])
                            ->children()
                                ->scalarNode('class')->defaultValue('App\Entity\DiscountRule')->end()
                                ->arrayNode('condition')
                                    ->children()
                                        ->scalarNode('class')->defaultValue('App\Entity\DiscountRuleCondition')->end()
                                        ->arrayNode('mapping')
                                            ->arrayPrototype()
                                            ->children()
                                                ->scalarNode('entity')->end()
                                                ->scalarNode('type')->end()
                                            ->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                ->end()
                                ->arrayNode('action')
                                    ->children()
                                        ->scalarNode('class')->defaultValue('App\Entity\DiscountRuleAction')->end()
                                        ->arrayNode('mapping')
                                            ->arrayPrototype()
                                            ->children()
                                                ->scalarNode('entity')->end()
                                                ->scalarNode('type')->end()
                                            ->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->scalarNode('invoice')->defaultValue('App\Entity\Invoice')->end()
                        ->scalarNode('payment')->defaultValue('App\Entity\Payment')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}