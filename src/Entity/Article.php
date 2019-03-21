<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $article_id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\source", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $source;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $topics = [];

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_first_seen;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $date_last_seen;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $show_interval;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $social_score;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $article_score;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $social_speed_sph;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $img_uri;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticleId(): ?string
    {
        return $this->article_id;
    }

    public function setArticleId(?string $article_id): self
    {
        $this->article_id = $article_id;

        return $this;
    }

    public function getSource(): ?source
    {
        return $this->source;
    }

    public function setSource(source $source): self
    {
        $this->source = $source;

        return $this;
    }

    public function getTopics(): ?array
    {
        return $this->topics;
    }

    public function setTopics(?array $topics): self
    {
        $this->topics = $topics;

        return $this;
    }

    public function getDateFirstSeen(): ?\DateTimeInterface
    {
        return $this->date_first_seen;
    }

    public function setDateFirstSeen(?\DateTimeInterface $date_first_seen): self
    {
        $this->date_first_seen = $date_first_seen;

        return $this;
    }

    public function getDateLastSeen(): ?string
    {
        return $this->date_last_seen;
    }

    public function setDateLastSeen(?string $date_last_seen): self
    {
        $this->date_last_seen = $date_last_seen;

        return $this;
    }

    public function getShowInterval(): ?string
    {
        return $this->show_interval;
    }

    public function setShowInterval(?string $show_interval): self
    {
        $this->show_interval = $show_interval;

        return $this;
    }

    public function getSocialScore(): ?int
    {
        return $this->social_score;
    }

    public function setSocialScore(?int $social_score): self
    {
        $this->social_score = $social_score;

        return $this;
    }

    public function getArticleScore(): ?int
    {
        return $this->article_score;
    }

    public function setArticleScore(?int $article_score): self
    {
        $this->article_score = $article_score;

        return $this;
    }

    public function getSocialSpeedSph(): ?int
    {
        return $this->social_speed_sph;
    }

    public function setSocialSpeedSph(?int $social_speed_sph): self
    {
        $this->social_speed_sph = $social_speed_sph;

        return $this;
    }

    public function getImgUri(): ?string
    {
        return $this->img_uri;
    }

    public function setImgUri(?string $img_uri): self
    {
        $this->img_uri = $img_uri;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
