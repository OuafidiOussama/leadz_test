<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    operations: [
        new GetCollection(
            normalizationContext: ['groups' => ['review:list']]
        ),
        new Get(
            normalizationContext: ['groups' => ['review:read']]
        ),
        new Post(
            denormalizationContext: ['groups' => ['review:write']]
        ),
        new Patch(
            denormalizationContext: ['groups' => ['review:write']]
        ),
        new Delete()
    ]
)]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['review:list', 'review:read'])]
    public ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Groups(['review:write', 'review:list', 'review:read', 'book:read'])]
    public ?string $fullName = "";

    #[ORM\Column]
    #[Assert\Email]
    #[Groups(['review:write', 'review:list', 'review:read', 'book:read'])]
    public ?string $email = "";

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Groups(['review:write', 'review:list', 'review:read', 'book:read'])]
    public ?string $comment = "";

    #[ORM\Column]
    #[Groups(['book:read', 'review:list', 'review:read'])]
    public ?\DateTimeImmutable $creationDate = null;

    #[ORM\ManyToOne(targetEntity: Book::class, inversedBy: 'reviews')]
    #[Assert\NotNull]
    #[Groups(['review:write', 'review:read'])]
    public ?Book $book;

    #[ORM\PrePersist]
    public function setCreationDate(): void
    {
        $this->creationDate = new DateTimeImmutable();
    }
}
