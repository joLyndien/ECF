<?php

namespace App\DTO;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InscriptionDTO
 *
 * @author dell-optilex-3010
 */
class InscriptionDTO {
    private $user;
    private $email;
    private $password;
    
    function getUser() {
        return $this->user;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }


}
