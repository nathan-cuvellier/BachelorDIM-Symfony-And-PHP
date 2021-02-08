<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ScoreRepository")
 * @ORM\Table(name="scores")
 */
class Score
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="float")
     */
    private ?float $score;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $image;

    /**
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="score")
     */
    private ?Player $player;

    /**
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="score")
     */
    private ?Game $game;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return float|null
     */
    public function getScore(): ?float
    {
        return $this->score;
    }

    /**
     * @param string|null $score
     * @return Score
     */
    public function setScore(?string $score): Score
    {
        $this->score = $score;
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
     * @return Score
     */
    public function setImage(?string $image): Score
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return Player|null
     */
    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    /**
     * @param Player|null $player
     * @return Score
     */
    public function setPlayer(?Player $player): Score
    {
        $this->player = $player;
        return $this;
    }

    /**
     * @return Game|null
     */
    public function getGame(): ?Game
    {
        return $this->game;
    }

    /**
     * @param Game|null $game
     * @return Score
     */
    public function setGame(?Game $game): Score
    {
        $this->game = $game;
        return $this;
    }



}
