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
$token=$_SESSION['token'];
$textcombine=$_SESSION['text'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="css.css">
	<title>Token</title>

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
	
	<div class="title1" >GENENRAL INFO</div> <div class="subtitle1" >FOLLOW THE TIME @ <?php echo htmlspecialchars($name); ?></div>
	
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
                    <a class="nav-link" href="tracktimer.php">LIVE TRACK</a>
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

<div class="wrapper">
<!-- Display the countdown timer in an element -->
<h2>YOUR TOKEN NO. IS <?php echo htmlspecialchars($token); ?></h2>
<p>YOUR OVERALL JOURNEY IS.<?php echo htmlspecialchars($textcombine); ?></p>

<div id="msg"></div>
</div>
</form>
</div>
</body>
</html>