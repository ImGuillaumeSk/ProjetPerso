<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
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

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $is_visible = null;

    #[ORM\Column(length: 255)]
    private ?string $Titre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateSortie = null;

    #[ORM\Column]
    private ?int $duree = null;

    #[ORM\Column]
    private ?float $note = null;

    #[ORM\OneToMany(mappedBy: 'idMedia', targetEntity: WatchedMedia::class)]
    private Collection $watchedMedias;

    #[ORM\OneToMany(mappedBy: 'idMedia', targetEntity: NextMedia::class)]
    private Collection $nextMedias;

    #[ORM\ManyToOne(inversedBy: 'medias')]
    private ?User $auteur = null;


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
    
    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

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

    public function isIsVisible(): ?bool
    {
        return $this->is_visible;
    }
    
    public function setIsVisible(?bool $is_visible): self
    {
        $this->is_visible = $is_visible;
        
        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }
    
    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;
        
        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->dateSortie;
    }

    public function setDateSortie(\DateTimeInterface $dateSortie): self
    {
        $this->dateSortie = $dateSortie;
        
        return $this;
    }
    
    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;
        
        return $this;
    }
    
    public function getNote(): ?float
    {
        return $this->note;
    }
    
    public function setNote(float $note): self
    {
        $this->note = $note;
        
        return $this;
    }
    
    public function getAuteur(): ?User
    {
        return $this->auteur;
    }
    
    public function setAuteur(?User $auteur): self
    {
        $this->auteur = $auteur;
        
        return $this;
    }
    
        /**
         *
         * @param User $user
         * @return boolean
         */
        public function isWatchedMedias(User $user): bool
        {
            foreach ($this->watchedMedias as $watchedMedias) {
                if ($watchedMedias->getIdUser() === $user) return true;
            }
            return false;
        }
    
        /**
         *
         * @param User $user
         * @return boolean
         */
        public function isNextMedias(User $user): bool
        {
            foreach ($this->nextMedias as $nextMedias) {
                if ($nextMedias->getIdUser() === $user) return true;
            }
            return false;
        }
}
