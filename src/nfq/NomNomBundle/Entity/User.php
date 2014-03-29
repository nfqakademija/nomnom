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
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="myUserProfile", inversedBy="users")
     */
    private $myuserprofile;

    public function __construct()
    {
        parent::__construct();
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
}
