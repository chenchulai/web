<?php
	class MyDB
	{
		private $con = null;     //
	
		private function getConn()
		{
			if ($this->con === null)
			{
				if (defined('SAE_MYSQL_DB'))//云平台链接	
				{
					$this->con = mysqli_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS)
						or die("Could not connect: " . mysqli_error($this->con ));	;//云平台链接
					mysqli_query($this->con, "SET NAMES 'utf8'");
					mysqli_select_db($this->con, SAE_MYSQL_DB) or die("Could not select database");//云平台数据库
                    //echo "Success";
				}
				else//本地链接
				{
					$this->con = mysqli_connect("127.0.0.1", "root", "root") or			
		   				die("Could not connect: " . mysqli_error($this->con ));
					mysqli_query($this->con, "SET NAMES 'utf8'");
					mysqli_select_db($this->con, "test") or die("Could not select database");
				}		
			}	
		}
		public function GetData($query) 
		{
			$this->getConn();
			
			$result = mysqli_query($this->con, $query) or die ('Can not Get Data!');
			return $result;
		}		
		public function FreeResult($result)
		{
			mysqli_free_result($result);
	
		}
		public function __destruct()
		{
			if ($this->con !== null)
			{
				mysqli_close($this->con);
				$this->con = null;
			}
		}
		
		public function GetLastInsertId()
		{
			$this->getConn();
			$result = mysqli_insert_id($this->con);
			return $result;
		}
		
		public function GetAffectedRows()
		{
			$this->getConn();
			$result = mysqli_affected_rows($this->con);
			return $result;
		}

	}
?>