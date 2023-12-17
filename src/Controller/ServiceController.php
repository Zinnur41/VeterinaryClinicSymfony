<?php

namespace App\Controller;

use App\Form\ExaminationFormType;
use App\Service\ReviewService;
use App\Service\ServicesService;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    #[Route('/service', name: 'app_service')]
    public function index(ServicesService $service, ReviewService $reviewService): Response
    {
        $averageScore = $reviewService->getAverageScore();

        $services = $service->getAllServices();
        return $this->render('service/services.html.twig', [
            'services' => $services,
            'averageScore' => $averageScore,
        ]);
    }
    #[Route('/service/{id}')]
    public function addExamination(Request $request, $id, UserService $userService): Response
    {
        $form = $this->createForm(ExaminationFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $userService->addExamination($data, $id);
            return $this->redirectToRoute('app_service');
        }
        return $this->render('service/addExamination.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
