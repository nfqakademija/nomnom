<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MyRecipeCategory
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\MyRecipeCategoryRepository")
 */
class MyRecipeCategory
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
     * @ORM\OneToMany(targetEntity="MyRecipe", mappedBy="myRecipeCategory")
     */
    private $myRecipes;

    /**
     * @var string
     *
     * @ORM\Column(name="categoryName", type="string", length=50)
     */
    private $categoryName;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->myRecipes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set categoryName
     *
     * @param string $categoryName
     * @return MyRecipeCategory
     */
    public function setCategoryName($categoryName)
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    /**
     * Get categoryName
     *
     * @return string
     */
    public function getCategoryName()
    {
        return $this->categoryName;
    }

    /**
     * Add myRecipes
     *
     * @param \Nfq\NomNomBundle\Entity\MyRecipe $myRecipes
     * @return MyRecipeCategory
     */
    public function addMyRecipe(\Nfq\NomNomBundle\Entity\MyRecipe $myRecipes)
    {
        $this->myRecipes[] = $myRecipes;

        return $this;
    }

    /**
     * Remove myRecipes
     *
     * @param \Nfq\NomNomBundle\Entity\MyRecipe $myRecipes
     */
    public function removeMyRecipe(\Nfq\NomNomBundle\Entity\MyRecipe $myRecipes)
    {
        $this->myRecipes->removeElement($myRecipes);
    }

    /**
     * Get myRecipes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMyRecipes()
    {
        return $this->myRecipes;
    }
}