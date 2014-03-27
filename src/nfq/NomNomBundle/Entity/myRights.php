<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
}
