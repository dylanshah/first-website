<!DOCTYPE html>
<html>
<head>
<title> Capacity Task Answers </title>
<style type="text/css">
body {
	font-family: "Apple Chancery", Times, serif;
	background-color: #00FFFF;
	color: #06A;
}
.center {
	text-align:center;
}
body h1 {
	font-family: "Arial", Times, serif;
	border-style: solid;
	border-width: 5px;
	border-radius: 15px; 
	font-size: 56px;
	color:#000000;
}	
td,tr {
	background-color: #F5F5DC;
}
th {
	background-color: #00FF00;
	color: #000000;
	font-size: 20px;
}
.larger {
	font-size:larger;
	text-align:right;
}
table {
	margin-left:auto;
	margin-right:auto;
	text-align:center;
}
.errormsg {
	color:#FF0000;
	font-size: 20px;
}
</style>
</head>
<body>
<h1 class="center">Licensed Venues of Required Capacity</h1>
	<table border="2" width="400px" style="left: 550px; top: 285px; position: absolute">
	<!-- Creates the table Headings -->
	<tr>
			<th scope="col">Venue Name</th>
			<th scope="col">Weekend Price</th>
			<th scope="col">Weekday Price</th>
	</tr>
	
	<?php
		//Validates the username and password from a different file
		require_once('MDB2.php');
		include "coa123-mysql-connect.php";
		
		$host='localhost';
		$dbName='coa123wdb';
		
		//link to allow access to the database on the server.
		$dsn = "mysql://$username:$password@$host/$dbName";
		$db =& MDB2::connect($dsn);
		
		if (PEAR::isError($db)) {
			die($db->getMessage());
		}
		
		//Gets the user input and stores them are their respective variables.
		$venue_table = 'venue';
		$minCapacity = $_GET['minCapacity'];
		$maxCapacity = $_GET['maxCapacity'];
		
		//Validates to see if the entry is not empty and that it is an integer.
		if ($maxCapacity == "" || $minCapacity == "") {
			$error = "Please Enter The Required Fields!<br>"; //Error message
			echo "<p class=\"errormsg\">".$error."</p>";
		} else if (is_numeric($minCapacity) && is_numeric($maxCapacity)) {
			$db->setFetchMode(MDB2_FETCHMODE_ORDERED);
			$sql = "SELECT name,weekend_price,weekday_price FROM $venue_table WHERE licensed=1 AND capacity>=$minCapacity AND capacity<=$maxCapacity ORDER BY venue_id";
		
			if (PEAR::isError($db)) {
				die($db->getMessage());
			}
			
			$res =& $db->query($sql);
			$num = $res->numRows();
			//Continues if the query returns a row
			while ($row = $res->fetchRow()) {
				echo "<tr>";
				for($j=0;$j<3;$j++) {
					echo "<td>";
					//Gets the venue with the given capacity limits.
					echo $row[$j];
				}
				echo "</tr>";
				
			}
			//Error message for no results found
			if ($num==0) {
				$error = "No Results Found!";
				echo "<p class=\"errormsg\">".$error."</p>";
			}
		} else {
			$error = "Please enter Numeric Capacity Limits!<br>";
			echo "<p class=\"errormsg\">".$error."</p>";
		}
	?>
	
	</table> 
</body>
</html>