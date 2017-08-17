<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Party
 *
 * @author Venus
 */
class Party 
{
   var $party_id;
   var $party_name;
   var $president;
   var $image;
   
   function __construct($party_id, $party_name, $president, $image) {
       $this->party_id = $party_id;
       $this->party_name = $party_name;
       $this->president = $president;
       $this->image = $image;
   }
   
   function getParty_id() {
       return $this->party_id;
   }

   function getParty_name() {
       return $this->party_name;
   }

   function getPresident() {
       return $this->president;
   }

   function getImage() {
       return $this->image;
   }

   function setParty_id($party_id) {
       $this->party_id = $party_id;
   }

   function setParty_name($party_name) {
       $this->party_name = $party_name;
   }

   function setPresident($president) {
       $this->president = $president;
   }

   function setImage($image) {
       $this->image = $image;
   }



}
