<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource]
#[ORM\Entity]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;
    #[ORM\Column]
    public ?string $fullName = "";
    #[ORM\Column]
    public ?string $email = "";
    #[ORM\Column]
    public ?string $comment = "";
    #[ORM\Column]
    public ?\DateTimeImmutable $creationDate = null;
    #[ORM\ManyToOne(targetEntity: Book::class, inversedBy: 'reviews')]
    #[Assert\NotNull]
    public ?Book $book;
}
