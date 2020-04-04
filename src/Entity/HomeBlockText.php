<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HomeBlockText
 *
 * @ORM\Table(name="home_block_text")
 * @ORM\Entity(repositoryClass="App\Repository\HomeBlockTextRepository")
 */
class HomeBlockText
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string")
     */
    private $text;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=250)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="icon", type="string", length=250)
     */
    private $icon;

    /**
     * @var string
     *
     * @ORM\Column(name="checkmark", type="string", length=50)
     */
    private $checkmark;

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=5)
     */
    private $language;

    /**
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\HomeBlock", inversedBy="homeBlockText")
     */
    private $block;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * @return string
     */
    public function getCheckmark()
    {
        return $this->checkmark;
    }

    /**
     * @param string $checkmark
     */
    public function setCheckmark($checkmark)
    {
        $this->checkmark = $checkmark;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return mixed
     */
    public function getBlock()
    {
        return $this->block;
    }

    /**
     * @param mixed $block
     */
    public function setBlock($block)
    {
        $this->block = $block;
    }

}
