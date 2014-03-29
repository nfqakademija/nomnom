<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * myRoles
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\myRolesRepository")
 */
class myRoles
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
     * @var string
     *
     * @ORM\Column(name="roleName", type="string", length=50)
     */
    private $roleName;

    /**
     * @ORM\OneToMany(targetEntity="myRoleRights", mappedBy="myroles")
     */
    private $myrolerights;

    public function __construct()
    {
        $this->myrolerights = new ArrayCollection();
    }


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
     * Set roleName
     *
     * @param string $roleName
     * @return myRoles
     */
    public function setRoleName($roleName)
    {
        $this->roleName = $roleName;

        return $this;
    }

    /**
     * Get roleName
     *
     * @return string 
     */
    public function getRoleName()
    {
        return $this->roleName;
    }

    /**
     * Add myrolerights
     *
     * @param \Nfq\NomNomBundle\Entity\myRoleRights $myrolerights
     * @return myRoles
     */
    public function addMyroleright(\Nfq\NomNomBundle\Entity\myRoleRights $myrolerights)
    {
        $this->myrolerights[] = $myrolerights;

        return $this;
    }

    /**
     * Remove myrolerights
     *
     * @param \Nfq\NomNomBundle\Entity\myRoleRights $myrolerights
     */
    public function removeMyroleright(\Nfq\NomNomBundle\Entity\myRoleRights $myrolerights)
    {
        $this->myrolerights->removeElement($myrolerights);
    }

    /**
     * Get myrolerights
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMyrolerights()
    {
        return $this->myrolerights;
    }
}
