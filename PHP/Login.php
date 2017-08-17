<?php

class Login 
{
    var $id;
    var $username;
    var $password;
    var $role;
    var $status;
    
    function __construct($id, $username, $password, $role, $status)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
        $this->status = $status;
    }

    
    
    function getId() 
    {
        return $this->id;
    }

    function getUsername() 
    {
        return $this->username;
    }

    function getPassword()
    {
        return $this->password;
    }

    function getRole()
    {
        return $this->role;
    }

    function getStatus()
    {
        return $this->status;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setUsername($username)
    {
        $this->username = $username;
    }

    function setPassword($password)
    {
        $this->password = $password;
    }

    function setRole($role)
    {
        $this->role = $role;
    }

    function setStatus($status) 
    {
        $this->status = $status;
    }


}
