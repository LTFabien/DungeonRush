<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CharacterRepository")
 * @ApiResource
 */
class Player
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
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CharacterClass")
     */
    private $class;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Move", inversedBy="characters")
     * @ApiSubresource()
     */
    private $move;

    /**
     * @ORM\Column(type="integer")
     */
    private $HPmax;

    /**
     * @ORM\Column(type="integer")
     */
    private $HP;

    /**
     * @ORM\Column(type="integer")
     */
    private $MPmax;

    /**
     * @ORM\Column(type="integer")
     */
    private $MP;

    /**
     * @ORM\Column(type="integer")
     */
    private $Strength;

    /**
     * @ORM\Column(type="integer")
     */
    private $Intelligence;

    /**
     * @ORM\Column(type="integer")
     */
    private $Spirit;

    /**
     * @ORM\Column(type="integer")
     */
    private $Vitality;

    /**
     * @ORM\Column(type="integer")
     */
    private $Speed;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Team", mappedBy="characters")
     */
    private $teams;

    public function __construct()
    {
        $this->move = new ArrayCollection();
        $this->teams = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }


    public function getClass(): ?CharacterClass
    {
        return $this->class;
    }

    public function setClass(?CharacterClass $class): self
    {
        $this->class = $class;
        return $this;
    }

    /**
     * @return Collection|Move[]
     */
    public function getMove(): Collection
    {
        return $this->move;
    }

    public function addMove(Move $move): self
    {
        if (!$this->move->contains($move)) {
            $this->move[] = $move;
        }

        return $this;
    }

    public function removeMove(Move $move): self
    {
        if ($this->move->contains($move)) {
            $this->move->removeElement($move);
        }

        return $this;
    }

    public function getHPmax(): ?int
    {
        return $this->HPmax;
    }

    public function setHPmax(int $HPmax): self
    {
        $this->HPmax = $HPmax;

        return $this;
    }

    public function getHP(): ?int
    {
        return $this->HP;
    }

    public function setHP(int $HP): self
    {
        $this->HP = $HP;

        return $this;
    }

    public function getMPmax(): ?int
    {
        return $this->MPmax;
    }

    public function setMPmax(int $MPmax): self
    {
        $this->MPmax = $MPmax;

        return $this;
    }

    public function getMP(): ?int
    {
        return $this->MP;
    }

    public function setMP(int $MP): self
    {
        $this->MP = $MP;

        return $this;
    }

    public function getStrength(): ?int
    {
        return $this->Strength;
    }

    public function setStrength(int $Strength): self
    {
        $this->Strength = $Strength;

        return $this;
    }

    public function getIntelligence(): ?int
    {
        return $this->Intelligence;
    }

    public function setIntelligence(int $Intelligence): self
    {
        $this->Intelligence = $Intelligence;

        return $this;
    }

    public function getSpirit(): ?int
    {
        return $this->Spirit;
    }

    public function setSpirit(int $Spirit): self
    {
        $this->Spirit = $Spirit;

        return $this;
    }

    public function getVitality(): ?int
    {
        return $this->Vitality;
    }

    public function setVitality(int $Vitality): self
    {
        $this->Vitality = $Vitality;

        return $this;
    }

    public function getSpeed(): ?int
    {
        return $this->Speed;
    }

    public function setSpeed(int $Speed): self
    {
        $this->Speed = $Speed;

        return $this;
    }

    /**
     * @return Collection|Team[]
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): self
    {
        if (!$this->teams->contains($team)) {
            $this->teams[] = $team;
            $team->addCharacter($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teams->contains($team)) {
            $this->teams->removeElement($team);
            $team->removeCharacter($this);
        }

        return $this;
    }
}