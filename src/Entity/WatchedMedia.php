<?php

namespace App\Entity;

use App\Repository\WatchedMediaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WatchedMediaRepository::class)]
class WatchedMedia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'watchedMedias')]
    private ?Media $idMedia = null;

    #[ORM\ManyToOne(inversedBy: 'watchedMedias')]
    private ?User $idUser = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateAdded = null;

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

    public function getDateAdded(): ?\DateTimeInterface
    {
        return $this->dateAdded;
    }

    public function setDateAdded(\DateTimeInterface $dateAdded): self
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }
}
