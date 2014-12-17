<?php

namespace BionicUniversity\Bundle\ProductBundle\Entity;

use BionicUniversity\Bundle\CatalogBundle\Entity\CategoryProductInterface;

use BionicUniversity\Bundle\CheckoutBundle\Entity\PurchaseProductProductInterface;
use BionicUniversity\Bundle\ProductBundle\Entity\Product\Status;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Product
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Product implements CategoryProductInterface, PurchaseProductProductInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @var mixed
     *
     * @ORM\ManyToOne(targetEntity="BionicUniversity\Bundle\ProductBundle\Entity\ProductCategoryInterface", inversedBy="products")
     */
    private $category;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @var Status
     * @ORM\ManyToOne(targetEntity="BionicUniversity\Bundle\ProductBundle\Entity\Product\Status", inversedBy="products" )
     */
    private $status;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="ProductPurchaseProductInterface", mappedBy="product")
     */
    private $purchaseProducts;

    /**
     * @Assert\File(maxSize="6000000")
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $path;

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return UploadedFile
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $image
     */
    public function setImage(UploadedFile $image)
    {
        $this->image = $image;
    }

    /**
     * @param mixed $purchaseProducts
     */
    public function setPurchaseProducts($purchaseProducts)
    {
        $this->purchaseProducts = $purchaseProducts;
    }

    /**
     * {@inheritdoc}
     */
    public function getPurchaseProducts()
    {
        return $this->purchaseProducts;
    }


    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param Status $status
     */
    public function setStatus(Status $status)
    {
        $this->status = $status;
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
     * Set name
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set category
     *
     * @param ProductCategoryInterface $category
     *
     * @return Product
     */
    public function setCategory(ProductCategoryInterface $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }


}

