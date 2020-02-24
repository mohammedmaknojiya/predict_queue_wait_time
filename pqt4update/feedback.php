<?php
/*For My LocalPC*/
$con=mysqli_connect ("localhost", "root", "") or die ('I cannot connect to the database because: ' . mysql_error());
mysqli_select_db ($con,'hospital_login_db');
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Feedback</title>
  </head>
  <body>
      <h1 class="text-center bg-info">FEEDBACK FORM</h1>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  
  <!----nav bar-->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <!--<li class="nav-item active">
              <a class="nav-link" href="index.php">HOME <span class="sr-only">(current)</span></a>
            </li>-->
            <li class="nav-item">
                    <a class="nav-link" href="profile.php">PROFILE</a>
                  </li>
            <li class="nav-item">
              <a class="nav-link" href="addtreatment.php">ADD-TREATMENT</a>
            </li>
            <li class="nav-item">
                    <a class="nav-link" href="#">TOKEN</a>
                  </li>
            <li class="nav-item">
                <a class="nav-link" href="feedback.php">FEEDBACK</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="adminlogin.php">ADMIN-LOGIN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="map.php">MAP</a>
                  </li>
                  <li class="nav-item">
                        <a class="nav-link" href="index.php">LOGOUT</a>
                </li>

             
          </ul>
        </div>
      </nav>
    
      <br><br><br>
   
   
    <!----registration form making -->
<div class="text-center "  >
    <form action="feedback.php" method="POST">
        First name:<br>
        <input type="text" name="firstname" >
        <br>
        Phone Number:<br>
        <input type="number"  name="phone"  >
        <br>
        Treatment Type:<br>
        <input type="text" name="treatment" list="treat">
        <datalist id="treat">
            <option value="x-ray"></option>
            <option value="fracture"></option>
            <option value="consultant"></option>
            <option value="fever"></option>
            <option value="blood-checkup"></option>
            <option value="MRI"></option>
            <option value="sonography"></option>
            <option value="admit"></option>
            

        </datalist>
        <br>
        Service According To Wait Time Prediction:
        <input type="radio" name="rate" value="good"> Good
        <input type="radio" name="rate" value="moderate"> Moderate
        <input type="radio" name="rate" value="bad"> Bad
        <br>
        How Much Extra Time Of Waiting Required By You For Treatment:
        <input type="number" name="extratime" placeholder="eg:5min or 15min">
        <br>
        <input type="submit" value="Submit" name="btnclick">
      </form>

</div>
    </body>
</html>


<!------php code-->

<?php
			if(isset($_POST['btnclick']))
			{
				@$username=$_POST['firstname'];
        @$phone=$_POST['phone'];
        @$treatment=$_POST['treatment'];
        @$rate=$_POST['rate'];
        @$extratime=$_POST['extratime'];
       
				
				$query = "insert into feedback_table(name,phoneno,treatment_type,rating,extratime) values('$username','$phone','$treatment','$rate','$extratime')";
				$query_run = mysqli_query($con,$query);
				if($query_run)
					{
						echo '<script type="text/javascript">alert("Feedback Submitted.. Welcome")</script>';
						
						
					}
				else
					{
						echo '<p class="bg-danger msg-block">Registration Unsuccessful due to server error. Please try later</p>';
					}
				
				}
				
				
			
			
		?>