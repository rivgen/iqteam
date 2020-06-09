<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *  Docks
 *
 * @ORM\Table(name="docks")
 * @ORM\Entity(repositoryClass="App\Repository\DocksRepository")
 */
class Docks
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="en", type="string", length=255)
     */
    private $en;

    /**
     * @ORM\Column(name="ru", type="string", length=255)
     */
    private $ru;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEn()
    {
        return $this->en;
    }

    /**
     * @param mixed $en
     */
    public function setEn($en)
    {
        $this->en = $en;
    }

    /**
     * @return mixed
     */
    public function getRu()
    {
        return $this->ru;
    }

    /**
     * @param mixed $ru
     */
    public function setRu($ru)
    {
        $this->ru = $ru;
    }

}
