<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MyUserProduct
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\MyUserProductRepository")
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
     * @ORM\ManyToOne(targetEntity="MyQuantityMeasure", inversedBy="myUserProducts")
     * @ORM\JoinColumn(name="my_quantity_measure_id", referencedColumnName="id")
     */
    private $myQuantityMeasure;

    /**
     * @ORM\ManyToOne(targetEntity="MyUserEvent", inversedBy="myUserProducts")
     * @ORM\JoinColumn(name="my_user_event_id", referencedColumnName="id")
     */
    private $myUserEvent;

    /**
     * @ORM\ManyToOne(targetEntity="MyRecipeProduct", inversedBy="myUserProducts")
     * @ORM\JoinColumn(name="my_recipe_product_id", referencedColumnName="id")
     */
    protected $myRecipeProduct;

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

    /**
     * Set myRecipeProduct
     *
     * @param \Nfq\NomNomBundle\Entity\MyRecipeProduct $myRecipeProduct
     * @return MyUserProduct
     */
    public function setMyRecipeProduct(\Nfq\NomNomBundle\Entity\MyRecipeProduct $myRecipeProduct = null)
    {
        $this->myRecipeProduct = $myRecipeProduct;

        return $this;
    }

    /**
     * Get myRecipeProduct
     *
     * @return \Nfq\NomNomBundle\Entity\MyRecipeProduct
     */
    public function getMyRecipeProduct()
    {
        return $this->myRecipeProduct;
    }

    /**
     * Set myQuantityMeasure
     *
     * @param \Nfq\NomNomBundle\Entity\MyQuantityMeasure $myQuantityMeasure
     * @return MyUserProduct
     */
    public function setMyQuantityMeasure(\Nfq\NomNomBundle\Entity\MyQuantityMeasure $myQuantityMeasure = null)
    {
        $this->myQuantityMeasure = $myQuantityMeasure;

        return $this;
    }

    /**
     * Get myQuantityMeasure
     *
     * @return \Nfq\NomNomBundle\Entity\MyQuantityMeasure
     */
    public function getMyQuantityMeasure()
    {
        return $this->myQuantityMeasure;
    }
}
