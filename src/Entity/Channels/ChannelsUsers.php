<?php

namespace App\Entity\Channels;

use App\Entity\Users\Users;
use App\Repository\Channels\ChannelsUsersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChannelsUsersRepository::class)
 * @ORM\Table(name="channels_users", schema="channels")
 */
class ChannelsUsers
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Channels::class, inversedBy="channelsUsers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $channel;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="channelsUsers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    /**
     * @ORM\Column(type="smallint")
     */
    private $role;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $read_at;

    /**
     * @ORM\Column(type="smallint")
     */
    private $notify;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $ghost;

    public function __construct()
    {
        $this->ghost = false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChannel(): ?Channels
    {
        return $this->channel;
    }

    public function setChannel(?Channels $channel): self
    {
        $this->channel = $channel;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getRole(): ?int
    {
        return $this->role;
    }

    public function setRole(int $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getReadAt(): ?\DateTimeInterface
    {
        return $this->read_at;
    }

    public function setReadAt(\DateTimeInterface $read_at): self
    {
        $this->read_at = $read_at;

        return $this;
    }

    public function getNotify(): ?int
    {
        return $this->notify;
    }

    public function setNotify(int $notify): self
    {
        $this->notify = $notify;

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
}
