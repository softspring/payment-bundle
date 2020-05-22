<?php

namespace Softspring\PaymentBundle\Form\Admin\DiscountRule\Condition;

use Doctrine\ORM\EntityManagerInterface;
use Softspring\PolymorphicFormType\Form\Type\Node\AbstractNodeType;
use Softspring\ShopBundle\Model\SalableItemInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SalableItemConditionType extends AbstractNodeType
{
    /**
     * @var EntityManagerInterface|null
     */
    protected $shopEm;

    /**
     * SalableItemConditionType constructor.
     *
     * @param EntityManagerInterface|null $shopEm
     */
    public function __construct(?EntityManagerInterface $shopEm)
    {
        $this->shopEm = $shopEm;
    }

    public function getBlockPrefix()
    {
        return 'salable_item_condition';
    }

    protected function configureChildOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'label_format' => 'admin_discount_rule.form.conditions.salable_item.%name%.label',
            'prototype_button_label' => 'admin_discount_rule.form.conditions.salable_item.prototype_button',
            'prototype_button_attr' => [ 'class' => 'dropdown-item btn btn-light' ],
        ]);
    }

    protected function buildChildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('salableItem', EntityType::class, [
            'required' => false,
            'class' => SalableItemInterface::class,
            'em' => $this->shopEm,
        ]);
    }
}