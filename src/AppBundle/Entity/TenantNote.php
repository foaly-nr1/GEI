<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class TenantNote extends AbstractNote
{
    /**
     * @ORM\ManyToOne(targetEntity="Tenant", inversedBy="notes")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull
     */
    private $tenant;

    /**
     * @return Tenant|null
     */
    public function getTenant()
    {
        return $this->tenant;
    }

    /**
     * @param Tenant $tenant
     *
     * @return $this
     */
    public function setTenant(Tenant $tenant)
    {
        $this->tenant = $tenant;

        return $this;
    }
}
