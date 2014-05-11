<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * MyQuantityMeasure
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\MyQuantityMeasureRepository")
 */
class MyQuantityMeasure
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
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="myQuantityMeasureName", type="string", length=255)
     */
    private $myQuantityMeasureName;


    /**
     * @ORM\OneToMany(targetEntity="MyRecipeProduct", mappedBy="myQuantityMeasure")
     */
    private $myRecipeProducts;

    /**
     * @ORM\OneToMany(targetEntity="MyUserProduct", mappedBy="myQuantityMeasure")
     */
    private $myUserProducts;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->myRecipeProducts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->myUserProducts = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set myQuantityMeasureName
     *
     * @param string $myQuantityMeasureName
     * @return MyQuantityMeasure
     */
    public function setMyQuantityMeasureName($myQuantityMeasureName)
    {
        $this->myQuantityMeasureName = $myQuantityMeasureName;

        return $this;
    }

    /**
     * Get myQuantityMeasureName
     *
     * @return string
     */
    public function getMyQuantityMeasureName()
    {
        return $this->myQuantityMeasureName;
    }

    /**
     * Add myRecipeProducts
     *
     * @param \Nfq\NomNomBundle\Entity\MyRecipeProduct $myRecipeProducts
     * @return MyQuantityMeasure
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
     * Add myUserProducts
     *
     * @param \Nfq\NomNomBundle\Entity\MyUserProduct $myUserProducts
     * @return MyQuantityMeasure
     */
    public function addMyUserProduct(\Nfq\NomNomBundle\Entity\MyUserProduct $myUserProducts)
    {
        $this->myUserProducts[] = $myUserProducts;

        return $this;
    }

    /**
     * Remove myUserProducts
     *
     * @param \Nfq\NomNomBundle\Entity\MyUserProduct $myUserProducts
     */
    public function removeMyUserProduct(\Nfq\NomNomBundle\Entity\MyUserProduct $myUserProducts)
    {
        $this->myUserProducts->removeElement($myUserProducts);
    }

    /**
     * Get myUserProducts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMyUserProducts()
    {
        return $this->myUserProducts;
    }
}
