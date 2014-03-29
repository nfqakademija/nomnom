<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * myRoleRights
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\myRoleRightsRepository")
 */
class myRoleRights
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="myRoles", inversedBy="myrolerights")
     * @ORM\JoinColumn(name="myroles_id", referencedColumnName="id")
     */
    private $myroles;

    /**
     * @ORM\ManyToOne(targetEntity="myRights", inversedBy="myrolerights")
     * @ORM\JoinColumn(name="myrights_id", referencedColumnName="id")
     */
    private $myrights;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set myroles
     *
     * @param \Nfq\NomNomBundle\Entity\myRoles $myroles
     * @return myRoleRights
     */
    public function setMyroles(\Nfq\NomNomBundle\Entity\myRoles $myroles = null)
    {
        $this->myroles = $myroles;

        return $this;
    }

    /**
     * Get myroles
     *
     * @return \Nfq\NomNomBundle\Entity\myRoles 
     */
    public function getMyroles()
    {
        return $this->myroles;
    }

    /**
     * Set myrights
     *
     * @param \Nfq\NomNomBundle\Entity\myRights $myrights
     * @return myRoleRights
     */
    public function setMyrights(\Nfq\NomNomBundle\Entity\myRights $myrights = null)
    {
        $this->myrights = $myrights;

        return $this;
    }

    /**
     * Get myrights
     *
     * @return \Nfq\NomNomBundle\Entity\myRights 
     */
    public function getMyrights()
    {
        return $this->myrights;
    }
}
