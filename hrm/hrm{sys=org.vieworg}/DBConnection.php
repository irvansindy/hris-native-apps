<?php


// }


// $host 			= "localhost";
// $user 			= "root";
// $port 			= "3306";
// $pwd 			= "";
// $dbname 		= $databases;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DBConnection
 *
 * @author asep
 */
class DBConnection {

    //put your code here
    private $host = "localhost";
    private $dbName = "dbhr_sfbiznet_training";
    private $usr = "root";
    private $pwd = "";

    public function getConnection() {
        try {
            $conn = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->usr, $this->pwd);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return $conn;
       
    }
   

}