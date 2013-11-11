<?php
	require_once(LIB_PATH.DS."config.php"); //initial constant variable about server, user... first
	class Database
	{
		private $connection;
		public $sql_query;
		private $magic_quotes_active;
		private $real_escape_string_exists;
		
		// constructor function
		function __construct()
		{
			$this->connect();
			
			$this->magic_quotes_active = get_magic_quotes_gpc();
			$this->real_escape_string_exists = function_exists("mysql_real_escape_string");
		}
		
		//function open connection to db
		public function connect()
		{
			$this->connection = mysql_connect(SERVER_NAME,USER_NAME,PASSWORD);
			
			if(!$this->connection)
				die("Database connection failed: ". mysql_error);
			else
			{
				$select_db = mysql_select_db(DB_NAME,$this->connection);
				if(!$select_db)
					die("Database selection failed: ". mysql_error());
			}
		}
		
		//function for escaping special char
		public function escape_value($value)
		{
			if($this->real_escape_string_exists){
				if($this->magic_quotes_active)
					$value = stripslashes($value);
					
				$value = mysql_real_escape_string($value);
			}
			else
			{
				if(!$this->magic_quotes_active)
					$value = addslashes($value);
			}
			return $value;
		}
		
		//function for qurey mysql
		public function sql_query($sql)
		{
			$this->sql_query = $sql;
			mysql_set_charset('utf8',$this->connection);
			$result = mysql_query($sql, $this->connection);
			$this->confirm_query_result($result);
			return $result;
		}
		
		//function confirm_query
		private function confirm_query_result($result)
		{
			if(!$result){
				$output = "Database query failed: ". mysql_error()."<br/><br/>";
				$output .= "SQL query: ". $this->sql_query;
				$output .= "Error in our application!";
				die( $output);
			}
		}
		
		public function fetch_array($result_set)
		{
			return mysql_fetch_array($result_set);
		}
	
		public function num_rows($result_set)
		{
			return mysql_num_rows($result_set);
		}

		// function close_connection
		public function close_connection()
		{
			if(isset($this->connection))
			{
				mysql_close($this->connection);
				unset($this->connection);
			}
		}
	
	}
	$database = new Database();  // Create  constant (connection is open by constructor)
?>