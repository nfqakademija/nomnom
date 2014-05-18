<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MyNotification
 *
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\MyNotificationRepository")
 */
class MyNotification
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
     * there will be 3 notification types:
     * soonEndPlanning
     * endPlanning
     * gotInvitation
     * assignedProduct
     *
     * @var string
     *
     * @ORM\Column(name="myNotificationName", type="string", length=255)
     */
    private $myNotificationName;

    /**
     * @var boolean
     *
     * @ORM\Column(name="unread", type="boolean")
     */
    private $unread;

    /**
     * @ORM\ManyToOne(targetEntity="MyUserEvent", inversedBy="myNotifications")
     * @ORM\JoinColumn(name="my_user_event_id", referencedColumnName="id")
     */
    private $myUserEvent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="notification_date",type="datetime")
     */
    private $notificationDate;

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
     * Set myNotificationName
     *
     * @param string $myNotificationName
     * @return MyNotification
     */
    public function setMyNotificationName($myNotificationName)
    {
        $this->myNotificationName = $myNotificationName;

        return $this;
    }

    /**
     * Get myNotificationName
     *
     * @return string
     */
    public function getMyNotificationName()
    {
        return $this->myNotificationName;
    }

    /**
     * Set unread
     *
     * @param boolean $unread
     * @return MyNotification
     */
    public function setUnread($unread)
    {
        $this->unread = $unread;

        return $this;
    }

    /**
     * Get unread
     *
     * @return boolean
     */
    public function getUnread()
    {
        return $this->unread;
    }

    /**
     * Set myUserEvent
     *
     * @param \Nfq\NomNomBundle\Entity\MyUserEvent $myUserEvent
     * @return MyNotification
     */
    public function setMyUserEvent(\Nfq\NomNomBundle\Entity\MyUserEvent $myUserEvent = null)
    {
        $this->myUserEvent = $myUserEvent;

        return $this;
    }

    /**
     * Get myUserEvent
     *
     * @return \Nfq\NomNomBundle\Entity\MyUserEvent
     */
    public function getMyUserEvent()
    {
        return $this->myUserEvent;
    }

    /**
     * get the notification time
     *
     * @return MyNotification
     * @ORM\PostPersist
     * @ORM\PrePersist
     * don't know is this a good thing but we need datetime when created and when modified
     */
    public function setNotificationDate()
    {
        $this->notificationDate = new \DateTime();

        return $this;
    }

    /**
     * Get notificationDate
     *
     * @return \DateTime
     */
    public function getNotificationDate()
    {
        return $this->notificationDate;
    }
}
