<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * myProducts
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\myProductsRepository")
 */
class myProducts
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
     * @ORM\OneToMany(targetEntity="myUserProducts",mappedBy="myproducts")
     */
    private $myuserproducts;

    /**
     * @var string
     *
     * @ORM\Column(name="productName", type="string", length=50)
     */
    private $productName;

    public function __construct()
    {
        $this->myuserproducts = new ArrayCollection();
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
     * Set productName
     *
     * @param string $productName
     * @return myProducts
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;

        return $this;
    }

    /**
     * Get productName
     *
     * @return string 
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * Add myuserproducts
     *
     * @param \Nfq\NomNomBundle\Entity\myUserProducts $myuserproducts
     * @return myProducts
     */
    public function addMyuserproduct(\Nfq\NomNomBundle\Entity\myUserProducts $myuserproducts)
    {
        $this->myuserproducts[] = $myuserproducts;

        return $this;
    }

    /**
     * Remove myuserproducts
     *
     * @param \Nfq\NomNomBundle\Entity\myUserProducts $myuserproducts
     */
    public function removeMyuserproduct(\Nfq\NomNomBundle\Entity\myUserProducts $myuserproducts)
    {
        $this->myuserproducts->removeElement($myuserproducts);
    }

    /**
     * Get myuserproducts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMyuserproducts()
    {
        return $this->myuserproducts;
    }
}
