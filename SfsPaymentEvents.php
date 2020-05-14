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

    /**
     * @Event("Softspring\CrudlBundle\Event\GetResponseEntityEvent")
     */
    const ADMIN_PAYMENTS_CREATE_INITIALIZE = 'sfs_payment.admin.payments.create_initialize';

    /**
     * @Event("Softspring\CrudlBundle\Event\GetResponseFormEvent")
     */
    const ADMIN_PAYMENTS_CREATE_FORM_VALID = 'sfs_payment.admin.payments.create_form_valid';

    /**
     * @Event("Softspring\CrudlBundle\Event\GetResponseEntityEvent")
     */
    const ADMIN_PAYMENTS_CREATE_SUCCESS = 'sfs_payment.admin.payments.create_success';

    /**
     * @Event("Softspring\CrudlBundle\Event\GetResponseFormEvent")
     */
    const ADMIN_PAYMENTS_CREATE_FORM_INVALID = 'sfs_payment.admin.payments.create_form_invalid';

    /**
     * @Event("Softspring\CoreBundle\Event\ViewEvent")
     */
    const ADMIN_PAYMENTS_CREATE_VIEW = 'sfs_payment.admin.payments.create_view';

    /**
     * @Event("Softspring\CrudlBundle\Event\GetResponseEntityEvent")
     */
    const ADMIN_PAYMENTS_REFUND_INITIALIZE = 'sfs_payment.admin.payments.refund_initialize';

    /**
     * @Event("Softspring\CrudlBundle\Event\GetResponseFormEvent")
     */
    const ADMIN_PAYMENTS_REFUND_FORM_VALID = 'sfs_payment.admin.payments.refund_form_valid';

    /**
     * @Event("Softspring\CrudlBundle\Event\GetResponseEntityEvent")
     */
    const ADMIN_PAYMENTS_REFUND_SUCCESS = 'sfs_payment.admin.payments.refund_success';

    /**
     * @Event("Softspring\CrudlBundle\Event\GetResponseFormEvent")
     */
    const ADMIN_PAYMENTS_REFUND_FORM_INVALID = 'sfs_payment.admin.payments.refund_form_invalid';

    /**
     * @Event("Softspring\CoreBundle\Event\ViewEvent")
     */
    const ADMIN_PAYMENTS_REFUND_VIEW = 'sfs_payment.admin.payments.refund_view';

    /**
     * @Event("Softspring\CrudlBundle\Event\FilterEvent")
     */
    const ADMIN_INVOICES_LIST_FILTER = 'sfs_payment.admin.invoices.list_filter';

    /**
     * @Event("Softspring\CoreBundle\Event\ViewEvent")
     */
    const ADMIN_INVOICES_LIST_VIEW = 'sfs_payment.admin.invoices.list_view';

    /**
     * @Event("Softspring\CoreBundle\Event\ViewEvent")
     */
    const ADMIN_INVOICES_READ_VIEW = 'sfs_payment.admin.invoices.read_view';

    /**
     * @Event("Softspring\CrudlBundle\Event\GetResponseEntityEvent")
     */
    const ADMIN_INVOICES_CREATE_INITIALIZE = 'sfs_payment.admin.invoices.create_initialize';

    /**
     * @Event("Softspring\CrudlBundle\Event\GetResponseFormEvent")
     */
    const ADMIN_INVOICES_CREATE_FORM_VALID = 'sfs_payment.admin.invoices.create_form_valid';

    /**
     * @Event("Softspring\CrudlBundle\Event\GetResponseEntityEvent")
     */
    const ADMIN_INVOICES_CREATE_SUCCESS = 'sfs_payment.admin.invoices.create_success';

    /**
     * @Event("Softspring\CrudlBundle\Event\GetResponseFormEvent")
     */
    const ADMIN_INVOICES_CREATE_FORM_INVALID = 'sfs_payment.admin.invoices.create_form_invalid';

    /**
     * @Event("Softspring\CoreBundle\Event\ViewEvent")
     */
    const ADMIN_INVOICES_CREATE_VIEW = 'sfs_payment.admin.invoices.create_view';

    /**
     * @Event("Softspring\CrudlBundle\Event\FilterEvent")
     */
    const ADMIN_CONCEPTS_LIST_FILTER = 'sfs_payment.admin.concepts.list_filter';

    /**
     * @Event("Softspring\CoreBundle\Event\ViewEvent")
     */
    const ADMIN_CONCEPTS_LIST_VIEW = 'sfs_payment.admin.concepts.list_view';

    /**
     * @Event("Softspring\CoreBundle\Event\ViewEvent")
     */
    const ADMIN_CONCEPTS_READ_VIEW = 'sfs_payment.admin.concepts.read_view';

    /**
     * @Event("Softspring\CrudlBundle\Event\GetResponseEntityEvent")
     */
    const ADMIN_CONCEPTS_CREATE_INITIALIZE = 'sfs_payment.admin.concepts.create_initialize';

    /**
     * @Event("Softspring\CrudlBundle\Event\GetResponseFormEvent")
     */
    const ADMIN_CONCEPTS_CREATE_FORM_VALID = 'sfs_payment.admin.concepts.create_form_valid';

    /**
     * @Event("Softspring\CrudlBundle\Event\GetResponseEntityEvent")
     */
    const ADMIN_CONCEPTS_CREATE_SUCCESS = 'sfs_payment.admin.concepts.create_success';

    /**
     * @Event("Softspring\CrudlBundle\Event\GetResponseFormEvent")
     */
    const ADMIN_CONCEPTS_CREATE_FORM_INVALID = 'sfs_payment.admin.concepts.create_form_invalid';

    /**
     * @Event("Softspring\CoreBundle\Event\ViewEvent")
     */
    const ADMIN_CONCEPTS_CREATE_VIEW = 'sfs_payment.admin.concepts.create_view';
}