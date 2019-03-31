<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 * @ApiResource
 */
class Team
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
     * @ORM\OneToOne(targetEntity="App\Entity\Inventory", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Inventory;

    /**
     * @ORM\Column(type="integer")
     */
    private $Money;

    /**
     * @ORM\ManyToMany(targetEntity="Player", inversedBy="teams")
     */
    private $characters;


    public function __construct()
    {
        $this->characters = new ArrayCollection();
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

    public function getInventory(): ?Inventory
    {
        return $this->Inventory;
    }

    public function setInventory(Inventory $Inventory): self
    {
        $this->Inventory = $Inventory;

        return $this;
    }

    public function getMoney(): ?int
    {
        return $this->Money;
    }

    public function setMoney(int $Money): self
    {
        $this->Money = $Money;

        return $this;
    }

    /**
     * @return Collection|Player[]
     */
    public function getCharacters(): Collection
    {
        return $this->characters;
    }

    public function addCharacter(Player $character): self
    {
        if (!$this->characters->contains($character)) {
            $this->characters[] = $character;
        }

        return $this;
    }

    public function removeCharacter(Player $character): self
    {
        if ($this->characters->contains($character)) {
            $this->characters->removeElement($character);
        }

        return $this;
    }
}
