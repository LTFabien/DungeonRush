<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use mysql_xdevapi\CollectionAdd;

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
    private $HPmax;

    /**
     * @ORM\Column(type="integer")
     */
    private $HP;

    /**
     * @ORM\Column(type="integer")
     */
    private $MPmax;

    /**
     * @ORM\Column(type="integer")
     */
    private $MP;

    /**
     * @ORM\Column(type="integer")
     */
    private $Strength;

    /**
     * @ORM\Column(type="integer")
     */
    private $Intelligence;

    /**
     * @ORM\Column(type="integer")
     */
    private $Speed;

    /**
     * @ORM\Column(type="integer")
     */
    private $Vitality;

    /**
     * @ORM\Column(type="integer")
     */
    private $Spirit;



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



    public function getStats()
    {
        $stats = [$this->getHPmax(),
            $this->getHP(),
            $this->getMPmax(),
            $this->getMP(),
            $this->getStrength(),
            $this->getIntelligence(),
            $this->getSpeed(),
            $this->getVitality(),
            $this->getSpirit()];
        return $stats;
    }

    public function setStats($stats)
    {
        $this->setHPmax($stats[0]);
        $this->setHP($stats[1]);
        $this->setMPmax($stats[2]);
        $this->setMP($stats[3]);
        $this->setStrength($stats[4]);
        $this->setIntelligence($stats[5]);
        $this->setSpeed($stats[6]);
        $this->setVitality($stats[7]);
        $this->setSpirit($stats[8]);
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


    public function getHPmax(): ?int
    {
        return $this->HPmax;
    }

    public function setHPmax(int $HPmax): self
    {
        $this->HPmax = $HPmax;

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


    public function getMPmax(): ?int
    {
        return $this->MPmax;
    }

    public function setMPmax(int $MPmax): self
    {
        $this->MPmax = $MPmax;

        return $this;
    }

    public function getMP(): ?int
    {
        return $this->MP;
    }

    public function setMP(int $MP): self
    {
        $this->MP = $MP;

        return $this;
    }

    public function getStrength(): ?int
    {
        return $this->Strength;
    }

    public function setStrength(int $Strength): self
    {
        $this->Strength = $Strength;

        return $this;
    }

    public function getIntelligence(): ?int
    {
        return $this->Intelligence;
    }

    public function setIntelligence(int $Intelligence): self
    {
        $this->Intelligence = $Intelligence;

        return $this;
    }

    public function getSpeed(): ?int
    {
        return $this->Speed;
    }

    public function setSpeed(int $Speed): self
    {
        $this->Speed = $Speed;

        return $this;
    }

    public function getVitality(): ?int
    {
        return $this->Vitality;
    }

    public function setVitality(int $Vitality): self
    {
        $this->Vitality = $Vitality;

        return $this;
    }

    public function getSpirit(): ?int
    {
        return $this->Spirit;
    }

    public function setSpirit(int $Spirit): self
    {
        $this->Spirit = $Spirit;

        return $this;
    }


}
