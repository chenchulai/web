<?php
@header('Content-type: text/html;charset=UTF-8');
class DB{
    private $host = "localhost";
    private $user = "root";
    private $password ="root";
    private $database = "oj";
    private $conn = null;

    private function getConn(){
        if($this->conn == null){
            if(defined('SAE_MYSQL_DB')){
                $this->conn = mysqli_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS) or die("Could not connect: " . mysqli_error($this->conn ));//云平台链接
				mysqli_query($this->conn, "SET NAMES 'utf8'");
				mysqli_select_db($this->conn, SAE_MYSQL_DB) or die("Could not select database");//云平台数据库
				echo "Success";
            }else{
                $this->conn = mysqli_connect($this->host, $this->user, $this->password);
                mysqli_query($this->conn,"set names 'utf-8'");
                mysqli_query($this->conn,"set character set utf8");
                mysqli_query($this->conn,"set collation_connection='utf8_general_ci'");
                mysqli_select_db($this->conn,$this->database) or die('could not get data');
            }
        }
    }

    public function query($query){
        $this->getConn();
        $result = mysqli_query($this->conn, $query) or die ('can not get data! ');
       return $result; 
    }
    public function free_result($result){
        mysqli_free_result($result);
    }

    function __set($property_name,$value){
        $this->$property_name = $value;
    }
    
    function __get($property_name){
        if(isset($this->$property_name))
            return $this->$property_name;
        else
            return NULL;
    }
    public function __destruct(){
        if($this->conn != null){
            mysqli_close($this->conn);
            $this->conn = null;
        }
    }

    function check_input($value){
        if(get_magic_quotes_gpc()){
            $value = stripcslashes($value);
        }
        $this->getConn();
        $value = mysqli_real_escape_string($this->conn,$value);
        return $value;
    }

}
