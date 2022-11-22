<?php
class Posisi {
    //put your code here
    private $posisiId;
    private $kodePosisi;
    private $namaPosisi;
    private $parent;
    private $parentPath;
    private $cabangId;
    private $activeStatus;
    private $peopleId;
    private $pembinaan;
    private $hari;
    private $jam;
    private $flagadd;
    private $up;
    private $orderId;
    
    function getPembinaan() {
        return $this->pembinaan;
    }

    function getHari() {
        return $this->hari;
    }

    function getJam() {
        return $this->jam;
    }

    function getFlagadd() {
        return $this->flagadd;
    }

    function setPembinaan($pembinaan) {
        $this->pembinaan = $pembinaan;
    }

    function setHari($hari) {
        $this->hari = $hari;
    }

    function setJam($jam) {
        $this->jam = $jam;
    }

    function setFlagadd($flagadd) {
        $this->flagadd = $flagadd;
    }

        
    function getPeopleId() {
        return $this->peopleId;
    }

    function setorderId($orderId) {
        $this->orderId = $orderId;
    }

        
    function getorderId() {
        return $this->orderId;
    }

    function setUp($up) {
        $this->up = $up;
    }

        
    function getUp() {
        return $this->up;
    }

    function setPeopleId($peopleId) {
        $this->peopleId = $peopleId;
    }

        
    function getPosisiId() {
        return $this->posisiId;
    }

    function getKodePosisi() {
        return $this->kodePosisi;
    }

    function getNamaPosisi() {
        return $this->namaPosisi;
    }

    function getParent() {
        return $this->parent;
    }

    function getParentPath() {
        return $this->parentPath;
    }

    function getCabangId() {
        return $this->cabangId;
    }

    function getActiveStatus() {
        return $this->activeStatus;
    }

    function setPosisiId($posisiId) {
        $this->posisiId = $posisiId;
    }

    function setKodePosisi($kodePosisi) {
        $this->kodePosisi = $kodePosisi;
    }

    function setNamaPosisi($namaPosisi) {
        $this->namaPosisi = $namaPosisi;
    }

    function setParent($parent) {
        $this->parent = $parent;
    }

    function setParentPath($parentPath) {
        $this->parentPath = $parentPath;
    }

    function setCabangId($cabangId) {
        $this->cabangId = $cabangId;
    }

    function setActiveStatus($activeStatus) {
        $this->activeStatus = $activeStatus;
    }


}
