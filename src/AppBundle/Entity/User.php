<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\AttributeOverrides({
 *   @ORM\AttributeOverride(name="username",
 *     column=@ORM\Column(type="string", length=10)
 *   ),
 *   @ORM\AttributeOverride(name="usernameCanonical",
 *     column=@ORM\Column(type="string", length=10)
 *   ),
 *   @ORM\AttributeOverride(name="email",
 *     column=@ORM\Column(type="string", length=50)
 *   ),
 *   @ORM\AttributeOverride(name="emailCanonical",
 *     column=@ORM\Column(type="string", length=50)
 *   )
 * })
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $lastName;

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
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string|null
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return null|string
     */
    public function getDisplayName()
    {
        return $this->getFirstName() ? $this->getFirstName() : $this->getUserName();
    }
}
