<?php
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
	private $grade;
	private $los;
    private $picture;
    private $age;
    private $lastpos;
    private $lastposyear;
    
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

    function getPicture() {
        return $this->picture;
    }

    function setPicture($picture) {
        $this->picture = $picture;
    }

    function getAge() {
        return $this->age;
    }

    function setAge($age) {
        $this->age = $age;
    }

    function getLastpos() {
        return $this->lastpos;
    }

    function setLastpos($lastpos) {
        $this->lastpos = $lastpos;
    }

    function getLastposyear() {
        return $this->lastposyear;
    }

    function setLastposyear($lastposyear) {
        $this->lastposyear = $lastposyear;
    }

    function getPeopleId1() {
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

	function getGrade() {
        return $this->grade;
    }
	
	function getLos() {
        return $this->los;
    }
	
    function setPeopleId1($peopleId) {
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
	
	function setGrade($grade) {
        $this->grade = $grade;
    }
	
	function setLos($los) {
        $this->los = $los;
    }


}
