<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource]
#[ORM\Entity]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;
    #[ORM\Column]
    #[Assert\NotBlank]
    public ?string $title = '';
    #[ORM\Column(type:"text")]
    #[Assert\NotBlank]
    public ?string $description = '';
    #[ORM\Column]
    #[Assert\NotNull]
    public ?\DateTimeImmutable $publicationDate = null;
    #[ORM\Column]
    #[Assert\NotBlank]
    public ?string $genre = '';
    #[ORM\ManyToOne(targetEntity: Author::class, inversedBy: 'books')]
    #[Assert\NotNull]
    public ?Author $author;
    #[ORM\OneToMany(targetEntity: Review::class, mappedBy: 'book')]
    public iterable $reviews;
}
