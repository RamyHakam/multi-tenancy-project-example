<?php

namespace App\Controller;

use App\Entity\Main\TenantDbConfig;
use App\Entity\Main\TenantUser;
use App\Entity\Tenant\StoreCategory;
use Doctrine\ORM\EntityManagerInterface;
use Hakam\MultiTenancyBundle\Doctrine\ORM\TenantEntityManager;
use Hakam\MultiTenancyBundle\Event\SwitchDbEvent;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MultiTenantExampleController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $mainEntityManager,
        private TenantEntityManager $tenantEntityManager,
        private EventDispatcherInterface $dispatcher,
    ) {}

    #[Route('/create-tenant', name: 'create_db')]
      public function createTenant(EntityManagerInterface $entityManager)
      {
          //example of creating a new tenant
          $tenant = new TenantUser();
          $tenant->setEmail('test@test.com');
          $tenant->setPassword('password');
          // create a new db config for the tenant
            $tenantDbConfig = new TenantDbConfig();
            $tenantDbConfig->setDbName('tenantStore1');
          $tenant->setTenantDbConfig($tenantDbConfig);
            $entityManager->persist($tenant);
            $entityManager->flush();

            // Then you need to execute the following command to create the database
            // php bin/console tenant:database:create $tenantDbConfig->getDbName()
            // You can execute the command in the controller or in the terminal or you can  add cron job to execute the command every 5 minutes for example

          return new JsonResponse();
      }
    /**
     * An example of how to switch and update tenant databases
     */
    #[Route('/update-tenant-store', name: 'app_test_db')]
    public function updateTenantStore(): JsonResponse
    {
        //get the tenant user example
        $tenantUser = $this->mainEntityManager->getRepository(TenantUser::class)->findOneBy(['email' => 'test@test.com ']);
        // Dispatch an event with the index ID for the entity that contains the tenant database connection details.

        $switchEvent = new SwitchDbEvent($tenantUser->getTenantDbConfig()->getId());
        $this->dispatcher->dispatch($switchEvent);
        //create a new entity in the tenant database
        $newTenantStoreCategory = new StoreCategory();
        $newTenantStoreCategory->setCategoryName('newTenantStoreCategory');
        //persist and flush the new entity with the tenant entity manager
        $this->tenantEntityManager->persist($newTenantStoreCategory);
        $this->tenantEntityManager->flush();
        return new JsonResponse( sprintf('newTenantStoreCategory with id = %s created in tenant database %s', $newTenantStoreCategory->getId(), $tenantUser->getTenantDbConfig()->getDbName()));
    }
}
