<?php

class Database
{
    private $localHost = 'localhost';
    private $name = 'root';
    private $password = '';
    private $dbname = 'location';
    private $connect;
    public function getdatabase()
    {
       try {
        $dns = "mysql:host={$this->localHost};dbname={$this->dbname};charset=utf8";
        $this->connect = new PDO($dns,$this->name,$this->password);
        $this->connect->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

    //    echo 'fgndfgjkdgjkg';
       } catch (PDOException) {
        echo 'errure de connection';
       }
       return $this->connect;
    }
}
