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
     * @ORM\ManyToOne(targetEntity="MyQuantityMeasure", inversedBy="myRecipeProducts")
     * @ORM\JoinColumn(name="my_quantity_measure_id", referencedColumnName="id")
     */
    private $myQuantityMeasure;

    /**
     * @ORM\OneToMany(targetEntity="MyUserProduct", mappedBy="myRecipeProduct")
     */
    private $myUserProducts;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->myUserProducts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Measurements keys and values
     *
     * @var array
     */
    private $measuresMap = array(
        '0' => '',
        '1' => 'g',
        '2' => 'tbsp',
        '3' => 'stalk',
        '4' => 'kg',
        '5' => 'bunch',
    );


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
     * @param \Nfq\NomNomBundle\Entity\MyProduct $myProduct
     * @return MyRecipeProduct
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
     * Returns measurement title by measurement key
     *
     * @param $measurementKey
     * @return string
     */
    public function getMeasurementTitle($measurementKey)
    {
        if (isset($this->measuresMap[$measurementKey])) {
            return $this->measuresMap[$measurementKey];
        }
        return '';
    }

    /**
     * Add myUserProducts
     *
     * @param \Nfq\NomNomBundle\Entity\MyUserProduct $myUserProducts
     * @return MyRecipeProduct
     */
    public function addMyUserProduct(\Nfq\NomNomBundle\Entity\MyUserProduct $myUserProducts)
    {
        $this->myUserProducts[] = $myUserProducts;

        return $this;
    }

    /**
     * Remove myUserProducts
     *
     * @param \Nfq\NomNomBundle\Entity\MyUserProduct $myUserProducts
     */
    public function removeMyUserProduct(\Nfq\NomNomBundle\Entity\MyUserProduct $myUserProducts)
    {
        $this->myUserProducts->removeElement($myUserProducts);
    }

    /**
     * Get myUserProducts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMyUserProducts()
    {
        return $this->myUserProducts;
    }

    /**
     * Returns quantity adapted by total upvote
     * If numberOfServings is 4 and totalUpvote is 6, then product quantity * 2
     *
     * @param MyEventRecipe $eventRecipe
     * @return float|string
     */
    public function getQuantityDisplay(\Nfq\NomNomBundle\Entity\MyEventRecipe $eventRecipe)
    {
        $quantityDisplay = '';

        if ($this->getQuantity()) {
            $quantityDisplay = $this->getQuantity() * ceil($eventRecipe->getTotalUpvote() / $eventRecipe->getMyRecipe()->getNumberOfServings());
        }
        return $quantityDisplay;
    }

    /**
     * Set myQuantityMeasure
     *
     * @param \Nfq\NomNomBundle\Entity\MyQuantityMeasure $myQuantityMeasure
     * @return MyRecipeProduct
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
