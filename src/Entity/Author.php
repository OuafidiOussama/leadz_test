<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource]
#[ORM\Entity]
class Author
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;
    #[ORM\Column]
    #[Assert\NotBlank]
    public ?string $firstName = "";
    #[ORM\Column]
    #[Assert\NotBlank]
    public ?string $lastName = "";
    #[ORM\Column(type:"text")]
    #[Assert\NotBlank]
    public ?string $biography = "";
    #[ORM\OneToMany(targetEntity: Book::class, mappedBy: 'author')]
    public iterable $books;

    
}
