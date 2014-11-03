<?php
	session_start();
	require_once('connectvar.php');
	$error_msg = "";
	$log ="Log In";
	if(!isset($_SESSION['user_id'])){
			if(isset($_POST['btnLogin'])){
			$dbc = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)
			or die("Unable to connect to the database " . mysql_error());

			$db_select = mysql_select_db(DB_NAME, $dbc)
			or die("Error selecting database. " . mysql_error());

			$user_username = mysql_real_escape_string(trim($_POST['r_name']), $dbc);
      		$user_password = mysql_real_escape_string(trim($_POST['r_password']), $dbc);

      		if (!empty($user_username) && !empty($user_password)) {
       		 // Look up the username and password in the database
       		 $query = "SELECT user_id, username FROM admin WHERE username = '$user_username' AND password = SHA1('$user_password')";
        	$data = mysql_query($query, $dbc)
        	or die("Unable to query database " . mysql_error());

	        	if (mysql_num_rows($data) == 1) {
	          // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
	          $row = mysql_fetch_array($data);
	          $_SESSION['user_id'] = $row['user_id'];
	          setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
	          $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
	          header('Location: ' . $home_url);
	        }
	        else {
	          // The username/password are incorrect so set an error message
	          $error_msg = 'Sorry, you must enter a valid username and password to log in.';
	        }
		 }
	      else {
	        // The username/password weren't entered so set an error message
	        $error_msg = 'Sorry, you must enter your username and password to log in.';
	      }
	      mysql_close($dbc);
		}
	}
?>



<!DOCTYPE HTML>
<html>
<head>
	<title>Home | Automated License Plate Recognition</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body class="modal-header">
	<div class="navbar navbar-inverse navbar-static-top">
		<div class="container">
			<a href="#" class="navbar-brand"><img src="img/pic1.png" alt="">ALPR</a>
			<button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div class="collapse navbar-collapse navHeaderCollapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="index.php">Home</a></li>
					<li><a href="state.php">Create Plate</a></li>
					<li><a href="format.php">Create Plate Format</a></li>
					<li><a href="number.php">Create Plate Number</a></li>
					<li><a href="vehicle.php">Register Vehicle</a></li>
					<li><a href="search.php">Search License</a></li>
					<li><a href="#contact" data-toggle="modal">Contact Us</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="jumbotron">
			<center>
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>
 
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="img/slide1.jpg" alt="..." width="700" height="700">
      <div class="carousel-caption">
          <h3>Caption Text 1</h3>
      </div>
    </div>
    <div class="item">
      <img src="img/slide2.jpg" alt="..."  width="700" height="800">
      <div class="carousel-caption">
          <h3>Caption Text 2</h3>
      </div>
    </div>
    <div class="item">
      <img src="img/slide3.jpg" alt="..." width="700" height="700">
      <div class="carousel-caption">
          <h3>Caption Text 3</h3>
      </div>
    </div>
    <div class="item">
      <img src="img/slide4.jpg" alt="..." width="700" height="700">
      <div class="carousel-caption">
          <h3>Caption Text 4</h3>
      </div>
    </div>
  </div>
 
  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div> <!-- Carousel -->
		</center>
		</div>
	<form class="form-horizontal">
		<div class="row">
				<h2 align="center">Automated License Plate Recognition (ALPR)</h2>
				<p>Enhance your officers' safety and productivity while maximizing your department's revenue. Automatic License Plate Recognition (ALPR) delivers the ability to read vehicle license plates and check them against an installed database for rapid identity verification. The license plate recognition system has been used to locate stolen or wanted vehicles and identify parking-ticket scofflaws.

This rapidly deployable, scalable solution uses rugged infrared cameras that connect to leading-edge optical character recognition (OCR) technology software, allowing you to conduct surveillance under varied lighting and weather conditions. Captured information is immediately processed, and you are alerted only when a "hit" occurs.</p>
						</p>
		</div>
	</div>
	<div class="navbar navbar-default navbar-fixed-bottom">
		<div class="container">
			<p class="navbar-text pull-left"><span>&copy; 2014 | Automated License Plate Recognition (ALPR)</span></p>
			<a href="http://youtube.com" class="navbar-btn btn-danger btn pull-right">Subscribe on YouTube</a>
		</div>
	</div>

	<div class="modal fade" id="contact" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4>Contact Tech Site</h4>
				</div>
				<div class="modal-body">
					<p>I was a software developer before Mac existed, so I remember how the tech industry
					reacted to it. For the most part, the community reacted with a fair amount of skepticism.The interesting thing is that the negative things people say about Bootstrap today sound exactly like the negative things people said about the Mac in 1984. And in both cases,the things that people didn’t like were what made them important
					</p>
				</div>
				<div class="modal-footer">
					<a class="btn btn-primary" data-dismiss="modal">Close</a>
				</div>
			</div>
		</div>
	</div>

	


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>