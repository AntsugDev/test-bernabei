<?php

namespace App\Client;

use App\Entity\Auth;
use App\Common\Pageable;
use Symfony\Contracts\HttpClient\HttpClientInterface;



class ConsumerClient
{
    const API = "https://fakestoreapi.com/products";
    const API_USER = "https://fakestoreapi.com/users";
    private HttpClientInterface  $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function requestConsumer(int $page = 0, int $size = 5, string $order = 'desc', string $sortBy = 'title', array $body)
    {
        $response = $this->client->request('GET', self::API);
        $content = $response->toArray();
        $pageable = new Pageable($page, $size, $order, $sortBy, $content);
        return $pageable->toArray($body);
    }

    public function requestUser(string $id)
    {
        $response = $this->client->request('GET', self::API_USER);
        $content = $response->toArray();
        $content = $this->LetUser($content);
        if (strcmp($id, "") !== 0) {
            return $this->ClientValidToken($id, $content);
        } else return $content;
    }

    private function LetUser(array $content)
    {
        $newArray = array();
        array_map(function ($value) use (&$newArray) {
            array_push($newArray, array('id' => $value['id'], 'username' => $value['username'], 'pwd' => $value['password'], 'firstaname' => $value['name']['firstname'], 'lastname' => $value['name']['lastname']));
        }, $content);
        return $newArray;
    }

    private function ClientValidToken(string $encode, array $content): array
    {

        return array_filter($content, function ($value) use ($encode) {
            return strcmp(base64_encode($value['username'] . ':' . $value['pwd']), $encode) === 0;
        });
    }
}
