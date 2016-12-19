<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table
 * @UniqueEntity("emailCanonical",
 *     message="Tenants with this email address already exist",
 *     errorPath="email"
 * )
 */
class TenantEmail
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Tenant", inversedBy="emails")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tenant;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     * @Assert\Email
     */
    private $email;

    /**
     * Used to compare email addresses. It equals the lowercase email address.
     *
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $emailCanonical;

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
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
     *
     * @return $this
     */
    public function setTenant(Tenant $tenant = null)
    {
        $this->tenant = $tenant;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     *
     * @return $this
     */
    public function setEmail(string $email = null)
    {
        $this->email = $email;
        $this->emailCanonical = strtolower($email);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmailCanonical()
    {
        return $this->emailCanonical;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->email ?? '';
    }
}
