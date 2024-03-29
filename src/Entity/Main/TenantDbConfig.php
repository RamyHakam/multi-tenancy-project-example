<?php

namespace App\Entity\Main;

use App\Repository\Main\TenantDbConfigRepository;
use Doctrine\ORM\Mapping as ORM;
use Hakam\MultiTenancyBundle\Services\TenantDbConfigurationInterface;
use Hakam\MultiTenancyBundle\Traits\TenantDbConfigTrait;

#[ORM\Entity(repositoryClass: TenantDbConfigRepository::class)]
class TenantDbConfig implements TenantDbConfigurationInterface
{
    use TenantDbConfigTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}