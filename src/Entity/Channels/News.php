<?php

namespace App\Entity\Channels;

use App\Repository\Channels\NewsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NewsRepository::class)
 * @ORM\Table(name="news", schema="channels")
 */
class News
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Channels::class, inversedBy="news")
     * @ORM\JoinColumn(nullable=false)
     */
    private $channel;

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
     * @ORM\Column(type="datetime", options={"default" : "now()"})
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", options={"default" : "now()"})
     */
    private $published_at;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $draft;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $ghost;

    /**
     * @ORM\OneToMany(targetEntity=NewsReads::class, mappedBy="news")
     */
    private $newsReads;

    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->published_at = new \DateTime();
        $this->draft = false;
        $this->ghost = false;
        $this->newsReads = new ArrayCollection();
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->published_at;
    }

    public function setPublishedAt(\DateTimeInterface $published_at): self
    {
        $this->published_at = $published_at;

        return $this;
    }

    public function getDraft(): ?bool
    {
        return $this->draft;
    }

    public function setDraft(bool $draft): self
    {
        $this->draft = $draft;

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
            $newsRead->setNews($this);
        }

        return $this;
    }

    public function removeNewsRead(NewsReads $newsRead): self
    {
        if ($this->newsReads->contains($newsRead)) {
            $this->newsReads->removeElement($newsRead);
            // set the owning side to null (unless already changed)
            if ($newsRead->getNews() === $this) {
                $newsRead->setNews(null);
            }
        }

        return $this;
    }
}
