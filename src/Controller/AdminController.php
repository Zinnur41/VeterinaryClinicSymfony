<?php

namespace App\Controller;

use App\Entity\Services;
use App\Form\ServiceFormType;
use App\Service\AdminService;
use App\Service\ReviewService;
use App\Service\ServicesService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(ReviewService $reviewService): Response
    {
        $averageScore = $reviewService->getAverageScore();
        return $this->render('admin/index.html.twig', [
            'averageScore' => $averageScore
        ]);
    }

    #[Route('/admin/getUsers', name: 'app_admin_getUsers', methods: 'GET')]
    public function getUsers(AdminService $adminService): Response
    {
        $users = $adminService->getAllUsers();
        return $this->render('admin/users.html.twig', [
            'users' => $users
        ]);
    }

    #[Route('/admin/deleteUser/{id}', name: 'app_admin_deleteUser', methods: 'POST')]
    public function deleteUser(AdminService $adminService, $id): Response
    {
        $adminService->deleteUser($id);
        return $this->redirectToRoute('app_admin_getUsers');
    }

    #[Route('/admin/blockUser/{id}', name: 'app_admin_blockUser', methods: 'POST')]
    public function blockUser(AdminService $adminService, $id): Response
    {
        $adminService->blockUser($id);
        return $this->redirectToRoute('app_admin_getUsers');
    }

    #[Route('/admin/unlockUser/{id}', name: 'app_admin_unlockUser', methods: 'POST')]
    public function unlockUser(AdminService $adminService, $id): Response
    {
        $adminService->unlockUser($id);
        return $this->redirectToRoute('app_admin_getUsers');
    }

    #[Route('/admin/services', name: 'app_admin_service')]
    public function addService(Request $request, ServicesService $servicesService): Response
    {
        $services = new Services();

        $form = $this->createForm(ServiceFormType::class, $services);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $imageName = uniqid() . '.' . $imageFile->guessExtension();

                $imageFile->move(
                    $this->getParameter('serviceImages_directory'),
                    $imageName
                );
                $servicesService->addService($services, $imageName);
                return $this->redirectToRoute('app_admin_service');
            }
        }
        $allServices = $servicesService->getAllServices();

        return $this->render('admin/services.html.twig', [
            'form' => $form->createView(),
            'services' => $allServices
        ]);
    }

    #[Route('/admin/services/{id}/edit', name: 'app_admin_updateService')]
    public function updateService(Request $request, ServicesService $servicesService, int $id): Response
    {
        $service = $servicesService->findService($id);

        $form = $this->createForm(ServiceFormType::class, $service);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $imageName = uniqid() . '.' . $imageFile->guessExtension();

                $imageFile->move(
                    $this->getParameter('serviceImages_directory'),
                    $imageName
                );

            } else {
                $imageName = $service->getImage();
            }
            $servicesService->updateService($service, $imageName);
            return $this->redirectToRoute('app_admin_service');
        }

        return $this->render('admin/updateServices.html.twig', [
            'form' => $form->createView()
        ]);
    }


    #[Route('/admin/services/{id}/delete', name: 'app_admin_deleteService', methods: 'POST')]
    public function deleteService(ServicesService $service, $id): Response
    {
        $service->deleteService($id);
        return $this->redirectToRoute('app_admin_service');
    }
}