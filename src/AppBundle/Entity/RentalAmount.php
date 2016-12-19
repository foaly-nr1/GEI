<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Money\Currency;
use Money\Money;

/**
 * @ORM\Embeddable
 */
class RentalAmount
{
    const TYPE_PCM = 'pcm';
    const TYPE_PW = 'pw';

    /**
     * @ORM\Embedded(class="Money\Money", columnPrefix=false)
     */
    private $amount;

    /**
     * @ORM\Column(type="string", nullable=false, length=5)
     */
    private $type = self::TYPE_PW;

    /**
     * @param string $currencyCode
     */
    public function __construct(string $currencyCode)
    {
        $this->amount = new Money(0, new Currency($currencyCode));
    }

    /**
     * @param Money $amount
     *
     * @return Money
     */
    private function convertMonthlyToWeekly(Money $amount)
    {
        return $amount->multiply(12 / 365 * 7);
    }

    /**
     * @param Money $amount
     *
     * @return Money
     */
    private function convertWeeklyToMonthly(Money $amount)
    {
        return $amount->divide(7 * 365 / 12);
    }

    /**
     * @return Money
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return Money
     */
    public function getAmountWeekly()
    {
        return $this->type === static::TYPE_PW
            ? $this->amount
            : $this->convertMonthlyToWeekly($this->amount)
        ;
    }

    /**
     * @return Money
     */
    public function getAmountMonthly()
    {
        return $this->type === static::TYPE_PCM
            ? $this->amount
            : $this->convertWeeklyToMonthly($this->amount)
        ;
    }

    /**
     * @param Money $amount
     *
     * @return $this
     */
    public function setAmount(Money $amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType(string $type)
    {
        if (!($type === static::TYPE_PCM || $type === static::TYPE_PW)) {
            throw new \InvalidArgumentException();
        }

        $this->type = $type;

        return $this;
    }

    /**
     * @param string $currencyCode
     *
     * @return $this
     */
    public function setCurrencyCode(string $currencyCode)
    {
        $this->amount = new Money($this->amount->getAmount(), new Currency($currencyCode));

        return $this;
    }
}
