<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Tenant
{
    const TYPE_LETTINGS_LONG = 1;
    const TYPE_LETTINGS_SHORT = 2;
    const TYPE_LICENSEE = 3;
    const TYPE_SALES = 4;
    const TYPE_LETTINGS_COMMERCIAL = 5;

    // lettings long
    const STATUS_EMPLOYED = 1;
    const STATUS_SELF_EMPLOYED = 2;
    const STATUS_STUDENT = 3;
    const STATUS_RETIRED = 4;
    const STATUS_HB = 5;
    const STATUS_SHARER = 6;
    const STATUS_ROOM_LET = 7;
    const STATUS_COMPANY = 8;
    const STATUS_COMMERCIAL = 9;

    // lettings short
    const STATUS_HOLIDAY = 10;
    const STATUS_MEDICAL = 11;
    const STATUS_COMPLIMENTARY = 12;
    const STATUS_OTHER = 13;

    // sales
    const STATUS_FTB = 14;
    const STATUS_INVESTOR = 15;
    const STATUS_CASH = 16;
    const STATUS_SSTC = 17;
    const STATUS_TO_SELL = 18;

    const SOURCE_APPLICANT = 1;
    const SOURCE_OUTDOOR = 2;
    const SOURCE_EMBASSY = 3;
    const SOURCE_FIND_A_PROPERTY = 4;
    const SOURCE_WEBSITE = 5;
    const SOURCE_GUMTREE = 6;
    const SOURCE_LONRES = 7;
    const SOURCE_PRIME_LOCATION = 8;
    const SOURCE_OTHER_WEBSITE = 9;
    const SOURCE_SPAREROOM = 10;
    const SOURCE_TELEPHONE = 11;
    const SOURCE_UNIVERSITY = 12;
    const SOURCE_WALK_IN = 13;
    const SOURCE_RIGHTMOVE = 14;
    const SOURCE_ZOOPLA = 15;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Date
     */
    private $type;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Date
     */
    private $subType;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="tenants")
     */
    private $negotiator;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Date
     */
    private $source;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Country
     */
    private $nationality;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Date
     */
    private $dob;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $postcode;

    /**
     * @ORM\OneToMany(targetEntity="TenantEmail", mappedBy="tenant", cascade={"all"}, orphanRemoval=true)
     * @Assert\Count(min=1, minMessage="Enter at least one email")
     * @Assert\Valid
     */
    private $emails;

    /**
     * @ORM\OneToMany(targetEntity="TenantPhone", mappedBy="tenant", cascade={"all"}, orphanRemoval=true)
     * @Assert\Count(min=1, minMessage="Enter at least one phone number")
     * @Assert\Valid
     */
    private $phones;

    /**
     * Hook timestampable behaviour
     * updates createdAt, updatedAt fields
     */
    use TimestampableEntity;

    /**
     * Hooks blameable behaviour
     * updates createdBy, updatedBy fields
     */
    use Traits\BlameableEntity;

    /**
     * Tenant constructor.
     */
    public function __construct()
    {
        $this->emails = new ArrayCollection();
        $this->phones = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getEmails(): Collection
    {
        return $this->emails;
    }

    /**
     * @param TenantEmail $email
     * @return $this
     */
    public function addEmail(TenantEmail $email)
    {
        $this->emails->add(
            $email->setTenant($this)
        );
        $this->updatedAt = new \DateTimeImmutable();

        return $this;
    }

    /**
     * @param TenantEmail $email
     * @return $this
     */
    public function removeEmail(TenantEmail $email)
    {
        if($this->emails->removeElement($email)) {
            $email->setTenant(null);
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getPhones(): Collection
    {
        return $this->phones;
    }

    /**
     * @param TenantPhone $phone
     * @return $this
     */
    public function addPhone(TenantPhone $phone)
    {
        $this->phones->add(
            $phone->setTenant($this)
        );
        $this->updatedAt = new \DateTimeImmutable();

        return $this;
    }

    /**
     * @param TenantPhone $phone
     * @return $this
     */
    public function removePhone(TenantPhone $phone)
    {
        if($this->phones->removeElement($phone)) {
            $phone->setTenant(null);
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }
}
