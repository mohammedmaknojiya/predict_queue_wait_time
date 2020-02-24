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
$in_billing_time=$_SESSION['inbilling'];
$out_billing_time=$_SESSION['outbilling'];
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
$datequery= "select date from billing_time ORDER BY token_no DESC LIMIT 2 ";
        $query_runnn = mysqli_query($con,$datequery);
        if(mysqli_num_rows($query_runnn)>0)
        {
          while($row=mysqli_fetch_assoc($query_runnn))
          {
              $datequerybill=$row["date"];
			  
          }
        }
	$billing= "select in_time,out_time from billing_time ORDER BY out_time DESC LIMIT 2 ";
        $query_runnn = mysqli_query($con,$billing);
			if(mysqli_num_rows($query_runnn)>0){
				while($row=mysqli_fetch_assoc($query_runnn)){
					$out_billingquery=$row["out_time"];
					$in_billingquery=$row['in_time'];
				}
			}	
	





?>
<!DOCTYPE html>
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
	
	<div class="title1" >Billing Counter</div> <div class="subtitle1" >FOLLOW THE TIME @ <?php echo htmlspecialchars($name); ?></div>
	
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
                    <a class="nav-link" href="bot.php">ASK BOT</a>
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

<h2 align="text-center bg-info">The Last Billing Out Time is/was :</h2>
<p  name="in-info" ></p>
<p><?php echo htmlspecialchars($out_billingquery); ?></p>


<div class="wrapper">
<!-- Display the countdown timer in an element -->

<h2 align="text-center bg-info">Your Billing Starts in:</h2>
<p  name="in-info" id="demo"></p>
<p><?php echo htmlspecialchars($_SESSION["inbilling"]); ?></p>

<h2 align="text-center bg-info">Your Billing Time expires in:</h2>
<p name="hi" id="demo1"></p>
<p><?php echo htmlspecialchars($_SESSION["outbilling"]); ?></p>

<input type="submit" value="I am OUT" id='out' name='out'  disabled />


<div id="msg"></div>
</div>
</form>
</div>

</body>

</html>
<script>
var count = new Date("<?php echo htmlspecialchars($_SESSION["date"]);?> "+" "+"<?php echo htmlspecialchars($_SESSION["inbilling"]); ?>").getTime();
var count1 = new Date("<?php echo htmlspecialchars($_SESSION["date"]);?> "+" "+"<?php echo htmlspecialchars($_SESSION["outbilling"]); ?>").getTime();
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
  document.getElementById("demo").innerHTML = hours + "h "
  + minutes + "m " + seconds + "s ";
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "Billing Started";
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
    document.getElementById("demo1").innerHTML = "Billing done";
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