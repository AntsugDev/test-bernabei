<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErrorController extends AbstractController
{
    #[Route('/error-cust', name: 'app_error_cust')]
    public function index(Response $response): JsonResponse
    {
        dump('error',$response);die;
        return $this->json([

            'message' => '',
            'path' => 'src/Controller/ErrorController.php',
        ]);
    }
}
