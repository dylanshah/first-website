<!DOCTYPE html>
<html>
<head>
<title> Costs Task Answers </title>
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
<h1 class="center">Price of Venues on Selected Date</h1>
	<table border="2" width="50%" style="left: 365px; top: 285px; position: absolute" >	
	<!--Table Headings-->
	<tr>
		<th scope=\"col\">Venue Name</th>
		<th scope=\"col\">Price</th>
	</tr>
	<?php
		//Verifies the details to login to the server from an external file
		require_once('MDB2.php');
		include "coa123-mysql-connect.php";
		
		$host='localhost';
		$dbName='coa123wdb';
		
		//Link to access the server and database
		$dsn = "mysql://$username:$password@$host/$dbName";
		$db =& MDB2::connect($dsn);
		
		if (PEAR::isError($db)) {
			die($db->getMessage());
		}
		
		//Gets the user inputs and stores the values as variables
		$venue_table = 'venue';
		$catering_table = 'catering';
		$booking_table = 'venue_booking';
		$date = $_GET['date'];
		$arr = explode('/', $date);
		
		
		//function to get the day of input date and query accordingly if its a weekend or a weekday
		function isweekend($date){
			$statement = "";
			$datebooked = $_GET['date'];
			$partySize = $_GET['partySize'];
			$date = str_replace('/','-',$datebooked);
			$date1 = date('Y-m-d', strtotime($date));
			$date = strtotime($date1);
			$date = date("l", $date);
			$date = strtolower($date);
			if($date == "saturday" || $date == "sunday") {
				//Query for if the date is on a weekend
				$statement .= "SELECT name,weekend_price FROM venue LEFT JOIN venue_booking 
				ON venue.venue_id = venue_booking.venue_id 
				WHERE venue.venue_id NOT IN (SELECT venue_id FROM venue_booking WHERE date_booked = '$date1')
				AND venue.capacity >=$partySize 
				GROUP BY venue.name
				ORDER BY venue.venue_id";
			} else {
				//Query for if the date is on a weekday
				$statement .= "SELECT name,weekday_price  FROM venue LEFT JOIN venue_booking 
				ON venue.venue_id = venue_booking.venue_id
				WHERE venue.venue_id NOT IN (SELECT venue_id FROM venue_booking WHERE date_booked = '$date1')
				AND venue.capacity >=$partySize 
				GROUP BY venue.name
				ORDER BY venue.venue_id";
			}
			return $statement;
		}
		//Applies some validation to the inputs
		if ($date == "" || $_GET['partySize'] == "") {
			echo "Please Enter The Required Fields!";
		} else if (is_numeric($_GET['partySize']) && count($arr == 3)) {
			if (checkdate($arr[1], $arr[0], $arr[2])) { // Checks the date is entered correctly
				$db->setFetchMode(MDB2_FETCHMODE_ORDERED);
				$sql = isweekend($date);
				$res =& $db->query($sql);
				$num = $res->numRows();
				if (PEAR::isError($db)) {
					die($db->getMessage());
				}
				
				$res =& $db->query($sql);
				//Iterates through the rows returned by the query
				while ($row = $res->fetchRow()) {
					echo "<tr>";
					for($j=0;$j<2;$j++) {
						echo "<td>";
						echo $row[$j];
					}
					echo "</tr>";	
				}
				//Displays error if no rows are returned
				if ($num==0) {
					$error = "No Results Found!";
					echo "<p class=\"errormsg\">".$error."</p>";
				}		
			} else {
				$error = "Please Enter a Valid Date!";
				echo "<p class=\"errormsg\">".$error."</p>";
			}
		} else if (!(is_numeric($_GET['partySize'])) && !(checkdate($arr[1], $arr[0], $arr[2]))) {
			$error = "Please Enter a Valid Date and Party Size!";
			echo "<p class=\"errormsg\">".$error."</p>";
		} else {
			$error = "Please Enter a Valid Party Size!";
			echo "<p class=\"errormsg\">".$error."</p>";
		}
	?>
	</table> 
</body>
</html>