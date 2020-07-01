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
			left: 8px;
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
			background-color: #00FFAA;
			color: #06A;
			margin: 0;
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
			top: 15px;
			width: 98%;
			top: 15px;
			left: 8px;
			position: relative;
		}

		.container {
			position: relative;
			width: 99%;
		}

		.slides {
			display: none;
			style: left: 20px;
		}
		
		.prev {
			cursor: pointer;
			position: absolute;
			top: 30%;
			width: auto;
			padding: 16px;
			color: white;
			font-weight: bold;
			font-size: 20px;
			background-color: #000000;
			left: 0;
		}
		
		.next {
			cursor: pointer;
			position: absolute;
			top: 30%;
			width: auto;
			padding: 16px;
			color: #FFFFFF;
			font-weight: bold;
			font-size: 20px;
			background-color: #000000;
			right: 0;
		}

		.pagenumber {
			color: #f6f6f6;
			font-size: 18px;
			padding: 8px;
			position: absolute;
			background-color: #000000;
			font-weight: bold;
		}

		.venuename {
			text-align: center;
			background-color: #555;
			padding: 5px;
			color: #000000;
			width: 98.5%;
			position: relative;
			left: 8;
			top: 10;
		}

		.row:after {
			content: "";
			display: table;
			clear: both;
		}

		.column {
			float: left;
			width: 10%;
			height: 10%;
		}

		.view {
			opacity: 0.5;
		}

		.currentpic{
			opacity: 1;
		}
		</style>
	</head>
	<body>
		<h1 class = "center"> Dylan's Wedding Planner </h1>
		<!-- Tabs to move htom homepage tot he search page -->
		<div class="button">
		  <a class="currentpage" >Home</a>
		  <a href='searchpage.php'>Search Venues</a>
		</div>
		
		
		<div class="venuename" style= "font-size: 22px; font-weight:bold" id="venuename"></div> <!-- section to display the name of the venue of the current photo -->
		
		<!--A Container to hold the photos of the venues according to the page number -->
		<div class="container" style="left:10px; top: 10px">
			<div class="slides">
			<div class="pagenumber">1 / 10</div>
			<img src='images/venue1.jpg' style="width:100%; height: 500px">
		</div>

		<div class="slides">
			<div class="pagenumber">2 / 10</div>
			<img src='images/venue2.jpg' style="width:100%; height: 500px">
		</div>

		<div class="slides">
			<div class="pagenumber">3 / 10</div>
			<img src='images/venue3.jpg' style="width:100%; height: 500px">
		</div>
		
		<div class="slides">
			<div class="pagenumber">4 / 10</div>
			<img src='images/venue4.jpg' style="width:100%; height: 500px">
		</div>

		<div class="slides">
			<div class="pagenumber">5 / 10</div>
			<img src='images/venue5.jpg' style="width:100%; height: 500px">
		</div>
		
		<div class="slides">
			<div class="pagenumber">6 / 10</div>
			<img src='images/venue6.jpg' style="width:100%; height: 500px">
		</div>
	  
		<div class="slides">
			<div class="pagenumber">7 / 10</div>
			<img src='images/venue7.jpg' style="width:100%; height: 500px">
		</div>
	  
		<div class="slides">
			<div class="pagenumber">8 / 10</div>
			<img src='images/venue8.jpg' style="width:100%; height: 500px">
		</div>
	  
		<div class="slides">
			<div class="pagenumber">9 / 10</div>
			<img src='images/venue9.jpg' style="width:100%; height: 500px">
		</div>
	  
		<div class="slides">
			<div class="pagenumber">10 / 10</div>
			<img src='images/venue10.jpg' style="width:100%; height: 500px">
		</div> 
	  
		<!-- Buttons in the container to toggle to the next or previous photo of the venue -->
		<a class="prev" onclick="nextslide(-1)"><</a>
		<a class="next" onclick="nextslide(1)">></a>

		
		<!-- Section ot diaplay all the venues under the container and blur all other venues apart from the current venue -->
		<div class="row" style= "top:5px; position:relative">
			<div class="column">
				<img class="view" src='images/venue1.jpg' style="width:100%; height:60%" onclick="currentslide(1)" id="Central Plaza">
			</div>
			<div class="column">
				<img class="view" src='images/venue2.jpg' style="width:100%; height:60%" onclick="currentslide(2)" id="Pacific Towers Hotel">
			</div>
			<div class="column">
				<img class="view" src='images/venue3.jpg' style="width:100%; height:60%" onclick="currentslide(3)" id="Sky Center Complex">
			</div>
			<div class="column">
				<img class="view" src='images/venue4.jpg' style="width:100%; height:60%" onclick="currentslide(4)" id="Sea View Tavern">
			</div>
			<div class="column">
				<img class="view" src='images/venue5.jpg' style="width:100%; height:60%" onclick="currentslide(5)" id="Ashby Castle">
			</div>    
			<div class="column">
				<img class="view" src='images/venue6.jpg' style="width:100%; height:60%" onclick="currentslide(6)" id="Fawlty Towers">
			</div>
			<div class="column">
				<img class="view" src='images/venue7.jpg' style="width:100%; height:60%" onclick="currentslide(7)" id="Hilltop Mansion">
			</div>
			<div class="column">
				<img class="view" src='images/venue8.jpg' style="width:100%; height:60%" onclick="currentslide(8)" id="Haslegrave Hotel">
			</div>
			<div class="column">
				<img class="view" src='images/venue9.jpg' style="width:100%; height:60%" onclick="currentslide(9)" id="Forest Inn">
			</div>
			<div class="column">
				<img class="view" src='images/venue10.jpg'style="width:100%; height:60%" onclick="currentslide(10)" id="Southwestern Estate">
			</div>
		</div>
	</body>
	<script = "text/javascript">
		var slidenumber = 1;
		show(slidenumber);

		function nextslide(n) {
			show(slidenumber += n);
		}

		function currentslide(n) {
			show(slidenumber = n);
		}

		function show(n) {
			var i;
			var slides = document.getElementsByClassName("slides");
			var pic = document.getElementsByClassName("view");
			var venueName = document.getElementById("venuename");
			if (n > slides.length) {
				slidenumber = 1;
			}
			if (n < 1) {
				slidenumber = slides.length;
			}
			for (i = 0; i < slides.length; i++) {
				slides[i].style.display = "none";
			}
			for (i = 0; i < pic.length; i++) {
				pic[i].className = pic[i].className.replace("currentpic", "");
			}
			slides[slidenumber-1].style.display = "block";
			pic[slidenumber-1].className += " currentpic";
			venueName.innerHTML = pic[slidenumber-1].id;
		}
	</script>
</html>
