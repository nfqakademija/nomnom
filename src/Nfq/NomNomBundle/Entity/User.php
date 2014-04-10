<?php

namespace Nfq\NomNomBundle\Entity;


//#* @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\MyUserRepository")
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
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="MyUserProfile", inversedBy="myUser")
     */
    private $myUserProfile;

    /**
     * @ORM\OneToMany(targetEntity="MyUserEvent", mappedBy="myUser")
     */
    protected $myUserEvents;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
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
     * Set myUserProfile
     *
     * @param \Nfq\NomNomBundle\Entity\MyUserProfile $myUserProfile
     * @return MyUser
     */
    public function setMyUserProfile(\Nfq\NomNomBundle\Entity\MyUserProfile $myUserProfile = null)
    {
        $this->myUserProfile = $myUserProfile;

        return $this;
    }

    /**
     * Get myUserProfile
     *
     * @return \Nfq\NomNomBundle\Entity\MyUserProfile 
     */
    public function getMyUserProfile()
    {
        return $this->myUserProfile;
    }

    /**
     * Add myUserEvents
     *
     * @param \Nfq\NomNomBundle\Entity\MyUserEvent $myUserEvents
     * @return MyUser
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
