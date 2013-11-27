<?php

namespace Acme\StoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Color
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Color
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
     * @ORM\Column(name="color", type="string", length=255)
     */
    private $color;

    /**
     * @var array
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="colors")
     */
    private $products;

    /**
     *
     */
    public function __construct()
    {
        $this->products = new ArrayCollection();
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
     * Set color
     *
     * @param string $color
     * @return Color
     */
    public function setColor($color)
    {
        $this->color = $color;
    
        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set products
     *
     * @param Product
     * @return Color
     */
    public function addProducts($products)
    {
        $this->products[] = $products;
    
        return $this;
    }

    /**
     * Get products
     *
     * @return array 
     */
    public function getProducts()
    {
        return $this->products;
    }
}
