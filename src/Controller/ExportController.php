<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Routing\Annotation\Route;

class ExportController extends AbstractController
{
    #[Route('/export', name: 'app_export')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!'
        ]);
    }
}
