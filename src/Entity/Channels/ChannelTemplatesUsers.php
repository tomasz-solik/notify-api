<?php

namespace App\Entity\Channels;

use App\Entity\Users\Users;
use App\Repository\Channels\ChannelTemplatesUsersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChannelTemplatesUsersRepository::class)
 * @ORM\Table(name="channel_templates_users", schema="channels")
 */
class ChannelTemplatesUsers
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="channelTemplatesUsers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity=ChannelTemplates::class, inversedBy="channelTemplatesUsers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $channelTemplate;

    /**
     * @ORM\Column(type="datetime", options={"default" : "now()"})
     */
    private $created_at;

    public function __construct()
    {
        $this->created_at = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getChannelTemplate(): ?ChannelTemplates
    {
        return $this->channelTemplate;
    }

    public function setChannelTemplate(?ChannelTemplates $channelTemplate): self
    {
        $this->channelTemplate = $channelTemplate;

        return $this;
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
}
