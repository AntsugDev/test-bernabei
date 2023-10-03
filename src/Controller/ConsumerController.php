<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Client\ConsumerClient;
use App\Entity\Auth;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ConsumerController extends AbstractController
{
    #[Route('/api/consumer', name: 'app_consumer', methods: ['POST', 'OPTIONS'])]
    public function index(HttpClientInterface $client, Request $request): JsonResponse
    {

        $body = $request->toArray();
        $queryString = $request->getQueryString();
        $obj = array();
        parse_str($queryString, $obj);
        $consumer = new ConsumerClient($client);
        return $this->json($consumer->requestConsumer($obj['page'], $obj['size'], $obj['order'], $obj['sortBy'],$body));
    }

    #[Route('/api/user/{id}', name: 'app_user', methods: ['GET', 'OPTIONS'])]
    public function user(string  $id = "" ,HttpClientInterface $client, Request $request): JsonResponse
    {
        $consumer = new ConsumerClient($client);
        $response = $consumer->requestUser($id);
        return new JsonResponse($response, array_key_exists('status',$response) ? $response['status'] : 200);
    }



    #[Route('/auth/consumer', name: 'app_consumer_auth', methods: ['GET','POST', 'OPTIONS'])]
    public function auth(HttpClientInterface $client, Request $request): JsonResponse
    {

        $body = $request->toArray();
        $queryString = $request->getQueryString();
        $obj = array();
        parse_str($queryString, $obj);
        $consumer = new ConsumerClient($client);
        return $this->json($consumer->requestConsumer($obj['page'], $obj['size'], $obj['order'], $obj['sortBy'],$body));
    }
}
