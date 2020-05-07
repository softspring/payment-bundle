<?php

namespace Softspring\PaymentBundle\Platform\Adapter;

use Softspring\CustomerBundle\Platform\Adapter\PlatformAdapterInterface;
use Softspring\CustomerBundle\Platform\Exception\PlatformException;
use Softspring\PaymentBundle\Model\ConceptInterface;

interface ConceptAdapterInterface extends PlatformAdapterInterface
{
    /**
     * Creates concept on defined platform
     *
     * @param ConceptInterface $concept
     *
     * @return mixed
     * @throws PlatformException
     */
    public function create(ConceptInterface $concept);

    /**
     * Retrive the concept platform data
     *
     * @param ConceptInterface $concept
     *
     * @return mixed
     * @throws PlatformException
     */
    public function get(ConceptInterface $concept);
}