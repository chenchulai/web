<?php
@header('Content-type: text/html;charset=UTF-8');
class DB{

    private $con = null;
    private $host = "127.0.0.1";
    private $user = "root";
    private $password ="root";
    private $database = "oj";

    private function getConn(){

        if($this->con==null){
            if(defined('SAE_MYSQL_DB'))//云平台连接
            {
                $this->con = new mysqli(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS)
                or die("Could not connect: " . $this->con->error );//云平台链接
                $this->con->query("SET NAMES 'utf8'");
                $this->con->select_db(SAE_MYSQL_DB) or die("Could not select database");//云平台数据库
            }
            else//本地链接
            {
                $this->con = new mysqli($this->host, $this->user, $this->password) or
                die("Could not connect: " . $this->con->error);
                $this->con->query("SET NAMES 'utf8'");
                $this->con->select_db($this->database) or die("Could not select database");
            }
        }

    }

    public function GetData($query)
    {
        $this->getConn();
        $result =  $this->con->query($query) or die ('Can not Get Data!');
        return $result;
    }

    public function FreeResult($result)
    {
        $result->free_result;

    }
    public function __destruct()
    {
        if ($this->con !== null)
        {
            $this->con->close();
            $this->con = null;
        }
    }

    public function GetLastInsertId()
    {
        $this->getConn();
        $result = $this->con->insert_id;
        return $result;
    }

    public function GetAffectedRows()
    {
        $this->getConn();
        $result = $this->con->affected_rows;
        return $result;
    }

    public function checkValue($value){
        $this->getConn();
        return $this->con->real_escape_string($value);
    }
}
?>