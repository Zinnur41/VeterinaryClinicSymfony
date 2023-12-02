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
}