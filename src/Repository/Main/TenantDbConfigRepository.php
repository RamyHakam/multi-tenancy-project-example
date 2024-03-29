<?php

namespace App\Repository\Main;

use App\Entity\Main\TenantDbConfig;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TenantDbConfigRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, string $entityClass=TenantDbConfig::class)
    {
        parent::__construct($registry, $entityClass);
    }

}