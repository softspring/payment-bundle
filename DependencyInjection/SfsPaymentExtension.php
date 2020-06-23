<?php

namespace Softspring\PaymentBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class SfsPaymentExtension extends Extension implements PrependExtensionInterface
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
        $container->setParameter('sfs_payment.discount.class', $config['model']['discount']);
        $container->setParameter('sfs_payment.discount_rule.class', $config['model']['discount_rule']['class'] ?? null);
        $container->setParameter('sfs_payment.discount_rule_condition.class', $config['model']['discount_rule']['condition']['class'] ?? null);
        $container->setParameter('sfs_payment.discount_rule_condition.mapping', $config['model']['discount_rule']['condition']['mapping'] ?? null);
        $container->setParameter('sfs_payment.discount_rule_action.class', $config['model']['discount_rule']['action']['class'] ?? null);
        $container->setParameter('sfs_payment.invoice.class', $config['model']['invoice']);
        $container->setParameter('sfs_payment.payment.class', $config['model']['payment']);

        // load services
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config/services'));

        $loader->load('param_converters.yaml');
        $loader->load('controller/admin_payments.yaml');
        $loader->load('controller/admin_concepts.yaml');
        $loader->load('controller/admin_invoices.yaml');
        $loader->load('manager/concept.yaml');
        $loader->load('manager/invoice.yaml');
        $loader->load('manager/payment.yaml');

        if (!empty($config['model']['discount'])) {
            $loader->load('controller/admin_discounts.yaml');
            $loader->load('manager/discount.yaml');
        }

        if (!empty($config['model']['discount_rule']['class'])) {
            $loader->load('controller/admin_discount_rules.yaml');
            $loader->load('manager/discount_rule.yaml');
        }
    }

    public function prepend(ContainerBuilder $container)
    {
        $container->prependExtensionConfig('twig', [
            // add polymorphic form theme path
            'paths' => [
                '%kernel.project_dir%/vendor/softspring/polymorphic-form-type/Resources/views' => 'SfsPolymorphicFormType'
            ],
            // load form themes
            'form_themes' => [
                '@SfsPolymorphicFormType/polymorphic-form-theme.html.twig',
                '@SfsPayment/form/rule-form-theme.html.twig'
            ]
        ]);
    }
}