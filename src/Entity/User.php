<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 *     fields={"email"},
 *     message="L'email que vous avez saisi est déjà utilisé",
 * )
 * @ApiResource
 */
class User implements UserInterface
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
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=8, minMessage="Votre mot de passe doit contenir minimum 8 caractères")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Vous n'avez pas tapé le même mot de passe")
     */
    public $confirm_password;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = ['ROLE_USER'];

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Team", mappedBy="user", cascade={"persist", "remove"})
     */
    private $team;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles(): array
    {
        $roles=$this->roles;
        return array_unique($roles);
    }


    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {}

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {}

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(Team $team): self
    {
        $this->team = $team;

        // set the owning side of the relation if necessary
        if ($this !== $team->getUser()) {
            $team->setUser($this);
        }

        return $this;
    }


}
