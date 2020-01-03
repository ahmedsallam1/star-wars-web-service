<?php
namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class People
 * @package App\Document
 * @MongoDB\Document(collection="people")
 */
class People
{
    /**
     * @MongoDB\Id
     */
    protected $objId;

    /**
     * @MongoDB\Field(type="integer")
     */
    protected $id;

    /**
     * @var string|null
     *
     * @MongoDB\Field(type="string")
     */
    private $name;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     * @return People
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
