<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $createdAt = null;

    #[ORM\Column(length: 255)]
    private ?string $carrierName = null;

    #[ORM\Column]
    private ?float $carrierPrice = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $delivry = null;

    /**
     * @var Collection<int, OrderDatail>
     */
    #[ORM\OneToMany(targetEntity: OrderDatail::class, mappedBy: 'myOrder')]
    private Collection $orderDatails;

    public function __construct()
    {
        $this->orderDatails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCarrierName(): ?string
    {
        return $this->carrierName;
    }

    public function setCarrierName(string $carrierName): static
    {
        $this->carrierName = $carrierName;

        return $this;
    }

    public function getCarrierPrice(): ?float
    {
        return $this->carrierPrice;
    }

    public function setCarrierPrice(float $carrierPrice): static
    {
        $this->carrierPrice = $carrierPrice;

        return $this;
    }

    public function getDelivry(): ?string
    {
        return $this->delivry;
    }

    public function setDelivry(string $delivry): static
    {
        $this->delivry = $delivry;

        return $this;
    }

    /**
     * @return Collection<int, OrderDatail>
     */
    public function getOrderDatails(): Collection
    {
        return $this->orderDatails;
    }

    public function addOrderDatail(OrderDatail $orderDatail): static
    {
        if (!$this->orderDatails->contains($orderDatail)) {
            $this->orderDatails->add($orderDatail);
            $orderDatail->setMyOrder($this);
        }

        return $this;
    }

    public function removeOrderDatail(OrderDatail $orderDatail): static
    {
        if ($this->orderDatails->removeElement($orderDatail)) {
            // set the owning side to null (unless already changed)
            if ($orderDatail->getMyOrder() === $this) {
                $orderDatail->setMyOrder(null);
            }
        }

        return $this;
    }
}
