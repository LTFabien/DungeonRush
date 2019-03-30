<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MonstersRepository")
 */
class Monsters
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Stages", mappedBy="Monster")
     */
    private $stages;

    public function __construct()
    {
        $this->stages = new ArrayCollection();
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
     * @return Collection|Stages[]
     */
    public function getStages(): Collection
    {
        return $this->stages;
    }

    public function addStage(Stages $stage): self
    {
        if (!$this->stages->contains($stage)) {
            $this->stages[] = $stage;
            $stage->addMonster($this);
        }

        return $this;
    }

    public function removeStage(Stages $stage): self
    {
        if ($this->stages->contains($stage)) {
            $this->stages->removeElement($stage);
            $stage->removeMonster($this);
        }

        return $this;
    }
}
