<?php

namespace anun\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Xmon\ColorPickerTypeBundle\Validator\Constraints as XmonAssertColor;

/**
 * ItemColor
 *
 * @ORM\Table(name="item_color")
 * @ORM\Entity(repositoryClass="anun\CmsBundle\Repository\ItemColorRepository")
 */
class ItemColor
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
     * @XmonAssertColor\HexColor()
     * @ORM\Column(name="color", type="string", length=255)
     */
    private $color;

    /**
     * @ORM\ManyToOne(targetEntity="Item", inversedBy="colors")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     */
    private $item;

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
     * Set color
     *
     * @param string $color
     *
     * @return ItemColor
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
     * Set item
     *
     * @param \anun\CmsBundle\Entity\Item $item
     *
     * @return ItemColor
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
}
