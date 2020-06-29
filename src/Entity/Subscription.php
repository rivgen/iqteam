<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 *
 * @UniqueEntity("email")
 */
class Subscription
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, unique=true)
     * @Assert\Email
     */
    private $email;

//    /**
//     * @var \DateTime
//     *
//     * @ORM\Column(type="string", type="datetime", nullable=false)
//     */
//    private $created;

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
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

//    /**
//     * @return \DateTime
//     */
//    public function getCreated()
//    {
//        return $this->created;
//    }
//
//    /**
//     * @param \DateTime $created
//     */
//    public function setCreated(\DateTime $created)
//    {
//        $this->created = $created;
//    }

}
