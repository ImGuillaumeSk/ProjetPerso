<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
class Media
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idAPI = null;

    #[ORM\Column(length: 255)]
    private ?string $mediaType = null;

    #[ORM\OneToMany(mappedBy: 'idMedia', targetEntity: WatchedMedia::class)]
    private Collection $watchedMedias;

    #[ORM\OneToMany(mappedBy: 'idMedia', targetEntity: NextMedia::class)]
    private Collection $nextMedias;

    public function __construct()
    {
        $this->watchedMedias = new ArrayCollection();
        $this->nextMedias = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdAPI(): ?int
    {
        return $this->idAPI;
    }

    public function setIdAPI(int $idAPI): self
    {
        $this->idAPI = $idAPI;

        return $this;
    }

    public function getMediaType(): ?string
    {
        return $this->mediaType;
    }

    public function setMediaType(string $mediaType): self
    {
        $this->mediaType = $mediaType;

        return $this;
    }

    /**
     * @return Collection<int, WatchedMedia>
     */
    public function getWatchedMedias(): Collection
    {
        return $this->watchedMedias;
    }

    public function addWatchedMedia(WatchedMedia $watchedMedia): self
    {
        if (!$this->watchedMedias->contains($watchedMedia)) {
            $this->watchedMedias->add($watchedMedia);
            $watchedMedia->setIdMedia($this);
        }

        return $this;
    }

    public function removeWatchedMedia(WatchedMedia $watchedMedia): self
    {
        if ($this->watchedMedias->removeElement($watchedMedia)) {
            // set the owning side to null (unless already changed)
            if ($watchedMedia->getIdMedia() === $this) {
                $watchedMedia->setIdMedia(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, NextMedia>
     */
    public function getNextMedias(): Collection
    {
        return $this->nextMedias;
    }

    public function addNextMedia(NextMedia $nextMedia): self
    {
        if (!$this->nextMedias->contains($nextMedia)) {
            $this->nextMedias->add($nextMedia);
            $nextMedia->setIdMedia($this);
        }

        return $this;
    }

    public function removeNextMedia(NextMedia $nextMedia): self
    {
        if ($this->nextMedias->removeElement($nextMedia)) {
            // set the owning side to null (unless already changed)
            if ($nextMedia->getIdMedia() === $this) {
                $nextMedia->setIdMedia(null);
            }
        }

        return $this;
    }
}
