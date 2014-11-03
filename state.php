<?php
   // require_once('appvars.php');
    require_once('startsession.php');
    require_once('connectvar.php');
    $message = "";
    $dbc = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)
            or die("Unable to connect to the database " . mysql_error());

    $db_select = mysql_select_db(DB_NAME, $dbc)
            or die("Error selecting database. " . mysql_error());

     if(isset($_POST['btnAdd'])){
     	$state = mysql_real_escape_string(trim($_POST['r_name']), $dbc);

     	$query1 = "SELECT * FROM state WHERE state = '$state'";
     	$data1 = mysql_query($query1, $dbc)
     	or die("Error selecting from database. " . mysql_error());

     	if(mysql_num_rows($data1) == 0){
     		$query = "INSERT INTO state(state)VALUES('$state')";

     		$data = mysql_query($query, $dbc)
     		or die("Error inserting into database. " . mysql_error());
     		$message = "Successfully added the state.";
     	}
     	else{
     		$message = "The data sent already exist.";
     	}
     	
     }
     mysql_close($dbc);
?>


<!DOCTYPE HTML>
<html>
<head>
	<title>Home | Automated License Plate Recognition</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/styles.css" type="text/css"/>
</head>
<body>
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
		<body class="modal-header">

		<form action='state.php' method='post' class="form-inline">
			<br><br>
			<fieldset>
			<input type="hidden" name="r_id" value="">
							<b style="font-size:20px">State Name:</b>&nbsp;
							<input type="hidden" name="r_id" value="">
							<input type="text" name="r_name" style="width:50%;" value="">&nbsp;
							<button id="btnAdd" name="btnAdd" class="btn btn-primary" title="Click here to add a new format.">Add Format</button><br><br><br>
							</fieldset>
<div class="row">
        
        
        <div class="col-md-12">
        <h4>Bootstrap Snipp for Datatable</h4>
        <div class="table-responsive">
        
                
              <table id="mytable" class="table table-bordred table-striped">
                   
                   <thead>
                   
                   <th><input type="checkbox" id="checkall" /></th>
                   <th>States</th>
                      <th>Edit</th>
                       <th>Delete</th>
                   </thead>
    <tbody>

    <?php
						require_once('connectvar.php');

					    $dbc = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)
					            or die("Unable to connect to the database " . mysql_error());

					    $db_select = mysql_select_db(DB_NAME, $dbc)
					            or die("Error selecting database. " . mysql_error());
							$query = "SELECT * FROM state";
							$data = mysql_query($query, $dbc)
							or die("Error selecting database. " . mysql_error());
							while ($row = mysql_fetch_array($data)) {
								 $id = $row['state_id'];
								 echo '<input type="hidden" name=' .$id . '/>';
								echo '<tr>';
   								echo'<td><input type="checkbox" class="checkthis" /></td>';
								echo '<td>'.$row['state'].'</td>';
						?>
    <td><p><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" data-placement="top" rel="tooltip">
    	<span class="glyphicon glyphicon-pencil"></span></button></p></td>
    <td><p><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-trash"></span></button></p></td>
    </tr> 
    <?php
    	}
    	mysql_close($dbc);
    ?>
    
    </tbody>
        
</table>

                
            </div>
            
        </div>
    </div>
</div>

    <div class="navbar navbar-default navbar-fixed-bottom">
        <div class="container">
            <p class="navbar-text pull-left"><span>&copy; 2014 | Automated License Plate Recognition (ALPR)</span></p>
            <a href="http://youtube.com" class="navbar-btn btn-danger btn pull-right">Subscribe on YouTube</a>
        </div>
    </div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="js/jquery-1.3.2.js"></script>
 
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
</form>
<form action="updateState.php" method="post">
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title custom_align" id="Heading">Edit State</h4>
      </div>
          <div class="modal-body">
          <div class="form-group">
        <input class="form-control " type="text" name="updateState">
        </div>
        </div>
      </div>
          <div class="modal-footer ">
        <button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>
    
    
    
    <div  class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
      </div>
          <div class="modal-body">
       
       <div class="alert alert-warning"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>
       
      </div>
        <div class="modal-footer ">
        <button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
</div>

</form>
</body>
</html>