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
     *
     * @ORM\ManyToOne(targetEntity="MyEvent", inversedBy="myEventRecipes")
     * @ORM\JoinColumn(name="my_event_id", referencedColumnName="id")
     */
    private $myEvent;

    /**
     * @ORM\ManyToOne(targetEntity="MyRecipe", inversedBy="myEventRecipes")
     * @ORM\JoinColumn(name="my_recipe_id", referencedColumnName="id")
     */
    private $myRecipe;

    /**
     * @ORM\OneToMany(targetEntity="MyRecipeVote", mappedBy="myEventRecipe")
     */
    private $myRecipeVotes;

    /**
     * Constructor
     */
    public function __constructor()
    {
        $this->myRecipeVotes = new ArrayCollection();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->myRecipeVotes = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Add myRecipeVotes
     *
     * @param \Nfq\NomNomBundle\Entity\MyRecipeVote $myRecipeVotes
     * @return MyEventRecipe
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
}
