<?php

namespace App\Entity;

use Symfony\Bundle\SecurityBundle\Security\UserAuthenticator;
use Symfony\Component\Validator\Constraints as Assert;

class Auth  {

    #[Assert\Email(messagge:"Formato email non valido")]
    #[Assert\NotBlank(messagge:"Campo obbligatorio")]
    private $username;

    #[Assert\NotBlank(messagge:"Campo obbligatorio")]
    private $password;

    private $roles = [];

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

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

}