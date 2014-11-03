<!DOCTYPE HTML>
<html>
<head>
    <title>Search | Automated License Plate Recognition</title>
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
                            <input type="text" name="r_search" style="width:50%;" value="">&nbsp;
                            <button id="btnAdd" name="btnAdd" class="btn btn-primary" title="Click here to add a new format.">Search Plate Number</button>
                              (i.e): XXX-23434-XX<br><br><br><br>
                            </fieldset>

<div class="col-md-12">
        <h4>Bootstrap Snipp for Datatable</h4>
        <div class="table-responsive">
        
                
              <table id="mytable" class="table table-bordred table-striped">
                   
                   <thead>
                   
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
                $search = mysql_real_escape_string(trim($_POST['r_search']), $dbc);

                $query = "SELECT owner.*, number.* FROM owner, number WHERE owner.number_id =  number.number_id 
                and number.number = '$search'";
                $data2 = mysql_query($query, $dbc)
                 or die("Error selecting from database. " . mysql_error());
                    while($row = mysql_fetch_array($data2)){ 
                        $fullname = $row['title']. ' ' .$row['firstname'].' '.$row['middlename'].' '.$row['lastname'];
                              echo '<tr><td class="label">Full name:</td><td>' . $fullname . '</td></tr>';
                              echo '<tr><td class="label">Sex:</td><td>' . $row['sex'] . '</td></tr>';
                              echo '<tr><td class="label">DOB:</td><td>' . $row['dob'] . '</td></tr>';
                    }
            }
                mysql_close($dbc);
    ?>
    
    </tbody>
        
</table>

                
            </div>
            
        </div>


</div>

</form>

    <div class="navbar navbar-default navbar-fixed-bottom">
        <div class="container">
            <p class="navbar-text pull-left"><span>&copy; 2014 | Automated License Plate Recognition (ALPR)</span></p>
            <a href="http://youtube.com" class="navbar-btn btn-danger btn pull-right">Subscribe on YouTube</a>
        </div>
    </div>