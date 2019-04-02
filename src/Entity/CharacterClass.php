<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CharacterClassRepository")
 * @ApiResource
 */
class CharacterClass
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Weapons", inversedBy="class_authorized")
     */
    private $authorized_weapons;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Move", inversedBy="class_authorized")
     */
    private $authorized_move;

    /**
     * @ORM\Column(type="integer")
     */
    private $HP;



    public function __construct()
    {
        $this->authorized_weapons = new ArrayCollection();
        $this->authorized_move = new ArrayCollection();
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

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Weapons[]
     */
    public function getAuthorizedWeapons(): Collection
    {
        return $this->authorized_weapons;
    }

    public function addAuthorizedWeapon(Weapons $authorizedWeapon): self
    {
        if (!$this->authorized_weapons->contains($authorizedWeapon)) {
            $this->authorized_weapons[] = $authorizedWeapon;
        }

        return $this;
    }

    public function removeAuthorizedWeapon(Weapons $authorizedWeapon): self
    {
        if ($this->authorized_weapons->contains($authorizedWeapon)) {
            $this->authorized_weapons->removeElement($authorizedWeapon);
        }

        return $this;
    }

    /**
     * @return Collection|Move[]
     */
    public function getAuthorizedMove(): Collection
    {
        return $this->authorized_move;
    }

    public function addAuthorizedMove(Move $authorizedMove): self
    {
        if (!$this->authorized_move->contains($authorizedMove)) {
            $this->authorized_move[] = $authorizedMove;
        }

        return $this;
    }

    public function removeAuthorizedMove(Move $authorizedMove): self
    {
        if ($this->authorized_move->contains($authorizedMove)) {
            $this->authorized_move->removeElement($authorizedMove);
        }

        return $this;
    }

    public function getHP(): ?int
    {
        return $this->HP;
    }

    public function setHP(int $HP): self
    {
        $this->HP = $HP;

        return $this;
    }


}
