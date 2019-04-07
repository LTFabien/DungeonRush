<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ArmorRepository")
 */
class Armor
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("Team")
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Groups("Team")
     */
    private $defense;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Inventory", mappedBy="armors")
     */
    private $inventories;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CharacterClass", mappedBy="authorized_armors")
     */
    private $characterClasses;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("Team")
     */
    private $element;

    /**
     * @ORM\Column(type="integer")
     */
    private $lvl;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Player", mappedBy="armor")
     */
    private $players;

    public function __construct()
    {
        $this->inventories = new ArrayCollection();
        $this->characterClasses = new ArrayCollection();
        $this->players = new ArrayCollection();
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

    public function getDefense(): ?int
    {
        return $this->defense;
    }

    public function setDefense(int $defense): self
    {
        $this->defense = $defense;

        return $this;
    }

    /**
     * @return Collection|Inventory[]
     */
    public function getInventories(): Collection
    {
        return $this->inventories;
    }

    public function addInventory(Inventory $inventory): self
    {
        if (!$this->inventories->contains($inventory)) {
            $this->inventories[] = $inventory;
            $inventory->addArmor($this);
        }

        return $this;
    }

    public function removeInventory(Inventory $inventory): self
    {
        if ($this->inventories->contains($inventory)) {
            $this->inventories->removeElement($inventory);
            $inventory->removeArmor($this);
        }

        return $this;
    }

    /**
     * @return Collection|CharacterClass[]
     */
    public function getCharacterClasses(): Collection
    {
        return $this->characterClasses;
    }

    public function addCharacterClass(CharacterClass $characterClass): self
    {
        if (!$this->characterClasses->contains($characterClass)) {
            $this->characterClasses[] = $characterClass;
            $characterClass->addAuthorizedArmor($this);
        }

        return $this;
    }

    public function removeCharacterClass(CharacterClass $characterClass): self
    {
        if ($this->characterClasses->contains($characterClass)) {
            $this->characterClasses->removeElement($characterClass);
            $characterClass->removeAuthorizedArmor($this);
        }

        return $this;
    }

    public function getElement(): ?string
    {
        return $this->element;
    }

    public function setElement(string $element): self
    {
        $this->element = $element;

        return $this;
    }

    public function getLvl(): ?int
    {
        return $this->lvl;
    }

    public function setLvl(int $lvl): self
    {
        $this->lvl = $lvl;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|Player[]
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Player $player): self
    {
        if (!$this->players->contains($player)) {
            $this->players[] = $player;
            $player->setArmor($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->players->contains($player)) {
            $this->players->removeElement($player);
            // set the owning side to null (unless already changed)
            if ($player->getArmor() === $this) {
                $player->setArmor(null);
            }
        }

        return $this;
    }
}
