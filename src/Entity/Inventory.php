<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InventoryRepository")
 * @ApiResource
 */
class Inventory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Weapons", inversedBy="inventories")
     * @ApiSubresource
     */
    private $weapons;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Consumables", inversedBy="inventories")
     * @ApiSubresource
     * @Groups("Team")
     */
    private $consumables;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Armor", inversedBy="inventories")
     */
    private $armors;

    public function __construct()
    {
        $this->weapons = new ArrayCollection();
        $this->consumables = new ArrayCollection();
        $this->armors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Weapons[]
     */
    public function getWeapons(): Collection
    {
        return $this->weapons;
    }

    public function addWeapon(Weapons $weapon): self
    {
        if (!$this->weapons->contains($weapon)) {
            $this->weapons[] = $weapon;
        }

        return $this;
    }

    public function removeWeapon(Weapons $weapon): self
    {
        if ($this->weapons->contains($weapon)) {
            $this->weapons->removeElement($weapon);
        }

        return $this;
    }

    /**
     * @return Collection|Consumables[]
     */
    public function getConsumables(): Collection
    {
        return $this->consumables;
    }

    public function addConsumable(Consumables $consumable): self
    {
        if (!$this->consumables->contains($consumable)) {
            $this->consumables[] = $consumable;
        }

        return $this;
    }

    public function removeConsumable(Consumables $consumable): self
    {
        if ($this->consumables->contains($consumable)) {
            $this->consumables->removeElement($consumable);
        }

        return $this;
    }

    /**
     * @return Collection|Armor[]
     */
    public function getArmors(): Collection
    {
        return $this->armors;
    }

    public function addArmor(Armor $armor): self
    {
        if (!$this->armors->contains($armor)) {
            $this->armors[] = $armor;
        }

        return $this;
    }

    public function removeArmor(Armor $armor): self
    {
        if ($this->armors->contains($armor)) {
            $this->armors->removeElement($armor);
        }

        return $this;
    }
}
