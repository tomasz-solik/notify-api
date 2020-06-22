<?php

namespace App\Entity\Channels;

use App\Repository\Channels\ChannelsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChannelsRepository::class)
 * @ORM\Table(name="channels", schema="channels")
 */
class Channels
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $path_to_icon;

    /**
     * @ORM\Column(type="datetime", options={"default" : "now()"})
     */
    private $created_at;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $ghost;

    /**
     * @ORM\OneToMany(targetEntity=News::class, mappedBy="channel")
     */
    private $news;

    /**
     * @ORM\OneToMany(targetEntity=ChannelsUsers::class, mappedBy="channel")
     */
    private $channelsUsers;

    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->ghost = false;
        $this->news = new ArrayCollection();
        $this->channelsUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
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

    public function getPathToIcon(): ?string
    {
        return $this->path_to_icon;
    }

    public function setPathToIcon(string $path_to_icon): self
    {
        $this->path_to_icon = $path_to_icon;

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
     * @return Collection|News[]
     */
    public function getNews(): Collection
    {
        return $this->news;
    }

    public function addNews(News $news): self
    {
        if (!$this->news->contains($news)) {
            $this->news[] = $news;
            $news->setChannel($this);
        }

        return $this;
    }

    public function removeNews(News $news): self
    {
        if ($this->news->contains($news)) {
            $this->news->removeElement($news);
            // set the owning side to null (unless already changed)
            if ($news->getChannel() === $this) {
                $news->setChannel(null);
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
            $channelsUser->setChannel($this);
        }

        return $this;
    }

    public function removeChannelsUser(ChannelsUsers $channelsUser): self
    {
        if ($this->channelsUsers->contains($channelsUser)) {
            $this->channelsUsers->removeElement($channelsUser);
            // set the owning side to null (unless already changed)
            if ($channelsUser->getChannel() === $this) {
                $channelsUser->setChannel(null);
            }
        }

        return $this;
    }
}
