<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer extends User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
   

    public function getId(): ?int
    {
        return $this->id;
    }
}
