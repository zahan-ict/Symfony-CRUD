<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostsRepository")
 */
class Posts
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
    private $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $email;

    /**
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     *@ORM\Column(type="datetime", nullable=false)
     *@ORM\Version
     *@var \DateTime
     */
    private $time = null;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getMessage()
    {

        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }


    public function getTime()
    {
        return $this->time;
    }

    // public function setTime($time)
    // {
    //     $this->time = $time;
    // }
}
