<?php
session_start();
$con=mysqli_connect ("localhost", "root", "") or die ('I cannot connect to the database because: ' . mysql_error());
mysqli_select_db ($con,'hospitalpqt');
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"] ) || $_SESSION["loggedin"] !== true ){
    header("location: login.php");
	exit;
}
if(!isset($_SESSION["waittime"]) || !isset($_SESSION['timer'] )){
	header("location: treatmenteg.php");
    exit;
}
$phone=$_SESSION['phone'];
$query ="select name from user_login_online where phone= '$phone' or name='$phone' ";
$query_run = mysqli_query($con,$query);
if(mysqli_num_rows($query_run)>0)
      {
        while($row=mysqli_fetch_assoc($query_run))
        {
            $name=$row["name"];
        }
      }
$treat=$_SESSION['treatment'];
$indoc=$_SESSION['indoctime'];
$date=$_SESSION['date'];
////////////////////////////////////////////////////////////////
if($treat=='fever' or $treat=='fracture' or $treat=='others'){
	$query="select token_no from doctor_cabin_entry_table where date='$date' and treat_start_doc='$indoc'";
	$query_run = mysqli_query($con,$query);
			if(mysqli_num_rows($query_run)>0){
				while($row=mysqli_fetch_assoc($query_run)){
					$token=$row["token_no"];
				}
			}
	}
else if($treat=='xray'){
	$query="select token_no from xray_cabin_entry_table where date='$date' and treat_start_lab_xray='$indoc'";
	$query_run = mysqli_query($con,$query);
			if(mysqli_num_rows($query_run)>0){
				while($row=mysqli_fetch_assoc($query_run)){
					$token=$row["token_no"];
				}
			}
	}
else if($treat=='mri'){
	$query="select token_no from mri_cabin_entry_table where date='$date' and treat_start_lab_mri='$indoc'";
	$query_run = mysqli_query($con,$query);
			if(mysqli_num_rows($query_run)>0){
				while($row=mysqli_fetch_assoc($query_run)){
					$token=$row["token_no"];
				}
			}
	} 
else if($treat=='bloodcheck'){
	$query="select token_no from blood_cabin_entry_table where date='$date' and treat_start_lab_blood='$indoc'";
	$query_run = mysqli_query($con,$query);
			if(mysqli_num_rows($query_run)>0){
				while($row=mysqli_fetch_assoc($query_run)){
					$token=$row["token_no"];
				}
			}
	} 
else if($treat=='sonography'){
	$query="select token_no from sono_cabin_entry_table where date='$date' and treat_start_lab_sono='$indoc'";
	$query_run = mysqli_query($con,$query);
			if(mysqli_num_rows($query_run)>0){
				while($row=mysqli_fetch_assoc($query_run)){
					$token=$row["token_no"];
				}
			}
	}



///////////////////////////////////////////////////////////////
if(isset($_POST['in'])){
	
$time_now=mktime(date('H')+4,date('i')+30,date('s'));
@$time = date(' H:i:s', $time_now);
if($treat=='fever' or $treat=='fracture' or $treat=='others'){
	$query="UPDATE doctor_cabin_entry_table SET actual_treat_start_doc = '$time' where treat_start_doc = '$indoc'";
	$query_run = mysqli_query($con,$query);
	}
else if($treat=='xray'){
	$query="UPDATE xray_cabin_entry_table SET actual_treat_start_xray = '$time' where treat_start_lab_xray = '$indoc'";
	$query_run = mysqli_query($con,$query);
	}
else if($treat=='mri'){
	$query="UPDATE mri_cabin_entry_table SET actual_treat_start_mri = '$time' where treat_start_lab_mri = '$indoc'";
	$query_run = mysqli_query($con,$query);
	} 
else if($treat=='bloodcheck'){
	$query="UPDATE blood_cabin_entry_table SET actual_treat_start_blood = '$time' where treat_start_lab_blood = '$indoc'";
	$query_run = mysqli_query($con,$query);
	} 
else if($treat=='sonography'){
	$query="UPDATE sono_cabin_entry_table SET actual_treat_start_sono = '$time' where treat_start_lab_sono == '$indoc' ";
	$query_run = mysqli_query($con,$query);
	}
if($query_run){
	$query="insert into admin_page values('$token $time')";
	$query_run = mysqli_query($con,$query);
	echo '<script>alert("Treatment time updated")</script>';
	}	
}
/////////////////////////////////////////////////////////////////////////
if(isset($_POST['out'])){
	
$time_now=mktime(date('H')+4,date('i')+30,date('s'));
@$time = date('H:i:s', $time_now);
if($treat=='fever' or $treat=='fracture' or $treat=='others'){
	$query="UPDATE doctor_cabin_entry_table SET actual_treat_start_doc = '$time' where treat_start_doc = '$indoc'";
	$query_run = mysqli_query($con,$query);
	}
else if($treat=='xray'){
	$query="UPDATE xray_cabin_entry_table SET actual_treat_start_xray = '$time' where treat_start_lab_xray = '$indoc'";
	$query_run = mysqli_query($con,$query);
	}
else if($treat=='mri'){
	$query="UPDATE mri_cabin_entry_table SET actual_treat_start_mri = '$time' where treat_start_lab_mri = '$indoc'";
	$query_run = mysqli_query($con,$query);
	} 
else if($treat=='bloodcheck'){
	$query="UPDATE blood_cabin_entry_table SET actual_treat_start_blood = '$time' where treat_start_lab_blood = '$indoc'";
	$query_run = mysqli_query($con,$query);
	} 
else if($treat=='sonography'){
	$query="UPDATE sono_cabin_entry_table SET actual_treat_start_sono = '$time' where treat_start_lab_sono == '$indoc' ";
	$query_run = mysqli_query($con,$query);
	}
if($query_run){
	$query="insert into admin_page values('$token $time')";
	$query_run = mysqli_query($con,$query);
	unset($_SESSION['timer']);
	$_SESSION['billing_no']=$_SESSION['date']." ".$_SESSION['inbilling'];
	echo '<script>alert("Treatment Done, Hope for speedy recovery");</script>'; 
	header("location:billing.php");
	exit;
	}
	
	$datequery= "select date from billing_time ORDER BY token_no DESC LIMIT 1 ";
        $query_runnn = mysqli_query($con,$datequery);
        if(mysqli_num_rows($query_runnn)>0)
        {
          while($row=mysqli_fetch_assoc($query_runnn))
          {
              $datequerybill=$row["date"];
			  
          }
        }
	$billing= "select in_time,out_time from billing_time ORDER BY out_time DESC LIMIT 1 ";
        $query_runnn = mysqli_query($con,$billing);
			if(mysqli_num_rows($query_runnn)>0){
				while($row=mysqli_fetch_assoc($query_runnn)){
					$out_billingquery=$row["out_time"];
					$in_billingquery=$row['in_time'];
				}
			}	
	
		
}        

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="css.css">
	<title>Live Track</title>

	<style type="text/css">
	.title1 {
	  		
	  text-align:center;
	  color:blue;
	  font: 40px sans-serif;
	  font-weight:300;
	  margin:0 0 10px;
	}
	.subtitle1{ 
	 
	  text-align:right;
	  color:blue;
	  font: 25px sans-serif;
	  font-weight:300;
	  margin:0 0 10px;
	}
	.subtitle2{ 
	 
	  text-align:center;
	  color:blue;
	  font: 25px sans-serif;
	  font-weight:300;
	  margin:0 0 10px;
	}
	h2{ 
	  color:red;	
	}
		
    </style>
	
	<div class="title1" >LIVE TRACK</div> <div class="subtitle1" >FOLLOW THE TIME @ <?php echo htmlspecialchars($name); ?></div>
	
   <!----nav bar-->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <!--<li class="nav-item active">
              <a class="nav-link" href="index.php">HOME <span class="sr-only">(current)</span></a>
            </li> -->
            
            <li class="nav-item">
                    <a class="nav-link" href="token.php">TOKEN</a>
                  </li>
			<li class="nav-item">
                    <a class="nav-link" href="bot.php">ASK-BOT</a>
                  </li>	  
            <li class="nav-item">
                <a class="nav-link" href="feedback.php">FEEDBACK</a>
              </li>
                <li class="nav-item">
                    <a class="nav-link" href="map.php">MAP</a>
                  </li>
                  <li class="nav-item">
                        <a class="nav-link" href="logout.php">LOGOUT</a>
                </li>

             
          </ul>
        </div>
      </nav>

</head>
<body>
<div="main" align="center">
<form name='f1' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

<div class="wrapper">
<!-- Display the countdown timer in an element -->

<h2 align="text-center bg-info">Your Treatment Starts in:</h2>
<p  name="in-info" id="demo"></p>
<p><?php echo htmlspecialchars($_SESSION["indoctime"]); ?></p>
<input type="submit" value="I am IN" id='in' name='in' disabled >

<h2 align="text-center bg-info">Your Treatment Ends in:</h2>
<p name="hi" id="demo1"></p>
<p><?php echo htmlspecialchars($_SESSION["outdoctime"]); ?></p>
<input type="submit" value="I am OUT" id='out' name='out'  disabled />

<div id="msg"></div>
</div>
</form>
</div>
</body>
</html>
<script>
var count = new Date("<?php echo htmlspecialchars($_SESSION["date"]);?> "+" "+"<?php echo htmlspecialchars($_SESSION["indoctime"]); ?>").getTime();
var count1 = new Date("<?php echo htmlspecialchars($_SESSION["date"]);?> "+" "+"<?php echo htmlspecialchars($_SESSION["outdoctime"]); ?>").getTime();
var x = setInterval( function() { startTimer(); }, 1000 );
var y = setInterval( function() { startTimer2(); }, 1000 );
function startTimer()
{
  
  var now = new Date().getTime();
  var distance = count - now;
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  document.getElementById("demo").innerHTML =  hours + "h "
  + minutes + "m " + seconds + "s ";
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "Treatment Started";
	document.getElementById('in').disabled = false;

  }

}
function startTimer2()
{
  var now = new Date().getTime();
  var distance = count1 - now;
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  document.getElementById("demo1").innerHTML = hours + "h "
  + minutes + "m " + seconds + "s ";
  if (distance < 0) {
    clearInterval(y);
    document.getElementById("demo1").innerHTML = "Treatment Done";
	document.getElementById('out').disabled = false;
  }
}
$(document).ready(function () {

        $("#f1").submit(function (e) {

            //stop submitting the form to see the disabled button effect
            e.preventDefault();

            //disable the submit button
            $("#in").attr("disabled", true);

            return true;

        });
    });

</script>