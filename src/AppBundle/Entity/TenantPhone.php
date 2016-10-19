<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Misd\PhoneNumberBundle\Validator\Constraints as MisdAssert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table
 * @UniqueEntity("phoneCanonical",
 *     message="Tenants with this phone number already exist",
 *     errorPath="phone"
 * )
 */
class TenantPhone
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Tenant", inversedBy="phones")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tenant;

    /**
     * @ORM\Column(type="string", length=50)
     * @MisdAssert\PhoneNumber
     */
    private $phone;

    /**
     * Used to compare phone numbers. It equals  the phone number
     * after removing all whitespace.
     *
     * @ORM\Column(type="string", length=50)
     */
    private $phoneCanonical;

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     * @return $this
     */
    public function setPhone(string $phone = null)
    {
        $this->phone = $phone;
        $this->phoneCanonical = !$phone ?: preg_replace('/\s+/', '', $phone);

        return $this;
    }

    /**
     * @return Tenant|null
     */
    public function getTenant()
    {
        return $this->tenant;
    }

    /**
     * @param Tenant|null $tenant
     * @return $this
     */
    public function setTenant(Tenant $tenant = null)
    {
        $this->tenant = $tenant;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->phone ?? '';
    }
}
