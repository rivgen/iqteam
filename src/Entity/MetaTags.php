<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * MetaTags
 *
 * @ORM\Table(name="meta_tags")
 * @ORM\Entity(repositoryClass="App\Repository\MetaTagsRepository")
 */
class MetaTags
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
     * @ORM\Column(name="title", type="string", length=80, nullable=true)
     *  @Assert\Length(
     *      max = 80,
     *      maxMessage = "Поле заполнено более чем на {{ limit }} символов")
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="title_en", type="string", length=80, nullable=true)
     *  @Assert\Length(
     *      max = 80,
     *      maxMessage = "Поле заполнено более чем на {{ limit }} символов")
     */
    private $titleEn;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=180, nullable=true)
     *  @Assert\Length(
     *      max = 180,
     *      maxMessage = "Поле заполнено более чем на {{ limit }} символов")
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description_en", type="string", length=180, nullable=true)
     *  @Assert\Length(
     *      max = 180,
     *      maxMessage = "Поле заполнено более чем на {{ limit }} символов")
     */
    private $descriptionEn;

    /**
     * @var string|null
     *
     * @ORM\Column(name="url", type="string", length=50, nullable=true)
     */
    private $url;

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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return null|string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param null|string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
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
    public function getDescriptionEn()
    {
        return $this->descriptionEn;
    }

    /**
     * @param null|string $descriptionEn
     */
    public function setDescriptionEn($descriptionEn)
    {
        $this->descriptionEn = $descriptionEn;
    }

}
