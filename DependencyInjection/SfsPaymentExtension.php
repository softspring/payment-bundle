<?php

namespace Softspring\PaymentBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class SfsPaymentExtension extends Extension
{
    /**
     * @inheritdoc
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->processConfiguration($configuration, $configs);

        $container->setParameter('sfs_payment.entity_manager_name', $config['entity_manager']);

        $container->setParameter('sfs_payment.concept.class', $config['model']['concept']);
        $container->setParameter('sfs_payment.invoice.class', $config['model']['invoice']);
        $container->setParameter('sfs_payment.payment.class', $config['model']['payment']);

        // load services
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config/services'));

        $container->setParameter('sfs_payment.adapter.name', $config['adapter']['driver']);

        if ($config['adapter']['driver'] == 'stripe') {
            $loader->load('adapter/stripe.yaml');
        }

        $loader->load('services.yaml');
        $loader->load('controller/admin_payments.yaml');
        $loader->load('manager/concept.yaml');
        $loader->load('manager/invoice.yaml');
        $loader->load('manager/payment.yaml');
    }
}