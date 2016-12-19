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

    const TITLE_MS = 1;
    const TITLE_MR = 2;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint", nullable=false)
     * @Assert\NotNull
     * @Assert\Choice(choices={
     *     Tenant::TYPE_LETTINGS_LONG,
     *     Tenant::TYPE_LETTINGS_SHORT,
     *     Tenant::TYPE_LICENSEE,
     *     Tenant::TYPE_SALES,
     *     Tenant::TYPE_LETTINGS_COMMERCIAL,
     * })
     */
    private $type;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $subType;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="tenants")
     */
    private $negotiator;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $source;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $companyName;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank
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
     * @ORM\Column(type="string", nullable=false)
     * @Assert\Country
     * @Assert\NotNull
     */
    private $country = 'GB';

    /**
     * @ORM\OneToMany(targetEntity="TenantEmail", mappedBy="tenant", cascade={"all"}, orphanRemoval=true)
     * @Assert\Valid
     */
    private $emails;

    /**
     * @ORM\OneToMany(targetEntity="TenantPhone", mappedBy="tenant", cascade={"all"}, orphanRemoval=true)
     * @Assert\Valid
     */
    private $phones;

    /**
     * @ORM\Embedded(class="PropertyCriteria")
     */
    private $criteria;

    /*
     * Hook timestampable behaviour
     * updates createdAt, updatedAt fields
     */
    use TimestampableEntity;

    /*
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
        $this->criteria = new PropertyCriteria();
    }

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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     *
     * @return $this
     */
    public function setType(string $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSubType()
    {
        return $this->subType;
    }

    /**
     * @param string|null $subType
     *
     * @return $this
     */
    public function setSubType(string $subType = null)
    {
        $this->subType = $subType;

        return $this;
    }

    /**
     * @return User|null
     */
    public function getNegotiator()
    {
        return $this->negotiator;
    }

    /**
     * @param User|null $negotiator
     *
     * @return $this
     */
    public function setNegotiator(User $negotiator = null)
    {
        $this->negotiator = $negotiator;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param string|null $source
     *
     * @return $this
     */
    public function setSource(string $source = null)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     *
     * @return $this
     */
    public function setTitle(string $title = null)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @param string|null $companyName
     *
     * @return $this
     */
    public function setCompanyName(string $companyName = null)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string|null $firstName
     *
     * @return $this
     */
    public function setFirstName(string $firstName = null)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return $this
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * @param string|null $nationality
     *
     * @return $this
     */
    public function setNationality(string $nationality = null)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * @param \DateTimeInterface|null $dob
     *
     * @return $this
     */
    public function setDob(\DateTimeInterface $dob = null)
    {
        $this->dob = $dob;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     *
     * @return $this
     */
    public function setAddress(string $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     *
     * @return $this
     */
    public function setCity(string $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @param string|null $postcode
     *
     * @return $this
     */
    public function setPostcode(string $postcode = null)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     *
     * @return $this
     */
    public function setCountry(string $country)
    {
        $this->country = $country;

        return $this;
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
     *
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
     *
     * @return $this
     */
    public function removeEmail(TenantEmail $email)
    {
        if ($this->emails->removeElement($email)) {
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
     *
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
     *
     * @return $this
     */
    public function removePhone(TenantPhone $phone)
    {
        if ($this->phones->removeElement($phone)) {
            $phone->setTenant(null);
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    /**
     * @return PropertyCriteria
     */
    public function getCriteria()
    {
        return $this->criteria;
    }
}
