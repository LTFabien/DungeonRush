<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CharacterRepository")
 */
class Character
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Move", inversedBy="character_taught")
     */
    private $move_learned;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Group", inversedBy="characters")
     */
    private $team;

    /**
     * @ORM\Column(type="integer")
     */
    private $HPMax;

    /**
     * @ORM\Column(type="integer")
     */
    private $HP;

    /**
     * @ORM\Column(type="integer")
     */
    private $MPMax;

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

    public function __construct()
    {
        $this->move_learned = new ArrayCollection();
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
    public function getMoveLearned(): Collection
    {
        return $this->move_learned;
    }

    public function addMoveLearned(Move $moveLearned): self
    {
        if (!$this->move_learned->contains($moveLearned)) {
            $this->move_learned[] = $moveLearned;
        }

        return $this;
    }

    public function removeMoveLearned(Move $moveLearned): self
    {
        if ($this->move_learned->contains($moveLearned)) {
            $this->move_learned->removeElement($moveLearned);
        }

        return $this;
    }

    public function getTeam(): ?Group
    {
        return $this->team;
    }

    public function setTeam(?Group $team): self
    {
        $this->team = $team;

        return $this;
    }

    public function getHPMax(): ?int
    {
        return $this->HPMax;
    }

    public function setHPMax(int $HPMax): self
    {
        $this->HPMax = $HPMax;

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

    public function getMPMax(): ?int
    {
        return $this->MPMax;
    }

    public function setMPMax(int $MPMax): self
    {
        $this->MPMax = $MPMax;

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
}
