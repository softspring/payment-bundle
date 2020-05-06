<?php

namespace Softspring\PaymentBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AliasDoctrineEntityManagerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $emName = $container->getParameter('sfs_payment.entity_manager_name');

        $container->addAliases([
            'sfs_payment.entity_manager' => 'doctrine.orm.'.$emName.'_entity_manager'
        ]);
    }
}