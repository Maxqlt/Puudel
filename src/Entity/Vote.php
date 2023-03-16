<?php

namespace App\Entity;

use App\Repository\VoteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoteRepository::class)]
class Vote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'votes')]
    private ?Termin $termin_id = null;

    #[ORM\ManyToOne(inversedBy: 'votes')]
    private ?User $user_id = null;

    #[ORM\Column(length: 255)]
    private ?string $answer = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTerminId(): ?Termin
    {
        return $this->termin_id;
    }

    public function setTerminId(?Termin $termin_id): self
    {
        $this->termin_id = $termin_id;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): self
    {
        $this->answer = $answer;

        return $this;
    }
}
