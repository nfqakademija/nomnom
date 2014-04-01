<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * myRecipeCategory
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\myRecipeCategoryRepository")
 */
class myRecipeCategory
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
     * @ORM\OneToMany(targetEntity="myRecipes", mappedBy="myrecipecategory")
     */
    private $myrecipies;

    /**
     * @var string
     *
     * @ORM\Column(name="categoryName", type="string", length=50)
     */
    private $categoryName;


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
     * Set categoryName
     *
     * @param string $categoryName
     * @return myRecipeCategory
     */
    public function setCategoryName($categoryName)
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    /**
     * Get categoryName
     *
     * @return string 
     */
    public function getCategoryName()
    {
        return $this->categoryName;
    }
}
