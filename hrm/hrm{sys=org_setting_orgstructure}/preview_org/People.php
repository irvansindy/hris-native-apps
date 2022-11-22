<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of People
 *
 * @author asep
 */
class People {
    //put your code here
    private $peopleId;
    private $name;
    private $telepon;
    private $adress;
    private $statusId;
    private $joindate;
    private $activeStatus;
    private $endDate;
    private $email;
    private $komitment;
    private $username;
    private $password;
    private $cabang;

    private $gender;
    
    function getGender() {
        return $this->gender;
    }

    function setGender($gender) {
        $this->gender = $gender;
    }
    
    function getCabang() {
        return $this->cabang;
    }

    function setCabang($cabang) {
        $this->cabang = $cabang;
    }
    
    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }
    
    function getKomitment() {
        return $this->komitment;
    }

    function setKomitment($komitment) {
        $this->komitment = $komitment;
    }

    function getPeopleId() {
        return $this->peopleId;
    }

    function getName() {
        return $this->name;
    }

    function getTelepon() {
        return $this->telepon;
    }

    function getAdress() {
        return $this->adress;
    }

    function getStatusId() {
        return $this->statusId;
    }

    function getJoindate() {
        return $this->joindate;
    }

    function getActiveStatus() {
        return $this->activeStatus;
    }

    function getEndDate() {
        return $this->endDate;
    }

    function getEmail() {
        return $this->email;
    }

    function setPeopleId($peopleId) {
        $this->peopleId = $peopleId;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setTelepon($telepon) {
        $this->telepon = $telepon;
    }

    function setAdress($adress) {
        $this->adress = $adress;
    }

    function setStatusId($statusId) {
        $this->statusId = $statusId;
    }

    function setJoindate($joindate) {
        $this->joindate = $joindate;
    }

    function setActiveStatus($activeStatus) {
        $this->activeStatus = $activeStatus;
    }

    function setEndDate($endDate) {
        $this->endDate = $endDate;
    }

    function setEmail($email) {
        $this->email = $email;
    }


}
