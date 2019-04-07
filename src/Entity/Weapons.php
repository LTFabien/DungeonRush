<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WeaponsRepository")
 * @ApiResource
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
     * @Groups("Team")
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


    /**
     * @ORM\Column(type="integer")
     * @Groups("Team")
     */
    private $damage;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("Team")
     */
    private $element;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $lvl;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Player", mappedBy="weapon")
     */
    private $players;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\InventoryWeapons", mappedBy="weapons")
     */
    private $quantity;

    public function __construct()
    {
        $this->class_authorized = new ArrayCollection();
        $this->players = new ArrayCollection();
        $this->quantity = new ArrayCollection();
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

    public function getDamage(): ?int
    {
        return $this->damage;
    }

    public function setDamage(int $damage): self
    {
        $this->damage = $damage;

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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

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
            $player->setWeapon($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->players->contains($player)) {
            $this->players->removeElement($player);
            // set the owning side to null (unless already changed)
            if ($player->getWeapon() === $this) {
                $player->setWeapon(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|InventoryWeapons[]
     */
    public function getQuantity(): Collection
    {
        return $this->quantity;
    }

    public function addQuantity(InventoryWeapons $quantity): self
    {
        if (!$this->quantity->contains($quantity)) {
            $this->quantity[] = $quantity;
            $quantity->setWeapons($this);
        }

        return $this;
    }

    public function removeQuantity(InventoryWeapons $quantity): self
    {
        if ($this->quantity->contains($quantity)) {
            $this->quantity->removeElement($quantity);
            // set the owning side to null (unless already changed)
            if ($quantity->getWeapons() === $this) {
                $quantity->setWeapons(null);
            }
        }

        return $this;
    }
}
