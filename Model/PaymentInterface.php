<?php

namespace Softspring\PaymentBundle\Model;

use Softspring\CustomerBundle\Model\CustomerInterface;
use Softspring\CustomerBundle\Model\PlatformObjectInterface;
use Softspring\CustomerBundle\Model\SourceInterface;

interface PaymentInterface extends PlatformObjectInterface
{
    const STATUS_PENDING = 1;
    const STATUS_DONE = 2;
    const STATUS_FAILED = 3;

    const TYPE_CHARGE = 1;
    const TYPE_REFUND = 2;

    public function getCustomer(): ?CustomerInterface;

    public function setCustomer(?CustomerInterface $customer): void;

    public function getSource(): ?SourceInterface;

    public function setSource(?SourceInterface $source): void;

    public function getStatus(): ?int;

    public function setStatus(?int $status): void;

    public function getStatusString(): ?string;

    public function getType(): ?int;

    public function setType(?int $type): void;

    public function getDate(): ?\DateTime;

    public function setDate(?\DateTime $date): void;

    public function getAmount(): ?float;

    public function setAmount(?float $amount): void;

    public function getCurrency(): ?string;

    public function setCurrency(?string $currency): void;

    public function getDescription(): ?string;

    public function setDescription(?string $description): void;
}