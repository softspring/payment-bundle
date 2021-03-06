<?php

namespace Softspring\PaymentBundle\Form\Admin;

use Jhg\DoctrinePaginationBundle\Request\RequestParam;
use Softspring\CrudlBundle\Form\EntityListFilterForm;
use Softspring\PaymentBundle\Model\InvoiceInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceListFilterForm extends EntityListFilterForm implements InvoiceListFilterFormInterface
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
                'invoice.status_string.draft' => InvoiceInterface::STATUS_PENDING,
                'invoice.status_string.pending' => InvoiceInterface::STATUS_PENDING,
                'invoice.status_string.paid' => InvoiceInterface::STATUS_PAID,
                'invoice.status_string.partial_paid' => InvoiceInterface::STATUS_PARTIAL_PAID,
                'invoice.status_string.unpaid' => InvoiceInterface::STATUS_UNPAID,
                'invoice.status_string.canceled' => InvoiceInterface::STATUS_CANCELED,
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