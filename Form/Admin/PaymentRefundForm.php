<?php

namespace Softspring\PaymentBundle\Form\Admin;

use Doctrine\ORM\EntityManagerInterface;
use Softspring\PaymentBundle\Manager\PaymentManagerInterface;
use Softspring\PaymentBundle\Model\PaymentInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentRefundForm extends AbstractType implements PaymentRefundFormInterface
{
    /**
     * @var PaymentManagerInterface
     */
    protected $paymentManager;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * PaymentRefundForm constructor.
     *
     * @param PaymentManagerInterface $paymentManager
     * @param EntityManagerInterface   $em
     */
    public function __construct(PaymentManagerInterface $paymentManager, EntityManagerInterface $em)
    {
        $this->paymentManager = $paymentManager;
        $this->em = $em;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PaymentInterface::class,
            'translation_domain' => 'sfs_payment',
            'label_format' => 'admin_payment.create.form.%name%.label',
            'payment' => null,
        ]);

        $resolver->setAllowedTypes('payment', PaymentInterface::class);
        $resolver->setRequired('payment');
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('amount', MoneyType::class, [
            'constraints' => []
        ]);
    }

    public function formOptions(PaymentInterface $payment, Request $request): array
    {
        $options = [];

        $payment->setType(PaymentInterface::TYPE_REFUND);
        $options['payment'] = $this->paymentManager->getRepository()->findOneById($request->attributes->get('payment'));
        $payment->setRefundPayment($options['payment']);

        return $options;
    }
}