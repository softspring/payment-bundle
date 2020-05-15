<?php

namespace Softspring\PaymentBundle\Form\Admin\DiscountRule;

use Doctrine\ORM\EntityManagerInterface;
use Softspring\PolymorphicFormType\Form\Type\DoctrinePolymorphicCollectionType;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConditionsCollectionType extends DoctrinePolymorphicCollectionType
{
    /**
     * @var string
     */
    protected $conditionClass;

    /**
     * @var array
     */
    protected $conditionMappings;

    /**
     * ConditionsCollectionType constructor.
     *
     * @param string                      $conditionClass
     * @param array                       $conditionMappings
     * @param FormFactory|null            $formFactory
     * @param EntityManagerInterface|null $em
     */
    public function __construct(string $conditionClass, array $conditionMappings, FormFactory $formFactory = null, EntityManagerInterface $em = null)
    {
        parent::__construct($formFactory, $em);
        $this->conditionClass = $conditionClass;
        $this->conditionMappings = $conditionMappings;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $mappings = [];
        foreach ($this->conditionMappings as $condition => list('entity' => $entity, 'type' => $formType)) {
            $mappings[$condition] = $formType;
        }

        $resolver->setDefaults([
            'abstract_class' => $this->conditionClass,
            'error_bubbling' => false,
            'types_map' => $mappings,
        ]);
    }
}