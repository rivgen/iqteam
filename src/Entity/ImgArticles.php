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
     * @var null
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $general;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param mixed $img
     */
    public function setImg($img)
    {
        $this->img = $img;
    }

    /**
     * @return mixed
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param mixed $article
     */
    public function setArticle($article)
    {
        $this->article = $article;
    }

    /**
     * @return null
     */
    public function getGeneral()
    {
        return $this->general;
    }

    /**
     * @param null $general
     */
    public function setGeneral($general)
    {
        $this->general = $general;
    }

}
