<?php

namespace App\Service;

use App\Entity\Services;
use Doctrine\ORM\EntityManagerInterface;

class ServicesService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAllServices(): array
    {
        return $this->entityManager->getRepository(Services::class)->findAll();
    }

    public function addService(Services $services, $image): void
    {
        $services->setImage($image);
        $this->entityManager->persist($services);
        $this->entityManager->flush();
    }

    public function updateService(Services $services, $image = null): void
    {
        if ($image !== null) {
            $services->setImage($image);
        }
        $this->entityManager->flush();
    }

    public function findService($id): Services
    {
        return $this->entityManager->getRepository(Services::class)->find($id);
    }

    public function deleteService(int $id): void
    {
        $service = $this->entityManager->getRepository(Services::class)->find($id);
        $this->entityManager->remove($service);
        $this->entityManager->flush();
    }
}