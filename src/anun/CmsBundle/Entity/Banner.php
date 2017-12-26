<?php

namespace anun\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use tsetsee\Annotation\OrderIndexer;
use tsetsee\Annotation\OrderIndexerProperty;

/**
 * Banner
 * @Vich\Uploadable()
 * @OrderIndexer()
 * @ORM\Table(name="banner")
 * @ORM\Entity(repositoryClass="anun\CmsBundle\Repository\BannerRepository")
 */
class Banner
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=255, nullable=true)
     */
    private $img;

    /**
     * @var File
     * @Vich\UploadableField(mapping="banner_images", fileNameProperty="img")
     */
    private $imgFile;

    /**
     * @var string
     *
     * @ORM\Column(name="href", type="string", length=255, nullable=true)
     */
    private $href;

    /**
     * @var int
     * @OrderIndexerProperty()
     * @ORM\Column(name="priority", type="integer", nullable=true)
     */
    private $priority;

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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param string $img
     * @return Banner
     */
    public function setImg($img)
    {
        $this->img = $img;
        return $this;
    }

    /**
     * Set href
     *
     * @param string $href
     *
     * @return Banner
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
     * Set priority
     *
     * @param integer $priority
     *
     * @return Banner
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set publishAt
     *
     * @param \DateTime $publishAt
     *
     * @return Banner
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
     * @return Banner
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Banner
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
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
     * @return Banner
     */
    public function setImgFile($imgFile)
    {
        $this->imgFile = $imgFile;
        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

}

