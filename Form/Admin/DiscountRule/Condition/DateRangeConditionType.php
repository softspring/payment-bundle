<?php

namespace Softspring\PaymentBundle\Form\Admin\DiscountRule\Condition;

use Softspring\PolymorphicFormType\Form\Type\Node\AbstractNodeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DateRangeConditionType extends AbstractNodeType
{
    public function getBlockPrefix()
    {
        return 'date_range_condition';
    }

    protected function configureChildOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'label_format' => 'admin_discount_rule.form.conditions.date_range.%name%.label',
            'prototype_button_label' => 'admin_discount_rule.form.conditions.date_range.prototype_button',
            'prototype_button_attr' => [ 'class' => 'dropdown-item btn btn-light' ],
        ]);
    }

    protected function buildChildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fromDate', DateType::class, [
            'required' => false,
            'widget' => 'single_text',
        ]);

        $builder->add('toDate', DateType::class, [
            'required' => false,
            'widget' => 'single_text',
        ]);
    }
}