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
    #[Route('/api/consumer', name: 'app_consumer')]
    public function index(HttpClientInterface $client): JsonResponse
    {
        $consumer = new ConsumerClient($client);
        return $this->json($consumer->requestConsumer());
    }


    #[Route('/api/consumer/post', name: 'app_consumer_post')]
    public function post(HttpClientInterface $client,Request $request): JsonResponse
    {
        $queryString = $request->getQueryString();
        $obj = array();
        parse_str($queryString,$obj);
        $consumer = new ConsumerClient($client);
        return $this->json($consumer->requestConsumer($obj['page'],$obj['size'],$obj['order'],$obj['sortBy']));
    }


    #[Route('/api/auth/consumer', name: 'app_consumer_auth')]
    public function auth(HttpClientInterface $client, Request $request): JsonResponse
    {
        $headers = $request->headers;
        if ($headers->has('php-auth-user') &&  !is_null($headers->get('php-auth-user')) &&  $headers->has('php-auth-pw') &&  !is_null($headers->get('php-auth-pw'))) {

            $entity = new Auth();
            $entity->setUsername($headers->get('php-auth-user'));
            $entity->setPassword($headers->get('php-auth-pw'));

            $consumer = new ConsumerClient($client);
            $check = $consumer->Auth($entity);
            if (count($check) > 0)
                return $this->json($check);
            else
                return new JsonResponse(array("msg" => "Utente non presente", "status" => 401, "timestamp" => time()), 401);
        } else {
            return new JsonResponse(array("msg" => "Impossibile procedere in quanto la richiesta non è corretta", "status" => 404, "timestamp" => time()), 404);
        }
    }
}
