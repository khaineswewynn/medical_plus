<?php
class Database{
    private static $hostname="localhost";
    private static $dbname="medical_db";
    private static $username="root";
    private static $password="";
    private static $connection=null;

    static function connect()
    {
        if(self::$connection==null)
        {
            self::$connection=new PDO("mysql:host=localhost;dbname=medical_db",self::$username,self::$password);
        }
        return self::$connection;
    }
    static function disconnect()
    {

    }
}

?>