<?php

namespace Softspring\PaymentBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Softspring\CoreBundle\Controller\AbstractController;
use Softspring\PaymentBundle\Manager\InvoiceManagerInterface;
use Softspring\PaymentBundle\Model\InvoiceInterface;
use Softspring\SubscriptionBundle\Model\SubscriptionInterface;
use Symfony\Component\HttpFoundation\Response;

class InvoiceController extends AbstractController
{
    /**
     * @var InvoiceManagerInterface
     */
    protected $invoiceManager;

    /**
     * InvoiceController constructor.
     *
     * @param InvoiceManagerInterface $invoiceManager
     */
    public function __construct(InvoiceManagerInterface $invoiceManager)
    {
        $this->invoiceManager = $invoiceManager;
    }

    /**
     * @Security(expression="is_granted('ROLE_SUBSCRIPTION_ADMIN_SUBSCRIPTIONS_SYNC', invoice)")
     */
    public function sync(InvoiceInterface $invoice): Response
    {
        $this->invoiceManager->sync($invoice);

        return $this->redirectToRoute('sfs_payment_admin_invoices_read', ['invoice' => $invoice]);
    }
}