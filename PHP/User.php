<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author Venus
 */
class User 
{
    //put your code here
    
    var $user_id;
    var $name;
    var $surname;
    var $province;
    var $phone;
    var $email;
    
    function __construct($user_id, $name, $surname, $province, $phone, $email) 
    {
        $this->user_id = $user_id;
        $this->name = $name;
        $this->surname = $surname;
        $this->province = $province;
        $this->phone = $phone;
        $this->email = $email;
    }

    
    function getUser_id() {
        return $this->user_id;
    }

    function getName() {
        return $this->name;
    }

    function getSurname() {
        return $this->surname;
    }

    function getProvince() {
        return $this->province;
    }

    function getPhone() {
        return $this->phone;
    }

    function getEmail() {
        return $this->email;
    }

    function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setSurname($surname) {
        $this->surname = $surname;
    }

    function setProvince($province) {
        $this->province = $province;
    }

    function setPhone($phone) {
        $this->phone = $phone;
    }

    function setEmail($email) {
        $this->email = $email;
    }


}
