<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * myEventRecipes
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\myEventRecipesRepository")
 */
class myEventRecipes
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
     * @ORM\ManyToOne(targetEntity="myEvents", inversedBy="myEventRecipes")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     */
    private $eventId;

    /**
     * @var integer
     *
     * @ORM\Column(name="recipeId", type="integer")
     */
    private $recipeId;

    /**
     * @var integer
     *
     * @ORM\Column(name="totalUpvote", type="integer")
     */
    private $totalUpvote;

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
     * Set eventId
     *
     * @param integer $eventId
     * @return myEventRecipes
     */
    public function setEventId($eventId)
    {
        $this->eventId = $eventId;

        return $this;
    }

    /**
     * Get eventId
     *
     * @return integer 
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * Set recipeId
     *
     * @param integer $recipeId
     * @return myEventRecipes
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
     * @return myEventRecipes
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
}
