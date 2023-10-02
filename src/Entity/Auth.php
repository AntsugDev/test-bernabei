<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Auth {

    /**
     * @Assert\Type("string")
     * @Assert\Email(messagge="Formato email ono valido",mode="html5",checkMx= true)
     * @Assert\NotBlank(allowNull=true,messagge="Campo Obbligatorio")
     */
    private $username;

    /**
     * @Assert\Type("string")
     * @Assert\NotBlank(allowNull=true,messagge="Campo Obbligatorio")
     */
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