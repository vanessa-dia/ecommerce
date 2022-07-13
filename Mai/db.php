<?php
class DB {
    public function connect()
    {
        $con = new mysqli('localhost','root','','testMai');
        if ($con->connect_error) {
            echo 'CONNECT ERROR';
        }
        return $con; 
    }
}