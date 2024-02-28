<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiFilter(SearchFilter::class, properties: ['title' => 'ipartial', 'genre' => 'ipartial', 'author.firstName' => 'ipartial', 'author.lastName' => 'ipartial'])]

#[ApiResource(
    operations: [
        new GetCollection(
            normalizationContext: ['groups' => ['book:list']]
        ),
        new Get(
            normalizationContext: ['groups' => ['book:read']]
        ),
        new Post(
            denormalizationContext: ['groups' => ['book:write']]
        ),
        new Patch(
            denormalizationContext: ['groups' => ['book:write']]
        ),
        new Delete()
    ]
)]

#[ORM\Entity]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['book:list', 'book:read'])]
    public ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Groups(['book:list', 'book:read', 'book:write', 'author:read', 'review:read'])]
    public ?string $title = '';

    #[ORM\Column(type: "text")]
    #[Assert\NotBlank]
    #[Groups(['book:read', 'book:write'])]
    public ?string $description = '';

    #[ORM\Column]
    #[Assert\NotNull]
    #[Groups(['book:read', 'book:write'])]
    public ?\DateTimeImmutable $publishedAt = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Groups(['book:list', 'book:read', 'book:write', 'review:read'])]
    public ?string $genre = '';

    #[ORM\ManyToOne(targetEntity: Author::class, inversedBy: 'books')]
    #[Assert\NotNull]
    #[Groups(['book:list', 'book:read', 'book:write', 'review:read'])]
    public ?Author $author;

    // if you want to delete the author and all its books please add "cascade:["remove"]" after mappedBy in both Author.php & Book.php
    #[ORM\OneToMany(targetEntity: Review::class, mappedBy: 'book')]
    #[Groups(['book:read'])]
    public Collection $reviews;


    public function __construct()
    {
        $this->reviews = new ArrayCollection();
    }
}
