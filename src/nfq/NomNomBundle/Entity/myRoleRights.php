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
     * @var integer
     *
     * @ORM\Column(name="roleId", type="integer")
     */
    private $roleId;

    /**
     * @var integer
     *
     * @ORM\Column(name="rightId", type="integer")
     */
    private $rightId;


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
     * Set roleId
     *
     * @param integer $roleId
     * @return myRoleRights
     */
    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;

        return $this;
    }

    /**
     * Get roleId
     *
     * @return integer 
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * Set rightId
     *
     * @param integer $rightId
     * @return myRoleRights
     */
    public function setRightId($rightId)
    {
        $this->rightId = $rightId;

        return $this;
    }

    /**
     * Get rightId
     *
     * @return integer 
     */
    public function getRightId()
    {
        return $this->rightId;
    }
}
