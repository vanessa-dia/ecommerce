<?php
require_once("./db.php");

class Model extends DB
{
    public $conn;
    protected $table;
    public function __construct($nameTable)
    {
        $this->table = $nameTable;
        $this->conn = $this->connect();
    }
    public function getAll()
    {
        $json = array();
        $data = [];
        $table = $this->table;
        $query =  "SELECT * FROM $table";
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_array()) {
                $json['id'] = $row[0];
                $data[] = $json;
            }
        }
        print_r($data);
    }
    public function queryId($id,$table){
        $query = "SELECT * from $table where id = '$id' ";
        $result = $this->conn->query($query);
        if ($result->num_rows > 0){
            return $result->fetch_assoc();
        } else {
            return 'Không có dữ liệu';
        }

    }

}
