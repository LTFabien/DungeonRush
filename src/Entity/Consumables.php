<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConsumablesRepository")
 * @ApiResource
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
     * @Groups("Team")
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("Team")
     */
    private $stat_buffed;

    /**
     * @ORM\Column(type="integer")
     * @Groups("Team")
     */
    private $number_buff;


    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("Team")
     */
    private $turn;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\InventoryConsumables", mappedBy="consumables")
     */
    private $quantity;

    public function __construct()
    {
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


    public function getTurn(): ?int
    {
        return $this->turn;
    }

    public function setTurn(?int $turn): self
    {
        $this->turn = $turn;

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
     * @return Collection|InventoryConsumables[]
     */
    public function getQuantity(): Collection
    {
        return $this->quantity;
    }

    public function addQuantity(InventoryConsumables $quantity): self
    {
        if (!$this->quantity->contains($quantity)) {
            $this->quantity[] = $quantity;
            $quantity->setConsumables($this);
        }

        return $this;
    }

    public function removeQuantity(InventoryConsumables $quantity): self
    {
        if ($this->quantity->contains($quantity)) {
            $this->quantity->removeElement($quantity);
            // set the owning side to null (unless already changed)
            if ($quantity->getConsumables() === $this) {
                $quantity->setConsumables(null);
            }
        }

        return $this;
    }
}
