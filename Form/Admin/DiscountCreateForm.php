<?php

namespace Softspring\PaymentBundle\Form\Admin;

use Doctrine\ORM\EntityManagerInterface;
use Softspring\CustomerBundle\Manager\CustomerManagerInterface;
use Softspring\PaymentBundle\Model\DiscountInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
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

        $builder->add('target', ChoiceType::class, [
            'choice_translation_domain' => 'sfs_payment',
            'choices' => [
                'discount.target_string.invoice' => DiscountInterface::TARGET_INVOICE,
                'discount.target_string.shopping_cart' => DiscountInterface::TARGET_SHOPPING_CART,
                'discount.target_string.shopping_salable' => DiscountInterface::TARGET_SHOPPING_SALABLE,
                'discount.target_string.subscription' => DiscountInterface::TARGET_SUBSCRIPTION,
            ],
        ]);

        $builder->add('type', ChoiceType::class, [
            'choice_translation_domain' => 'sfs_payment',
            'choices' => [
                'discount.type_string.percentage' => DiscountInterface::TYPE_PERCENTAGE,
                'discount.type_string.fixed_amount' => DiscountInterface::TYPE_FIXED_AMOUNT,
            ],
        ]);

        $builder->add('due', ChoiceType::class, [
            'choice_translation_domain' => 'sfs_payment',
            'choices' => [
                'discount.due_string.never' => DiscountInterface::DUE_NEVER,
                'discount.due_string.date' => DiscountInterface::DUE_DATE,
                'discount.due_string.after_once' => DiscountInterface::DUE_AFTER_ONCE,
                'discount.due_string.after_repeats' => DiscountInterface::DUE_AFTER_REPEATS,
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