<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(name="title", type="string", length=250, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="title_en", type="string", length=250, nullable=true)
     */
    private $titleEn;

    /**
     * @var string|null
     *
     * @ORM\Column(name="text_preview", type="text", length=16777215, nullable=true)
     */
    private $textPreview;

    /**
     * @var string|null
     *
     * @ORM\Column(name="text_preview_en", type="text", length=16777215, nullable=true)
     */
    private $textPreviewEn;

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=250, nullable=true)
     */
    private $alias;

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
     * @var string|null
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Поле заполнено более чем на {{ limit }} символов")
     */
    private $fullTitle;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Поле заполнено более чем на {{ limit }} символов")
     */
    private $fullTitleEn;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $icon;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Assert\Length(
     *      max = 20,
     *      maxMessage = "Поле заполнено более чем на {{ limit }} символов")
     */
    private $year;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Поле заполнено более чем на {{ limit }} символов")
     */
    private $client;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Поле заполнено более чем на {{ limit }} символов")
     */
    private $clientEn;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ordering;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Поле заполнено более чем на {{ limit }} символов")
     */
    private $technology;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Поле заполнено более чем на {{ limit }} символов")
     */
    private $technologyEn;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionEn;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     * @Assert\Length(
     *      max = 80,
     *      maxMessage = "Поле заполнено более чем на {{ limit }} символов")
     */
    private $metaTitle;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     * @Assert\Length(
     *      max = 80,
     *      maxMessage = "Поле заполнено более чем на {{ limit }} символов")
     */
    private $metaTitleEn;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     * @Assert\Length(
     *      max = 180,
     *      maxMessage = "Поле заполнено более чем на {{ limit }} символов")
     */
    private $metaDescription;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     * @Assert\Length(
     *      max = 180,
     *      maxMessage = "Поле заполнено более чем на {{ limit }} символов")
     */
    private $metaDescriptionEn;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ImgArticles", mappedBy="article", orphanRemoval=true)
     */
    private $imgArticles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ButtonArticles", mappedBy="articles", cascade = {"persist"}, orphanRemoval=true)
     */
    private $buttonArticles;

    public function __construct()
    {
        $this->imgArticles = new ArrayCollection();
        $this->buttonArticles = new ArrayCollection();
    }

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
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     */
    public function setAlias($alias)
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

    /**
     * @return null|string
     */
    public function getFullTitle()
    {
        return $this->fullTitle;
    }

    /**
     * @param null|string $fullTitle
     */
    public function setFullTitle($fullTitle)
    {
        $this->fullTitle = $fullTitle;
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

    /**
     * @return null|string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param null|string $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return null|string
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param null|string $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return null|string
     */
    public function getTechnology()
    {
        return $this->technology;
    }

    /**
     * @param null|string $technology
     */
    public function setTechnology($technology)
    {
        $this->technology = $technology;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImgArticles(): Collection
    {
        return $this->imgArticles;
    }

    public function addImgArticle(ImgArticles $imgArticles): self
    {
        if (!$this->imgArticles->contains($imgArticles)) {
            $this->imgArticles[] = $imgArticles;
            $imgArticles->setArticle($this);
        }

        return $this;
    }

    public function removeImgArticle(ImgArticles $imgArticles): self
    {
        if (!$this->imgArticles->contains($imgArticles)) {
            $this->imgArticles->removeElement($imgArticles);
            // set the owning side to null (unless already changed)
            if ($imgArticles->getArticle() === $this) {
                $imgArticles->setArticle(null);
            }
//            return $this;
        }

//        $this->imgArticles->removeElement($imgArticle);
        // needed to update the owning side of the relationship!
//        $imgArticle->setArticle(null);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getButtonArticles()
    {
        return $this->buttonArticles;
    }

    public function addButtonArticle(ButtonArticles $ButtonArticles): self
    {
        if (!$this->buttonArticles->contains($ButtonArticles)) {
            $this->buttonArticles[] = $ButtonArticles;
            $ButtonArticles->setArticles($this);
        }

        return $this;
    }

    public function removeButtonArticle(ButtonArticles $ButtonArticles): self
    {
        if (!$this->buttonArticles->contains($ButtonArticles)) {
//            $this->imgArticles->removeElement($imgArticle);
            // set the owning side to null (unless already changed)
//            if ($imgArticle->getArticle() === $this) {
//                $imgArticle->setArticle(null);
//            }
            return $this;
        }

        $this->buttonArticles->removeElement($ButtonArticles);
        // needed to update the owning side of the relationship!
        $ButtonArticles->setArticles(null);

//        return $this;
    }

    /**
     * @return int|null
     */
    public function getOrdering()
    {
        return $this->ordering;
    }

    /**
     * @param int|null $ordering
     */
    public function setOrdering($ordering)
    {
        $this->ordering = $ordering;
    }

    /**
     * @return mixed
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * @param mixed $metaTitle
     */
    public function setMetaTitle($metaTitle)
    {
        $this->metaTitle = $metaTitle;
    }

    /**
     * @return mixed
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * @param mixed $metaDescription
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;
    }

    /**
     * @return string
     */
    public function getTitleEn()
    {
        return $this->titleEn;
    }

    /**
     * @param string $titleEn
     */
    public function setTitleEn($titleEn)
    {
        $this->titleEn = $titleEn;
    }

    /**
     * @return null|string
     */
    public function getTextPreviewEn()
    {
        return $this->textPreviewEn;
    }

    /**
     * @param null|string $textPreviewEn
     */
    public function setTextPreviewEn($textPreviewEn)
    {
        $this->textPreviewEn = $textPreviewEn;
    }

    /**
     * @return null|string
     */
    public function getFullTitleEn()
    {
        return $this->fullTitleEn;
    }

    /**
     * @param null|string $fullTitleEn
     */
    public function setFullTitleEn($fullTitleEn)
    {
        $this->fullTitleEn = $fullTitleEn;
    }

    /**
     * @return null|string
     */
    public function getClientEn()
    {
        return $this->clientEn;
    }

    /**
     * @param null|string $clientEn
     */
    public function setClientEn($clientEn)
    {
        $this->clientEn = $clientEn;
    }

    /**
     * @return null|string
     */
    public function getTechnologyEn()
    {
        return $this->technologyEn;
    }

    /**
     * @param null|string $technologyEn
     */
    public function setTechnologyEn($technologyEn)
    {
        $this->technologyEn = $technologyEn;
    }

    /**
     * @return mixed
     */
    public function getDescriptionEn()
    {
        return $this->descriptionEn;
    }

    /**
     * @param mixed $descriptionEn
     */
    public function setDescriptionEn($descriptionEn)
    {
        $this->descriptionEn = $descriptionEn;
    }

    /**
     * @return mixed
     */
    public function getMetaTitleEn()
    {
        return $this->metaTitleEn;
    }

    /**
     * @param mixed $metaTitleEn
     */
    public function setMetaTitleEn($metaTitleEn)
    {
        $this->metaTitleEn = $metaTitleEn;
    }

    /**
     * @return mixed
     */
    public function getMetaDescriptionEn()
    {
        return $this->metaDescriptionEn;
    }

    /**
     * @param mixed $metaDescriptionEn
     */
    public function setMetaDescriptionEn($metaDescriptionEn)
    {
        $this->metaDescriptionEn = $metaDescriptionEn;
    }

}
