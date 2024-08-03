<?php

namespace App\Controller;

use App\Entity\Main\TenantDbConfig;
use App\Entity\Tenant\StoreCategory;
use App\Form\ListStoreCategoriesType;
use App\Form\StoreCategoryType;
use App\Form\TenantDbConfigType;
use App\Form\TenantUserType;
use Doctrine\ORM\EntityManagerInterface;
use Hakam\MultiTenancyBundle\Doctrine\ORM\TenantEntityManager;
use Hakam\MultiTenancyBundle\Event\SwitchDbEvent;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MultiTenantExampleController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface   $mainEntityManager,
        private readonly TenantEntityManager      $tenantEntityManager,
        private readonly EventDispatcherInterface $dispatcher,
    )
    {
    }

    #[Route('/', name: 'home')]
    public function index(Request $request): Response
    {
        $tenantDbForm = $this->createForm(TenantDbConfigType::class);
        $tenantUserForm = $this->createForm(TenantUserType::class);
        $storeCategoryForm = $this->createForm(StoreCategoryType::class);
        $listStoreCategoriesForm = $this->createForm(ListStoreCategoriesType::class);

        $tenantDbForm->handleRequest($request);
        $tenantUserForm->handleRequest($request);
        $storeCategoryForm->handleRequest($request);

        if ($tenantDbForm->isSubmitted() && $tenantDbForm->isValid()) {
            $data = $tenantDbForm->getData();
            $hostPort = $data->getDbPort();
            // Fetch the DB config based on the selected port
            $dbConfig = $this->mainEntityManager->getRepository(TenantDbConfig::class)->findOneBy(['dbPort' => $hostPort]);

            if ($dbConfig) {
                $data->setDbUsername($dbConfig->getDbUsername());
                $data->setDbPassword($dbConfig->getDbPassword());
                $data->setDriverType($dbConfig->getDriverType());
            }

            $this->mainEntityManager->persist($data);
            $this->mainEntityManager->flush();
            $this->addFlash('success', 'Tenant DB Config added successfully!');
            return $this->redirectToRoute('home');
        }

        if ($tenantUserForm->isSubmitted() && $tenantUserForm->isValid()) {
            $data = $tenantUserForm->getData();
            $this->mainEntityManager->persist($data);
            $this->mainEntityManager->flush();
            $this->addFlash('success', 'Tenant User added successfully!');
            return $this->redirectToRoute('home');
        }

        if ($storeCategoryForm->isSubmitted() && $storeCategoryForm->isValid()) {
            $storeCategory = $storeCategoryForm->getData();
            $switchEvent = new SwitchDbEvent($storeCategory['tenantUser']->getId());
            $this->dispatcher->dispatch($switchEvent);

            $newTenantStoreCategory = new StoreCategory();
            $newTenantStoreCategory->setCategoryName($storeCategory['categoryName']);
            $this->tenantEntityManager->persist($newTenantStoreCategory);
            $this->tenantEntityManager->flush();
            $this->addFlash('success', 'Store Category added successfully!');
            return $this->redirectToRoute('home');
        }

        return $this->render('features.html.twig', [
            'tenantDbForm' => $tenantDbForm->createView(),
            'tenantUserForm' => $tenantUserForm->createView(),
            'storeCategoryForm' => $storeCategoryForm->createView(),
            'listStoreCategoriesForm' => $listStoreCategoriesForm->createView()
        ]);
    }

    #[Route('/categoryList', name: 'category_list')]
    public function listCategories(Request $request): JsonResponse
    {
        $form = $this->createForm(ListStoreCategoriesType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $tenantUser = $data['tenantUser'];
            // Query the store categories from the selected tenant user's DB
            $switchEvent = new SwitchDbEvent($tenantUser->getId());
            $this->dispatcher->dispatch($switchEvent);
            $storeCategories = $this->tenantEntityManager->getRepository(StoreCategory::class)->findAll();
            $categoriesArray = [];
            foreach ($storeCategories as $category) {
                $categoriesArray[] = [
                    'id' => $category->getId(),
                    'categoryName' => $category->getCategoryName(),
                ];
            }

            return new JsonResponse($categoriesArray);
        }

        return new JsonResponse(['error' => 'Invalid form submission'], 400);
    }
}
