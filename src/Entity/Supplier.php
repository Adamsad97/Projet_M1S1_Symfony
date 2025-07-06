<?php

namespace App\Entity;

use App\Repository\SupplierRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SupplierRepository::class)]
class Supplier extends User 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]


    public function getId(): ?int
    {
        return $this->id;
    }
}
