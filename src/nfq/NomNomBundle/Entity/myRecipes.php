<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * myRecipes
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\myRecipesRepository")
 */
class myRecipes
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
     * @ORM\Column(name="numberOfServings", type="smallint")
     */
    private $numberOfServings;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="preparationTime", type="time")
     */
    private $preparationTime;

    /**
     * @var string
     *
     * @ORM\Column(name="recipeName", type="string", length=50)
     */
    private $recipeName;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="blob")
     */
    private $foto;

    /**
     * @var string
     *
     * @ORM\Column(name="preparationInstructions", type="text")
     */
    private $preparationInstructions;

    /**
     * @var integer
     *
     * @ORM\Column(name="categoryId", type="integer")
     */
    private $categoryId;


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
     * Set numberOfServings
     *
     * @param integer $numberOfServings
     * @return myRecipes
     */
    public function setNumberOfServings($numberOfServings)
    {
        $this->numberOfServings = $numberOfServings;

        return $this;
    }

    /**
     * Get numberOfServings
     *
     * @return integer 
     */
    public function getNumberOfServings()
    {
        return $this->numberOfServings;
    }

    /**
     * Set preparationTime
     *
     * @param \DateTime $preparationTime
     * @return myRecipes
     */
    public function setPreparationTime($preparationTime)
    {
        $this->preparationTime = $preparationTime;

        return $this;
    }

    /**
     * Get preparationTime
     *
     * @return \DateTime 
     */
    public function getPreparationTime()
    {
        return $this->preparationTime;
    }

    /**
     * Set recipeName
     *
     * @param string $recipeName
     * @return myRecipes
     */
    public function setRecipeName($recipeName)
    {
        $this->recipeName = $recipeName;

        return $this;
    }

    /**
     * Get recipeName
     *
     * @return string 
     */
    public function getRecipeName()
    {
        return $this->recipeName;
    }

    /**
     * Set foto
     *
     * @param string $foto
     * @return myRecipes
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get foto
     *
     * @return string 
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set preparationInstructions
     *
     * @param string $preparationInstructions
     * @return myRecipes
     */
    public function setPreparationInstructions($preparationInstructions)
    {
        $this->preparationInstructions = $preparationInstructions;

        return $this;
    }

    /**
     * Get preparationInstructions
     *
     * @return string 
     */
    public function getPreparationInstructions()
    {
        return $this->preparationInstructions;
    }

    /**
     * Set categoryId
     *
     * @param integer $categoryId
     * @return myRecipes
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer 
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }
}
