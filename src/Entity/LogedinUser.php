<?php

namespace App\Entity;

use App\Repository\LogedinUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: LogedinUserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class LogedinUser implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'logged_in_user', targetEntity: Umfrage::class)]
    private Collection $created_umfrages;

    #[ORM\OneToMany(mappedBy: 'Owner', targetEntity: User::class)]
    private Collection $users;

    public function __construct()
    {
        $this->created_umfrages = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Umfrage>
     */
    public function getCreatedUmfrages(): Collection
    {
        return $this->created_umfrages;
    }

    public function addCreatedUmfrage(Umfrage $createdUmfrage): self
    {
        if (!$this->created_umfrages->contains($createdUmfrage)) {
            $this->created_umfrages->add($createdUmfrage);
            $createdUmfrage->setLoggedInUser($this);
        }

        return $this;
    }

    public function removeCreatedUmfrage(Umfrage $createdUmfrage): self
    {
        if ($this->created_umfrages->removeElement($createdUmfrage)) {
            // set the owning side to null (unless already changed)
            if ($createdUmfrage->getLoggedInUser() === $this) {
                $createdUmfrage->setLoggedInUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setOwner($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getOwner() === $this) {
                $user->setOwner(null);
            }
        }

        return $this;
    }
}
