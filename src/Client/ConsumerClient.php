<?php

namespace App\Client;

use App\Entity\Auth;
use App\Common\Pageable;
use PhpParser\Node\Expr\Cast\Double;
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

    public function requestConsumer(int $page = 0, int $size = 5, string $order = 'desc', string $sortBy = 'title',array $body)
    {
        $response = $this->client->request('GET', self::API);
        $content = $response->toArray();
        $pageable = new Pageable($page, $size, $order, $sortBy, $content);
        return $pageable->toArray($body);
    }

    private function requestUser()
    {
        $response = $this->client->request('GET', self::API_USER);
        $content = $response->toArray();

        return $this->LetUser($content);
    }

    private function LetUser(array $content)
    {
        $newArray = array();
        array_map(function ($value) use (&$newArray) {
            array_push($newArray, array('id' => $value['id'], 'username' => $value['username'], 'pwd' => $value['password'], 'firstaname' => $value['name']['firstname'], 'lastname' => $value['name']['lastname']));
        }, $content);
        return $newArray;
    }


    /*public function ricercaDati (string $title, double $price, string $description,string $categoria) {


    }*/

    public function Auth(Auth $auth)
    {
        return  array_filter($this->requestUser(),function($value) use($auth)  {
            return strcmp($value['username'],$auth->getUsername()) === 0 && strcmp($value['pwd'],$auth->getPassword());
        });

    }
}
