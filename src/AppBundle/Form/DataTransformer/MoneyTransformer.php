<?php

namespace AppBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Money;

class MoneyTransformer implements DataTransformerInterface
{
    /**
     * @var string
     */
    private $currency;

    /**
     * @param string $currency
     */
    public function __construct(string $currency)
    {
        $this->currency = $currency;
    }

    /**
     * {@inheritdoc}
     */
    public function transform($money)
    {
        if (is_null($money)) {
            return null;
        }

        if (!($money instanceof Money\Money)) {
            throw new TransformationFailedException(sprintf(
                'Object of type Money expected, %s given',
                is_object($money) ? get_class($money) : gettype($money)
            ));
        }

        return $money->getAmount() / 100;
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($amount)
    {
        if (is_null($amount)) {
            return null;
        }

        if (!is_numeric($amount)) {
            throw new TransformationFailedException('Numeric string expected');
        }

        return new Money\Money(intval($amount * 100), new Money\Currency($this->currency));
    }
}
