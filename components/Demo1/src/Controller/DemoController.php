<?php

declare(strict_types=1);

namespace Demo1\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DemoController extends AbstractController
{
    #[Route("/demo1", name: "demo1", methods: ["GET"], format: "json")]
    public function index(): JsonResponse
    {
        return $this->json(["demo" => "1"]);
    }
}
