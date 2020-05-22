<?php

namespace Softspring\PaymentBundle\EventListener\Admin;

use Softspring\CrudlBundle\Event\GetResponseEntityEvent;
use Softspring\PaymentBundle\Manager\DiscountManagerInterface;
use Softspring\PaymentBundle\Model\DiscountInterface;
use Softspring\PaymentBundle\Model\DiscountRuleInterface;
use Softspring\PaymentBundle\SfsPaymentEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;

class DiscountRuleListener implements EventSubscriberInterface
{
    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * @var DiscountManagerInterface
     */
    protected $manager;

    /**
     * DiscountRuleListener constructor.
     *
     * @param RouterInterface          $router
     * @param DiscountManagerInterface $manager
     */
    public function __construct(RouterInterface $router, DiscountManagerInterface $manager)
    {
        $this->router = $router;
        $this->manager = $manager;
    }

    public static function getSubscribedEvents()
    {
        return [
            SfsPaymentEvents::ADMIN_DISCOUNT_RULES_CREATE_INITIALIZE => 'onDiscountRuleInitialize',
            SfsPaymentEvents::ADMIN_DISCOUNT_RULES_READ_INITIALIZE => 'onDiscountRuleInitialize',
            SfsPaymentEvents::ADMIN_DISCOUNT_RULES_UPDATE_INITIALIZE => 'onDiscountRuleInitialize',
            SfsPaymentEvents::ADMIN_DISCOUNT_RULES_CREATE_SUCCESS => 'onDiscountRuleCreateSuccess',
        ];
    }

    public function onDiscountRuleInitialize(GetResponseEntityEvent $event)
    {
        /** @var DiscountRuleInterface $rule */
        $rule = $event->getEntity();
        $request = $event->getRequest();

        if (!$request->attributes->has('discount')) {
            return;
        }

        $discountId = $request->attributes->get('discount');
        /** @var DiscountInterface|null $discount */
        $discount = $this->manager->getRepository()->findOneById($discountId);
        $request->attributes->set('discount', $discount);

        if ($discount) {
            $discount->addRule($rule);
        }
    }

    public function onDiscountRuleCreateSuccess(GetResponseEntityEvent $event)
    {
        if ($event->getRequest()->attributes->get('_route') == 'sfs_payment_admin_discount_child_rules_create') {
            /** @var DiscountRuleInterface $rule */
            $rule = $event->getEntity();

            $response = new RedirectResponse($this->router->generate('sfs_payment_admin_discounts_read', ['discount' => $rule->getDiscount()]));
            $event->setResponse($response);
            return;
        }

        $response = new RedirectResponse($this->router->generate('sfs_payment_admin_discount_rules_list'));
        $event->setResponse($response);
    }
}