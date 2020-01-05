<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoleRepository")
 */
class Role
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nameRole;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameRole(): ?string
    {
        return $this->nameRole;
    }

    public function setNameRole(string $nameRole): self
    {
        $this->nameRole = $nameRole;

        return $this;
    }
}
