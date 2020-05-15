<?php

namespace Softspring\PaymentBundle\Doctrine;

use Doctrine\ORM\Event\LoadClassMetadataEventArgs;

class DiscountRuleConditionMetadata
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
     * DiscountRuleConditionMetadata constructor.
     *
     * @param string $conditionClass
     * @param array  $conditionMappings
     */
    public function __construct(string $conditionClass, array $conditionMappings)
    {
        $this->conditionClass = $conditionClass;
        $this->conditionMappings = $conditionMappings;
    }

    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        $classMetadata = $eventArgs->getClassMetadata();
        $name = $classMetadata->name;

        if ($this->conditionClass !== $name) {
            return;
        }

        foreach ($this->conditionMappings as $condition => list('entity' => $entity, 'type' => $formType)) {
            $classMetadata->addDiscriminatorMapClass($condition, $entity);
        }
    }
}