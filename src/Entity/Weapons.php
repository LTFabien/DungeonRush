<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WeaponsRepository")
 */
class Weapons
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
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CharacterClass", mappedBy="authorized_weapons")
     */
    private $class_authorized;

    public function __construct()
    {
        $this->class_authorized = new ArrayCollection();
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
            $classAuthorized->addAuthorizedWeapon($this);
        }

        return $this;
    }

    public function removeClassAuthorized(CharacterClass $classAuthorized): self
    {
        if ($this->class_authorized->contains($classAuthorized)) {
            $this->class_authorized->removeElement($classAuthorized);
            $classAuthorized->removeAuthorizedWeapon($this);
        }

        return $this;
    }
}
