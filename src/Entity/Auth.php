<?php

namespace App\Entity;


use Symfony\Component\Validator\Constraints as Assert;

class Auth {

    #[Assert\Email(messagge:"Formato email non valido")]
    #[Assert\NotBlank(messagge:"Campo obbligatorio")]
    private $username;

    #[Assert\NotBlank(messagge:"Campo obbligatorio")]
    private $password;


    public function setUsername(string $username){
        $this->username = $username;
    }

    public function setPassword(string $password){
        $this->username = $password;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getPassword(){
        return $this->password;
    }

}