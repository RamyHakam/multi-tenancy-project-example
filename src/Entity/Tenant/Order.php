<?php

namespace App\Entity\Tenant;

use App\Repository\Tenant\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $orderName = null;

    #[ORM\ManyToOne(targetEntity: StoreCategory::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?StoreCategory $storeCategory = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getOrderName(): ?string
    {
        return $this->orderName;
    }

    /**
     * @param string|null $orderName
     */
    public function setOrderName(?string $orderName): void
    {
        $this->orderName = $orderName;
    }

    /**
     * @return StoreCategory|null
     */
    public function getStoreCategory(): ?StoreCategory
    {
        return $this->storeCategory;
    }

    /**
     * @param StoreCategory|null $storeCategory
     */
    public function setStoreCategory(?StoreCategory $storeCategory): void
    {
        $this->storeCategory = $storeCategory;
    }

}