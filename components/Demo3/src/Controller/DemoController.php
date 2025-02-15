<?php

declare(strict_types=1);

namespace Demo3\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DemoController extends AbstractController
{
    #[Route("/demo3", name: "demo3", methods: ["GET"], format: "json")]
    public function index(): JsonResponse
    {
        return $this->json(["demo" => "2"]);
    }
}
