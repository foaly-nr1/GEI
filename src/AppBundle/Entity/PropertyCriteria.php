<?php

namespace AppBundle\Entity;

use AppBundle\Intl\CurrencyHelper;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Embeddable
 */
class PropertyCriteria
{
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotNull
     */
    private $country = 'GB';

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $visaRequired;

    /**
     * @ORM\Embedded(class="RentalAmount")
     */
    private $minRent;

    /**
     * @ORM\Embedded(class="RentalAmount")
     */
    private $maxRent;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $minBeds;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $maxBeds;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $moveDate;

    /**
     * TODO: Make embeddable that handles both weeks and months.
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $minTerm;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxTerm;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $furnished;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     * @Assert\Choice(choices={
     *   Property::TYPE_FLAT,
     *   Property::TYPE_HOUSE,
     *   Property::TYPE_OTHER,
     * })
     */
    private $propertyType;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $outsideSpace;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $parking;

    public function __construct()
    {
        $this->minRent = new RentalAmount(CurrencyHelper::getCurrencyForCountry($this->country));
        $this->maxRent = new RentalAmount(CurrencyHelper::getCurrencyForCountry($this->country));
    }

    /**
     * @return string|null
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string|null $country
     *
     * @return $this
     */
    public function setCountry(string $country = null)
    {
        $this->country = $country;

        $this->setCurrencyCode(CurrencyHelper::getCurrencyForCountry($this->country));

        return $this;
    }

    /**
     * @return bool
     */
    public function isVisaRequired()
    {
        return $this->visaRequired;
    }

    /**
     * @param bool $visaRequired
     *
     * @return $this
     */
    public function setVisaRequired(bool $visaRequired)
    {
        $this->visaRequired = $visaRequired;

        return $this;
    }

    /**
     * @return RentalAmount
     */
    public function getMinRent()
    {
        return $this->minRent;
    }

    /**
     * @return RentalAmount
     */
    public function getMaxRent()
    {
        return $this->maxRent;
    }

    /**
     * @param string $currencyCode
     */
    public function setCurrencyCode(string $currencyCode)
    {
        $this->minRent->setCurrencyCode($currencyCode);
        $this->maxRent->setCurrencyCode($currencyCode);
    }

    /**
     * @return int|null
     */
    public function getMinBeds()
    {
        return $this->minBeds;
    }

    /**
     * @param int|null $minBeds
     *
     * @return $this
     */
    public function setMinBeds(int $minBeds = null)
    {
        $this->minBeds = $minBeds;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getMaxBeds()
    {
        return $this->maxBeds;
    }

    /**
     * @param int|null $maxBeds
     *
     * @return $this
     */
    public function setMaxBeds(int $maxBeds = null)
    {
        $this->maxBeds = $maxBeds;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getMinTerm()
    {
        return $this->minTerm;
    }

    /**
     * @param int|null $minTerm
     *
     * @return $this
     */
    public function setMinTerm(int $minTerm = null)
    {
        $this->minTerm = $minTerm;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getMaxTerm()
    {
        return $this->maxTerm;
    }

    /**
     * @param int|null $maxTerm
     *
     * @return $this
     */
    public function setMaxTerm(int $maxTerm = null)
    {
        $this->maxTerm = $maxTerm;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function isFurnished()
    {
        return $this->furnished;
    }

    /**
     * @param bool|null $furnished
     *
     * @return $this
     */
    public function setFurnished(bool $furnished = null)
    {
        $this->furnished = $furnished;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPropertyType()
    {
        return $this->propertyType;
    }

    /**
     * @param int|null $propertyType
     *
     * @return $this
     */
    public function setPropertyType(int $propertyType = null)
    {
        $this->propertyType = $propertyType;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function hasOutsideSpace()
    {
        return $this->outsideSpace;
    }

    /**
     * @param bool|null $outsideSpace
     *
     * @return $this
     */
    public function setOutsideSpace(bool $outsideSpace = null)
    {
        $this->outsideSpace = $outsideSpace;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function hasParking()
    {
        return $this->parking;
    }

    /**
     * @param bool|null $parking
     *
     * @return $this
     */
    public function setParking(bool $parking = null)
    {
        $this->parking = $parking;

        return $this;
    }
}
