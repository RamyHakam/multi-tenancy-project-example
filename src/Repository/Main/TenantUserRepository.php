<?php

namespace App\Repository\Main;

use App\Entity\Main\TenantDbConfig;
use App\Entity\Main\TenantUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TenantUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, string $entityClass=TenantUser::class)
    {
        parent::__construct($registry, $entityClass);
    }
}