<?php

namespace App\Entity;

use App\Repository\NextMediaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NextMediaRepository::class)]
class NextMedia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'nextMedias')]
    private ?Media $idMedia = null;

    #[ORM\ManyToOne(inversedBy: 'nextMedias')]
    private ?User $idUser = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMedia(): ?Media
    {
        return $this->idMedia;
    }

    public function setIdMedia(?Media $idMedia): self
    {
        $this->idMedia = $idMedia;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }
}
