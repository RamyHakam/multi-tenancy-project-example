<?php

namespace App\DataFixtures;

use App\Entity\Main\TenantUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TenantUserFixture extends Fixture implements DependentFixtureInterface
{
    public const TENANT_DB_REFERENCE = 'tenant_db_config_';
    public function load(ObjectManager $manager)
    {
        // Add 10 tenant users for each tenant database
        for ($i = 1; $i <= 50; $i++) {
            $tenantUser = new TenantUser();
            $tenantUser->setPassword('tenant_user_' . $i);
            $tenantUser->setEmail('tenant_user_' . $i . '@example.com');
            $tenantUser->setTenantDbConfig($this->getReference(self::TENANT_DB_REFERENCE . $i));
            $manager->persist($tenantUser);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            TenantDbFixture::class,
        ];
    }
}