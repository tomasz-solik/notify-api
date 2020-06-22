<?php

namespace App\Entity\Channels;

use App\Repository\Channels\ChannelTemplatesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChannelTemplatesRepository::class)
 * @ORM\Table(name="channel_template", schema="channels")
 */
class ChannelTemplates
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $path_to_image;

    /**
     * @ORM\Column(type="smallint")
     */
    private $type;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $ghost;

    /**
     * @ORM\OneToMany(targetEntity=ChannelTemplatesUsers::class, mappedBy="channelTemplate")
     */
    private $channelTemplatesUsers;

    public function __construct()
    {
        $this->ghost = false;
        $this->channelTemplatesUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getPathToImage(): ?string
    {
        return $this->path_to_image;
    }

    public function setPathToImage(string $path_to_image): self
    {
        $this->path_to_image = $path_to_image;

        return $this;
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
            $channelTemplatesUser->setChannelTemplate($this);
        }

        return $this;
    }

    public function removeChannelTemplatesUser(ChannelTemplatesUsers $channelTemplatesUser): self
    {
        if ($this->channelTemplatesUsers->contains($channelTemplatesUser)) {
            $this->channelTemplatesUsers->removeElement($channelTemplatesUser);
            // set the owning side to null (unless already changed)
            if ($channelTemplatesUser->getChannelTemplate() === $this) {
                $channelTemplatesUser->setChannelTemplate(null);
            }
        }

        return $this;
    }
}
