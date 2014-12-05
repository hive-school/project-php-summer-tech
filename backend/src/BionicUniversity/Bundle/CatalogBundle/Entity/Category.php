<?php

namespace BionicUniversity\Bundle\CatalogBundle\Entity;

use BionicUniversity\Bundle\ProductBundle\Entity\ProductCategoryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Category
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Category implements ProductCategoryInterface
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
     * @Gedmo\TreePathSource()
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    /**
     * @Gedmo\TreeParent()
     * @var Category
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="children", cascade={"persist"})
     */
    private $parent;
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
     */
    private $children;
    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Gedmo\TreePath
     */
    private $materializedPath;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="BionicUniversity\Bundle\CatalogBundle\Entity\CategoryProductInterface", mappedBy="category")
     */
    private $products;

    /**
     * {@inheritdoc}
     */
    public function getProducts()
    {
        return $this->products;
    }



    /**
     * @return string
     */
    public function getMaterializedPath()
    {
        return $this->materializedPath;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Category
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param mixed $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /**
     * @return mixed
     */
    public function getChildren()
    {
        return $this->children;
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
     * @return Category
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
}

