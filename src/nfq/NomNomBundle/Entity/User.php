<?php

namespace Nfq\NomNomBundle\Entity;


//#* @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\UserRepository")
    use FOS\UserBundle\Model\User as BaseUser;
    use Doctrine\ORM\Mapping as ORM;

    /**
     * @ORM\Entity
     * @ORM\Table(name="my_user")
     */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="myUserEvents", mappedBy="myroles")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="myUserProfile", inversedBy="user")
     */
    private $myuserprofile;

    /**
     * @ORM\OneToMany(targetEntity="myUserEvents", mappedBy="myUser")
     */
    protected $myUserEvents;

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set myuserprofile
     *
     * @param \Nfq\NomNomBundle\Entity\myUserProfile $myuserprofile
     * @return User
     */
    public function setMyuserprofile(\Nfq\NomNomBundle\Entity\myUserProfile $myuserprofile = null)
    {
        $this->myuserprofile = $myuserprofile;

        return $this;
    }

    /**
     * Get myuserprofile
     *
     * @return \Nfq\NomNomBundle\Entity\myUserProfile 
     */
    public function getMyuserprofile()
    {
        return $this->myuserprofile;
    }

    /**
     * Add myUserEvents
     *
     * @param \Nfq\NomNomBundle\Entity\myUserEvents $myUserEvents
     * @return User
     */
    public function addMyUserEvent(\Nfq\NomNomBundle\Entity\myUserEvents $myUserEvents)
    {
        $this->myUserEvents[] = $myUserEvents;

        return $this;
    }

    /**
     * Remove myUserEvents
     *
     * @param \Nfq\NomNomBundle\Entity\myUserEvents $myUserEvents
     */
    public function removeMyUserEvent(\Nfq\NomNomBundle\Entity\myUserEvents $myUserEvents)
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
