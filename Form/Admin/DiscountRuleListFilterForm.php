<?php

namespace Softspring\PaymentBundle\Form\Admin;

use Jhg\DoctrinePaginationBundle\Request\RequestParam;
use Softspring\CrudlBundle\Form\EntityListFilterForm;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DiscountRuleListFilterForm extends EntityListFilterForm implements DiscountRuleListFilterFormInterface
{
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'translation_domain' => 'sfs_payment',
            'label_format' => 'admin_discount_rule.list.filter_form.%name%.label',
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $builder->add('status', ChoiceType::class, [
//            'required' => false,
//            'choices' => [
//                'pending' => PaymentInterface::STATUS_PENDING,
//                'done' => PaymentInterface::STATUS_DONE,
//                'failed' => PaymentInterface::STATUS_FAILED,
//            ]
//        ]);
//
//        $builder->add('submit', SubmitType::class, [
//            'label' => 'admin_payment.list.filter_form.actions.search'
//        ]);
    }

    public function getOrder(Request $request): array
    {
        if (class_exists(RequestParam::class)) {
            $order = RequestParam::getQueryValidParam($request, self::getOrderFieldParamName(), 'name', ['id','name']);
            $sort = RequestParam::getQueryValidParam($request, self::getOrderDirectionParamName(), 'desc', ['asc','desc']);

            return [$order => $sort];
        }

        return [$request->query->get(self::getOrderFieldParamName(), 'id') => $request->query->get(self::getOrderDirectionParamName(), 'asc')];
    }
}