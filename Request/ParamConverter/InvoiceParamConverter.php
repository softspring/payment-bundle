<?php

namespace Softspring\PaymentBundle\Request\ParamConverter;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Softspring\PaymentBundle\Model\InvoiceInterface;
use Softspring\PaymentBundle\Manager\InvoiceManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class InvoiceParamConverter implements ParamConverterInterface
{
    /**
     * @var InvoiceManagerInterface
     */
    protected $manager;

    /**
     * InvoiceParamConverter constructor.
     * @param InvoiceManagerInterface $manager
     */
    public function __construct(InvoiceManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function apply(Request $request, ParamConverter $configuration)
    {
        $query = $request->attributes->get($configuration->getName());
        $entity = $this->manager->getRepository()->findOneBy(['id' => $query]);
        $request->attributes->set($configuration->getName(), $entity);
    }

    public function supports(ParamConverter $configuration)
    {
        return $configuration->getClass() === InvoiceInterface::class;
    }
}