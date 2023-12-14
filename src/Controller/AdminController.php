<?php

namespace App\Controller;

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
    public function addService(ServicesService $service, Request $request): Response
    {
        $form = $this->createForm(ServiceFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $imageName = uniqid() . '.' . $imageFile->guessExtension();

                $imageFile->move(
                    $this->getParameter('serviceImages_directory'),
                    $imageName
                );
                $data = $form->getData();
                $service->addService($data, $imageName);
                return $this->redirectToRoute('app_admin_service');
            }
        }
        $services = $service->getAllServices();

        return $this->render('admin/services.html.twig', [
            'form' => $form->createView(),
            'services' => $services
        ]);
    }
}