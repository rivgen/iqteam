<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ButtonRepository")
 */
class Button
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
    private $icon;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $title;

//    /**
//     * @ORM\ManyToOne(targetEntity="App\Entity\ButtonArticles", inversedBy="button")
//     */
//    private $buttonArticles;

//    public function __construct()
//    {
//        $this->buttonArticles = new ArrayCollection();
//    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|ButtonArticles[]
     */
    public function getButtonArticles(): Collection
    {
        return $this->buttonArticles;
    }

    public function addButtonArticle(ButtonArticles $buttonArticle): self
    {
        if (!$this->buttonArticles->contains($buttonArticle)) {
            $this->buttonArticles[] = $buttonArticle;
            $buttonArticle->setButton($this);
        }

        return $this;
    }

    public function removeButtonArticle(ButtonArticles $buttonArticle): self
    {
        if ($this->buttonArticles->contains($buttonArticle)) {
            $this->buttonArticles->removeElement($buttonArticle);
            // set the owning side to null (unless already changed)
            if ($buttonArticle->getButton() === $this) {
                $buttonArticle->setButton(null);
            }
        }

        return $this;
    }

}
