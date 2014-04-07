<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\Column(name="numberOfServings", type="integer")
     */
    private $numberOfServings;

    /**
     * @var string
     * @ORM\Column(name="preparationTime", type="string", length=50)
     */
    private $preparationTime;

    /**
     * @var string
     * @ORM\Column(name="recipeName", type="string", length=50)
     */
    private $recipeName;

    /**
     * @var string

     * @ORM\Column(name="recipePhoto", type="string", length=50)
     */
    private $photo;

    /**
     * @var string
     * @ORM\Column(name="preparationInstructions", type="string", length=500)
     */
    private $preparationInstructions;


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


    private $PhotoDir = 'recipes';
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->myRecipeProducts = new ArrayCollection();
        $this->myRecipeVotes = new ArrayCollection();
        $this->myEventRecipes = new  ArrayCollection();
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
     * Set numberOfServings
     *
     * @param integer $numberOfServings
     * @return MyRecipe
     */
    public function setNumberOfServings($numberOfServings)
    {
        $this->numberOfServings = $numberOfServings;

        return $this;
    }

    /**
     * Get numberOfServings
     *
     * @return integer 
     */
    public function getNumberOfServings()
    {
        return $this->numberOfServings;
    }

    /**
     * Set preparationTime
     *
     * @param string $preparationTime
     * @return MyRecipe
     */
    public function setPreparationTime($preparationTime)
    {
        $this->preparationTime = $preparationTime;

        return $this;
    }

    /**
     * Get preparationTime
     *
     * @return string 
     */
    public function getPreparationTime()
    {
        return $this->preparationTime;
    }

    /**
     * Set recipeName
     *
     * @param string $recipeName
     * @return MyRecipe
     */
    public function setRecipeName($recipeName)
    {
        $this->recipeName = $recipeName;

        return $this;
    }

    /**
     * Get recipeName
     *
     * @return string 
     */
    public function getRecipeName()
    {
        return $this->recipeName;
    }

    /**
     * Set photo
     *
     * @param string $photo
     * @return MyRecipe
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set preparationInstructions
     *
     * @param string $preparationInstructions
     * @return MyRecipe
     */
    public function setPreparationInstructions($preparationInstructions)
    {
        $this->preparationInstructions = $preparationInstructions;

        return $this;
    }

    /**
     * Get preparationInstructions
     *
     * @return string 
     */
    public function getPreparationInstructions()
    {
        return $this->preparationInstructions;
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

    public function getPhotoDir()
    {
        return $this->PhotoDir;
    }

    public function getPhotoUrl()
    {
        return 'bundles/NfqNomNom/images/'.$this->getPhotoDir().'/'.$this->getPhoto();
    }
}

