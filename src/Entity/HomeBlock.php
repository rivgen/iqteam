<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * HomeBlock
 *
 * @ORM\Table(name="home_block")
 * @ORM\Entity()
 */
class HomeBlock
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
     * @ORM\Column(name="title_ru", type="string", length=250)
     */
    private $titleRu;

    /**
     * @var string
     *
     * @ORM\Column(name="title_en", type="string", length=250)
     */
    private $titleEn;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\HomeBlockText", mappedBy="block")
     */
    private $homeBlockText;

    public function __construct()
    {
        $this->homeBlockText = new ArrayCollection();
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
    public function getTitleRu()
    {
        return $this->titleRu;
    }

    /**
     * @param string $titleRu
     */
    public function setTitleRu($titleRu)
    {
        $this->titleRu = $titleRu;
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
     * @return mixed
     */
    public function getHomeBlockText()
    {
        return $this->homeBlockText;
    }

    /**
     * @param mixed $homeBlockText
     */
    public function setHomeBlockText($homeBlockText)
    {
        $this->homeBlockText = $homeBlockText;
    }

}
