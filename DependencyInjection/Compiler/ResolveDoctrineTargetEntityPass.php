<?php

namespace Softspring\PaymentBundle\DependencyInjection\Compiler;

use Doctrine\ORM\Mapping\MappingException;
use Softspring\CoreBundle\DependencyInjection\Compiler\AbstractResolveDoctrineTargetEntityPass;
use Softspring\PaymentBundle\Model\PaymentInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ResolveDoctrineTargetEntityPass extends AbstractResolveDoctrineTargetEntityPass
{
    /**
     * @inheritDoc
     */
    protected function getEntityManagerName(ContainerBuilder $container): string
    {
        return $container->getParameter('sfs_payment.entity_manager_name');
    }

    /**
     * @param ContainerBuilder $container
     *
     * @throws MappingException
     * @throws \ReflectionException
     */
    public function process(ContainerBuilder $container)
    {
        $this->setTargetEntityFromParameter('sfs_payment.payment.class', PaymentInterface::class, $container, true);
    }
}