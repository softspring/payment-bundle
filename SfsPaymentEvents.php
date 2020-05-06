<?php

namespace Softspring\PaymentBundle;

class SfsPaymentEvents
{
    /**
     * @Event("Softspring\CrudlBundle\Event\FilterEvent")
     */
    const ADMIN_PAYMENTS_LIST_FILTER = 'sfs_payment.admin.payments.list_filter';

    /**
     * @Event("Softspring\CoreBundle\Event\ViewEvent")
     */
    const ADMIN_PAYMENTS_LIST_VIEW = 'sfs_payment.admin.payments.list_view';

    /**
     * @Event("Softspring\CoreBundle\Event\ViewEvent")
     */
    const ADMIN_PAYMENTS_READ_VIEW = 'sfs_payment.admin.payments.read_view';
}