<?php

namespace Softspring\PaymentBundle\Form\Admin;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Softspring\CustomerBundle\Manager\CustomerManagerInterface;
use Softspring\CustomerBundle\Model\CustomerInterface;
use Softspring\PaymentBundle\Model\DiscountInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class DiscountCreateForm extends AbstractType implements DiscountCreateFormInterface
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
            'data_class' => DiscountInterface::class,
            'translation_domain' => 'sfs_payment',
            'label_format' => 'admin_discount.create.form.%name%.label',
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');

        $builder->add('type', ChoiceType::class, [
            'choices' => [
                'TYPE_PERCENTAGE' => DiscountInterface::TYPE_PERCENTAGE,
                'TYPE_FIXED_AMOUNT' => DiscountInterface::TYPE_FIXED_AMOUNT,
            ],
        ]);

        $builder->add('due', ChoiceType::class, [
            'choices' => [
                'DUE_NEVER' => DiscountInterface::DUE_NEVER,
                'DUE_DATE' => DiscountInterface::DUE_DATE,
                'DUE_AFTER_ONCE' => DiscountInterface::DUE_AFTER_ONCE,
                'DUE_AFTER_REPEATS' => DiscountInterface::DUE_AFTER_REPEATS,
            ],
        ]);

        $builder->add('value', NumberType::class, [
            'constraints' => new Range(['min' => 0]),
        ]);

        $builder->add('currency', CurrencyType::class, [
            'preferred_choices' => ['EUR', 'USD'],
        ]);
    }

    public function formOptions(DiscountInterface $discount, Request $request): array
    {
        $options = [];

        return $options;
    }
}