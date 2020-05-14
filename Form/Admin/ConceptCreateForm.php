<?php

namespace Softspring\PaymentBundle\Form\Admin;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Softspring\CustomerBundle\Manager\CustomerManagerInterface;
use Softspring\CustomerBundle\Model\CustomerInterface;
use Softspring\PaymentBundle\Model\ConceptInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class ConceptCreateForm extends AbstractType implements ConceptCreateFormInterface
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
            'data_class' => ConceptInterface::class,
            'translation_domain' => 'sfs_payment',
            'label_format' => 'admin_concept.create.form.%name%.label',
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('customer', EntityType::class, [
            'required' => false,
            'constraints' => new NotBlank(),
            'class' => CustomerInterface::class,
            'em' => $this->em,
            'query_builder' => function (EntityRepository $entityRepository) {
                $qb = $entityRepository->createQueryBuilder('c');
                return $qb;
            },
            'choice_label' => function (CustomerInterface $customer) {
                return $customer->getName();
            }
        ]);

        $builder->add('concept');

        $builder->add('price', MoneyType::class, [
            'constraints' => new Range(['min' => 0]),
        ]);

        $builder->add('quantity', IntegerType::class, [
            'constraints' => new Range(['min' => 1]),
        ]);

        $builder->add('currency', CurrencyType::class, [
            'preferred_choices' => ['EUR', 'USD'],
        ]);
    }

    public function formOptions(ConceptInterface $concept, Request $request): array
    {
        $options = [];

        return $options;
    }
}