<?php

namespace Softspring\PaymentBundle\Model;

class DiscountRule implements DiscountRuleInterface
{
    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var bool
     */
    protected $active = true;

    /**
     * @var int
     */
    protected $priority = 0;

    /**
     * @var bool
     */
    protected $stopApply = false;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     */
    public function setPriority(int $priority): void
    {
        $this->priority = $priority;
    }

    /**
     * @return bool
     */
    public function isStopApply(): bool
    {
        return $this->stopApply;
    }

    /**
     * @param bool $stopApply
     */
    public function setStopApply(bool $stopApply): void
    {
        $this->stopApply = $stopApply;
    }
}