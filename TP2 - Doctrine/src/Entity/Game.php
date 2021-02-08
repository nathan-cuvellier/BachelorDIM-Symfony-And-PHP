<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToOne;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 * @ORM\Table(name="games")
 */
class Game
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $name;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private ?string $image;


    /**
     * @OneToOne(targetEntity="Player")
     */
    private ?Player $owned;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Game
     */
    public function setName(?string $name): Game
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     * @return Game
     */
    public function setImage(?string $image): Game
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return Player|null
     */
    public function getOwned(): ?Player
    {
        return $this->owned;
    }

    /**
     * @param Player|null $owned
     * @return Game
     */
    public function setOwned(?Player $owned): Game
    {
        $this->owned = $owned;
        return $this;
    }



}
