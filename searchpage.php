<!DOCTYPYE html>
<html>
	<head>
		<title>Wedding Task</title>
		<style type="text/css">
			.button a {
				display: inline-block;
				color: #000000;
				text-align: center;
				padding: 14px;
				text-decoration: none;
				font-size: 17px;
				border-radius: 5px;
				font-size: 17px;
				font-weight: bold;
				background-color: #999;
				position: relative;
			}

			.button a:hover {
				background-color: #0055FF;
			}

			.button a.currentpage {
				background-color: #F56;
			}
			body {
				font-family: "Arial", Times, serif;
				background-color: #00FFFF;
				color: #000000;
			}
			body h1 {
				font-family: "Arial", Times, serif;
				border-style: solid;
				border-width: 5px;
				border-radius: 15px; 
				font-size: 56px;
				color:#000000;
				top: 15px;
				position: relative;
			}
			.center {
				text-align: center;
			}
			tr, td {
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
			.total {
				color:#000000;
				font-weight: bold;
				font-size: 18px;
			}
			.yes {
				color:#00AA00;
				font-weight: bold;
			}
			.no {
				color:#FF0000;
				font-weight: bold;
			}
		</style>
		<script type='text/javascript'>
			function f() {
				document.getElementById("buttonclicked").value = document.Search.cateringGrade.selectedIndex;
			}
		</script>
	</head>
	<body>
		<h1 class = "center"> Dylan's Wedding Planner </h1>
		<!-- Tabs to select the homepage -->
		<div class="button">
			<a href='wedding.php'>Home</a>
			<a class="currentpage">Search Venues</a> <!-- Shows a different tab colour fro the current page -->
		</div>
		
		<form name="Search" class="Search" method="get" id="Search">
		<label for="partySize" style="z-index: 1; left: 100px; top: 215px; position: absolute; height: 200px; width: 500px"> Party Size:</label>
		<input type="text" id="partySize" name="partySize" size="24" style="z-index: 1; left: 180px; top: 212px; position: absolute; height: 30px; width: 100px" value="" />
		
		<label for="cateringGrade" style="z-index: 1; left: 320px; top: 215px; position: absolute; height: 200px; width: 500px"> Catering Grade:</label>
		<!-- Option menu to select the catering grade -->
		<select size="1" id="cateringGrade" name="cateringGrade" onchange="f();" style="z-index: 1; left: 430px; top: 212px; position: absolute; height: 30px; width: 100px" value="">
			<option value="">Please Select</option>
			<option value="c1">1</option>
			<option value="c2">2</option>
			<option value="c3">3</option>
			<option value="c4">4</option>
			<option value="c5">5</option>
		</select>
		
		<label for="dateRange" style="z-index: 1; left: 570px; top: 215px; position: absolute; height: 200px; width: 500px"> Date Range(dd/mm/yyyy):</label>
		<label for="dateRange" style="z-index: 1; left: 760px; top: 190px; position: absolute; height: 200px; width: 500px"> Start Date</label>
		<input type="text" id="dateRange" name="startDate" size="24" style="z-index: 1; left: 760px; top: 210px; position: absolute; height: 30px; width: 150px" value=""/>
		
		<label for="dateRange" style="z-index: 1; left: 920px; top: 190px; position: absolute; height: 190px; width: 500px"> End Date</label>
		<input type="text" id="dateRange" name="endDate" size="24" style="z-index: 1; left: 920px; top: 210px; position: absolute; height: 30px; width: 150px" value=""/>
		
		<input type="submit" name="submit" id="submit" value="Search" class="larger" onclick="f()" style="z-index: 1; left: 1200px; top: 210px; position: absolute; height: 30px" />
		<input type="hidden" id="buttonclicked" name="buttonclicked" value="" />
		
		</form>
		<table border="0" width="1200" style="left: 120px; top: 450px; position: absolute">	
		
		<!--Images to display on the page -->
		<img src='images/wedding.jpg' style="left: 20x; top: 250px; width:275px; height: 183px; position:absolute">
		<img src='images/wedding1.jpg' style="left: 290px; top: 250px; width:275px; height: 183px; position:absolute">
		<img src='images/wedding2.jpg' style="left: 575px; top: 250px; width:275px; height: 183px; position:absolute">
		<img src='images/wedding3.jpg' style="left: 860px; top: 250px; width:275px; height: 183px; position:absolute">
		<img src='images/wedding4.jpg' style="left: 1145px; top: 250px; width:275px; height: 183px; position:absolute">

		<?php
			//Verifies the username and password to access the servers database
			require_once("MDB2.php");
			include "coa123-mysql-connect.php";
			
			$host="localhost";
			$dbName="coa123wdb";
			
			//Link to the server and database
			$dsn = "mysql://$username:$password@$host/$dbName";
			$db =& MDB2::connect($dsn);
			
			$venue_table = "venue";
			$venue_booking = "venue_booking";
			$catering = "catering";
			$partySize = null;
			
			//Validation of the input chosen by the user to allow the variable to be allocated a useable value
			if (isset($_GET["partySize"])) {
				$partySize = $_GET["partySize"];
			}
			
			
			$db->setFetchMode(MDB2_FETCHMODE_ASSOC);
			
			$startdate = null;
			if (isset($_GET['startDate'])) {
				$startdate = $_GET['startDate'];
			}
			$date = str_replace('/','-',$startdate);
			$date = date('Y-m-d', strtotime($date));
			
			$currentdate = strtotime($date);
			
			$enddate = null;
			if (isset($_GET['endDate'])) {
				$enddate = $_GET['endDate'];
			}
			$date1 = str_replace('/','-',$enddate);
			$date1 = date('Y-m-d', strtotime($date1));
			
			$start = explode('/', $startdate);
			$end = explode('/', $enddate);
			
			
			$index = 0;
			
			if (isset($_GET["buttonclicked"])) {
				$index = $_GET["buttonclicked"]; 
			}
			//Appends images of each venue to an array
			$object[] = null;
			for ($i=1;$i<=10;$i++) {
				$image = "<img src='images/venue".$i.".jpg' style=\"width:200px; height:100px\">";
				$object[$i] = $image;
			}
			$obj = json_encode($object);
			
			//gets the days between the date range submitted
			$diff = strtotime($date1) - strtotime($date);
			$days = $diff / (60*60*24);
			
			
			if ($startdate != null && $enddate != null && $partySize != null && $index != 0) {
				if (is_numeric($partySize) && count($start == 3)) {
					if (checkdate($start[1], $start[0], $start[2])) {
						if ($days >=0 && $days < 7) {
							for ($i = 0;$i <= $days;$i++) {
								$current = date('Y-m-d', $currentdate);
								$date = date("l", $currentdate);
								$date = strtolower($date);
								
								$dispdate = strtotime($current);
								$dispdate = date('d/m/Y', $dispdate);
			
								if($date == "saturday" || $date == "sunday") {
									//Sql statement to query the required party size date range and the catering grade and price depending on day of the week
									$sql = "SELECT venue.venue_id, venue.name,venue.capacity,venue.weekend_price \"Price\",venue.licensed,catering.cost 
									FROM $venue_table, $venue_booking, $catering 
									WHERE venue.venue_id NOT IN (SELECT venue_id FROM venue_booking WHERE date_booked ='$current')
									AND venue.capacity>=$partySize		
									AND venue.venue_id = catering.venue_id 
									AND catering.grade=$index 
									GROUP BY venue.venue_id
									ORDER BY venue.venue_id";
								} else {
									//Sql statement to query the required party size date range and the catering grade and price depending on day of the week
									$sql = "SELECT venue.venue_id, venue.name,venue.capacity,venue.weekday_price \"Price\",venue.licensed,catering.cost 
									FROM $venue_table, $venue_booking, $catering 
									WHERE venue.venue_id NOT IN (SELECT venue_id FROM venue_booking WHERE date_booked ='$current')
									AND venue.capacity>=$partySize		
									AND venue.venue_id = catering.venue_id 
									AND catering.grade=$index 
									GROUP BY venue.venue_id
									ORDER BY venue.venue_id";
								}
								$res =& $db->query($sql);
								if (PEAR::isError($db)) {
									die($db->getMessage());
								}
								
			
								$res =& $db->query($sql);
								$num = $res->numRows();
								if ($num != 0) { //Only displays heardings if the query returns records
									//Displays the table headings after all the validation have taken place and have been successful
									echo "</br>";
									echo "<th>".$dispdate."</th>";
									echo "<tr>";
									echo "<th scope=\"col\">Venue</th>";
									echo "<th scope=\"col\">Venue Name</th>";
									echo "<th scope=\"col\">Capacity</th>";
									echo "<th scope=\"col\">Venue Price</th>";
									echo "<th scope=\"col\">Cost per Person</th>";
									echo "<th scope=\"col\">Licensed</th>";
									echo "<th scope=\"col\">Total</th>";
									echo "</tr>";
								}
								//Displays the results onto a table
								$res =& $db->query($sql);
								while ($row = $res->fetchRow()) {
									//Stores the fields to variables
									$id = $row[strtolower("venue_id")];
									$name = $row[strtolower("name")];
									$capacity = $row[strtolower("capacity")];
									$venueprice = $row[strtolower("Price")];
									$licenced = $row[strtolower("licensed")];
									//Changes the display of if the venue is licenced to YES or NO
									if ($licenced == "1") {
										$licenced = "<p class=\"yes\">Yes</p>";
									} else {
										$licenced = "<p class=\"no\">No</p>";
									}
									$cost = $row[strtolower("cost")];
									$total = ($cost * $partySize) + $venueprice;
									
									echo "<tr>";
									echo "<td>";
									$obje = json_decode($obj);
									echo $obje[$id];
									echo "<td>";
									echo $name;
									echo "<td>";
									echo $capacity;
									echo "<td>";
									echo "£" . $venueprice;
									echo "<td>";
									echo "£" . $cost;
									echo "<td>";
									echo $licenced;
									echo "<td>";
									echo "<p class=\"total\">"."£" . $total."</p>";;
									echo "</tr>";
								}
								$currentdate  += (60*60*24); //Adds one day to the date to go through the loop again within the date range
								
							}
						} else if ($days < 0) {
							$error = "Start Date Must be Earlier than End Date!";
							echo "<p class=\"errormsg\">".$error."</p>";
						} else {
							$error = "Please Enter a Date Range No More Than One Week!";
							echo "<p class=\"errormsg\">".$error."</p>";
						}
					} else {
						$error = "Please Enter The Correct Details!";
						echo "<p class=\"errormsg\">".$error."</p>";
					}
				} else {
					$error = "Please Enter The Correct Details!";
					echo "<p class=\"errormsg\">".$error."</p>";
				}
			} else if ($index == 0 && $startdate != null  && $enddate != null && $partySize != null) {
				$error = "Enter a Catering Grade";
				echo "<p class=\"errormsg\">".$error."</p>";
			} else if ($index != 0 && $startdate == null   && $enddate != null && $partySize != null) {
				$error = "Enter a Start Date";
				echo "<p class=\"errormsg\">".$error."</p>";
			} else if ($index != 0 && $startdate == null   && $enddate == null && $partySize != null) {
				$error = "Enter a End Date";
				echo "<p class=\"errormsg\">".$error."</p>";
			} else if ($index != 0 && $startdate != null   && $enddate != null && $partySize == null) {
				$error = "Enter a Party Size";
				echo "<p class=\"errormsg\">".$error."</p>";
			} else if ($index == null && $startdate == null   && $enddate == null && $partySize == null) {
			} else {
				$error = "More Than One Missing Fields";
				echo "<p class=\"errormsg\">".$error."</p>";
			}
		?>
	</body>
</html>