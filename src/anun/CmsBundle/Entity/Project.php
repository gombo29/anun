<?php

namespace anun\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 * Project
 * @Vich\Uploadable()
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="anun\CmsBundle\Repository\ProjectRepository")
 */
class Project
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
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="headline", type="string", length=255, nullable=true)
     */
    private $headline;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text", nullable=true)
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(name="preview_img", type="string", length=255, nullable=true)
     */
    private $previewImg;

    /**
     * @var File
     * @Vich\UploadableField(mapping="project_images", fileNameProperty="previewImg")
     */
    private $previewImgFile;

    /**
     * @var string
     *
     * @ORM\Column(name="client", type="string", length=255, nullable=true)
     */
    private $client;

    /**
     * @var string
     *
     * @ORM\Column(name="detail_size", type="string", length=255, nullable=true)
     */
    private $detailSize;

    /**
     * @var string
     *
     * @ORM\Column(name="detail_year", type="string", length=255, nullable=true)
     */
    private $detailYear;

    /**
     * @var string
     *
     * @ORM\Column(name="detail_location", type="string", length=255, nullable=true)
     */
    private $detailLocation;

    /**
     * @var string
     *
     * @ORM\Column(name="detail_goods", type="string", length=255, nullable=true)
     */
    private $detailGoods;


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
     * Set title
     *
     * @param string $title
     *
     * @return Project
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set headline
     *
     * @param string $headline
     *
     * @return Project
     */
    public function setHeadline($headline)
    {
        $this->headline = $headline;

        return $this;
    }

    /**
     * Get headline
     *
     * @return string
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * Set previewImg
     *
     * @param string $previewImg
     *
     * @return Project
     */
    public function setPreviewImg($previewImg)
    {
        $this->previewImg = $previewImg;

        return $this;
    }

    /**
     * Get previewImg
     *
     * @return string
     */
    public function getPreviewImg()
    {
        return $this->previewImg;
    }

    /**
     * Set client
     *
     * @param string $client
     *
     * @return Project
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return string
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set detailSize
     *
     * @param string $detailSize
     *
     * @return Project
     */
    public function setDetailSize($detailSize)
    {
        $this->detailSize = $detailSize;

        return $this;
    }

    /**
     * Get detailSize
     *
     * @return string
     */
    public function getDetailSize()
    {
        return $this->detailSize;
    }

    /**
     * Set detailYear
     *
     * @param string $detailYear
     *
     * @return Project
     */
    public function setDetailYear($detailYear)
    {
        $this->detailYear = $detailYear;

        return $this;
    }

    /**
     * Get detailYear
     *
     * @return string
     */
    public function getDetailYear()
    {
        return $this->detailYear;
    }

    /**
     * Set detailLocation
     *
     * @param string $detailLocation
     *
     * @return Project
     */
    public function setDetailLocation($detailLocation)
    {
        $this->detailLocation = $detailLocation;

        return $this;
    }

    /**
     * Get detailLocation
     *
     * @return string
     */
    public function getDetailLocation()
    {
        return $this->detailLocation;
    }

    /**
     * Set detailGoods
     *
     * @param string $detailGoods
     *
     * @return Project
     */
    public function setDetailGoods($detailGoods)
    {
        $this->detailGoods = $detailGoods;

        return $this;
    }

    /**
     * Get detailGoods
     *
     * @return string
     */
    public function getDetailGoods()
    {
        return $this->detailGoods;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return Project
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return File
     */
    public function getPreviewImgFile()
    {
        return $this->previewImgFile;
    }

    /**
     * @param File $previewImgFile
     * @return Project
     */
    public function setPreviewImgFile($previewImgFile)
    {
        $this->previewImgFile = $previewImgFile;
        return $this;
    }
}

