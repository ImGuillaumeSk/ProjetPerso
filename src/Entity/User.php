<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\OneToMany(mappedBy: 'idUser', targetEntity: WatchedMedia::class)]
    private Collection $watchedMedias;

    #[ORM\OneToMany(mappedBy: 'idUser', targetEntity: NextMedia::class)]
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

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
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
            $watchedMedia->setIdUser($this);
        }

        return $this;
    }

    public function removeWatchedMedia(WatchedMedia $watchedMedia): self
    {
        if ($this->watchedMedias->removeElement($watchedMedia)) {
            // set the owning side to null (unless already changed)
            if ($watchedMedia->getIdUser() === $this) {
                $watchedMedia->setIdUser(null);
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
            $nextMedia->setIdUser($this);
        }

        return $this;
    }

    public function removeNextMedia(NextMedia $nextMedia): self
    {
        if ($this->nextMedias->removeElement($nextMedia)) {
            // set the owning side to null (unless already changed)
            if ($nextMedia->getIdUser() === $this) {
                $nextMedia->setIdUser(null);
            }
        }

        return $this;
    }
}
