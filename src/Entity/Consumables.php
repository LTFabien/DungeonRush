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
     * @Groups("Team")
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
    private $stat;

    /**
     * @ORM\Column(type="integer")
     * @Groups("Team")
     */
    private $number;


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

    public function getStat(): ?string
    {
        return $this->stat;
    }

    public function setStat(string $stat): self
    {
        $this->stat = $stat;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

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
