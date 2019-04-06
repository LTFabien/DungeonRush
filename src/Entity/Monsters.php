<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MonstersRepository")
 * @ApiResource
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
     * @Groups("Dungeons")
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Groups("Dungeons")
     */
    private $HPmax;

    /**
     * @ORM\Column(type="integer")
     * @Groups("Dungeons")
     */
    private $HP;

    /**
     * @ORM\Column(type="integer")
     * @Groups("Dungeons")
     */
    private $MPmax;

    /**
     * @ORM\Column(type="integer")
     * @Groups("Dungeons")
     */
    private $MP;

    /**
     * @ORM\Column(type="integer")
     * @Groups("Dungeons")
     */
    private $Strength;

    /**
     * @ORM\Column(type="integer")
     * @Groups("Dungeons")
     */
    private $Intelligence;

    /**
     * @ORM\Column(type="integer")
     * @Groups("Dungeons")
     */
    private $Spirit;

    /**
     * @ORM\Column(type="integer")
     * @Groups("Dungeons")
     */
    private $Vitality;

    /**
     * @ORM\Column(type="integer")
     * @Groups("Dungeons")
     */
    private $Speed;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Stages", mappedBy="Monster")
     */
    private $stages;

    /**
     * @ORM\Column(type="integer")
     * @Groups("Dungeons")
     */
    private $Exp;

    /**
     * @ORM\Column(type="integer")
     * @Groups("Dungeons")
     */
    private $Gold;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Move", inversedBy="monsters")
     * @Groups("Dungeons")
     * @ApiSubresource
     */
    private $move;

    public function __construct()
    {
        $this->stages = new ArrayCollection();
        $this->move = new ArrayCollection();
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

    public function getExp(): ?int
    {
        return $this->Exp;
    }

    public function setExp(int $Exp): self
    {
        $this->Exp = $Exp;

        return $this;
    }

    public function getGold(): ?int
    {
        return $this->Gold;
    }

    public function setGold(int $Gold): self
    {
        $this->Gold = $Gold;

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
}
