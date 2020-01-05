<?php
namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class Species
 * @package App\Document
 * @MongoDB\Document(collection="species")
 */
class Species
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
     * @var string|null
     *
     * @MongoDB\Field(type="bin_bytearray")
     */
    private $people;

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
     * @return Species
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
