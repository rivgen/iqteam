<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ServisBlok
 *
 * @ORM\Table(name="servis_blok")
 * @ORM\Entity(repositoryClass="App\Repository\ServisBlockRepository")
 */
class ServisBlok
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
     * @var string|null
     *
     * @ORM\Column(name="title", type="string", length=50, nullable=true)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="title_en", type="string", length=50, nullable=true)
     */
    private $titleEn;

    /**
     * @var string|null
     *
     * @ORM\Column(name="text", type="text", length=65535, nullable=true)
     */
    private $text;

    /**
     * @var string|null
     *
     * @ORM\Column(name="text_en", type="text", length=65535, nullable=true)
     */
    private $textEn;

    /**
     * @var string|null
     *
     * @ORM\Column(name="img", type="string", length=50, nullable=true)
     */
    private $img;

    /**
     * @var string|null
     *
     * @ORM\Column(name="icon", type="string", length=50, nullable=true)
     */
    private $icon;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return null|string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param null|string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return null|string
     */
    public function getTitleEn()
    {
        return $this->titleEn;
    }

    /**
     * @param null|string $titleEn
     */
    public function setTitleEn($titleEn)
    {
        $this->titleEn = $titleEn;
    }

    /**
     * @return null|string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param null|string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return null|string
     */
    public function getTextEn()
    {
        return $this->textEn;
    }

    /**
     * @param null|string $textEn
     */
    public function setTextEn($textEn)
    {
        $this->textEn = $textEn;
    }

    /**
     * @return null|string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param null|string $img
     */
    public function setImg($img)
    {
        $this->img = $img;
    }

    /**
     * @return null|string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param null|string $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

}
