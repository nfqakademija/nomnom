<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * myEvents
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\myEventsRepository")
 */
class myEvents
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
     * @ORM\OneToMany(targetEntity="myUserEvents", mappedBy="myEvents")
     */
    private $myrolerights;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreated", type="datetime")
     */
    private $dateCreated;

    /**
     * @var string
     *
     * @ORM\Column(name="eventName", type="string", length=50)
     */
    private $eventName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="eventDate", type="datetime")
     */
    private $eventDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="evenPhase", type="smallint")
     */
    private $evenPhase;

    /**
     * @ORM\OneToMany(targetEntity="myUserEvents", mappedBy="myEvent")
     */
    private $myUserEvents;

    /**
     * @ORM\OneToMany(targetEntity="myEventRecipes", mappedBy="myEvent")
     */
    private $myEventRecipes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->myrolerights = new \Doctrine\Common\Collections\ArrayCollection();
        $this->myUserEvents = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return myEvents
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime 
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set eventName
     *
     * @param string $eventName
     * @return myEvents
     */
    public function setEventName($eventName)
    {
        $this->eventName = $eventName;

        return $this;
    }

    /**
     * Get eventName
     *
     * @return string 
     */
    public function getEventName()
    {
        return $this->eventName;
    }

    /**
     * Set eventDate
     *
     * @param \DateTime $eventDate
     * @return myEvents
     */
    public function setEventDate($eventDate)
    {
        $this->eventDate = $eventDate;

        return $this;
    }

    /**
     * Get eventDate
     *
     * @return \DateTime 
     */
    public function getEventDate()
    {
        return $this->eventDate;
    }

    /**
     * Set evenPhase
     *
     * @param integer $evenPhase
     * @return myEvents
     */
    public function setEvenPhase($evenPhase)
    {
        $this->evenPhase = $evenPhase;

        return $this;
    }

    /**
     * Get evenPhase
     *
     * @return integer 
     */
    public function getEvenPhase()
    {
        return $this->evenPhase;
    }

    /**
     * Add myrolerights
     *
     * @param \Nfq\NomNomBundle\Entity\myUserEvents $myrolerights
     * @return myEvents
     */
    public function addMyroleright(\Nfq\NomNomBundle\Entity\myUserEvents $myrolerights)
    {
        $this->myrolerights[] = $myrolerights;

        return $this;
    }

    /**
     * Remove myrolerights
     *
     * @param \Nfq\NomNomBundle\Entity\myUserEvents $myrolerights
     */
    public function removeMyroleright(\Nfq\NomNomBundle\Entity\myUserEvents $myrolerights)
    {
        $this->myrolerights->removeElement($myrolerights);
    }

    /**
     * Get myrolerights
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMyrolerights()
    {
        return $this->myrolerights;
    }

    /**
     * Add myUserEvents
     *
     * @param \Nfq\NomNomBundle\Entity\myUserEvents $myUserEvents
     * @return myEvents
     */
    public function addMyUserEvent(\Nfq\NomNomBundle\Entity\myUserEvents $myUserEvents)
    {
        $this->myUserEvents[] = $myUserEvents;

        return $this;
    }

    /**
     * Remove myUserEvents
     *
     * @param \Nfq\NomNomBundle\Entity\myUserEvents $myUserEvents
     */
    public function removeMyUserEvent(\Nfq\NomNomBundle\Entity\myUserEvents $myUserEvents)
    {
        $this->myUserEvents->removeElement($myUserEvents);
    }

    /**
     * Get myUserEvents
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMyUserEvents()
    {
        return $this->myUserEvents;
    }

    /**
     * Add myEventRecipes
     *
     * @param \Nfq\NomNomBundle\Entity\myEventRecipes $myEventRecipes
     * @return myEvents
     */
    public function addMyEventRecipe(\Nfq\NomNomBundle\Entity\myEventRecipes $myEventRecipes)
    {
        $this->myEventRecipes[] = $myEventRecipes;

        return $this;
    }

    /**
     * Remove myEventRecipes
     *
     * @param \Nfq\NomNomBundle\Entity\myEventRecipes $myEventRecipes
     */
    public function removeMyEventRecipe(\Nfq\NomNomBundle\Entity\myEventRecipes $myEventRecipes)
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
