<?php

namespace Softspring\PaymentBundle\Form\Admin;

use Doctrine\ORM\EntityManagerInterface;
use Softspring\CustomerBundle\Manager\CustomerManagerInterface;
use Softspring\PaymentBundle\Form\Admin\DiscountRule\ConditionsCollectionType;
use Softspring\PaymentBundle\Model\DiscountRuleInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Range;

class DiscountRuleCreateForm extends AbstractType implements DiscountRuleCreateFormInterface
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
            'data_class' => DiscountRuleInterface::class,
            'translation_domain' => 'sfs_payment',
            'label_format' => 'admin_discount_rule.create.form.%name%.label',
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');

        $builder->add('priority', IntegerType::class);

        $builder->add('active', CheckboxType::class, [
            'required' => false,
        ]);
        $builder->add('stopApply', CheckboxType::class, [
            'required' => false,
        ]);

        $builder->add('conditions', ConditionsCollectionType::class);
    }

    public function formOptions(DiscountRuleInterface $discount, Request $request): array
    {
        $options = [];

        return $options;
    }
}