<?php

namespace anun\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use tsetsee\Annotation\OrderIndexer;
use tsetsee\Annotation\OrderIndexerProperty;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * ItemCategory
 *
 * @Vich\Uploadable
 * @OrderIndexer()
 *
 * @ORM\Table(name="item_category")
 * @ORM\Entity(repositoryClass="anun\CmsBundle\Repository\ItemCategoryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ItemCategory
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="img_path", type="string", length=255, nullable=true)
     */
    private $imgPath;

    /**
     * @Vich\UploadableField(mapping="category_images", fileNameProperty="imgPath")
     * @var File
     */
    private $imgFile;

    /**
     * @var string
     *
     * @ORM\Column(name="descr", type="text", nullable=true)
     */
    private $descr;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="ItemCategory", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="ItemCategory", mappedBy="parent")
     */
    private $children;

    /**
     * @var int
     * @OrderIndexerProperty()
     * @ORM\Column(name="order_num", type="integer", nullable=true)
     */
    private $orderNum;

    /**
     * @ORM\OneToMany(targetEntity="Item", mappedBy="category")
     */
    private $items;

    /**
     * @ORM\PrePersist()
     */
    public function onPrePersist() {
        $this->createdAt = new \DateTime('now');
    }

    /**
     * @ORM\PreUpdate()
     */
    public function onPreUpdate() {
        $this->updatedAt = new \DateTime('now');
    }

    /**
     * Get id
     *
     * @return int
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
     * @return ItemCategory
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return ItemCategory
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return ItemCategory
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set imgPath
     *
     * @param string $imgPath
     *
     * @return ItemCategory
     */
    public function setImgPath($imgPath)
    {
        $this->imgPath = $imgPath;

        return $this;
    }

    /**
     * Get imgPath
     *
     * @return string
     */
    public function getImgPath()
    {
        return $this->imgPath;
    }

    /**
     * Set descr
     *
     * @param string $descr
     *
     * @return ItemCategory
     */
    public function setDescr($descr)
    {
        $this->descr = $descr;

        return $this;
    }

    /**
     * Get descr
     *
     * @return string
     */
    public function getDescr()
    {
        return $this->descr;
    }

    /**
     * Set orderNum
     *
     * @param integer $orderNum
     *
     * @return ItemCategory
     */
    public function setOrderNum($orderNum)
    {
        $this->orderNum = $orderNum;

        return $this;
    }

    /**
     * Get orderNum
     *
     * @return integer
     */
    public function getOrderNum()
    {
        return $this->orderNum;
    }

    /**
     * Set parent
     *
     * @param \anun\CmsBundle\Entity\ItemCategory $parent
     *
     * @return ItemCategory
     */
    public function setParent(\anun\CmsBundle\Entity\ItemCategory $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \anun\CmsBundle\Entity\ItemCategory
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add child
     *
     * @param \anun\CmsBundle\Entity\ItemCategory $child
     *
     * @return ItemCategory
     */
    public function addChild(\anun\CmsBundle\Entity\ItemCategory $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \anun\CmsBundle\Entity\ItemCategory $child
     */
    public function removeChild(\anun\CmsBundle\Entity\ItemCategory $child)
    {
        $this->children->removeElement($child);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }


    /**
     * Add item
     *
     * @param \anun\CmsBundle\Entity\Item $item
     *
     * @return ItemCategory
     */
    public function addItem(\anun\CmsBundle\Entity\Item $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Remove item
     *
     * @param \anun\CmsBundle\Entity\Item $item
     */
    public function removeItem(\anun\CmsBundle\Entity\Item $item)
    {
        $this->items->removeElement($item);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItems()
    {
        return $this->items;
    }


    /**
     * @return mixed
     */
    public function getImgFile()
    {
        return $this->imgFile;
    }

    /**
     * @param mixed $imgFile
     */
    public function setImgFile(File $imgFile = null)
    {
        $this->imgFile = $imgFile;

        if($imgFile) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function __toString()
    {
        return $this->name;
    }
}
