<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class AdminService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAllUsers(): array
    {
        return $this->entityManager->getRepository(User::class)->findAll();
    }

    public function deleteUser(int $id): void
    {
        $user = $this->entityManager->getRepository(User::class)->find($id);
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }

    public function blockUser(int $id): void
    {
        $user = $this->entityManager->getRepository(User::class)->find($id);
        $user->setRoles(['ROLE_BLOCKED']);
        $this->entityManager->flush();
    }

    public function unlockUser(int $id): void
    {
        $user = $this->entityManager->getRepository(User::class)->find($id);
        $user->setRoles(['ROLE_USER']);
        $this->entityManager->flush();
    }
}