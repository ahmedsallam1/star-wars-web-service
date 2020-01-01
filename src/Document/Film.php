<?php
namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(collection="films")
 */
class Film
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @var \DateTime|null
     *
     * @MongoDB\Field(type="date")
     */
    private $created;

    /**
     * @var string|null
     *
     * @MongoDB\Field(type="string")
     */
    private $director;

    /**
     * @var \DateTime|null
     *
     * @MongoDB\Field(type="date")
     */
    private $edited;

    /**
     * @var int|null
     *
     * @MongoDB\Field(name="episode_id", type="int")
     */
    private $episodeId;

    /**
     * @var string|null
     *
     * @MongoDB\Field(name="opening_crawl", type="string")
     */
    private $openingCrawl;

    /**
     * @var string|null
     *
     * @MongoDB\Field(name="producer", type="string")
     */
    private $producer;

    /**
     * @var \DateTime|null
     *
     * @MongoDB\Field(name="release_date", type="date")
     */
    private $releaseDate;

    /**
     * @var string|null
     *
     * @MongoDB\Field(type="string")
     */
    private $title;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(?\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getDirector(): ?string
    {
        return $this->director;
    }

    public function setDirector(?string $director): self
    {
        $this->director = $director;

        return $this;
    }

    public function getEdited(): ?\DateTimeInterface
    {
        return $this->edited;
    }

    public function setEdited(?\DateTimeInterface $edited): self
    {
        $this->edited = $edited;

        return $this;
    }

    public function getEpisodeId(): ?int
    {
        return $this->episodeId;
    }

    public function setEpisodeId(?int $episodeId): self
    {
        $this->episodeId = $episodeId;

        return $this;
    }

    public function getOpeningCrawl(): ?string
    {
        return $this->openingCrawl;
    }

    public function setOpeningCrawl(?string $openingCrawl): self
    {
        $this->openingCrawl = $openingCrawl;

        return $this;
    }

    public function getProducer(): ?string
    {
        return $this->producer;
    }

    public function setProducer(?string $producer): self
    {
        $this->producer = $producer;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(?\DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }


}
