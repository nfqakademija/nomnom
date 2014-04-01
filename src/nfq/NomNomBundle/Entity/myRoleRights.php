<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MyRoleRight
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\MyRoleRightRepository")
 */
class MyRoleRight
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
     * @ORM\ManyToOne(targetEntity="MyRole", inversedBy="myRoleRights")
     * @ORM\JoinColumn(name="my_role_id", referencedColumnName="id")
     */
    private $myRole;

    /**
     * @ORM\ManyToOne(targetEntity="MyRight", inversedBy="myRoleRights")
     * @ORM\JoinColumn(name="my_right_id", referencedColumnName="id")
     */
    private $myRight;

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
     * Set myRole
     *
     * @param \Nfq\NomNomBundle\Entity\MyRole $myRole
     * @return MyRoleRight
     */
    public function setMyRole(\Nfq\NomNomBundle\Entity\MyRole $myRole = null)
    {
        $this->myRole = $myRole;

        return $this;
    }

    /**
     * Get myRole
     *
     * @return \Nfq\NomNomBundle\Entity\MyRole 
     */
    public function getMyRole()
    {
        return $this->myRole;
    }

    /**
     * Set myRight
     *
     * @param \Nfq\NomNomBundle\Entity\MyRight $myRight
     * @return MyRoleRight
     */
    public function setMyRight(\Nfq\NomNomBundle\Entity\MyRight $myRight = null)
    {
        $this->myRight = $myRight;

        return $this;
    }

    /**
     * Get myRight
     *
     * @return \Nfq\NomNomBundle\Entity\MyRight 
     */
    public function getMyRight()
    {
        return $this->myRight;
    }
}
