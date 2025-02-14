<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends AbstractController
{
    public function __construct(
        private UserRepository $userRepository,
        private EntityManagerInterface $entityManager
    ) {}

    #[Route("/", name: "home", methods: ["GET"], format: "json")]
    public function index(): JsonResponse
    {
        return $this->json([]);
    }

    #[Route("/users", name: "app_get_user", methods: ["GET"], format: "json")]
    public function allUsers(SerializerInterface $serializer): JsonResponse
    {
        $jsonContent = $serializer->serialize(
            $this->userRepository->findAll(),
            "json"
        );

        return JsonResponse::fromJsonString($jsonContent);
    }
}
