<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * myRecipeProducts
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\myRecipeProductsRepository")
 */
class myRecipeProducts
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
     * @ORM\ManyToOne(targetEntity="myRecipes", inversedBy="myrecipeproducts")
     *
     */
    private $myrecipes;

    /**
     * @var integer
     *
     * @ORM\Column(name="recipeId", type="integer")
     */
    private $recipeId;

    /**
     * @ORM\ManyToOne(targetEntity="myProducts", inversedBy="myrecipeproducts")
     *
     */
    private $myproducts;

    /**
     * @var integer
     *
     * @ORM\Column(name="productId", type="integer")
     */
    private $productId;

    /**
     * @var float
     *
     * @ORM\Column(name="quantity", type="float")
     */
    private $quantity;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantityMeasure", type="integer")
     */
    private $quantityMeasure;


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
     * Set recipeId
     *
     * @param integer $recipeId
     * @return myRecipeProducts
     */
    public function setRecipeId($recipeId)
    {
        $this->recipeId = $recipeId;

        return $this;
    }

    /**
     * Get recipeId
     *
     * @return integer 
     */
    public function getRecipeId()
    {
        return $this->recipeId;
    }

    /**
     * Set productId
     *
     * @param integer $productId
     * @return myRecipeProducts
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Get productId
     *
     * @return integer 
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set quantity
     *
     * @param float $quantity
     * @return myRecipeProducts
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
     * @return myRecipeProducts
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
