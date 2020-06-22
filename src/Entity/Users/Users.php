<?php

namespace App\Entity\Users;

use App\Entity\Channels\ChannelTemplatesUsers;
use App\Entity\Channels\ChannelsUsers;
use App\Entity\Channels\NewsReads;
use App\Repository\Users\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 * @ORM\Table(name="users", schema="users")
 */
class Users implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint", options={"default":1})
     */
    private $role;

    /**
     * @ORM\Column(type="string", length=150, unique=true, options={"unsigned":true})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=150, unique=true, options={"unsigned":true})
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $salt;

    /**
     * @ORM\Column(type="datetime", options={"default" : "now()"})
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $blocked;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $test;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $ghost;

    /**
     * @ORM\OneToMany(targetEntity=NewsReads::class, mappedBy="users")
     */
    private $newsReads;

    /**
     * @ORM\OneToMany(targetEntity=ChannelsUsers::class, mappedBy="users")
     */
    private $channelsUsers;

    /**
     * @ORM\OneToMany(targetEntity=ChannelTemplatesUsers::class, mappedBy="users")
     */
    private $channelTemplatesUsers;

    public function __construct()
    {
        $this->role = UsersRepository::ROLE_USER;
        $this->salt = md5(time().random_bytes(5));
        $this->created_at = new \DateTime();
        $this->blocked = false;
        $this->test = false;
        $this->ghost = false;
        $this->newsReads = new ArrayCollection();
        $this->channelsUsers = new ArrayCollection();
        $this->channelTemplatesUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoles()
    {
        return $this->getRole();
    }

    public function getRole()
    {
        switch ($this->role) {
            case UsersRepository::ROLE_USER:
                return ['ROLE_USER'];
            case UsersRepository::ROLE_MODERATOR:
                return ['ROLE_USER', 'ROLE_MODERATOR'];
            case UsersRepository::ROLE_ADMIN:
                return ['ROLE_USER', 'ROLE_MODERATOR', 'ROLE_ADMIN'];
            default:
                return ['ROLE_USER'];
        }
    }

    public function setRole(int $role): self
    {
        $this->role = $role;

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

    public function getSalt(): ?string
    {
        return $this->salt;
    }

    public function setSalt(string $salt): self
    {
        $this->salt = $salt;

        return $this;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getBlocked(): ?bool
    {
        return $this->blocked;
    }

    public function setBlocked(bool $blocked): self
    {
        $this->blocked = $blocked;

        return $this;
    }

    public function getTest(): ?bool
    {
        return $this->test;
    }

    public function setTest(bool $test): self
    {
        $this->test = $test;

        return $this;
    }

    public function getGhost(): ?bool
    {
        return $this->ghost;
    }

    public function setGhost(bool $ghost): self
    {
        $this->ghost = $ghost;

        return $this;
    }

    /**
     * @return Collection|NewsReads[]
     */
    public function getNewsReads(): Collection
    {
        return $this->newsReads;
    }

    public function addNewsRead(NewsReads $newsRead): self
    {
        if (!$this->newsReads->contains($newsRead)) {
            $this->newsReads[] = $newsRead;
            $newsRead->setUsers($this);
        }

        return $this;
    }

    public function removeNewsRead(NewsReads $newsRead): self
    {
        if ($this->newsReads->contains($newsRead)) {
            $this->newsReads->removeElement($newsRead);
            // set the owning side to null (unless already changed)
            if ($newsRead->getUsers() === $this) {
                $newsRead->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ChannelsUsers[]
     */
    public function getChannelsUsers(): Collection
    {
        return $this->channelsUsers;
    }

    public function addChannelsUser(ChannelsUsers $channelsUser): self
    {
        if (!$this->channelsUsers->contains($channelsUser)) {
            $this->channelsUsers[] = $channelsUser;
            $channelsUser->setUsers($this);
        }

        return $this;
    }

    public function removeChannelsUser(ChannelsUsers $channelsUser): self
    {
        if ($this->channelsUsers->contains($channelsUser)) {
            $this->channelsUsers->removeElement($channelsUser);
            // set the owning side to null (unless already changed)
            if ($channelsUser->getUsers() === $this) {
                $channelsUser->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ChannelTemplatesUsers[]
     */
    public function getChannelTemplatesUsers(): Collection
    {
        return $this->channelTemplatesUsers;
    }

    public function addChannelTemplatesUser(ChannelTemplatesUsers $channelTemplatesUser): self
    {
        if (!$this->channelTemplatesUsers->contains($channelTemplatesUser)) {
            $this->channelTemplatesUsers[] = $channelTemplatesUser;
            $channelTemplatesUser->setUsers($this);
        }

        return $this;
    }

    public function removeChannelTemplatesUser(ChannelTemplatesUsers $channelTemplatesUser): self
    {
        if ($this->channelTemplatesUsers->contains($channelTemplatesUser)) {
            $this->channelTemplatesUsers->removeElement($channelTemplatesUser);
            // set the owning side to null (unless already changed)
            if ($channelTemplatesUser->getUsers() === $this) {
                $channelTemplatesUser->setUsers(null);
            }
        }

        return $this;
    }
}
