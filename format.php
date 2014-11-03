<?php
								require_once('startsession.php');
    								require_once('connectvar.php');
    								$message = "";
									$dbc = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)
						            or die("Unable to connect to the database " . mysql_error());

						    		$db_select = mysql_select_db(DB_NAME, $dbc)
						            or die("Error selecting database. " . mysql_error());

    								if(isset($_POST['btnAdd'])){
    									$prefix = mysql_real_escape_string(trim(strtoupper($_POST['r_prefix'])), $dbc);
    									$state_id = mysql_real_escape_string(trim($_POST['r_state']), $dbc);

    									$query1 = "SELECT * FROM format WHERE prefix = '$prefix'";
								     	$data1 = mysql_query($query1, $dbc)
								     	or die("Error selecting from database. " . mysql_error());

								     	$query2 = "SELECT * FROM state WHERE state_id = '$state_id'";
								     	$data2 = mysql_query($query2, $dbc)
								     	or die("Error selecting from database. " . mysql_error());

								     	if(mysql_num_rows($data2) == 1){
								     		$row = mysql_fetch_array($data2);
								     		$states = $row['state'];
								     	}

								     	if(mysql_num_rows($data1) == 0){
	    									$query1 = "INSERT INTO format(state_id,state,prefix)VALUES ('$state_id','$states','$prefix')";
	    									$data1 = mysql_query($query1, $dbc)
	    									or die("Error insert into database. " . mysql_error());
	    									$message = "Successfully added the state.";
	    								}
								     	else{
								     		$message = "The data sent already exist.";
								     	}
    								}
								
							 ?>




<!DOCTYPE HTML>
<html>
<head>
	<title>Plate Format | Automated License Plate Recognition</title>
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

		<form action='index.php' method='post' class="form-inline">
			<input type="hidden" name="r_id" value="">
							<b>State:</b>&nbsp;
							<select name="r_state">	
								<?php
						            $query = "SELECT * FROM state";
						            $data = mysql_query($query, $dbc)
						            or die("Error selecting from database. " . mysql_error());

						            while ($row = mysql_fetch_array($data)) {
						            	echo '<option value="'.$row['state_id'].'">' . $row['state']. '</option>';
						            }
								 ?>				
							</select>&nbsp;
							<input type="text" name="r_prefix" style="width:50%" value="">&nbsp;
							<button id="b1" name="btnAdd" class="btn btn-primary" title="Click here to add a new format.">Add Format</button>
<div class="row">
        
        
        <div class="col-md-12">
        <h4>Bootstrap Snipp for Datatable</h4>
        <div class="table-responsive">
        
                
              <table id="mytable" class="table table-bordred table-striped">
                   
                   <thead>
                   
                   <th><input type="checkbox" id="checkall" /></th>
                   <th>First Name</th>
                    <th>Last Name</th>
                     <th>Address</th>
                      <th>Edit</th>
                       <th>Delete</th>
                   </thead>
    <tbody>
    
    <tr>
    <td><input type="checkbox" class="checkthis" /></td>
    <td>Mohsin</td>
    <td>Irshad</td>
    <td>CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan</td>
    <td><p><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-pencil"></span></button></p></td>
    <td><p><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-trash"></span></button></p></td>
    </tr>
    
        <tr>
    <td><input type="checkbox" class="checkthis" /></td>
    <td>Mohsin</td>
    <td>Irshad</td>
    <td>CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan</td>
    <td><p><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-pencil"></span></button></p></td>
    <td><p><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-trash"></span></button></p></td>
    </tr>
    
    
        <tr>
    <td><input type="checkbox" class="checkthis" /></td>
    <td>Mohsin</td>
    <td>Irshad</td>
    <td>CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan</td>
    <td><p><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-pencil"></span></button></p></td>
    <td><p><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-trash"></span></button></p></td>
    </tr>
    
    
    
        <tr>
    <td><input type="checkbox" class="checkthis" /></td>
    <td>Mohsin</td>
    <td>Irshad</td>
    <td>CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan</td>
    <td><p><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-pencil"></span></button></p></td>
    <td><p><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-trash"></span></button></p></td>
    </tr>
    
    
    
        <tr>
    <td><input type="checkbox" class="checkthis" /></td>
    <td>Mohsin</td>
    <td>Irshad</td>
    <td>CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan</td>
    <td><p><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-pencil"></span></button></p></td>
    <td><p><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-trash"></span></button></p></td>
    </tr>
    
    
   
    
   
    
    </tbody>
        
</table>

                
            </div>
            
        </div>
    </div>
</div>


<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
      </div>
          <div class="modal-body">
          <div class="form-group">
        <input class="form-control " type="text" placeholder="Mohsin">
        </div>
        <div class="form-group">
        
        <input class="form-control " type="text" placeholder="Irshad">
        </div>
        <div class="form-group">
        <textarea rows="2" class="form-control" placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>
    
        
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

    <div class="navbar navbar-default navbar-fixed-bottom">
        <div class="container">
            <p class="navbar-text pull-left"><span>&copy; 2014 | Automated License Plate Recognition (ALPR)</span></p>
            <a href="http://youtube.com" class="navbar-btn btn-danger btn pull-right">Subscribe on YouTube</a>
        </div>
    </div>

<script type="text/javascript">

    $(document).ready(function(){
$("#mytable #checkall").click(function () {
        if ($("#mytable #checkall").is(':checked')) {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });

        } else {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
});

 $(function () {
            $("[rel='tooltip']").tooltip();
        });
</script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="js/jquery-1.3.2.js"></script>
 
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>