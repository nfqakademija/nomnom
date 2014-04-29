<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * MyRole
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\MyRoleRepository")
 */
class MyRole
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
     * @ORM\OneToMany(targetEntity="MyRoleRight", mappedBy="myRole")
     */
    private $myRoleRights;

    /**
     * @ORM\OneToMany(targetEntity="MyUserEvent", mappedBy="myRole")
     */
    protected $myUserEvents;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->myRoleRights = new \Doctrine\Common\Collections\ArrayCollection();
        $this->myUserEvents = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return MyRole
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
     * Add myRoleRights
     *
     * @param \Nfq\NomNomBundle\Entity\MyRoleRight $myRoleRights
     * @return MyRole
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

    /**
     * Add myUserEvents
     *
     * @param \Nfq\NomNomBundle\Entity\MyUserEvent $myUserEvents
     * @return MyRole
     */
    public function addMyUserEvent(\Nfq\NomNomBundle\Entity\MyUserEvent $myUserEvents)
    {
        $this->myUserEvents[] = $myUserEvents;

        return $this;
    }

    /**
     * Remove myUserEvents
     *
     * @param \Nfq\NomNomBundle\Entity\MyUserEvent $myUserEvents
     */
    public function removeMyUserEvent(\Nfq\NomNomBundle\Entity\MyUserEvent $myUserEvents)
    {
        $this->myUserEvents->removeElement($myUserEvents);
    }

    /**
     * Get myUserEvents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMyUserEvents()
    {
        return $this->myUserEvents;
    }
}
