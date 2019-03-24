<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConsumablesRepository")
 */
class Consumables
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
     * @ORM\Column(type="string", length=255)
     */
    private $stat_buffed;

    /**
     * @ORM\Column(type="integer")
     */
    private $number_buff;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Inventory", mappedBy="consumables")
     */
    private $inventories;

    public function __construct()
    {
        $this->inventories = new ArrayCollection();
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

    public function getStatBuffed(): ?string
    {
        return $this->stat_buffed;
    }

    public function setStatBuffed(string $stat_buffed): self
    {
        $this->stat_buffed = $stat_buffed;

        return $this;
    }

    public function getNumberBuff(): ?int
    {
        return $this->number_buff;
    }

    public function setNumberBuff(int $number_buff): self
    {
        $this->number_buff = $number_buff;

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
            $inventory->addConsumable($this);
        }

        return $this;
    }

    public function removeInventory(Inventory $inventory): self
    {
        if ($this->inventories->contains($inventory)) {
            $this->inventories->removeElement($inventory);
            $inventory->removeConsumable($this);
        }

        return $this;
    }
}
