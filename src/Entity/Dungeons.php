<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DungeonsRepository")
 */
class Dungeons
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
     * @ORM\OneToMany(targetEntity="App\Entity\Stages", mappedBy="dungeons")
     */
    private $Stages;

    public function __construct()
    {
        $this->Stages = new ArrayCollection();
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
     * @return Collection|Stages[]
     */
    public function getStages(): Collection
    {
        return $this->Stages;
    }

    public function addStage(Stages $stage): self
    {
        if (!$this->Stages->contains($stage)) {
            $this->Stages[] = $stage;
            $stage->setDungeons($this);
        }

        return $this;
    }

    public function removeStage(Stages $stage): self
    {
        if ($this->Stages->contains($stage)) {
            $this->Stages->removeElement($stage);
            // set the owning side to null (unless already changed)
            if ($stage->getDungeons() === $this) {
                $stage->setDungeons(null);
            }
        }

        return $this;
    }
}
