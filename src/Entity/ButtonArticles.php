<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ButtonArticles
 *
 * @ORM\Table(name="button_articles")
 * @ORM\Entity(repositoryClass="App\Repository\ButtonArticlesRepository")
 */
class ButtonArticles
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
     * @ORM\Column(name="url", type="string", length=100, nullable=false, options={"default"="''"})
     */
    private $url = '\'\'';

    /**
     * @var \Articles
     *
     * @ORM\ManyToOne(targetEntity="Articles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="articles_id", referencedColumnName="id")
     * })
     */
    private $articles;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Button", inversedBy="buttonArticles")
     */
    private $button;

    public function __construct()
    {
        $this->button = new ArrayCollection();
    }

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
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    /**
     * @return \Articles
     */
    public function getArticles(): \Articles
    {
        return $this->articles;
    }

    /**
     * @param \Articles $articles
     */
    public function setArticles(\Articles $articles)
    {
        $this->articles = $articles;
    }

    public function getButton(): ?Button
    {
        return $this->button;
    }

    public function setButton(?Button $button): self
    {
        $this->button = $button;

        return $this;
    }

}
