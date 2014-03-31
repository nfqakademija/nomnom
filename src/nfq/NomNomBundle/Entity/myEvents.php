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
     * @ORM\OneToMany(targetEntity="myEventRecipes", mappedBy="myEvents")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="myUserEvents", mappedBy="myEvents")
     */
    private $myrolerights;

    /**
     * @ORM\OneToMany(targetEntity="myEventRecipes", mappedBy="myEvents")
     */
    private $myEventRecipes;

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
}
