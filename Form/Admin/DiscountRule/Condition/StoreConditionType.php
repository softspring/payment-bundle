<?php

namespace Softspring\PaymentBundle\Form\Admin\DiscountRule\Condition;

use Doctrine\ORM\EntityManagerInterface;
use Softspring\PolymorphicFormType\Form\Type\Node\AbstractNodeType;
use Softspring\ShopBundle\Model\StoreInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StoreConditionType extends AbstractNodeType
{
    /**
     * @var EntityManagerInterface|null
     */
    protected $shopEm;

    /**
     * StoreConditionType constructor.
     *
     * @param EntityManagerInterface|null $shopEm
     */
    public function __construct(?EntityManagerInterface $shopEm)
    {
        $this->shopEm = $shopEm;
    }

    public function getBlockPrefix()
    {
        return 'store_condition';
    }

    protected function configureChildOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'label_format' => 'admin_discount_rule.form.conditions.store.%name%.label',
            'prototype_button_label' => 'admin_discount_rule.form.conditions.store.prototype_button',
            'prototype_button_attr' => [ 'class' => 'dropdown-item btn btn-light' ],
        ]);
    }

    protected function buildChildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('store', EntityType::class, [
            'required' => false,
            'class' => StoreInterface::class,
            'em' => $this->shopEm,
        ]);
    }
}