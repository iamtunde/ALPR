<?php
   // require_once('appvars.php');
    require_once('startsession.php');
    require_once('connectvar.php');
    require_once('appvars.php');
    $numberid = "";

    $dbc = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)
            or die("Unable to connect to the database " . mysql_error());

    $db_select = mysql_select_db(DB_NAME, $dbc)
            or die("Error selecting database. " . mysql_error());

    if(isset($_POST['btnAdd'])){
        $numberid = mysql_real_escape_string(trim($_POST['r_number']), $dbc);
        $number = mysql_real_escape_string(trim($_POST['r_number']), $dbc);
        $title = mysql_real_escape_string(trim($_POST['r_title']), $dbc);
        $fName = mysql_real_escape_string(trim($_POST['f_name']), $dbc);
        $mName = mysql_real_escape_string(trim($_POST['m_name']), $dbc);
        $lName = mysql_real_escape_string(trim($_POST['l_name']), $dbc);
        $mSex = mysql_real_escape_string(trim($_POST['r_sex']), $dbc);
        $dob = mysql_real_escape_string(trim($_POST['r_dob']), $dbc);
        $email = $_POST['r_email'];
        $phone = mysql_real_escape_string(trim($_POST['r_phome']), $dbc);
        $company = mysql_real_escape_string(trim($_POST['r_company']), $dbc);
        $address = mysql_real_escape_string(trim($_POST['r_address']), $dbc);
        $companyAddress = mysql_real_escape_string(trim($_POST['r_caddress']), $dbc);
        $companyPhone = mysql_real_escape_string(trim($_POST['r_cphone']), $dbc);
        $create = mysql_real_escape_string(trim($_POST['r_created']), $dbc);
        $renew = mysql_real_escape_string(trim($_POST['r_expires']), $dbc);
        $screenshot = mysql_real_escape_string(trim($_FILES['screenshot']['name']), $dbc);
        $screenshot_type = $_FILES['screenshot']['type'];
        $screenshot_size = $_FILES['screenshot']['size'];

        if ((($screenshot_type == 'image/gif') || ($screenshot_type == 'image/jpeg') || ($screenshot_type == 'image/pjpeg') || ($screenshot_type == 'image/png'))
        && ($screenshot_size > 0) && ($screenshot_size <= MM_MAXFILESIZE)) {
        if ($_FILES['screenshot']['error'] == 0) {
          // Move the file to the target upload folder
          $target = MM_UPLOADPATH . $screenshot;
          if (move_uploaded_file($_FILES['screenshot']['tmp_name'], $target)) {
            // Write the data to the database
            $query1 = "SELECT * from owner WHERE number_id = '$numberid'";
            $data1 = mysql_query($query1, $dbc)
            or die("Error querying from database. " . mysql_error());
            if(mysql_num_rows($data1) != 0){
                echo '<p class="error">Sorry, the user already exist.</p>';
            }
            else{
                $query = "INSERT INTO owner (title, firstname, middlename, lastname, sex, dob, email,
                     phone, address, company, c_address, c_phone, img)VALUES('$title', '$fName', '$mName',
                     '$lName', '$mSex', '$dob', '$email', '$phone', '$address', '$company', '$companyAddress',
                     '$companyPhone', '$screenshot')";
                $data = mysql_query($query, $dbc)
                or die("Error inserting into the database. " . mysql_error());
                 echo '<p>A new account has been successfully created.</p>';
              }
          }
          else {
            echo '<p class="error">Sorry, there was a problem uploading your screen shot image.</p>';
          }
      }
      else {
        echo '<p class="error">The screen shot must be a GIF, JPEG, or PNG image file no greater than ' . (MM_MAXFILESIZE / 1024) . ' KB in size.</p>';
      }

      // Try to delete the temporary screen shot image file
      @unlink($_FILES['screenshot']['tmp_name']);
    }
}
?>




<!DOCTYPE HTML>
<html>
<head>
    <title>Vehicle | Automated License Plate Recognition</title>
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
         <div class="container" style="margin: 50px;">
 <form class="form-horizontal" method="post" action="vehicle.php">
<!-- Select Basic -->

      <legend>New Registration</legend>
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Plate Number</label>
  <div class="col-md-4">
    <select id="selectbasic" name="r_number" class="form-control">
      <?php
                                            $query = "SELECT * FROM number";
                                            $data = mysql_query($query, $dbc)
                                            or die("Error selecting from database. " . mysql_error());

                                            while ($row = mysql_fetch_array($data)) {
                                                $prefix = $row['number'];
                                                echo '<option value="'.$row['number_id'].'">' . $row['number']. '</option>';
                                            }
                                        ?> 
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="r_title">Title</label>
  <div class="col-md-4">
    <select id="r_title" name="r_title" class="form-control">
      <option value="Mr.">Mr.</option>
      <option value="Mrs.">Mrs.</option>
      <option value="Dr.">Dr.</option>
      <option value="Engr.">Engr.</option>
      <option value="Jnr.">Jnr.</option>
      <option value="Prof.">Prof.</option>
    </select>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="f_name">First Name</label>  
  <div class="col-md-4">
  <input id="f_name" name="f_name" type="text" placeholder="" class="form-control input-md" required="true">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="m_name">Middle Name</label>  
  <div class="col-md-4">
  <input id="m_name" name="m_name" type="text" placeholder="" class="form-control input-md" required="true">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="l_name">Last Name</label>  
  <div class="col-md-4">
  <input id="l_name" name="l_name" type="text" placeholder="" class="form-control input-md" required="true">
    
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="r_sex">Sex</label>
  <div class="col-md-4">
    <select id="r_sex" name="r_sex" class="form-control">
      <option value="Male.">-- Select one --</option>
      <option value="Female.">Male.</option>
      <option value="">Female</option>
    </select>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="r_dob">DOB</label>  
  <div class="col-md-4">
  <input id="r_dob" name="r_dob" type="date" placeholder="" class="form-control input-md" required="true">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="r_email">Email</label>  
  <div class="col-md-4">
  <input id="r_email" name="r_email" type="email" placeholder="" class="form-control input-md" required="true">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="r_phome">Phone</label>  
  <div class="col-md-4">
  <input id="r_phome" name="r_phome" type="text" placeholder="" class="form-control input-md" required="true">
    
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="r_address">Address</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="r_address" name="r_address"></textarea>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="r_company">Company</label>  
  <div class="col-md-4">
  <input id="r_company" name="r_company" type="text" placeholder="" class="form-control input-md" required="true">
    
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="r_caddress">Company's Address</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="r_caddress" name="r_caddress"></textarea>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="r_cphone">Company Phone</label>  
  <div class="col-md-4">
  <input id="r_cphone" name="r_cphone" type="text" placeholder="" class="form-control input-md" required="true">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="r_created">Created</label>  
  <div class="col-md-4">
  <input id="r_created" name="r_created" type="date" placeholder="" class="form-control input-md" required="true">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="r_expires">Expires</label>  
  <div class="col-md-4">
  <input id="r_expires" name="r_expires" type="date" placeholder="" class="form-control input-md" required="true">
    
  </div>
</div>
 
    <div class="form-group">
      <label for="uploadimage" class="col-md-4 control-label">Upload Image:</label>
      <div class="col-md-4">
        <input type="file" name="screenshot" name="screenshot" class="form-control input-md" required="true">
        <p class="help-block">
          Allowed formats: jpeg, jpg, gif, png
        </p><br>
      </div>

 
    <div class="form-group">
      <div class="col-md-4">
       <button id="btnAdd" name="btnAdd" class="btn btn-primary" title="Click here to register a new User.">Register</button>
       <br><br><br><br><br>
      </div>
    </div>
</fieldset>
    
    <div class="row">
        
        
        <div class="col-md-12">
        <h4>Bootstrap Snipp for Datatable</h4>
        <div class="table-responsive">
        
                
              <table id="mytable" class="table table-bordred table-striped">
                   
                   <thead>
                   
                   <th>Image</th>
                   <th>Full Name</th>
                    <th>Plate Number</th>
                     <th>Created/Renew</th>
                      <th>Expires</th>
                       <th>Edit</th>     
                       <th>Delete</th>
                   </thead>
    <tbody>
    
    <tr>
    <?php
         $query2 = "SELECT owner.*, number.* FROM owner, number WHERE owner.number_id =  number.number_id";
        $data2 = mysql_query($query2, $dbc)
         or die("Error selecting from database. " . mysql_error());
            while($row = mysql_fetch_array($data2)){ 
            $fullname = $row['title']. ' ' .$row['firstname'].' '.$row['middlename'].' '.$row['lastname'];
           if (is_file(MM_UPLOADPATH . $row['img']) && filesize(MM_UPLOADPATH . $row['img']) > 0) {
                 echo '<td><img class="image" src="' . MM_UPLOADPATH . $row['img'] . '" alt="Score image" /></td>';
            }
            else {
              echo '<td><img class="image" src="' . MM_UPLOADPATH . 'unverified.gif' . '" alt="Unverified score"/></td>';
            }
             echo '<td>'.$fullname.'</td>';
             echo '<td>'.$row['number'].'</td>';
             echo '<td>'.$row['created'].'</td>';
             echo '<td>'.$row['expire'].'</td>';
            ?>
    <td><p><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-pencil"></span></button></p></td>
    <td><p><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" data-placement="top" rel="tooltip"><span class="glyphicon glyphicon-trash"></span></button></p></td>
    </tr>    
        <?php
    }
    ?>
    </tbody>
        
</table>

                
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