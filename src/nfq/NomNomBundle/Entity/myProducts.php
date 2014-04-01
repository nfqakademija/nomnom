<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MyProduct
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\MyProductRepository")
 */
class MyProduct
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
     * @ORM\Column(name="productName", type="string", length=50)
     */
    private $productName;

    /**
     * @ORM\OneToMany(targetEntity="MyRecipeProduct", mappedBy="myProducts")
     */
    private $myRecipeProducts;

    /**
     * @ORM\OneToMany(targetEntity="MyUserProduct", mappedBy="myProduct")
     */
    private $myUserProducts;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->myRecipeProducts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->myUserProducts = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add myRecipeProducts
     *
     * @param \Nfq\NomNomBundle\Entity\MyRecipeProduct $myRecipeProducts
     * @return MyProduct
     */
    public function addMyRecipeProduct(\Nfq\NomNomBundle\Entity\MyRecipeProduct $myRecipeProducts)
    {
        $this->myRecipeProducts[] = $myRecipeProducts;

        return $this;
    }

    /**
     * Remove myRecipeProducts
     *
     * @param \Nfq\NomNomBundle\Entity\MyRecipeProduct $myRecipeProducts
     */
    public function removeMyRecipeProduct(\Nfq\NomNomBundle\Entity\MyRecipeProduct $myRecipeProducts)
    {
        $this->myRecipeProducts->removeElement($myRecipeProducts);
    }

    /**
     * Get myRecipeProducts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMyRecipeProducts()
    {
        return $this->myRecipeProducts;
    }

    /**
     * Add myUserProducts
     *
     * @param \Nfq\NomNomBundle\Entity\MyUserProduct $myUserProducts
     * @return MyProduct
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
     * Set productName
     *
     * @param string $productName
     * @return MyProduct
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;

        return $this;
    }

    /**
     * Get productName
     *
     * @return string 
     */
    public function getProductName()
    {
        return $this->productName;
    }
}
