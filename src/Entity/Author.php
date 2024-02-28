<?php

namespace App\Entity;

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

#[ApiResource(
    operations: [
        new GetCollection(
            normalizationContext: ['groups' => ['author:list']]
        ),
        new Get(
            normalizationContext: ['groups' => ['author:read']]
        ),
        new Post(
            denormalizationContext: ['groups' => ['author:write']]
        ),
        new Patch(
            denormalizationContext: ['groups' => ['author:write']]
        ),
        new Delete()
    ]
)]
#[ORM\Entity]
class Author
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['author:read', 'author:list'])]
    public ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Groups(['book:list', 'book:read', 'author:write', 'author:read', 'author:list', 'review:read'])]
    public ?string $firstName = "";

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Groups(['book:list', 'book:read', 'author:write', 'author:read', 'author:list', 'review:read'])]
    public ?string $lastName = "";

    #[ORM\Column(type: "text")]
    #[Assert\NotBlank]
    #[Groups(['author:write', 'author:read'])]
    public ?string $biography = "";

    // if you want to delete the author and all its books please add "cascade:["remove"]" after mappedBy in both Author.php & Book.php
    #[ORM\OneToMany(targetEntity: Book::class, mappedBy: 'author')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['author:read'])]
    public Collection $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }
}
