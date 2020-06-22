<?php

namespace App\Entity\Channels;

use App\Entity\Users\Users;
use App\Repository\Channels\NewsReadsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NewsReadsRepository::class)
 * @ORM\Table(name="news_reads", schema="channels")
 */
class NewsReads
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=News::class, inversedBy="newsReads")
     * @ORM\JoinColumn(nullable=false)
     */
    private $news;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="newsReads")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    /**
     * @ORM\Column(type="datetime", options={"default" : "now()"})
     */
    private $read_at;

    public function __construct()
    {
        $this->read_at = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNews(): ?News
    {
        return $this->news;
    }

    public function setNews(?News $news): self
    {
        $this->news = $news;

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

    public function getReadAt(): ?\DateTimeInterface
    {
        return $this->read_at;
    }

    public function setReadAt(\DateTimeInterface $read_at): self
    {
        $this->read_at = $read_at;

        return $this;
    }
}
