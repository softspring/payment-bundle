<?php

namespace Softspring\PaymentBundle\Form\Admin;

use Jhg\DoctrinePaginationBundle\Request\RequestParam;
use Softspring\CrudlBundle\Form\EntityListFilterForm;
use Softspring\PaymentBundle\Model\PaymentInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentListFilterForm extends EntityListFilterForm implements PaymentListFilterFormInterface
{
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'translation_domain' => 'sfs_payment',
            'label_format' => 'admin_payment.list.filter_form.%name%.label',
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('status', ChoiceType::class, [
            'required' => false,
            'choice_translation_domain' => 'sfs_payment',
            'choices' => [
                'payment.status_string.pending' => PaymentInterface::STATUS_PENDING,
                'payment.status_string.done' => PaymentInterface::STATUS_DONE,
                'payment.status_string.failed' => PaymentInterface::STATUS_FAILED,
            ]
        ]);

        $builder->add('submit', SubmitType::class, [
            'label' => 'admin_payment.list.filter_form.actions.search'
        ]);
    }

    public function getOrder(Request $request): array
    {
        if (class_exists(RequestParam::class)) {
            $order = RequestParam::getQueryValidParam($request, self::getOrderFieldParamName(), 'date', ['id','date']);
            $sort = RequestParam::getQueryValidParam($request, self::getOrderDirectionParamName(), 'desc', ['asc','desc']);

            return [$order => $sort];
        }

        return [$request->query->get(self::getOrderFieldParamName(), 'id') => $request->query->get(self::getOrderDirectionParamName(), 'asc')];
    }
}