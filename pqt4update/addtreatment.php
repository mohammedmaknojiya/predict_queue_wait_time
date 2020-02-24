<?php
/*For My LocalPC*/
$con=mysqli_connect ("localhost", "root", "") or die ('I cannot connect to the database because: ' . mysql_error());
mysqli_select_db ($con,'hospitalpqt');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$time_now=mktime(date('h')+4,date('i')+30,date('s'));
@$time = date(" H:i:s", $time_now);

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Add Treatment</title>
  </head>
  <body>
      <h1 class="text-center bg-info">ADD TREATMENT</h1>

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
            </li> -->
            
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
                        <a class="nav-link" href="logout.php">LOGOUT</a>
                </li>

             
          </ul>
        </div>
      </nav>
    
      <br><br><br>
    
    
    <!----registration form making -->
<div class="text-center">
    <form action="addtreatment.php" method="post">
            select task<input type="text" name="task" list="tasks">
		<datalist id = "tasks">
			  <!--<option value="0">billing</option>  -->
		      <option value="1">bloodtest</option>
		      <!-----<option value="2">checkup</option>  -->
		      <option value="3">ctscan</option>
		      <option value="4">fracture</option>
		      <!----<option value="5">medicime</option>--->
		      <option value="6">mri</option>
		      <option value="7">xray</option>
		</datalist>
		<br>


		select gender<input type="text" name="gender" list="genders">
		<datalist id = "genders">
			  <option value="0">Female</option>
    		  <option value="1">Male</option>
		</datalist>
		<br>


		select age<input type="text" name="age" list="ages">
		<datalist id = "ages">
			  <option value="0">adult</option>
			  <option value="1">child</option>
			  <option value="2">old</option>
		</datalist>
		<br>

			Previous Medical History if any:<br>
			<input type="text" name="medhist">
			<br>
            
            
            Date:<br>
            <select name="date" >
			<option value="<?php echo date("Y-m-d");?>"><?php echo date("Y-m-d");?></option>
			</select>
            <br>
			Avail Time:<br>
			<p id="timedoc"></p>
			<br>
            Phone Number:<br>
            <input type="number"  name="phone" required>
            <br>
            <!--Choose Time:<br>
            <input type="time" name="time" >
            <br>-->
            
        <br>
        <input type="submit" id="sub" value="Register" name="btnclick">
		<div id="h1"><script type="text/javascript"><?php print(@$textcombine); ?></div>
      </form>

</div>
    </body>
</html>


<!------php code-->

<?php
     
    
if(isset($_POST['btnclick']) or $_SERVER["REQUEST_METHOD"] == "POST")
{	
///////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////
	
    @$task=$_POST['task'];
    @$age=$_POST['age'];
    @$gender=$_POST['gender'];
	$sessions=$_POST["session"];
	//$doc_type=$_POST["doc_type"];
	$doc_type='3';
	//$dept=$_POST["dept"];
	$dept='5';
	@$phone=$_POST['phone'];
	
	$string=$task.$gender.$dept.$doc_type.$sessions.$age;
	
	$treattime=exec("model2.py $string");
	

////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////
    //getting user register time at time of registration
    $time_now=mktime(date('h')+4,date('i')+30,date('s'));
    @$time = date(" H:i:s", $time_now);
    @$date=date("Y-m-d");
    
    
        
 /////////////////////////////////////// FRACTURE : FEVER : OTHERS  DOC-CABIN  //////////////////////////////////       
    if($task=='4')
    {
        
        //my defined time from enter gate to lab
        $distlabfrom= '00:01:00';
        
        
        //giving different treatment time to different disease
/////////////////////GIVING CONDITION FOR GENDER , AGE AND GIVE TIME FOR PARTICULAR TREATMENT ///////////////////

            

////////////////////////////////////////END HERE////////////////////////////////////////////////////

        //adding distlabfrom and user register time to get timetolab
        $secs = strtotime($distlabfrom)-strtotime('00:00:00');
        $timetolab = date("H:i:s",strtotime($time)+$secs);
        $timetolabstr = strtotime($timetolab)-strtotime('00:00:00');


        if($task=='4')
        {

          //getting out time of previous user 
		  
        $treatstartdoc= "select out_time_doc from doctor_cabin_entry_table ORDER BY token_no DESC LIMIT 1 ";
        $query_runn = mysqli_query($con,$treatstartdoc);
        if(mysqli_num_rows($query_runn)>0)
        {
          while($row=mysqli_fetch_assoc($query_runn))
          {
              $query_run1=$row["out_time_doc"];
			  $prev_strtime=strtotime($query_run1)-strtotime('00:00:00');
          }
        }
		
		$datequery= "select date from doctor_cabin_entry_table ORDER BY token_no DESC LIMIT 1 ";
        $query_runnn = mysqli_query($con,$datequery);
        if(mysqli_num_rows($query_runnn)>0)
        {
          while($row=mysqli_fetch_assoc($query_runnn))
          {
              $datequery1=$row["date"];
			  
          }
        }
          
          //adding outtime of previous patient and and current user treattime to get outtimedoc means outtime of patient after treatment
		if($timetolab < $query_run1 && date("Y-m-d")==$datequery1){	
		$indoctime=	date("H:i:s",strtotime("00:00:30")+$prev_strtime);
        $secs = strtotime($treattime)-strtotime("00:00:00");
        $outdoctime= date("H:i:s",strtotime($indoctime)+$secs);
        }
		else{
		$secs = strtotime($treattime)-strtotime("00:00:00");
		$indoctime=	date("H:i:s",strtotime("00:00:30")+$timetolabstr);
		$outdoctime= date("H:i:s",strtotime($indoctime)+$secs);	
		}	

        //now to calculate waittimedoc means how much wait patient has to do to get treate by doctor 
        //for that we subtract treatment start doc means his given time + how much early he arrived means his timetolab

        #$secs = strtotime($indoctime)-strtotime("00:00:00");
        $waittime= date("H:i:s",strtotime($indoctime)-$timetolabstr);

        //now to calculate billing time we have to add distlabfrom  (means lab to first registration desk then from there to medicine counter time)  and 3min etc

        $medicinetime="00:03:00";

        $secs = strtotime($medicinetime)-strtotime("00:00:00");
        $billingtime= date("H:i:s",strtotime($outdoctime)+$secs);
		
		//if medicine is prescribed then that time will be out time or the biling time will be the outime
		
		$secs=strtotime("00:01:00")-strtotime("00:00:00");
		$outtime= date("H:i:s",strtotime($billingtime)+$secs);
 
        $query2= "insert into doctor_cabin_entry_table (doc_cabin,date,dist_lab_from,in_time,time_to_lab,treat_time,treat_start_doc,out_time_doc,wait_time_doc,billing_time,medicine_time,out_time) values('on','$date','00:01:00','$time','$timetolab','$treattime','$indoctime', '$outdoctime','$waittime','$billingtime','','$outtime')";
          $query_run3 = mysqli_query($con,$query2);
          /*if($query_run3)
					{
						echo '<script type="text/javascript">alert("User data inserted Registered.. Welcome")</script>';
						header( "Location: token.php");
						
					}
				else
					{
						echo '<p class="bg-danger msg-block">Registration Unsuccessful due to server error. Please try later</p>';
          }*/
        ///////////////////////////////////////////SMS FOR DOC_CABIN ///////////////////////////
	   
        /*$textcombine= "Your treatment :".$treatment."||".
                      "Your booking time is :".$time."||".
                      "Your booking date is :".$date."||".
                      "Your treatment start at :".$query_run1."||".
                      "Your outime is :".$outtimedoc."||".
                      "Your billing time is :".$billingtime."||".
                      "Your waittime is :".$waittime."||" ;
		
	
		
                      $url="www.way2sms.com/api/v1/sendCampaign";
                      $message = urlencode($textcombine);// urlencode your message
                      $curl = curl_init();
                      curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
                      curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=NQ4WGMOQ5P2V1BM8E893HHK8EVHY7KRS&secret=PWT0WMLUMXA1NJQS&usetype=stage&phone=$phone&senderid=mmra9593@gmail.com&message=$message");// post data
                      // query parameter values must be given without squarebrackets.
                      // Optional Authentication:
                      curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                      curl_setopt($curl, CURLOPT_URL, $url);
                      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                      $result = curl_exec($curl);
                      curl_close($curl);
                      echo $result;*/
                    //////////////////////////////////////////SMS END ///////////////////////////
          }
    }
////////////////////////////////////// DOC-CABIN ENDS /////////////////////////////////////////////////////////////



    
///////////////////////////////////////////////    X RAY   //////////////////////////////////////////////////



    else if($task=='7')
    {
        $distlabfrom= '00:03:00';

//////////////////GIVING TREATMENT TIME TO XRAY PATIENT ACCORDING TO AGE AND GENDER//////////////////////////////

		//$treattime='00:06:00';

////////////////////////////////////////END HERE////////////////////////////////////////////////////

        //adding distlabfrom and user register time to get timetolab
		$secs = strtotime($distlabfrom)-strtotime('00:00:00');
        $timetolab = date("H:i:s",strtotime($time)+$secs);
        $timetolabstr = strtotime($timetolab)-strtotime('00:00:00');
		

      //getting out time and date of previous user 
	  
        $treatstartxray= "select out_time_lab_xray from xray_cabin_entry_table ORDER BY token_no DESC LIMIT 1 ";
        $query_runn = mysqli_query($con,$treatstartxray);
		
		if(mysqli_num_rows($query_runn)>0)
      {
        while($row=mysqli_fetch_assoc($query_runn))
        {
            $query_run1=$row["out_time_lab_xray"];
			$prev_strtime=strtotime($query_run1)-strtotime('00:00:00');
        }
      }

	  $datequery= "select date from xray_cabin_entry_table ORDER BY token_no DESC LIMIT 1 ";
      $query_runnn = mysqli_query($con,$datequery);
        if(mysqli_num_rows($query_runnn)>0)
        {
          while($row=mysqli_fetch_assoc($query_runnn))
          {
              $datequery1=$row["date"];
			  
          }
        }	
        
        //adding outtime of previous patient and and current user treattime to get outtimedoc means outtime of patient after treatment
		
		if($timetolab < $query_run1 && date("Y-m-d")==$datequery1){		
		$indoctime=	date('H:i:s',strtotime("00:00:30")+$prev_strtime);
        $secs = strtotime($treattime)-strtotime("00:00:00");
        $outdoctime= date("H:i:s",strtotime($indoctime)+$secs);
        }
		else{
		$secs = strtotime($treattime)-strtotime("00:00:00");
		$indoctime=	date("H:i:s",strtotime("00:00:30")+$timetolabstr);
		$outdoctime= date("H:i:s",strtotime($indoctime)+$secs);	
		}
      
      //now to calculate waittimedoc means how much wait patient has to do to get treate by doctor 
      //for that we subtract treatment start doc means his given time + how much early he arrived means his timetolab

        $waittime= date("H:i:s",strtotime($indoctime)-$timetolabstr);

      //now to calculate billing time we have to add distlabfrom  (means lab to first registration desk then from there to medicine counter time)  and 3min etc

        $medicinetime="00:03:00";

        $secs = strtotime($medicinetime)-strtotime("00:00:00");
        $billingtime= date("H:i:s",strtotime($outdoctime)+$secs);

		//if medicine is prescribed then that time will be out time or the biling time will be the outime
		
		$secs=strtotime("00:01:00")-strtotime("00:00:00");
		$outtime= date("H:i:s",strtotime($billingtime)+$secs);

      /////////////////////////CHECKING NO OF TOKEN IS GREATER THAN LIMIT /////////////////////////////
      $tokennocheck="SELECT token_no FROM `xray_cabin_entry_table` ORDER BY token_no DESC LIMIT 1";
      $query_run6 = mysqli_query($con,$tokennocheck);
              if(mysqli_num_rows($query_run6)>0)
              {
                while($row=mysqli_fetch_assoc($query_run6))
                {
                    $token_no_check=$row["token_no"];
                }
              }

      if($token_no_check==10)
      {
        echo '<script type="text/javascript">alert("No of entries for Today is full.Register Tomorrow")</script>';
      }
      else
      {
        $query2= "insert into xray_cabin_entry_table (lab_xray,date,dist_lab_from,in_time,time_to_lab,treat_time,treat_start_lab_xray,out_time_lab_xray,wait_time_lab_xray,billing_time,medicine_time,out_time) values('on','$date','$distlabfrom','$time','$timetolab','$treattime','$indoctime','$outdoctime','$waittime','$billingtime','','$outtime')";
        $query_run3 = mysqli_query($con,$query2);
      }
      ///////////////////////////////////////CHECKING ENDs HERE////////////////////////////////////////////////////
        /*if($query_run3)
                  {
                      echo '<script type="text/javascript">alert("User data inserted Registered.. Welcome")</script>';
                      header( "Location: token.php");
                      
                  }
              else
                  {
                      echo '<p class="bg-danger msg-block">Registration Unsuccessful due to server error. Please try later</p>';
                  }*/
              

        ///////////////////////////////////////////SMS FOR XRAY ///////////////////////////
       /* $textcombine= "Your treatment :".$treatment."||".
                      "Your booking time is :".$time."||".
                      "Your booking date is :".$date."||".
                      "Your treatment start at :".$query_run1."||".
                      "Your outime is :".$outtimexray."||".
                      "Your billing time is :".$billingtime."||".
                      "Your waittime is :".$waittime."||" ;

        $url="www.way2sms.com/api/v1/sendCampaign";
        $message = urlencode($textcombine);// urlencode your message
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
        curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=NQ4WGMOQ5P2V1BM8E893HHK8EVHY7KRS&secret=PWT0WMLUMXA1NJQS&usetype=stage&phone=$phone&senderid=mmra9593@gmail.com&message=$message");// post data
        // query parameter values must be given without squarebrackets.
        // Optional Authentication:
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);
        echo $result;*/
      //////////////////////////////////////////SMS END ///////////////////////////



    }

/////////////////////////////////X RAY ENDS//////////////////////////////////////////////////////


///////////////////////////////////////////////    MRI    //////////////////////////////////////



    else if($task=='6')
    {
        $distlabfrom= '00:03:00';
        
//////////////////GIVING TREATMENT TIME TO MRI PATIENT ACCORDING TO AGE AND GENDER//////////////////////////////


        //$treattime="00:30:00";                    

////////////////////////////////////////END HERE////////////////////////////////////////////////////

        //adding distlabfrom and user register time to get timetolab
        $secs = strtotime($distlabfrom)-strtotime('00:00:00');
        $timetolab = date("H:i:s",strtotime($time)+$secs);
		$timetolabstr=strtotime($timetolab)-strtotime('00:00:00');
		
      //getting out time of previous user 
        $treatstartmri= "select out_time_lab_mri from mri_cabin_entry_table ORDER BY token_no DESC LIMIT 1 ";
        $query_runn = mysqli_query($con,$treatstartmri);
      if(mysqli_num_rows($query_runn)>0)
      {
        while($row=mysqli_fetch_assoc($query_runn))
        {
            $query_run1=$row["out_time_lab_mri"];
			$prev_strtime=strtotime($query_run1)-strtotime('00:00:00');
        }
      }
      
	  $datequery= "select date from mri_cabin_entry_table ORDER BY token_no DESC LIMIT 1 ";
        $query_runnn = mysqli_query($con,$datequery);
        if(mysqli_num_rows($query_runnn)>0)
        {
          while($row=mysqli_fetch_assoc($query_runnn))
          {
              $datequery1=$row["date"];
			  
          }
        }
        
        //adding outtime of previous patient and and current user treattime to get outtimedoc means outtime of patient after treatment

       if($timetolab < $query_run1 && date("Y-m-d")==$datequery1){		
		$indoctime=	date('H:i:s',strtotime("00:00:30")+$prev_strtime);
        $secs = strtotime($treattime)-strtotime("00:00:00");
        $outdoctime= date("H:i:s",strtotime($indoctime)+$secs);
        }
		else{
		$secs = strtotime($treattime)-strtotime("00:00:00");
		$indoctime=	date("H:i:s",strtotime("00:00:30")+$timetolabstr);
		$outdoctime= date("H:i:s",strtotime($indoctime)+$secs);	
		}

      //now to calculate waittimedoc means how much wait patient has to do to get treate by doctor 
      //for that we subtract treatment start doc means his given time + how much early he arrived means his timetolab

        $waittime= date("H:i:s",strtotime($indoctime)-$timetolabstr);

      //now to calculate billing time we have to add distlabfrom  (means lab to first registration desk then from there to medicine counter time)  and 3min etc

        $medicinetime="00:03:00";

        $secs = strtotime($medicinetime)-strtotime("00:00:00");
        $billingtime= date("H:i:s",strtotime($outdoctime)+$secs);

		//if medicine is prescribed then that time will be out time or the biling time will be the outime
		
		$secs=strtotime("00:01:00")-strtotime("00:00:00");
		$outtime= date("H:i:s",strtotime($billingtime)+$secs);

      /////////////////////////CHECKING NO OF TOKEN IS GREATER THAN LIMIT /////////////////////////////
      $tokennocheck="SELECT token_no FROM `mri_cabin_entry_table` ORDER BY token_no DESC LIMIT 1";
      $query_run7 = mysqli_query($con,$tokennocheck);
              if(mysqli_num_rows($query_run7)>0)
              {
                while($row=mysqli_fetch_assoc($query_run7))
                {
                    $token_no_check=$row["token_no"];
                }
              }

      if($token_no_check==10)
      {
        echo '<script type="text/javascript">alert("No of entries for Today is full.Register Tomorrow")</script>';
      }

      else
      {
        $query2= "insert into mri_cabin_entry_table (lab_mri,date,dist_lab_from,in_time,time_to_lab,treat_time,treat_start_lab_mri,out_time_lab_mri,wait_time_lab_mri,billing_time,medicine_time,out_time) values('on','$date','$distlabfrom','$time','$timetolab','$treattime','$indoctime', '$outdoctime','$waittime','$billingtime','','$outtime')";
        $query_run3 = mysqli_query($con,$query2);

      }
      ///////////////////////////////////////CHECKING ENDs HERE////////////////////////////////////////////////////
        /*if($query_run3)
                  {
                      echo '<script type="text/javascript">alert("User data inserted Registered.. Welcome")</script>';
                      header( "Location: token.php");
                      
                  }
              else
                  {
                      echo '<p class="bg-danger msg-block">Registration Unsuccessful due to server error. Please try later</p>';
                  }*/
              ///////////////////////////////////////////SMS FOR MRI ///////////////////////////
                /*$textcombine= "Your treatment :".$treatment."||".
                              "Your booking time is :".$time."||".
                              "Your booking date is :".$date."||".
                              "Your treatment start at :".$query_run1."||".
                              "Your outime is :".$outtimemri."||".
                              "Your billing time is :".$billingtime."||".
                              "Your waittime is :".$waittime."||" ;

                $url="www.way2sms.com/api/v1/sendCampaign";
                $message = urlencode($textcombine);// urlencode your message
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
                curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=NQ4WGMOQ5P2V1BM8E893HHK8EVHY7KRS&secret=PWT0WMLUMXA1NJQS&usetype=stage&phone=$phone&senderid=mmra9593@gmail.com&message=$message");// post data
                // query parameter values must be given without squarebrackets.
                // Optional Authentication:
                curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                $result = curl_exec($curl);
                curl_close($curl);
                echo $result;*/
              //////////////////////////////////////////SMS END ///////////////////////////    

    }

      //////////////////////////////////MRI ENDS/////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////    blood   //////////////////////////////////////////////////



    else if($task=='1')
    {
        $distlabfrom= '00:03:30';
       
		
//////////////////GIVING TREATMENT TIME TO BLOOD PATIENT ACCORDING TO AGE AND GENDER//////////////////////////////
	
		 //$treattime="00:05:30";

////////////////////////////////////////END HERE////////////////////////////////////////////////////

        //adding distlabfrom and user register time to get timetolab
        $secs = strtotime($distlabfrom)-strtotime('00:00:00');
        $timetolab = date("H:i:s",strtotime($time)+$secs);
		$timetolabstr= strtotime($timetolab)-strtotime('00:00:00');

      //getting out time of previous user 
        $treatstartblood= "select out_time_lab_blood from blood_cabin_entry_table ORDER BY token_no DESC LIMIT 1 ";
        $query_runn = mysqli_query($con,$treatstartblood);
			if(mysqli_num_rows($query_runn)>0){
				while($row=mysqli_fetch_assoc($query_runn)){
					$query_run1=$row["out_time_lab_blood"];
					$prev_strtime=strtotime($query_run1)-strtotime('00:00:00');
				}
			}
			
		$datequery= "select date from blood_cabin_entry_table ORDER BY token_no DESC LIMIT 1 ";
        $query_runnn = mysqli_query($con,$datequery);
			if(mysqli_num_rows($query_runnn)>0){
				while($row=mysqli_fetch_assoc($query_runnn)){
					$datequery1=$row["date"];
				}
			}
        
        //adding outtime of previous patient and and current user treattime to get outtimedoc means outtime of patient after treatment

        if($timetolab < $query_run1 && date("Y-m-d")==$datequery1){		
		$indoctime=	date('H:i:s',strtotime("00:00:30")+$prev_strtime);
        $secs = strtotime($treattime)-strtotime("00:00:00");
        $outdoctime= date("H:i:s",strtotime($indoctime)+$secs);
        }
		else{
		$secs = strtotime($treattime)-strtotime("00:00:00");
		$indoctime=	date("H:i:s",strtotime("00:00:30")+$timetolabstr);
		$outdoctime= date("H:i:s",strtotime($indoctime)+$secs);	
		}

      //now to calculate waittimedoc means how much wait patient has to do to get treate by doctor 
      //for that we subtract treatment start doc means his given time + how much early he arrived means his timetolab

        $waittime= date("H:i:s",strtotime($indoctime)-$timetolabstr);

      //now to calculate billing time we have to add distlabfrom  (means lab to first registration desk then from there to medicine counter time)  and 3min etc

        $medicinetime="00:03:00";

        $secs = strtotime($medicinetime)-strtotime("00:00:00");
        $billingtime= date("H:i:s",strtotime($outdoctime)+$secs);
		
		//if medicine is prescribed then that time will be out time or the biling time will be the outime
		
		$secs=strtotime("00:01:00")-strtotime("00:00:00");
		$outtime= date("H:i:s",strtotime($billingtime)+$secs);

/////////////////////////CHECKING NO OF TOKEN IS GREATER THAN LIMIT /////////////////////////////
        $tokennocheck="SELECT token_no FROM `blood_cabin_entry_table` ORDER BY token_no DESC LIMIT 1";
        $query_run9 = mysqli_query($con,$tokennocheck);
                if(mysqli_num_rows($query_run9)>0)
                {
                  while($row=mysqli_fetch_assoc($query_run9))
                  {
                      $token_no_check=$row["token_no"];
                  }
                }

        if($token_no_check==30)
        {
          echo '<script type="text/javascript">alert("No of entries for Today is full.Register Tomorrow")</script>';
        }
        else
        {

        $query2= "insert into blood_cabin_entry_table (lab_blood,date,dist_lab_from,in_time,time_to_lab,treat_time,treat_start_lab_blood,out_time_lab_blood,wait_time_lab_blood,billing_time,medicine_time,out_time) values('on','$date','$distlabfrom','$time','$timetolab','$treattime','$indoctime', '$outdoctime','$waittime','$billingtime','','$outtime')";
        $query_run3 = mysqli_query($con,$query2);

        }

  ///////////////////////////////////////CHECKING ENDs HERE////////////////////////////////////////////////////
       /* if($query_run3)
                  {
                      echo '<script type="text/javascript">alert("User data inserted Registered.. Welcome")</script>';
                      header( "Location: token.php");
                      
                  }
              else
                  {
                      echo '<p class="bg-danger msg-block">Registration Unsuccessful due to server error. Please try later</p>';
                  }*/

        ///////////////////////////////////////////SMS FOR BLOOD ///////////////////////////
        /*$textcombine= "Your treatment :".$treatment."||".
                      "Your booking time is :".$time."||".
                      "Your booking date is :".$date."||".
                      "Your treatment start at :".$query_run1."||".
                      "Your outime is :".$outtimeblood."||".
                      "Your billing time is :".$billingtime."||".
                      "Your waittime is :".$waittime."||" ;

        $url="www.way2sms.com/api/v1/sendCampaign";
        $message = urlencode($textcombine);// urlencode your message
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
        curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=NQ4WGMOQ5P2V1BM8E893HHK8EVHY7KRS&secret=PWT0WMLUMXA1NJQS&usetype=stage&phone=$phone&senderid=mmra9593@gmail.com&message=$message");// post data
        // query parameter values must be given without squarebrackets.
        // Optional Authentication:
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);
        echo $result;*/
      //////////////////////////////////////////SMS END ///////////////////////////
    }



    


    ////////////////////////////////blood ENDS///////////////////////////////////////////////////

///////////////////////////////////////////////    SONOGRAPHY   //////////////////////////////////////////////////



    else if($task=='3')
    {
        $distlabfrom = '00:03:00';
        
//////////////////GIVING TREATMENT TIME TO SONOGRAPHY PATIENT ACCORDING TO AGE AND GENDER///////////////////////////

		//$treattime = "00:18:00";

////////////////////////////////////////END HERE////////////////////////////////////////////////////

        //adding distlabfrom and user register time to get timetolab
        $secs = strtotime($distlabfrom)-strtotime('00:00:00');
        $timetolab = date("H:i:s",strtotime($time)+$secs);
		$timetolabstr = strtotime($timetolab)-strtotime('00:00:00');
		
      //getting out time and day of previous user 
        $treatstartsono= "select out_time_lab_sono from sono_cabin_entry_table ORDER BY token_no DESC LIMIT 1 ";
        $query_runn = mysqli_query($con,$treatstartsono);
			if(mysqli_num_rows($query_runn)>0){
				while($row=mysqli_fetch_assoc($query_runn)){
					$query_run1=$row["out_time_lab_sono"];
					$prev_strtime=strtotime($query_run1)-strtotime('00:00:00');
				}
			}
			
		$datequery= "select date from blood_cabin_entry_table ORDER BY token_no DESC LIMIT 1 ";
        $query_runnn = mysqli_query($con,$datequery);
			if(mysqli_num_rows($query_runnn)>0){
				while($row=mysqli_fetch_assoc($query_runnn)){
					$datequery1=$row["date"];
				}
			}
        
        //adding outtime of previous patient and and current user treattime to get outtimedoc means outtime of patient after treatment

		if($timetolab < $query_run1 && date("Y-m-d")==$datequery1){		
		$indoctime=	date('H:i:s',strtotime("00:00:30")+$prev_strtime);
        $secs = strtotime($treattime)-strtotime("00:00:00");
        $outdoctime= date("H:i:s",strtotime($indoctime)+$secs);
        }
		else{
		$secs = strtotime($treattime)-strtotime("00:00:00");
		$indoctime=	date("H:i:s",strtotime("00:00:30")+$timetolabstr);
		$outdoctime= date("H:i:s",strtotime($indoctime)+$secs);	
		}


      //now to calculate waittimedoc means how much wait patient has to do to get treate by doctor 
      //for that we subtract treatment start doc means his given time + how much early he arrived means his timetolab

        $secs = strtotime($timetolab)-strtotime("00:00:00");
        $waittime= date("H:i:s",strtotime($indoctime)-$secs);

      //now to calculate billing time we have to add distlabfrom  (means lab to first registration desk then from there to medicine counter time)  and 3min etc

        $medicinetime="00:03:00";

        $secs = strtotime($medicinetime)-strtotime("00:00:00");
        $billingtime= date("H:i:s",strtotime($outdoctime)+$secs);
		
		//if medicine is prescribed then that time will be out time or the biling time will be the outime
		
		$secs=strtotime("00:01:00")-strtotime("00:00:00");
		$outtime= date("H:i:s",strtotime($billingtime)+$secs);

      /////////////////////////CHECKING NO OF TOKEN IS GREATER THAN LIMIT /////////////////////////////
        $tokennocheck="SELECT token_no FROM `sono_cabin_entry_table` ORDER BY token_no DESC LIMIT 1";
        $query_run8 = mysqli_query($con,$tokennocheck);
                if(mysqli_num_rows($query_run8)>0)
                {
                  while($row=mysqli_fetch_assoc($query_run8))
                  {
                      $token_no_check=$row["token_no"];
                  }
                }

        if($token_no_check==10)
        {
          echo '<script type="text/javascript">alert("No of entries for Today is full.Register Tomorrow")</script>';
        }

        else
        {
        $query2= "insert into sono_cabin_entry_table (lab_sono,date,dist_lab_from,in_time,time_to_lab,treat_time,treat_start_lab_sono,out_time_lab_sono,wait_time_lab_sono,billing_time,medicine_time,out_time) values('on','$date','$distlabfrom','$time','$timetolab','$treattime','$indoctime', '$outdoctime','$waittime','$billingtime','','$outtime')";
        $query_run3 = mysqli_query($con,$query2);
        }

  ///////////////////////////////////////CHECKING ENDs HERE////////////////////////////////////////////////////
        /*if($query_run3)
                  {
                      echo '<script type="text/javascript">alert("User data inserted Registered.. Welcome")</script>';
                      header( "Location: token.php");
                      
                  }
              else
                  {
                      echo '<p class="bg-danger msg-block">Registration Unsuccessful due to server error. Please try later</p>';
                  }*/
    ///////////////////////////////////////////SMS FOR SONO ///////////////////////////
            /*$textcombine= "Your treatment :".$treatment."||".
                          "Your booking time is :".$time."||".
                          "Your booking date is :".$date."||".
                          "Your treatment start at :".$query_run1."||".
                          "Your outime is :".$outtimesono."||".
                          "Your billing time is :".$billingtime."||".
                          "Your waittime is :".$waittime."||" ;

            $url="www.way2sms.com/api/v1/sendCampaign";
            $message = urlencode($textcombine);// urlencode your message
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
            curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=NQ4WGMOQ5P2V1BM8E893HHK8EVHY7KRS&secret=PWT0WMLUMXA1NJQS&usetype=stage&phone=$phone&senderid=mmra9593@gmail.com&message=$message");// post data
            // query parameter values must be given without squarebrackets.
            // Optional Authentication:
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($curl);
            curl_close($curl);
            echo $result;*/
          //////////////////////////////////////////SMS END ///////////////////////////

    }


      /////////////////////////////////SONOGRAPHY ENDS///////////////////////////////////////////////////////////////





}
			
			
?>
