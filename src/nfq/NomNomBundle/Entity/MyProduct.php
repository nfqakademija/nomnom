<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MyProduct
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\MyProductRepository")
 */
class MyProduct
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
     *
     * @ORM\Column(name="productName", type="string", length=50)
     */
    private $productName;

    /**
     * @ORM\OneToMany(targetEntity="MyRecipeProduct", mappedBy="myProducts")
     */
    private $myRecipeProducts;

    /**
     * @ORM\OneToMany(targetEntity="MyUserProduct", mappedBy="myProduct")
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
}