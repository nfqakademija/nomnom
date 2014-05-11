<?php

namespace Nfq\NomNomBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * MyRecipe
 * @Vich\Uploadable
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\MyRecipeRepository")
 */
class MyRecipe
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
     * @Assert\NotBlank
     * @var integer
     * @ORM\Column(name="numberOfServings", type="integer")
     */
    private $numberOfServings;

    /**
     * @Assert\NotBlank
     * @var string
     * @ORM\Column(name="preparationTime", type="string", length=50)
     */
    private $preparationTime;

    /**
     * @Assert\NotBlank
     * @var string
     * @ORM\Column(name="recipeName", type="string", length=50)
     */
    private $recipeName;

    /**
     * @Assert\File(
     *     maxSize="1M",
     *     mimeTypes={"image/png", "image/jpeg"}
     * )
     * @Vich\UploadableField(mapping="recipe_image", fileNameProperty="imageName")
     *
     * @var File $photo
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, name="image_name")
     *
     * @var string $imageName
     */
    protected $imageName;

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImage(File $image)
    {
        $this->image = $image;
    }

    /**
     * @return File
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $imageName
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }

    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * @Assert\NotBlank
     * @var string
     * @ORM\Column(name="preparationInstructions", type="string", length=5000)
     */
    private $preparationInstructions;

    /**
     * @Assert\NotBlank
     * @ORM\ManyToOne(targetEntity="MyRecipeCategory", inversedBy="myRecipes")
     * @ORM\JoinColumn(name="my_recipe_category_id", referencedColumnName="id")
     */
    private $myRecipeCategory;

    /**
     * @Assert\Valid
     *
     * @ORM\OneToMany(targetEntity="MyRecipeProduct", mappedBy="myRecipe")
     */
    private $myRecipeProducts;

    /**
     * @ORM\OneToMany(targetEntity="MyEventRecipe", mappedBy="myRecipe")
     */
    private $myEventRecipes;


    private $ImageDir = 'recipes';

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->myRecipeProducts = new ArrayCollection();
        $this->myEventRecipes = new  ArrayCollection();
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
     * Set numberOfServings
     *
     * @param integer $numberOfServings
     * @return MyRecipe
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
     * @param string $preparationTime
     * @return MyRecipe
     */
    public function setPreparationTime($preparationTime)
    {
        $this->preparationTime = $preparationTime;

        return $this;
    }

    /**
     * Get preparationTime
     *
     * @return string
     */
    public function getPreparationTime()
    {
        return $this->preparationTime;
    }

    /**
     * Set recipeName
     *
     * @param string $recipeName
     * @return MyRecipe
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
     * Set preparationInstructions
     *
     * @param string $preparationInstructions
     * @return MyRecipe
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
     * Set myRecipeCategory
     *
     * @param \Nfq\NomNomBundle\Entity\MyRecipeCategory $myRecipeCategory
     * @return MyRecipe
     */
    public function setMyRecipeCategory(\Nfq\NomNomBundle\Entity\MyRecipeCategory $myRecipeCategory = null)
    {
        $this->myRecipeCategory = $myRecipeCategory;

        return $this;
    }

    /**
     * Get myRecipeCategory
     *
     * @return \Nfq\NomNomBundle\Entity\MyRecipeCategory
     */
    public function getMyRecipeCategory()
    {
        return $this->myRecipeCategory;
    }

    /**
     * Add myRecipeProducts
     *
     * @param \Nfq\NomNomBundle\Entity\MyRecipeProduct $myRecipeProducts
     * @return MyRecipe
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
     * Add myEventRecipes
     *
     * @param \Nfq\NomNomBundle\Entity\MyEventRecipe $myEventRecipes
     * @return MyRecipe
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

    public function getImageDir()
    {
        return $this->ImageDir;
    }

    public function getImageUrl()
    {
        return 'bundles/nfqnomnom/images/' . $this->getImageDir() . '/' . $this->getImageName();
    }
}
