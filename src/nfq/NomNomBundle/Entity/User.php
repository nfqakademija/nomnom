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
     * @ORM\OneToOne(targetEntity="myUserLikes", inversedBy="user")
     */
    private $myuserlikes;

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
     * Set myuserlikes
     *
     * @param \Nfq\NomNomBundle\Entity\myUserLikes $myuserlikes
     * @return User
     */
    public function setMyuserlikes(\Nfq\NomNomBundle\Entity\myUserLikes $myuserlikes = null)
    {
        $this->myuserlikes = $myuserlikes;

        return $this;
    }

    /**
     * Get myuserlikes
     *
     * @return \Nfq\NomNomBundle\Entity\myUserLikes 
     */
    public function getMyuserlikes()
    {
        return $this->myuserlikes;
    }
}
