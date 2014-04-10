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
     * @ORM\ManyToOne(targetEntity="MyUserEvent", inversedBy="myUserProducts")
     * @ORM\JoinColumn(name="my_user_event_id", referencedColumnName="id")
     */
    private $myUserEvent;

    /**
     * @ORM\ManyToOne(targetEntity="MyProduct", inversedBy="myUserProducts")
     * @ORM\JoinColumn(name="my_product_id", referencedColumnName="id")
     */
    protected $myProduct;

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

    /**
     * Set myUserEvent
     *
     * @param \Nfq\NomNomBundle\Entity\MyUserEvent $myUserEvent
     * @return MyUserProduct
     */
    public function setMyUserEvent(\Nfq\NomNomBundle\Entity\MyUserEvent $myUserEvent = null)
    {
        $this->myUserEvent = $myUserEvent;

        return $this;
    }

    /**
     * Get myUserEvent
     *
     * @return \Nfq\NomNomBundle\Entity\MyUserEvent 
     */
    public function getMyUserEvent()
    {
        return $this->myUserEvent;
    }
}
