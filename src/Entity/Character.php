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
}
