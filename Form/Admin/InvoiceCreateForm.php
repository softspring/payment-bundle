<?php

namespace Softspring\PaymentBundle\Form\Admin;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Softspring\CustomerBundle\Manager\CustomerManagerInterface;
use Softspring\CustomerBundle\Model\CustomerInterface;
use Softspring\PaymentBundle\Model\ConceptInterface;
use Softspring\PaymentBundle\Model\InvoiceInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class InvoiceCreateForm extends AbstractType implements InvoiceCreateFormInterface
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
            'data_class' => InvoiceInterface::class,
            'translation_domain' => 'sfs_payment',
            'label_format' => 'admin_invoice.create.form.%name%.label',
            'step' => 1,
            'customer' => null,
        ]);

        $resolver->setAllowedTypes('customer', ['null', CustomerInterface::class]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('date', DateType::class, [
            'required' => false,
            'constraints' => [
                new NotBlank(),
                new Range(['min' => new \DateTime('today')])
            ],
            'widget' => 'single_text',
            'attr' => [
                'min' => date('Y-m-d')
            ],
        ]);

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
            },
            'attr' => [
                'onchange' => 'submit()'
            ]
        ]);

        if ($options['step'] == 2) {
            $customer = $options['customer'];

            $builder->add('concepts', EntityType::class, [
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'constraints' => new Count(['min' => 1]),
                'class' => ConceptInterface::class,
                'em' => $this->em,
                'query_builder' => function (EntityRepository $entityRepository) use ($customer) {
                    $qb = $entityRepository->createQueryBuilder('c');
                    $qb->where('c.customer = :customer')->setParameter('customer', $customer);
                    $qb->andWhere('c.invoice IS NULL');
                    return $qb;
                },
                'choice_label' => function (ConceptInterface $concept) {
                    return $concept->getConcept();
                },
                'by_reference' => false,
            ]);
        }
    }

    public function formOptions(InvoiceInterface $invoice, Request $request): array
    {
        $options = [
        ];

        if ($request->request->get('invoice_create_form')['customer'] ?? false) {
            $options['customer'] =  $this->customerManager->getRepository()->findOneById($request->request->get('invoice_create_form')['customer']);
            $options['step'] =  2;
        }

        return $options;
    }
}