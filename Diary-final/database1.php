<?php
	class connectionMNGR
	{
		public function connect()
		{
			$servername = 'localhost';
			$username = 'root';
			$password = 'Btech6.taj';
			$db='dia';
			$db = mysqli_connect($servername,$username,$password,$db);
			#$dbConn = mysqli_connect("localhost", "root","lohith@123") or die ('MySQL connection failed. . . ' . mysqli_error());
			#$db = mysqli_select_db('reminder', $dbConn) or die('Cannot select database. . . ' . mysqli_error());
			if (!$db) 
			{
    			die("Connection failed: " . mysqli_connect_error());
			}

		}
	}

	class SQL
	{
			function dbQuery($sql)
			{
				$db = mysqli_connect("localhost","root","Btech6.taj","dia");
				$result = mysqli_query($db, $sql) or die(mysqli_connect_error());
				
				return $result;
			}
			
			function dbFetchAssoc($result)
			{
				return mysqli_fetch_assoc($result);
			}
						
			function dbFreeResult($result)
			{
				return mysqli_free_result($result);
			}
			
			function dbNumRows($result)
			{
				return mysqli_num_rows($result);
			}
			
			
			
	} // class SQL ends			
?>