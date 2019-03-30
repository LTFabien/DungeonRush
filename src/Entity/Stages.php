<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StagesRepository")
 */
class Stages
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Monsters", inversedBy="stages")
     */
    private $Monster;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Dungeons", inversedBy="Stages")
     */
    private $dungeons;

    public function __construct()
    {
        $this->Monster = new ArrayCollection();
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

    /**
     * @return Collection|Monsters[]
     */
    public function getMonster(): Collection
    {
        return $this->Monster;
    }

    public function addMonster(Monsters $monster): self
    {
        if (!$this->Monster->contains($monster)) {
            $this->Monster[] = $monster;
        }

        return $this;
    }

    public function removeMonster(Monsters $monster): self
    {
        if ($this->Monster->contains($monster)) {
            $this->Monster->removeElement($monster);
        }

        return $this;
    }

    public function getDungeons(): ?Dungeons
    {
        return $this->dungeons;
    }

    public function setDungeons(?Dungeons $dungeons): self
    {
        $this->dungeons = $dungeons;

        return $this;
    }
}
