<?php

namespace App\DataFixtures;

use App\Entity\Main\TenantDbConfig;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Hakam\MultiTenancyBundle\Enum\DatabaseStatusEnum;
use Hakam\MultiTenancyBundle\Enum\DriverTypeEnum;

class TenantDbFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // List of tenant database hosts we created in the initial setup
        $listOfTenantHosts = [
            1 => [
                'host' => 'host.docker.internal',  // replace this with your tenant database host if you don't use docker
                'username' => 'test-tenant1',
                'password' => 'test-tenant1',
                'port' => '4444',
            ],
            2 => [
                'host' => 'host.docker.internal',  // replace this with your tenant database host if you don't use docker
                'username' => 'test-tenant2',
                'password' => 'test-tenant2',
                'port' => '5555',
            ],
            3 => [
                'host' => 'host.docker.internal',  // replace this with your tenant database host if you don't use docker
                'username' => 'test-tenant3',
                'password' => 'test-tenant3',
                'port' => '6666',
            ],
            4 => [
                'host' => 'host.docker.internal',  // replace this with your tenant database host if you don't use docker
                'username' => 'test-tenant4',
                'password' => 'test-tenant4',
                'port' => '7777',
            ],
            5 => [
                'host' => 'host.docker.internal',  // replace this with your tenant database host if you don't use docker
                'username' => 'test-tenant5',
                'password' => 'test-tenant5',
                'port' => '8888',
            ],
        ];

        // Add 10 tenant databases for each host configuration
      $count = 0;
        foreach ($listOfTenantHosts as $key => $hostConfig) {
            for ($i = 1; $i <= 10; $i++) {
                $count++;
                $tenantDbConfig = new TenantDbConfig();
                $tenantDbConfig->setDbHost($hostConfig['host']);
                $tenantDbConfig->setDbUserName($hostConfig['username'] );
                $tenantDbConfig->setDbPassword($hostConfig['password'] );
                $tenantDbConfig->setDbPort($hostConfig['port']);
                $tenantDbConfig->setDriverType(DriverTypeEnum::POSTGRES);
                $tenantDbConfig->setDbName('tenant_' . $key . '_' . $i);
                $tenantDbConfig->setDatabaseStatus(DatabaseStatusEnum::DATABASE_NOT_CREATED);
                $manager->persist($tenantDbConfig);
                $this->setReference(TenantUserFixture::TENANT_DB_REFERENCE .  $count, $tenantDbConfig);
            }
        }
        $manager->flush();
    }
}