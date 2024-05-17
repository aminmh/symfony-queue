<?php

namespace App\Controller;

use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/client')]
class ClientController extends AbstractController
{
    public const APP_CLIENT_INDEX = 'app:client:index';

    public function __construct(private readonly ClientRepository $repository)
    {

    }

    #[Route('', name: 'app_client_index')]
    public function index(Request $request): JsonResponse
    {
        $itemPerPage = $request->query->get('itemPerPage', 10);
        $page = $request->query->get('page', 1);
        return $this->json([
            'data' => $this->repository->paginate($page, $itemPerPage)
        ], context: ['groups' => self::APP_CLIENT_INDEX]);
    }
}
