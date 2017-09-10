<?php

namespace anun\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * ItemGallery
 *
 * @Vich\Uploadable()
 *
 * @ORM\Table(name="item_gallery")
 * @ORM\Entity(repositoryClass="anun\CmsBundle\Repository\ItemGalleryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ItemGallery
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
     * @ORM\Column(name="img_path", type="string", length=255)
     */
    private $imgPath;

    /**
     * @var File
     * @Vich\UploadableField(mapping="item_images", fileNameProperty="imgPath")
     */
    private $imgFile;

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
     * @var int
     *
     * @ORM\Column(name="order_num", type="integer", nullable=true)
     */
    private $orderNum;

    /**
     * @ORM\ManyToOne(targetEntity="Item", inversedBy="images")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $item;

    /**
     * @var int
     *
     * @ORM\Column(name="width", type="integer")
     */
    private $width;

    /**
     * @var int
     *
     * @ORM\Column(name="height", type="integer")
     */
    private $height;

    /**
     * ItemGallery constructor.
     */
    public function __construct()
    {
        $this->width = -1;
        $this->height = -1;
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
     * Set imgPath
     *
     * @param string $imgPath
     *
     * @return ItemGallery
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return ItemGallery
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
     * @return ItemGallery
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
     * Set orderNum
     *
     * @param integer $orderNum
     *
     * @return ItemGallery
     */
    public function setOrderNum($orderNum)
    {
        $this->orderNum = $orderNum;

        return $this;
    }

    /**
     * Get orderNum
     *
     * @return int
     */
    public function getOrderNum()
    {
        return $this->orderNum;
    }

    /**
     * Set width
     *
     * @param integer $width
     *
     * @return ItemGallery
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return integer
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set height
     *
     * @param integer $height
     *
     * @return ItemGallery
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return integer
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set item
     *
     * @param \anun\CmsBundle\Entity\Item $item
     *
     * @return ItemGallery
     */
    public function setItem(\anun\CmsBundle\Entity\Item $item = null)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return \anun\CmsBundle\Entity\Item
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @return File
     */
    public function getImgFile()
    {
        return $this->imgFile;
    }

    /**
     * @param File $imgFile
     */
    public function setImgFile($imgFile)
    {
        $this->imgFile = $imgFile;

        if($imgFile) {
            $this->updatedAt = new \DateTime('now');
        }
    }

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
     * @return string
     */
    public function getSize() {
        return $this->width . 'x' . $this->height;
    }

}
