<!DOCTYPE html>
<html>
<head>
<title> Details Task Answers </title>
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
<h1 class="center"> Details of Selected Venue</h1>
	<table border="2" width="800px" style="left: 300px; top: 285px; position: absolute">
			<!-- Creates a table with following column headings -->
			<tr>
				<th scope="col">Venue Id</th>
				<th scope="col">Venue Name</th>
				<th scope="col">Capacity</th>
				<th scope="col">Weekend Price</th>
				<th scope="col">Weekday Price</th>
				<th scope="col">Licenced</th>
			</tr>
	<?php
	
		// Validates the username and password from an external file and allows access to the database on the server.
		require_once('MDB2.php');
		include "coa123-mysql-connect.php";
		
		$host='localhost';
		$dbName='coa123wdb';
		
		//Link to access the server containing the database.
		$dsn = "mysql://$username:$password@$host/$dbName";
		$db =& MDB2::connect($dsn);
		
		if (PEAR::isError($db)) {
			die($db->getMessage());
		}
		
		//Gets the User Input from the html page and stores it as a variable used for queries.
		$venueId = $_GET['venueId'];
		$venue_table = 'venue';
		
		//Checks if entry is not empty
		if ($venueId == "")  {
			$sql = "";
			$error = "Please Enter a Venue ID!";
			echo "<p class=\"errormsg\">".$error."</p>";
		} else if (is_numeric($venueId) && $venueId >= 0){	//Validates the input to be numberic and greater than zero
			$sql = "SELECT * FROM $venue_table WHERE venue_id=$venueId ORDER BY venue_id";
			$db->setFetchMode(MDB2_FETCHMODE_ORDERED);
		
			$res =& $db->query($sql);
			if (PEAR::isError($db)) {
				die($db->getMessage());
			}
			$res =& $db->query($sql);
			$row = $res->fetchRow();
			$num = $res->numRows();
			if ($row != "") {
				
				echo "<tr>";
				for($j=0;$j<6;$j++) {
					echo "<td>";
					//Gets the venue with the given venue Id.
					echo $row[$j];
					
				}
				echo "</tr>";
				
			} 
			if ($num==0) {
				$error = "No Results Found!";
				echo "<p class=\"errormsg\">".$error."</p>";
			}
		} else if (!(is_numeric($venueId)) || $venueId < 0) {  //Prints to screen the error if the data entry does not meet the validation criteria
			$error = "Please Enter a Valid ID!";
			echo "<p class=\"errormsg\">".$error."</p>";
		}
		
		
		
	?>
	
	</table> 
	
	
</body>
</html>