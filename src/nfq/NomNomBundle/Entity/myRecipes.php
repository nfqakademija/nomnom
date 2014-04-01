<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MyRecipe
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\MyRecipeRepository")
 */
class MyRecipe
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
     * @var integer
     */
    private $numberOfServings;

    /**
     * @var \DateTime
     */
    private $preparationTime;

    /**
     * @var string
     */
    private $recipeName;

    /**
     * @var string
     */
    private $foto;

    /**
     * @var string
     */
    private $preparationInstructions;

    /**
     * @var integer
     */
    private $categoryId;

    /**
     * @ORM\ManyToOne(targetEntity="MyRecipeCategory", inversedBy="myRecipes")
     * @ORM\JoinColumn(name="my_recipe_category_id", referencedColumnName="id")
     */
    private $myRecipeCategory;

    /**
     * @ORM\OneToMany(targetEntity="MyRecipeProduct", mappedBy="myRecipe")
     */
    private $myRecipeProducts;

    /**
     * @ORM\OneToMany(targetEntity="MyRecipeVote", mappedBy="myRecipe")
     */
    private $myRecipeVotes;

    /**
     * @ORM\OneToMany(targetEntity="MyEventRecipe", mappedBy="myRecipe")
     */
    private $myEventRecipes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->myRecipeProducts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->myRecipeVotes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->myEventRecipes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set myRecipeCategory
     *
     * @param \Nfq\NomNomBundle\Entity\MyRecipeCategory $myRecipeCategory
     * @return MyRecipe
     */
    public function setMyRecipeCategory(\Nfq\NomNomBundle\Entity\MyRecipeCategory $myRecipeCategory = null)
    {
        $this->myRecipeCategory = $myRecipeCategory;

        return $this;
    }

    /**
     * Get myRecipeCategory
     *
     * @return \Nfq\NomNomBundle\Entity\MyRecipeCategory 
     */
    public function getMyRecipeCategory()
    {
        return $this->myRecipeCategory;
    }

    /**
     * Add myRecipeProducts
     *
     * @param \Nfq\NomNomBundle\Entity\MyRecipeProduct $myRecipeProducts
     * @return MyRecipe
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
     * Add myRecipeVotes
     *
     * @param \Nfq\NomNomBundle\Entity\MyRecipeVote $myRecipeVotes
     * @return MyRecipe
     */
    public function addMyRecipeVote(\Nfq\NomNomBundle\Entity\MyRecipeVote $myRecipeVotes)
    {
        $this->myRecipeVotes[] = $myRecipeVotes;

        return $this;
    }

    /**
     * Remove myRecipeVotes
     *
     * @param \Nfq\NomNomBundle\Entity\MyRecipeVote $myRecipeVotes
     */
    public function removeMyRecipeVote(\Nfq\NomNomBundle\Entity\MyRecipeVote $myRecipeVotes)
    {
        $this->myRecipeVotes->removeElement($myRecipeVotes);
    }

    /**
     * Get myRecipeVotes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMyRecipeVotes()
    {
        return $this->myRecipeVotes;
    }

    /**
     * Add myEventRecipes
     *
     * @param \Nfq\NomNomBundle\Entity\MyEventRecipe $myEventRecipes
     * @return MyRecipe
     */
    public function addMyEventRecipe(\Nfq\NomNomBundle\Entity\MyEventRecipe $myEventRecipes)
    {
        $this->myEventRecipes[] = $myEventRecipes;

        return $this;
    }

    /**
     * Remove myEventRecipes
     *
     * @param \Nfq\NomNomBundle\Entity\MyEventRecipe $myEventRecipes
     */
    public function removeMyEventRecipe(\Nfq\NomNomBundle\Entity\MyEventRecipe $myEventRecipes)
    {
        $this->myEventRecipes->removeElement($myEventRecipes);
    }

    /**
     * Get myEventRecipes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMyEventRecipes()
    {
        return $this->myEventRecipes;
    }
}
