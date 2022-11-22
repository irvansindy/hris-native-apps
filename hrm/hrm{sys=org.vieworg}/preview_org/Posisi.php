<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Posisi
 *
 * @author asep
 */
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
    private $kitab;
    private $FlagAdd;
    private $OrgStatus;
    
    function getOrgStatus() {
        return $this->OrgStatus;
    }
    function setOrgStatus($OrgStatus) {
        $this->OrgStatus = $OrgStatus;
    }
    
    function getFlagAdd() {
        return $this->FlagAdd;
    }
    function setFlagAdd($FlagAdd) {
        $this->FlagAdd = $FlagAdd;
    }

    
    function getPembinaan() {
        return $this->pembinaan;
    }

    function getHari() {
        return $this->hari;
    }

    function getJam() {
        return $this->jam;
    }

    function getKitab() {
        return $this->kitab;
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

    function setKitab($kitab) {
        $this->kitab = $kitab;
    }

        
    function getPeopleId() {
        return $this->peopleId;
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
