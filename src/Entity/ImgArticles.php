<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImgArticlesRepository")
 */
class ImgArticles
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $img;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Articles", inversedBy="imgArticles")
     */
    private $article;

    /**
     * @ORM\Column(type="boolean")
     */
    private $general;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getArticle(): ?Articles
    {
        return $this->article;
    }

    public function setArticle(?Articles $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getGeneral(): ?bool
    {
        return $this->general;
    }

    public function setGeneral(bool $general): self
    {
        $this->general = $general;

        return $this;
    }
}
