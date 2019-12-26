<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Articles
 *
 * @ORM\Table(name="articles", indexes={@ORM\Index(name="FK_games_game_categories", columns={"category_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\ArticlesRepository")
 */
class Articles
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
     * @ORM\Column(name="title", type="string", length=250, nullable=false, options={"default"="' '"})
     */
    private $title = '\' \'';

    /**
     * @var string|null
     *
     * @ORM\Column(name="text_preview", type="text", length=16777215, nullable=true)
     */
    private $textPreview;

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=250, nullable=false, options={"default"="''"})
     */
    private $alias = '\'\'';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=false)
     */
    private $updated;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=50, nullable=false)
     */
    private $author;

    /**
     *
     * @ORM\ManyToOne(targetEntity="ArticlesCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fullTitle;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $icon;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $year;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $client;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $technology;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ImgArticles", mappedBy="article")
     */
    private $imgArticles;

    public function __construct()
    {
        $this->imgArticles = new ArrayCollection();
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return null|string
     */
    public function getTextPreview()
    {
        return $this->textPreview;
    }

    /**
     * @param null|string $textPreview
     */
    public function setTextPreview($textPreview)
    {
        $this->textPreview = $textPreview;
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     */
    public function setAlias(string $alias)
    {
        $this->alias = $alias;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param \DateTime $updated
     */
    public function setUpdated(\DateTime $updated)
    {
        $this->updated = $updated;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor(string $author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getFullTitle(): ?string
    {
        return $this->fullTitle;
    }

    public function setFullTitle(string $fullTitle): self
    {
        $this->fullTitle = $fullTitle;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getClient(): ?string
    {
        return $this->client;
    }

    public function setClient(string $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getTechnology(): ?string
    {
        return $this->technology;
    }

    public function setTechnology(string $technology): self
    {
        $this->technology = $technology;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|ImgArticles[]
     */
    public function getImgArticles(): Collection
    {
        return $this->imgArticles;
    }

    public function addImgArticle(ImgArticles $imgArticle): self
    {
        if (!$this->imgArticles->contains($imgArticle)) {
            $this->imgArticles[] = $imgArticle;
            $imgArticle->setArticle($this);
        }

        return $this;
    }

    public function removeImgArticle(ImgArticles $imgArticle): self
    {
        if ($this->imgArticles->contains($imgArticle)) {
            $this->imgArticles->removeElement($imgArticle);
            // set the owning side to null (unless already changed)
            if ($imgArticle->getArticle() === $this) {
                $imgArticle->setArticle(null);
            }
        }

        return $this;
    }

}
