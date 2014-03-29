<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * myUserProducts
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\myUserProductsRepository")
 */
class myUserProducts
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
     * @ORM\OneToMany(targetEntity="myUserEvents", mappedBy="myuserproducts")
     */
    private $myuserevents;

    /**
     * @ORM\ManyToOne(targetEntity="myProducts", inversedBy="myuserproducts")
     * @ORM\JoinColumn(name="myproducts_id", referencedColumnName="id")
     */
    private $myproducts;
    /**
     * @var float
     *
     * @ORM\Column(name="quantity", type="float")
     */
    private $quantity;

    /**
     * @var integer
     * quantity will be number coded
     *
     * @ORM\Column(name="quantityMeasure", type="smallint")
     */
    private $quantityMeasure;


    public function __construct()
    {
        $this->myuserevents = new ArrayCollection();
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
     * Set quantity
     *
     * @param float $quantity
     * @return myUserProducts
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return float 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set quantityMeasure
     *
     * @param integer $quantityMeasure
     * @return myUserProducts
     */
    public function setQuantityMeasure($quantityMeasure)
    {
        $this->quantityMeasure = $quantityMeasure;

        return $this;
    }

    /**
     * Get quantityMeasure
     *
     * @return integer 
     */
    public function getQuantityMeasure()
    {
        return $this->quantityMeasure;
    }

    /**
     * Add myuserevents
     *
     * @param \Nfq\NomNomBundle\Entity\myUserEvents $myuserevents
     * @return myUserProducts
     */
    public function addMyuserevent(\Nfq\NomNomBundle\Entity\myUserEvents $myuserevents)
    {
        $this->myuserevents[] = $myuserevents;

        return $this;
    }

    /**
     * Remove myuserevents
     *
     * @param \Nfq\NomNomBundle\Entity\myUserEvents $myuserevents
     */
    public function removeMyuserevent(\Nfq\NomNomBundle\Entity\myUserEvents $myuserevents)
    {
        $this->myuserevents->removeElement($myuserevents);
    }

    /**
     * Get myuserevents
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMyuserevents()
    {
        return $this->myuserevents;
    }

    /**
     * Set myproducts
     *
     * @param \Nfq\NomNomBundle\Entity\myProducts $myproducts
     * @return myUserProducts
     */
    public function setMyproducts(\Nfq\NomNomBundle\Entity\myProducts $myproducts = null)
    {
        $this->myproducts = $myproducts;

        return $this;
    }

    /**
     * Get myproducts
     *
     * @return \Nfq\NomNomBundle\Entity\myProducts 
     */
    public function getMyproducts()
    {
        return $this->myproducts;
    }
}
