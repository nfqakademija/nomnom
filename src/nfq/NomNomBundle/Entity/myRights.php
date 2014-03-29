<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * myRights
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\myRightsRepository")
 */
class myRights
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
     * @ORM\Column(name="rightName", type="string", length=50)
     */
    private $rightName;

    /**
     * @ORM\OneToMany(targetEntity="myRoleRights", mappedBy="myrights")
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
     * Set rightName
     *
     * @param string $rightName
     * @return myRights
     */
    public function setRightName($rightName)
    {
        $this->rightName = $rightName;

        return $this;
    }

    /**
     * Get rightName
     *
     * @return string 
     */
    public function getRightName()
    {
        return $this->rightName;
    }

    /**
     * Add myrolerights
     *
     * @param \Nfq\NomNomBundle\Entity\myRoleRights $myrolerights
     * @return myRights
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
