<?php

namespace App\Entity;

use App\Repository\UmfrageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UmfrageRepository::class)]
class Umfrage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $decription = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $expiration_date = null;

    #[ORM\OneToMany(mappedBy: 'umfrage_id', targetEntity: Termin::class, cascade: ['persist', 'remove']), ]
    private Collection $termins;

    public function __construct()
    {
        $this->termins = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->decription;
    }

    public function setDescription(?string $decription): self
    {
        $this->decription = $decription;

        return $this;
    }

    public function getExpiration_date(): ?\DateTimeInterface
    {
        return $this->expiration_date;
    }

    public function setExpirationDate(\DateTimeInterface $expiration_date): self
    {
        $this->expiration_date = $expiration_date;

        return $this;
    }

    /**
     * @return Collection<int, Termin>
     */
    public function getTermins(): Collection
    {
        return $this->termins;
    }

    public function addTermin(Termin $termin): self
    {
        if (!$this->termins->contains($termin)) {
            $this->termins->add($termin);
            $termin->setUmfrageId($this);
        }

        return $this;
    }

    public function removeTermin(Termin $termin): self
    {
        if ($this->termins->removeElement($termin)) {
            // set the owning side to null (unless already changed)
            if ($termin->getUmfrageId() === $this) {
                $termin->setUmfrageId(null);
            }
        }

        return $this;
    }
}
