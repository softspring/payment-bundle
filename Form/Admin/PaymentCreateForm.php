<?php

namespace Softspring\PaymentBundle\Form\Admin;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Softspring\CustomerBundle\Manager\CustomerManagerInterface;
use Softspring\CustomerBundle\Model\CustomerInterface;
use Softspring\CustomerBundle\Model\SourceAliasedInterface;
use Softspring\CustomerBundle\Model\SourceInterface;
use Softspring\PaymentBundle\Model\PaymentInterface;
use Softspring\PlatformBundle\Model\PlatformObjectInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Range;

class PaymentCreateForm extends AbstractType implements PaymentCreateFormInterface
{
    /**
     * @var CustomerManagerInterface
     */
    protected $customerManager;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * PaymentCreateForm constructor.
     *
     * @param CustomerManagerInterface $customerManager
     * @param EntityManagerInterface   $em
     */
    public function __construct(CustomerManagerInterface $customerManager, EntityManagerInterface $em)
    {
        $this->customerManager = $customerManager;
        $this->em = $em;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PaymentInterface::class,
            'translation_domain' => 'sfs_payment',
            'label_format' => 'admin_payment.create.form.%name%.label',
            'customer' => null,
        ]);

        $resolver->setAllowedTypes('customer', CustomerInterface::class);
        $resolver->setRequired('customer');
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var CustomerInterface $customer */
        $customer = $options['customer'];

        $builder->add('source', EntityType::class, [
            'class' => SourceInterface::class,
            'em' => $this->em,
            'query_builder' => function (EntityRepository $entityRepository) use ($customer) {
                $qb = $entityRepository->createQueryBuilder('s');
                $qb->where('s.customer = :customer')->setParameter('customer', $customer);
                return $qb;
            },
            'choice_label' => function (SourceInterface $source) {
                $sourceLabel = [];

                if ($source instanceof SourceAliasedInterface) {
                    $sourceLabel[] = $source->getAlias();
                }

                if ($source instanceof PlatformObjectInterface && $source->getPlatformData()) {
                    $sourceLabel[] = '****************'. ($source->getPlatformData()['last4'] ?? '');
                }

                if (empty($sourceLabel)) {
                    $sourceLabel[] = $source->getId();
                }

                return implode(' ', $sourceLabel);
            }
        ]);

        $builder->add('concept');

        $builder->add('amount', MoneyType::class, [
            'constraints' => new Range(['min' => 0]),
        ]);

        $builder->add('currency', CurrencyType::class, [
            'preferred_choices' => ['EUR', 'USD'],
        ]);
    }

    public function formOptions(PaymentInterface $payment, Request $request): array
    {
        $options = [];

        $payment->setType(PaymentInterface::TYPE_CHARGE);
        $options['customer'] = $this->customerManager->getRepository()->findOneById($request->attributes->get('customer'));
        $payment->setCustomer($options['customer']);

        return $options;
    }
}