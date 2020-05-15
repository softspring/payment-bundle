<?php

namespace Softspring\PaymentBundle\Entity\Rule\Condition;

use Doctrine\ORM\Mapping as ORM;

trait DateRangeConditionTrait
{
    /**
     * @var int|null
     * @ORM\Column(name="from_date", type="integer", nullable=true, options={"unsigned":true})
     */
    protected $fromDate;

    /**
     * @var int|null
     * @ORM\Column(name="to_date", type="integer", nullable=true, options={"unsigned":true})
     */
    protected $toDate;

    /**
     * @return \DateTime|null
     */
    public function getFromDate(): ?\DateTime
    {
        return $this->fromDate ? \DateTime::createFromFormat('U', $this->fromDate) : null;
    }

    /**
     * @param \DateTime|null $fromDate
     */
    public function setFromDate(?\DateTime $fromDate): void
    {
        $this->fromDate = $fromDate ? $fromDate->format('U') : null;
    }

    /**
     * @return \DateTime|null
     */
    public function getToDate(): ?\DateTime
    {
        return $this->toDate ? \DateTime::createFromFormat('U', $this->toDate) : null;
    }

    /**
     * @param \DateTime|null $toDate
     */
    public function setToDate(?\DateTime $toDate): void
    {
        $this->toDate = $toDate ? $toDate->format('U') : null;
    }


}