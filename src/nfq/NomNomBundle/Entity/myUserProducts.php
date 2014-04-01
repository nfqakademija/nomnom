<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MyUserProduct
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\MyUerProductRepository")
 */
class MyUserProduct
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
     * @var float
     *
     * @ORM\Column(name="quantity", type="float")
     */
    private $quantity;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantityMeasure", type="smallint")
     */
    private $quantityMeasure;

    /**
     * @ORM\OneToMany(targetEntity="MyUserEvent", mappedBy="myUserProduct")
     */
    private $myUserEvents;

    /**
     * @ORM\ManyToOne(targetEntity="MyProduct", inversedBy="myUserProducts")
     * @ORM\JoinColumn(name="my_product_id", referencedColumnName="id")
     */
    protected $myProduct;

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
     * Add myUserEvents
     *
     * @param \Nfq\NomNomBundle\Entity\MyUserEvent $myUserEvents
     * @return MyUserProduct
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

    /**
     * Set myProduct
     *
     * @param \Nfq\NomNomBundle\Entity\MyProduct $myProduct
     * @return MyUserProduct
     */
    public function setMyProduct(\Nfq\NomNomBundle\Entity\MyProduct $myProduct = null)
    {
        $this->myProduct = $myProduct;

        return $this;
    }

    /**
     * Get myProduct
     *
     * @return \Nfq\NomNomBundle\Entity\MyProduct 
     */
    public function getMyProduct()
    {
        return $this->myProduct;
    }

    /**
     * Set quantity
     *
     * @param float $quantity
     * @return MyUserProduct
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
     * @return MyUserProduct
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
}
