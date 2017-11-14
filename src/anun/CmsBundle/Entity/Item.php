<?php

namespace anun\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use tsetsee\Annotation\OrderIndexer;
use tsetsee\Annotation\OrderIndexerProperty;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Item
 * @Vich\Uploadable()
 * @OrderIndexer()
 * @ORM\Table(name="item")
 * @ORM\Entity(repositoryClass="anun\CmsBundle\Repository\ItemRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Item
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
     * @ORM\Column(name="main_img_path", type="string", length=255, nullable=true)
     */
    private $mainImgPath;

    /**
     * @var File
     * @Vich\UploadableField(mapping="item_images", fileNameProperty="mainImgPath")
     */
    private $mainImgFile;

    /**
     * @var string
     *
     * @ORM\Column(name="href", type="string", length=255, nullable=true)
     */
    private $href;

    /**
     * @var bool
     *
     * @ORM\Column(name="href_target", type="boolean", nullable=true)
     */
    private $hrefTarget;

    /**
     * @var string
     *
     * @ORM\Column(name="head_line", type="string", length=255, nullable=true)
     */
    private $headLine;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

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
     * @var \DateTime
     *
     * @ORM\Column(name="publish_at", type="datetime", nullable=true)
     */
    private $publishAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expire_at", type="datetime", nullable=true)
     */
    private $expireAt;

    /**
     * @ORM\OneToMany(targetEntity="ItemGallery", mappedBy="item", cascade={"persist"})
     */
    private $images;

    /**
     * @ORM\ManyToOne(targetEntity="ItemCategory", inversedBy="items")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @var integer
     * @OrderIndexerProperty()
     * @ORM\Column(name="order_num", type="integer", nullable=true)
     */
    private $orderNum;

    /**
     * @ORM\OneToMany(targetEntity="ItemColor", mappedBy="item", cascade={"persist"}, orphanRemoval=true)
     */
    private $colors;

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
     * @return File
     */
    public function getMainImgFile()
    {
        return $this->mainImgFile;
    }

    /**
     * @param File $mainImgFile
     */
    public function setMainImgFile($mainImgFile)
    {
        $this->mainImgFile = $mainImgFile;

        if($mainImgFile) {
            $this->updatedAt = new \DateTime();
        }
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
     * @return Item
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
     * Set mainImgPath
     *
     * @param string $mainImgPath
     *
     * @return Item
     */
    public function setMainImgPath($mainImgPath)
    {
        $this->mainImgPath = $mainImgPath;

        return $this;
    }

    /**
     * Get mainImgPath
     *
     * @return string
     */
    public function getMainImgPath()
    {
        return $this->mainImgPath;
    }

    /**
     * Set href
     *
     * @param string $href
     *
     * @return Item
     */
    public function setHref($href)
    {
        $this->href = $href;

        return $this;
    }

    /**
     * Get href
     *
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * Set hrefTarget
     *
     * @param boolean $hrefTarget
     *
     * @return Item
     */
    public function setHrefTarget($hrefTarget)
    {
        $this->hrefTarget = $hrefTarget;

        return $this;
    }

    /**
     * Get hrefTarget
     *
     * @return boolean
     */
    public function getHrefTarget()
    {
        return $this->hrefTarget;
    }

    /**
     * Set headLine
     *
     * @param string $headLine
     *
     * @return Item
     */
    public function setHeadLine($headLine)
    {
        $this->headLine = $headLine;

        return $this;
    }

    /**
     * Get headLine
     *
     * @return string
     */
    public function getHeadLine()
    {
        return $this->headLine;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Item
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Item
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
     * @return Item
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
     * Set publishAt
     *
     * @param \DateTime $publishAt
     *
     * @return Item
     */
    public function setPublishAt($publishAt)
    {
        $this->publishAt = $publishAt;

        return $this;
    }

    /**
     * Get publishAt
     *
     * @return \DateTime
     */
    public function getPublishAt()
    {
        return $this->publishAt;
    }

    /**
     * Set expireAt
     *
     * @param \DateTime $expireAt
     *
     * @return Item
     */
    public function setExpireAt($expireAt)
    {
        $this->expireAt = $expireAt;

        return $this;
    }

    /**
     * Get expireAt
     *
     * @return \DateTime
     */
    public function getExpireAt()
    {
        return $this->expireAt;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->hrefTarget = false;
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
        $this->colors = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add image
     *
     * @param \anun\CmsBundle\Entity\ItemGallery $image
     *
     * @return Item
     */
    public function addImage(\anun\CmsBundle\Entity\ItemGallery $image)
    {
        $image->setItem($this);
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \anun\CmsBundle\Entity\ItemGallery $image
     */
    public function removeImage(\anun\CmsBundle\Entity\ItemGallery $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set category
     *
     * @param \anun\CmsBundle\Entity\ItemCategory $category
     *
     * @return Item
     */
    public function setCategory(\anun\CmsBundle\Entity\ItemCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \anun\CmsBundle\Entity\ItemCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set orderNum
     *
     * @param integer $orderNum
     *
     * @return Item
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
     * Add color
     *
     * @param \anun\CmsBundle\Entity\ItemColor $color
     *
     * @return Item
     */
    public function addColor(\anun\CmsBundle\Entity\ItemColor $color)
    {
        $color->setItem($this);
        $this->colors[] = $color;

        return $this;
    }

    /**
     * Remove color
     *
     * @param \anun\CmsBundle\Entity\ItemColor $color
     */
    public function removeColor(\anun\CmsBundle\Entity\ItemColor $color)
    {
        $color->setItem(null);
        $this->colors->removeElement($color);
    }

    /**
     * Get colors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getColors()
    {
        return $this->colors;
    }
}
