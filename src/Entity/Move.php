<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MoveRepository")
 */
class Move
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CharacterClass", mappedBy="authorized")
     */
    private $class_authorized;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Character", mappedBy="move_learned")
     */
    private $character_taught;

    public function __construct()
    {
        $this->class_authorized = new ArrayCollection();
        $this->character_taught = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|CharacterClass[]
     */
    public function getClassAuthorized(): Collection
    {
        return $this->class_authorized;
    }

    public function addClassAuthorized(CharacterClass $classAuthorized): self
    {
        if (!$this->class_authorized->contains($classAuthorized)) {
            $this->class_authorized[] = $classAuthorized;
            $classAuthorized->addAuthorizedMove($this);
        }

        return $this;
    }

    public function removeClassAuthorized(CharacterClass $classAuthorized): self
    {
        if ($this->class_authorized->contains($classAuthorized)) {
            $this->class_authorized->removeElement($classAuthorized);
            $classAuthorized->removeAuthorizedMove($this);
        }

        return $this;
    }

    /**
     * @return Collection|Character[]
     */
    public function getCharacterTaught(): Collection
    {
        return $this->character_taught;
    }

    public function addCharacterTaught(Character $characterTaught): self
    {
        if (!$this->character_taught->contains($characterTaught)) {
            $this->character_taught[] = $characterTaught;
            $characterTaught->addMoveLearned($this);
        }

        return $this;
    }

    public function removeCharacterTaught(Character $characterTaught): self
    {
        if ($this->character_taught->contains($characterTaught)) {
            $this->character_taught->removeElement($characterTaught);
            $characterTaught->removeMoveLearned($this);
        }

        return $this;
    }
}
