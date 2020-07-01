<!DOCTYPE html>
<html>
<head>
<title> Catering Task Answers </title>
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
	position: center;
}
.errormsg {
	color:#FF0000;
	font-size: 20px;
}
</style>
</head>
<body>
<h1 class="center">Catering Costs depending on Party Size</h1>
	<table border="2" width="60%">	
	<?php
		function bounds($min,$max) {
			//Displays the table after the validations have taken place
			echo "<tr>";
			echo "<th scope=\"col\">Cost per Person -> </br>/ Party Size </th>";
			echo "<th scope=\"col\">".$_GET["c1"]."</th>";
			echo "<th scope=\"col\">".$_GET["c2"]."</th>";
			echo "<th scope=\"col\">".$_GET["c3"]."</th>";
			echo "<th scope=\"col\">".$_GET["c4"]."</th>";
			echo "<th scope=\"col\">".$_GET["c5"]."</th>";
			echo "</tr>";
			$row = "<tr>";
			for ($i = $min; $i <= $max; $i += 5) {
				$row .= "<th><label>" .$i. "</label></th>";
				for ($j = 1; $j <= 5; $j += 1) {
					//Multiplies the Cost per Person with the party size to get the total catering cost in each cell
					$row .= "<td><label>".($i * $_GET["c".$j])."</label></td>";
				}
				$row .= '</tr>';
			}	
			echo $row;
		}
		
	?>
	<?php 
		$c1 = $_GET["c1"];
		$c2 = $_GET["c2"];
		$c3 = $_GET["c3"];
		$c4 = $_GET["c4"];
		$c5 = $_GET["c5"];
		$minimum = $_GET["min"];
		$maximum = $_GET["max"];
		
		//Validates to see if the entries are not empty and if it is an integer entered
		if ($maximum == "" || $minimum == "" || $c1 == "" || $c2 == "" || $c3 == "" || $c4 == "" || $c5 == "") {
			$error = "Please Enter The Required Fields!";
			echo "<p class=\"errormsg\">".$error."</p>"; //Displays appropriate error message
		} else if (is_numeric($c1) && is_numeric($c2) && is_numeric($c3) && is_numeric($c4) && is_numeric($c5) && is_numeric($minimum) && is_numeric($maximum)) {
			//Calls the bounds function to display the results in form of a table
			bounds($minimum, $maximum);
		} else {
			$error = "Please Enter Valid Integers!";
			echo "<p class=\"errormsg\">".$error."</p>";
		}
	?>
	</table> 	
</body>
</html>
