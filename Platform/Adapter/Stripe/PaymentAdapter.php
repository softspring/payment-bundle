<?php

namespace Softspring\PaymentBundle\Platform\Adapter\Stripe;

use Softspring\CustomerBundle\Platform\Adapter\Stripe\AbstractStripeAdapter;
use Softspring\CustomerBundle\Platform\Exception\PlatformException;
use Softspring\CustomerBundle\Platform\PlatformInterface;
use Softspring\PaymentBundle\Model\PaymentInterface;
use Softspring\PaymentBundle\Platform\Adapter\PaymentAdapterInterface;
use Stripe\Charge;
use Stripe\Refund;

class PaymentAdapter extends AbstractStripeAdapter implements PaymentAdapterInterface
{
    const MAPPING_STATUSES = [
        'pending' => PaymentInterface::STATUS_PENDING,
        'succeeded' => PaymentInterface::STATUS_DONE,
        'failed' => PaymentInterface::STATUS_FAILED,
    ];

    /**
     * @param PaymentInterface $payment
     *
     * @return Charge|Refund|void
     * @throws PlatformException
     */
    public function create(PaymentInterface $payment)
    {
        try {
            $this->initStripe();

            // prepare data for stripe
            $data = self::prepareDataForPlatform($payment, 'create');

            switch ($payment->getType()) {
                case PaymentInterface::TYPE_CHARGE:
                    $paymentStripe = $this->stripeClientCreateCharge($data['charge']);
                    break;

                case PaymentInterface::TYPE_REFUND:
                    $paymentStripe = $this->stripeClientCreateRefund($data['refund']);
                    break;

                default:
                    throw new PlatformException(PlatformInterface::PLATFORM_STRIPE, 'Bad payment type');
            }

            $this->logger && $this->logger->info(sprintf('Stripe created payment %s', $paymentStripe->id));

            $this->syncPayment($payment, $paymentStripe);

            return $paymentStripe;
        } catch (\Exception $e) {
            return $this->attachStripeExceptions($e);
        }
    }

    /**
     * @param PaymentInterface $payment
     *
     * @return Charge|Refund|void
     * @throws PlatformException
     */
    public function get(PaymentInterface $payment)
    {
        try {
            $this->initStripe();

            switch ($payment->getType()) {
                case PaymentInterface::TYPE_CHARGE:
                    $paymentStripe = $this->stripeClientRetrieveCharge($payment->getPlatformId());
                    break;

                case PaymentInterface::TYPE_REFUND:
                    $paymentStripe = $this->stripeClientRetrieveRefund($payment->getPlatformId());
                    break;

                default:
                    throw new PlatformException(PlatformInterface::PLATFORM_STRIPE, 'Bad payment type');
            }

            $this->syncPayment($payment, $paymentStripe);

            return $paymentStripe;
        } catch (\Exception $e) {
            return $this->attachStripeExceptions($e);
        }
    }

    protected static function prepareDataForPlatform(PaymentInterface $payment, string $action = ''): array
    {
        $data = [];

        switch ($payment->getType()) {
            case PaymentInterface::TYPE_CHARGE:
                $data['charge'] = [
                    'customer' => $payment->getCustomer()->getPlatformId(),
                    'source' => $payment->getSource()->getPlatformId(),
                    'amount' => (int) ($payment->getAmount() * 100),
                    'currency' => $payment->getCurrency(),
                ];

                if ($payment->getConcept()) {
                    $data['charge']['description'] = $payment->getConcept();
                }

                break;

            case PaymentInterface::TYPE_REFUND:
                $data['refund'] = [];
                break;

            default:
                throw new PlatformException(PlatformInterface::PLATFORM_STRIPE, 'Bad payment type');
        }

        return $data;
    }

    public function syncPayment(PaymentInterface $payment, $paymentStripe)
    {
        $payment->setPlatform(PlatformInterface::PLATFORM_STRIPE);
        $payment->setPlatformId($paymentStripe->id);
        $payment->setTestMode(!$paymentStripe->livemode);
        $payment->setPlatformLastSync(\DateTime::createFromFormat('U', $paymentStripe->created)); // TODO update last sync date
        $payment->setPlatformConflict(false);
        $payment->setPlatformData($paymentStripe->toArray());

        if ($paymentStripe instanceof Charge) {
            $payment->setStatus(self::MAPPING_STATUSES[$paymentStripe->status]);
            $payment->setDate(\DateTime::createFromFormat('U', $paymentStripe->created));
            $payment->setConcept($paymentStripe->description);
        }

        if ($paymentStripe instanceof Refund) {

        }
    }

    protected function stripeClientCreateCharge($params = null, $options = null): Charge
    {
        return Charge::create($params, $options);
    }

    protected function stripeClientCreateRefund($params = null, $options = null): Refund
    {
        return Refund::create($params, $options);
    }

    protected function stripeClientRetrieveCharge($id, $opts = null): Charge
    {
        return Charge::retrieve($id, $opts);
    }

    protected function stripeClientRetrieveRefund($id, $opts = null): Refund
    {
        return Refund::retrieve($id, $opts);
    }
}