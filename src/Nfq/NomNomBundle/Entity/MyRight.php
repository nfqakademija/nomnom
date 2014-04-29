<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * MyRight
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\MyRightRepository")
 */
class MyRight
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
     * @ORM\OneToMany(targetEntity="MyRoleRight", mappedBy="myRight")
     */
    private $myRoleRights;

    public function __construct()
    {
        $this->myRoleRights = new ArrayCollection();
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
     * @return MyRight
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
     * Add myRoleRights
     *
     * @param \Nfq\NomNomBundle\Entity\MyRoleRight $myRoleRights
     * @return MyRight
     */
    public function addMyRoleRight(\Nfq\NomNomBundle\Entity\MyRoleRight $myRoleRights)
    {
        $this->myRoleRights[] = $myRoleRights;

        return $this;
    }

    /**
     * Remove myRoleRights
     *
     * @param \Nfq\NomNomBundle\Entity\MyRoleRight $myRoleRights
     */
    public function removeMyRoleRight(\Nfq\NomNomBundle\Entity\MyRoleRight $myRoleRights)
    {
        $this->myRoleRights->removeElement($myRoleRights);
    }

    /**
     * Get myRoleRights
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMyRoleRights()
    {
        return $this->myRoleRights;
    }
}
