<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={"get"={"normalization_context"={"groups"="article:list"}}},
 *     itemOperations={"get"={"normalization_context"={"groups"="article:item"}}},
 *     order={"id"="ASC"},
 *     paginationEnabled=false
 * )
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=13)
     */
    private $ean;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $teaser;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $stack;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picturemain;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picturefront;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pictureback;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $manuel;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="articles")
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="articles")
     */
    private $tag;

    public function __construct()
    {
        $this->tag = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEan(): ?string
    {
        return $this->ean;
    }

    public function setEan(string $ean): self
    {
        $this->ean = $ean;

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

    public function getTeaser(): ?string
    {
        return $this->teaser;
    }

    public function setTeaser(?string $teaser): self
    {
        $this->teaser = $teaser;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getStack(): ?int
    {
        return $this->stack;
    }

    public function setStack(?int $stack): self
    {
        $this->stack = $stack;

        return $this;
    }

    public function getPicturemain(): ?string
    {
        return $this->picturemain;
    }

    public function setPicturemain(?string $picturemain): self
    {
        $this->picturemain = $picturemain;

        return $this;
    }

    public function getPicturefront(): ?string
    {
        return $this->picturefront;
    }

    public function setPicturefront(?string $picturefront): self
    {
        $this->picturefront = $picturefront;

        return $this;
    }

    public function getPictureback(): ?string
    {
        return $this->pictureback;
    }

    public function setPictureback(?string $pictureback): self
    {
        $this->pictureback = $pictureback;

        return $this;
    }

    public function getManuel(): ?string
    {
        return $this->manuel;
    }

    public function setManuel(?string $manuel): self
    {
        $this->manuel = $manuel;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTag(): Collection
    {
        return $this->tag;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tag->contains($tag)) {
            $this->tag[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->tag->removeElement($tag);

        return $this;
    }
}
