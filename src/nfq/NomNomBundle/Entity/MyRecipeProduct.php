<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MyRecipeProduct
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\MyRecipeProductRepository")
 */
class MyRecipeProduct
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
     * @ORM\ManyToOne(targetEntity="MyRecipe", inversedBy="myRecipeProducts")
     * @ORM\JoinColumn(name="my_recipe_id", referencedColumnName="id")
     */
    private $myRecipe;

    /**
     * @ORM\ManyToOne(targetEntity="MyProduct", inversedBy="myRecipeProducts")
     * @ORM\JoinColumn(name="my_product_id", referencedColumnName="id")
     */
    private $myProduct;

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
     * @return MyRecipeProduct
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
     * @return MyRecipeProduct
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
     * @return MyRecipeProduct
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
     * @return MyRecipeProduct
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
     * Set myRecipe
     *
     * @param \Nfq\NomNomBundle\Entity\MyRecipe $myRecipe
     * @return MyRecipeProduct
     */
    public function setMyRecipe(\Nfq\NomNomBundle\Entity\MyRecipe $myRecipe = null)
    {
        $this->myRecipe = $myRecipe;

        return $this;
    }

    /**
     * Get myRecipe
     *
     * @return \Nfq\NomNomBundle\Entity\MyRecipe 
     */
    public function getMyRecipe()
    {
        return $this->myRecipe;
    }

    /**
     * Set myProduct
     *
     * @param \Nfq\NomNomBundle\Entity\myProducts $myProduct
     * @return MyRecipeProduct
     */
    public function setMyProduct(\Nfq\NomNomBundle\Entity\myProducts $myProduct = null)
    {
        $this->myProduct = $myProduct;

        return $this;
    }

    /**
     * Get myProduct
     *
     * @return \Nfq\NomNomBundle\Entity\myProducts 
     */
    public function getMyProduct()
    {
        return $this->myProduct;
    }
}
