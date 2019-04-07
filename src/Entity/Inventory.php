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
     * @Groups("Team")
     */
    private $id;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\InventoryWeapons", mappedBy="inventory",cascade={"persist","merge"})
     */
    private $weapons;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\InventoryArmor", mappedBy="inventory",cascade={"persist","merge"})
     */
    private $armor;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\InventoryConsumables", mappedBy="inventory",cascade={"persist","merge"})
     * @ApiSubresource
     * @Groups({"Team","write"})
     */
    private $consumables;


    public function __construct()
    {
        $this->weapons = new ArrayCollection();
        $this->armor = new ArrayCollection();
        $this->consumables = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return Collection|InventoryWeapons[]
     */
    public function getWeapons(): Collection
    {
        return $this->weapons;
    }

    public function addWeapon(Weapons $weapon): self
    {
        $tmp=new InventoryWeapons();
        $tmp->setWeapons($weapon);
        if (!$this->weapons->contains($weapon)) {
            $this->weapons[] = $tmp;
            $tmp->setInventory($this);
            $tmp->setQuantite(1);
        }

        return $this;
    }

    public function removeWeapon(InventoryWeapons $weapon): self
    {
        if ($this->weapons->contains($weapon)) {
            $this->weapons->removeElement($weapon);
            // set the owning side to null (unless already changed)
            if ($weapon->getInventory() === $this) {
                $weapon->setInventory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|InventoryArmor[]
     */
    public function getArmor(): Collection
    {
        return $this->armor;
    }

    public function addArmor(Armor $armor): self
    {
        $tmp=new InventoryArmor();
        $tmp->setArmor($armor);
        if (!$this->armor->contains($armor)) {
            $this->armor[] = $tmp;
            $tmp->setInventory($this);
            $tmp->setQuantite(1);
        }

        return $this;
    }

    public function removeArmor(InventoryArmor $armor): self
    {
        if ($this->armor->contains($armor)) {
            $this->armor->removeElement($armor);
            // set the owning side to null (unless already changed)
            if ($armor->getInventory() === $this) {
                $armor->setInventory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|InventoryConsumables[]
     */
    public function getConsumables(): Collection
    {
        return $this->consumables;
    }

    public function addConsumable(Consumables $consumable): self
    {       $tmp=new InventoryConsumables();
            $tmp->setConsumables($consumable);
        if (!$this->consumables->contains($tmp)) {
            $this->consumables[] = $tmp;
            $tmp->setInventory($this);
            $tmp->setQuantite(1);
        }
        return $this;
    }

    public function removeConsumable(InventoryConsumables $consumable): self
    {
        if ($this->consumables->contains($consumable)) {
            $this->consumables->removeElement($consumable);
            // set the owning side to null (unless already changed)
            if ($consumable->getInventory() === $this) {
                $consumable->setInventory(null);
            }
        }

        return $this;
    }

}
