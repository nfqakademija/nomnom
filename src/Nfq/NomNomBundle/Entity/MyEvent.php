<?php

namespace Nfq\NomNomBundle\Entity;


use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Nfq\NomNomBundle\Validator\Constraints as NfqAssert;

/**
 * MyEvent
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\MyEventRepository")
 */
class MyEvent
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreated", type="datetime")
     */
    private $dateCreated;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="eventName", type="string", length=50)
     */
    private $eventName;

    /**
     * @var \DateTime
     * @Assert\NotBlank()
     * @NfqAssert\ConstraintsNotInThePast
     * @ORM\Column(name="eventDate", type="datetime")
     */
    private $eventDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="eventPhase", type="smallint")
     * Events will be in 4 phases
     * 0 recipe suggestion and guest invitation
     * 1 recipe product assignment
     * 2 finalized event
     * 3 past due date
     */
    private $eventPhase;

    /**
     * @ORM\OneToMany(targetEntity="MyUserEvent", mappedBy="myEvent")
     */
    private $myUserEvents;

    /**
     * @ORM\OneToMany(targetEntity="MyEventRecipe", mappedBy="myEvent")
     */
    private $myEventRecipes;

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * @return MyEvent
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
     * @return MyEvent
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
     * @return MyEvent
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
     * Set eventPhase
     *
     * @param integer $eventPhase
     * @return MyEvent
     */
    public function setEventPhase($eventPhase)
    {
        $this->eventPhase = $eventPhase;

        return $this;
    }

    /**
     * Get eventPhase
     *
     * @return integer 
     */
    public function getEventPhase()
    {
        return $this->eventPhase;
    }

    /**
     * Add myUserEvents
     *
     * @param \Nfq\NomNomBundle\Entity\MyUserEvent $myUserEvents
     * @return MyEvent
     */
    public function addMyUserEvent(\Nfq\NomNomBundle\Entity\MyUserEvent $myUserEvents)
    {
        $this->myUserEvents[] = $myUserEvents;

        return $this;
    }

    /**
     * Remove myUserEvents
     *
     * @param \Nfq\NomNomBundle\Entity\MyUserEvent $myUserEvents
     */
    public function removeMyUserEvent(\Nfq\NomNomBundle\Entity\MyUserEvent $myUserEvents)
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
     * @param \Nfq\NomNomBundle\Entity\MyEventRecipe $myEventRecipes
     * @return MyEvent
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
