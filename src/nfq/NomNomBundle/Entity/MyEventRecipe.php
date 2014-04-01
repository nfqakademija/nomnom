<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MyEventRecipe
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\MyEventRecipeRepository")
 */
class MyEventRecipe
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
     *
     * @ORM\Column(name="totalUpvote", type="integer")
     */
    private $totalUpvote;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="MyEvent", inversedBy="myEventRecipes")
     * @ORM\JoinColumn(name="my_event_id", referencedColumnName="id")
     */
    private $myEvent;

    /**
     * @ORM\ManyToOne(targetEntity="MyRecipe", inversedBy="myEventRecipe")
     * @ORM\JoinColumn(name="my_recipe_id", referencedColumnName="id")*
     */
    private $myRecipe;

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
     * @return MyEventRecipe
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
     * Set totalUpvote
     *
     * @param integer $totalUpvote
     * @return MyEventRecipe
     */
    public function setTotalUpvote($totalUpvote)
    {
        $this->totalUpvote = $totalUpvote;

        return $this;
    }

    /**
     * Get totalUpvote
     *
     * @return integer 
     */
    public function getTotalUpvote()
    {
        return $this->totalUpvote;
    }

    /**
     * Set myEvent
     *
     * @param \Nfq\NomNomBundle\Entity\MyEvent $myEvent
     * @return MyEventRecipe
     */
    public function setMyEvent(\Nfq\NomNomBundle\Entity\MyEvent $myEvent = null)
    {
        $this->myEvent = $myEvent;

        return $this;
    }

    /**
     * Get myEvent
     *
     * @return \Nfq\NomNomBundle\Entity\MyEvent 
     */
    public function getMyEvent()
    {
        return $this->myEvent;
    }

    /**
     * Set myRecipes
     *
     * @param \Nfq\NomNomBundle\Entity\MyRecipe $myRecipes
     * @return MyEventRecipe
     */
    public function setMyRecipes(\Nfq\NomNomBundle\Entity\MyRecipe $myRecipes = null)
    {
        $this->myRecipes = $myRecipes;

        return $this;
    }

    /**
     * Get myRecipes
     *
     * @return \Nfq\NomNomBundle\Entity\MyRecipe 
     */
    public function getMyRecipes()
    {
        return $this->myRecipes;
    }

    /**
     * Set myRecipe
     *
     * @param \Nfq\NomNomBundle\Entity\MyRecipe $myRecipe
     * @return MyEventRecipe
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
}
