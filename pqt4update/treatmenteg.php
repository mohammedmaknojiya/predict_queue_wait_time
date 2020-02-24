<?php
session_start();    
/*For My LocalPC*/
$con=mysqli_connect ("localhost", "root", "") or die ('I cannot connect to the database because: ' . mysql_error());
mysqli_select_db ($con,'hospitalpqt');

 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"] ) || $_SESSION["loggedin"] !== true ){
    header("location: login.php");
	exit;
}
if(isset($_SESSION['timer'])){
	header("location: tracktimer.php");
	exit;
}
///////////////////welcome user////////////////////////////////////////////
else{
	
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
	
////////////////////////calc the outtime of last patient for each treatment//////////////////////////////////////////////////////////////////////////////////////////
$time_now=mktime(date('H')+4,date('i')+30,date('s'));
@$time = date('H:i:s', $time_now);

/////////////////////////doc-cabin//////////////////////////////////////////////////////////////////////////////////////////

$treatstartdoc= "select out_time_doc from doctor_cabin_entry_table ORDER BY token_no DESC LIMIT 1 ";
        $query_runn = mysqli_query($con,$treatstartdoc);
        if(mysqli_num_rows($query_runn)>0){
          while($row=mysqli_fetch_assoc($query_runn)){
              $docstart1=$row["out_time_doc"];
			  $prev_strtime=strtotime($docstart1)-strtotime('00:00:00');
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
////////////////////////////////x-ray/////////////////////////////////////////////////////////////////		
$treatstartxray= "select out_time_lab_xray from xray_cabin_entry_table ORDER BY token_no DESC LIMIT 1 ";
        $query_runn = mysqli_query($con,$treatstartxray);
		
		if(mysqli_num_rows($query_runn)>0)
      {
        while($row=mysqli_fetch_assoc($query_runn))
        {
            $xray=$row["out_time_lab_xray"];
			$prev_strtime=strtotime($xray)-strtotime('00:00:00');
        }
      }

	  $datequery= "select date from xray_cabin_entry_table ORDER BY token_no DESC LIMIT 1 ";
      $query_runnn = mysqli_query($con,$datequery);
        if(mysqli_num_rows($query_runnn)>0)
        {
          while($row=mysqli_fetch_assoc($query_runnn))
          {
              $datequery2=$row["date"];
			  
          }
        }	
////////////////////////////////mri////////////////////////////////////////////////////////////////////////////////
 $treatstartmri= "select out_time_lab_mri from mri_cabin_entry_table ORDER BY token_no DESC LIMIT 1 ";
        $query_runn = mysqli_query($con,$treatstartmri);
      if(mysqli_num_rows($query_runn)>0)
      {
        while($row=mysqli_fetch_assoc($query_runn))
        {
            $mri=$row["out_time_lab_mri"];
			$prev_strtime=strtotime($mri)-strtotime('00:00:00');
        }
      }
      
	  $datequery= "select date from mri_cabin_entry_table ORDER BY token_no DESC LIMIT 1 ";
        $query_runnn = mysqli_query($con,$datequery);
        if(mysqli_num_rows($query_runnn)>0)
        {
          while($row=mysqli_fetch_assoc($query_runnn))
          {
              $datequery3=$row["date"];
			  
          }
        }		

////////////////////////////////bloodcheck/////////////////////////////////////////////////////////////		
$treatstartblood= "select out_time_lab_blood from blood_cabin_entry_table ORDER BY token_no DESC LIMIT 1 ";
        $query_runn = mysqli_query($con,$treatstartblood);
			if(mysqli_num_rows($query_runn)>0){
				while($row=mysqli_fetch_assoc($query_runn)){
					$bloodcheck=$row["out_time_lab_blood"];
					$prev_strtime=strtotime($bloodcheck)-strtotime('00:00:00');
				}
			}
			
		$datequery= "select date from blood_cabin_entry_table ORDER BY token_no DESC LIMIT 1 ";
        $query_runnn = mysqli_query($con,$datequery);
			if(mysqli_num_rows($query_runnn)>0){
				while($row=mysqli_fetch_assoc($query_runnn)){
					$datequery4=$row["date"];
				}
			}


///////////////////////////////////////////////////////////////////////////////////////////////////
 $treatstartsono= "select out_time_lab_sono from sono_cabin_entry_table ORDER BY token_no DESC LIMIT 1 ";
        $query_runn = mysqli_query($con,$treatstartsono);
			if(mysqli_num_rows($query_runn)>0){
				while($row=mysqli_fetch_assoc($query_runn)){
					$sono=$row["out_time_lab_sono"];
					$prev_strtime=strtotime($sono)-strtotime('00:00:00');
				}
			}
			
		$datequery= "select date from sono_cabin_entry_table ORDER BY token_no DESC LIMIT 1 ";
        $query_runnn = mysqli_query($con,$datequery);
			if(mysqli_num_rows($query_runnn)>0){
				while($row=mysqli_fetch_assoc($query_runnn)){
					$datequery5=$row["date"];
				}
			}
		
			
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
   if(isset($_POST['btnclick']) )
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
	
	
	
	
    //@$treatment=$_POST['treatment'];
    @$name=$_POST['name'];
	//@$age=$_POST['age'];
    //@$gender=$_POST['gender'];
    @$medhist=$_POST['medhist'];
    //@$phone=$_POST['phone'];
	
	
	
	
	if($task=="$treatment"){

////////////////////////////////////////////////////////////////////////////
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
	$in_billing_strtime=strtotime($in_billingquery)-strtotime('00:00:00');
	$out_billing_strtime=strtotime($out_billingquery)-strtotime('00:00:00');	
////////////////////////////////////////////////////////////////////////////
    //getting user register time at time of registration
    $time_now=mktime(date('H')+4,date('i')+30,date('s'));
    @$time = date('H:i:s', $time_now);
    @$date=date("Y-m-d");
    $_SESSION['date']=$date;
	$query = "insert into add_treatment_online(phoneno,treatment_type,date,time,patient_name,patient_age,patient_gender,medical_history) values('$phone','$treatment','$date','$time','$name','$age','$gender','$medhist')";
	$query_run = mysqli_query($con,$query);
	
	$timelab=strtotime('00:02:00')-strtotime('00:00:00');	
    $medlabfrombilling=strtotime('00:02:30')-strtotime('00:00:00');
    
 /////////////////////////////////////// FRACTURE : FEVER : OTHERS  DOC-CABIN  //////////////////////////////////       
    if($task=='4')
	{
		$treatment='fracture';
	}
	else if($task=="1")
	{
		$treatment='bloodtest';
	}
	else if($task=="3")
	{
		$treatment='ct-scan';
	}
	else if($task=="6")
	{
		$treatment='mri';
	}
	else
	{
		$treatment='xray';
	}
        
        //my defined time from enter gate to lab
        $distlabfrom= '00:01:00';
        
        
        //giving different treatment time to different disease
/////////////////////GIVING CONDITION FOR GENDER , AGE AND GIVE TIME FOR PARTICULAR TREATMENT ///////////////////

            

////////////////////////////////////////END HERE////////////////////////////////////////////////////

        //adding distlabfrom and user register time to get timetolab
        $secs = strtotime($distlabfrom)-strtotime('00:00:00');
        $timetolab = date("H:i:s",strtotime($time)+$secs);
        $timetolabstr = strtotime($timetolab)-strtotime('00:00:00');
	

//////////////////////////////////////////////////////getting out time of previous user 
		  
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
		

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////        
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
		
		$outdoctime_str=strtotime($outdoctime)-strtotime('00:00:00');
		
        //now to calculate waittimedoc means how much wait patient has to do to get treate by doctor 
        //for that we subtract treatment start doc means his given time + how much early he arrived means his timetolab

        #$secs = strtotime($indoctime)-strtotime("00:00:00");
        $waittime= date("H:i:s",strtotime($indoctime)-$timetolabstr);
///////////////////////////////////////////////////////////////////////////////////////////////////////////////		
////////////now to calculate billing time we have to add distlabfrom  (means lab to first registration desk then from there to medicine counter time)  and 3min etc
		$lab="00:02:00";
		$timelab=strtotime($lab)-strtotime('00:00:00');
		$time_to_bill=date("H:i:s",strtotime($outdoctime)+$timelab);
		
		$billing= "select in_time,out_time from billing_time where in_time <= '$time_to_bill' ORDER BY in_time DESC LIMIT 1  ";
			$query_runnn = mysqli_query($con,$billing);
			if(mysqli_num_rows($query_runnn)>0){
				while($row=mysqli_fetch_assoc($query_runnn)){
					$in_billingprev1=$row["in_time"];
					$out_billingprev1=$row["out_time"];
				}
			}
		if($time_to_bill > $in_billingquery && $time_to_bill < $out_billingquery && date("Y-m-d")==$datequerybill){
			$billtime="00:02:00";
			$secs = strtotime($billtime)-strtotime("00:00:00");
			$in_billing_time= date('H:i:s',strtotime("00:00:30")+$out_billing_strtime);
			$out_billing_time= date("H:i:s",strtotime($in_billing_time)+$secs);
			}
		else if($time_to_bill < $in_billingquery && $time_to_bill <= $out_billingprev1 && date("Y-m-d")==$datequerybill){
			
			$billing_strtime=strtotime($out_billingprev1)-strtotime('00:00:00');
			$billtime="00:02:00";
			$secs = strtotime($billtime)-strtotime("00:00:00");
			$in_billing_time= date('H:i:s',strtotime("00:00:30")+$billing_strtime);
			$out_billing_time= date("H:i:s",strtotime($in_billing_time)+$secs);
		}
		else{
			$billtime="00:02:00";	
			$secs = strtotime($billtime)-strtotime("00:00:00");
			$in_billing_time=date("H:i:s",strtotime($outdoctime)+$timelab);
			$out_billing_time= date("H:i:s",strtotime($in_billing_time)+$secs);	
			}
		$timetobillstr=strtotime($time_to_bill)-strtotime("00:00:00");	
		$waittimebill=date("H:i:s",strtotime($in_billing_time) - $timetobillstr);
/////////////////////////////////////////////////////////////////////////////////////////////////////		
        
		$in_medicine_time= date("H:i:s",strtotime($out_billing_time)+$medlabfrombilling); 
		$secs=strtotime("00:03:00")-strtotime("00:00:00");
		$out_medicine_time= date("H:i:s",strtotime($in_medicine_time)+$secs);
		
		//if medicine is prescribed then that time will be out time or the biling time will be the outime
		
		$secs=strtotime("00:01:00")-strtotime("00:00:00");
		$outtime= date("H:i:s",strtotime($out_medicine_time)+$secs);
		
///////////////////////////////////////////////////////////////////////////////// 
        $tokennocheck="SELECT token_no from add_treatment_online ORDER BY token_no DESC LIMIT 1";
        $query_run8 = mysqli_query($con,$tokennocheck);
                if(mysqli_num_rows($query_run8)>0)
                {
                  while($row=mysqli_fetch_assoc($query_run8))
                  {
                      $token_no_check=$row["token_no"];
                  }
                }
		$tokenn=$token_no_check;
		$query2= "insert into doctor_cabin_entry_table (token_no,doc_cabin,date,dist_lab_from,in_time,time_to_lab,treat_time,treat_start_doc,actual_treat_start_doc,out_time_doc,actual_treat_out_doc,wait_time_doc,billing_time,medicine_time,out_time,wait_time_billing) values('$tokenn','on','$date','00:01:00','$time','$timetolab','$treattime','$indoctime','$indoctime', '$outdoctime','$outdoctime','$waittime','$in_billing_time','','$outtime','$waittimebill')";
        $query_run3 = mysqli_query($con,$query2);
		$query="insert into billing_time(token_no,date,phone,in_time,out_time) values('$tokenn','$date','$phone','$in_billing_time','$out_billing_time')"; 
        $query_run = mysqli_query($con,$query);
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
                      "Your treatment start at :".$indoctime."||".
                      "Your outimelab is :".$outdoctime."||".
					  "Your waittime for treatment is :".$waittime."||".
                      "Your billing time is :".$in_billing_time."||".
					  "Your waittime for biling is :".$waittimebill."||".
                      "Your medicine counter time is :".$in_medicine_time."||".
					  "Your hospital outtime is: ".$outtime."||".
					  "HOPE FOR SPEEDY RECOVERY. THANKS FOR VISITING.";

        $url="https://www.sms4india.com/api/v1/sendCampaign";
		$message = urlencode($textcombine);// urlencode your message
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
		curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=G1GN03WDKK99HKLG5VLGIJ9XKI8159OH&secret=5QCS2L9AA75KUYXP&usetype=stage&phone=$phone&senderid=huzefa5263@gmail.com&message=$message");// post data
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
     
		
////// /////  //adding outtime of previous patient and and current user treattime to get outtimedoc means outtime of patient after treatment
		
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
//////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////now to calculate billing time we have to add distlabfrom  (means lab to first registration desk then from there to medicine counter time)  and 3min etc
		////////////now to calculate billing time we have to add distlabfrom  (means lab to first registration desk then from there to medicine counter time)  and 3min etc
		$lab="00:02:00";
		$timelab=strtotime($lab)-strtotime('00:00:00');
		$time_to_bill=date("H:i:s",strtotime($outdoctime)+$timelab);
		
		$billing= "select in_time,out_time from billing_time where in_time <= '$time_to_bill' ORDER BY in_time DESC LIMIT 1  ";
			$query_runnn = mysqli_query($con,$billing);
			if(mysqli_num_rows($query_runnn)>0){
				while($row=mysqli_fetch_assoc($query_runnn)){
					$in_billingprev1=$row["in_time"];
					$out_billingprev1=$row["out_time"];
				}
			}
		if($time_to_bill > $in_billingquery && $time_to_bill < $out_billingquery && date("Y-m-d")==$datequerybill){
			$billtime="00:02:00";
			$secs = strtotime($billtime)-strtotime("00:00:00");
			$in_billing_time= date('H:i:s',strtotime("00:00:30")+$out_billing_strtime);
			$out_billing_time= date("H:i:s",strtotime($in_billing_time)+$secs);
			}
		else if($time_to_bill < $in_billingquery && $time_to_bill <= $out_billingprev1 && date("Y-m-d")==$datequerybill){
			
			$billing_strtime=strtotime($out_billingprev1)-strtotime('00:00:00');
			$billtime="00:02:00";
			$secs = strtotime($billtime)-strtotime("00:00:00");
			$in_billing_time= date('H:i:s',strtotime("00:00:30")+$billing_strtime);
			$out_billing_time= date("H:i:s",strtotime($in_billing_time)+$secs);
		}
		else{
			$billtime="00:02:00";	
			$secs = strtotime($billtime)-strtotime("00:00:00");
			$in_billing_time=date("H:i:s",strtotime($outdoctime)+$timelab);
			$out_billing_time= date("H:i:s",strtotime($in_billing_time)+$secs);	
			}
		$timetobillstr=strtotime($time_to_bill)-strtotime("00:00:00");	
		$waittimebill=date("H:i:s",strtotime($in_billing_time) - $timetobillstr);

///////////if medicine is prescribed then that time will be out time or the biling time will be the outime
		$in_medicine_time= date("H:i:s",strtotime($out_billing_time)+$medlabfrombilling); 
		$secs=strtotime("00:03:00")-strtotime("00:00:00");
		$out_medicine_time= date("H:i:s",strtotime($in_medicine_time)+$secs);
		
		//if medicine is prescribed then that time will be out time or the biling time will be the outime
		
		$secs=strtotime("00:01:00")-strtotime("00:00:00");
		$outtime= date("H:i:s",strtotime($out_medicine_time)+$secs);
		
///////////////////////////////////////////////////////////////////////////////////////////
      /////////////////////////CHECKING NO OF TOKEN IS GREATER THAN LIMIT /////////////////////////////
      $tokennocheck="SELECT token_no from add_treatment_online ORDER BY token_no DESC LIMIT 1";
        $query_run8 = mysqli_query($con,$tokennocheck);
                if(mysqli_num_rows($query_run8)>0)
                {
                  while($row=mysqli_fetch_assoc($query_run8))
                  {
                      $token_no_check=$row["token_no"];
                  }
                }
		$tokenn=$token_no_check;

      if($token_no_check==10)
      {
        echo '<script type="text/javascript">alert("No of entries for Today is full.Register Tomorrow")</script>';
      }
      else
      {
        $query2= "insert into xray_cabin_entry_table (token_no,lab_xray,date,dist_lab_from,in_time,time_to_lab,treat_time,treat_start_lab_xray,actual_treat_start_xray,out_time_lab_xray,actual_treat_out_xray,wait_time_lab_xray,billing_time,medicine_time,out_time,wait_time_billing) values('$tokenn','on','$date','$distlabfrom','$time','$timetolab','$treattime','$indoctime','$indoctime','$outdoctime','$outdoctime','$waittime','$in_billing_time','$in_medicine_time','$outtime','$waittimebill')";
        $query_run3 = mysqli_query($con,$query2);
		$query="insert into billing_time(token_no,date,phone,in_time,out_time) values('$tokenn','$date','$phone','$in_billing_time','$out_billing_time')"; 
        $query_run = mysqli_query($con,$query);
		
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
                      "Your treatment start at :".$indoctime."||".
                      "Your outimelab is :".$outdoctime."||".
					  "Your waittime for treatment is :".$waittime."||".
                      "Your billing time is :".$in_billing_time."||".
					  "Your waittime for biling is :".$waittimebill."||".
                      "Your medicine counter time is :".$in_medicine_time."||".
					  "Your hospital outtime is: ".$outtime."||".
					  "HOPE FOR SPEEDY RECOVERY. THANKS FOR VISITING.";

        $url="https://www.sms4india.com/api/v1/sendCampaign";
		$message = urlencode($textcombine);// urlencode your message
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
		curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=G1GN03WDKK99HKLG5VLGIJ9XKI8159OH&secret=5QCS2L9AA75KUYXP&usetype=stage&phone=$phone&senderid=huzefa5263@gmail.com&message=$message");// post data
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


       // $treattime="00:30:00";                    

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

/////////////////////////now to calculate billing time we have to add distlabfrom  (means lab to first registration desk then from there to medicine counter time)  and 3min etc
		////////////now to calculate billing time we have to add distlabfrom  (means lab to first registration desk then from there to medicine counter time)  and 3min etc
		$lab="00:02:00";
		$timelab=strtotime($lab)-strtotime('00:00:00');
		$time_to_bill=date("H:i:s",strtotime($outdoctime)+$timelab);
		
		$billing= "select in_time,out_time from billing_time where in_time <= '$time_to_bill' ORDER BY in_time DESC LIMIT 1  ";
			$query_runnn = mysqli_query($con,$billing);
			if(mysqli_num_rows($query_runnn)>0){
				while($row=mysqli_fetch_assoc($query_runnn)){
					$in_billingprev1=$row["in_time"];
					$out_billingprev1=$row["out_time"];
				}
			}
		if($time_to_bill > $in_billingquery && $time_to_bill < $out_billingquery && date("Y-m-d")==$datequerybill){
			$billtime="00:02:00";
			$secs = strtotime($billtime)-strtotime("00:00:00");
			$in_billing_time= date('H:i:s',strtotime("00:00:30")+$out_billing_strtime);
			$out_billing_time= date("H:i:s",strtotime($in_billing_time)+$secs);
			}
		else if($time_to_bill < $in_billingquery && $time_to_bill <= $out_billingprev1  && date("Y-m-d")==$datequerybill){
			
			$billing_strtime=strtotime($out_billingprev1)-strtotime('00:00:00');
			$billtime="00:02:00";
			$secs = strtotime($billtime)-strtotime("00:00:00");
			$in_billing_time= date('H:i:s',strtotime("00:00:30")+$billing_strtime);
			$out_billing_time= date("H:i:s",strtotime($in_billing_time)+$secs);
		}
		else{
			$billtime="00:02:00";	
			$secs = strtotime($billtime)-strtotime("00:00:00");
			$in_billing_time=date("H:i:s",strtotime($outdoctime)+$timelab);
			$out_billing_time= date("H:i:s",strtotime($in_billing_time)+$secs);	
			}
		$timetobillstr=strtotime($time_to_bill)-strtotime("00:00:00");	
		$waittimebill=date("H:i:s",strtotime($in_billing_time) - $timetobillstr);
        
///////////////////////if medicine is prescribed then that time will be out time or the biling time will be the outime
		$in_medicine_time= date("H:i:s",strtotime($out_billing_time)+$medlabfrombilling); 
		$secs=strtotime("00:03:00")-strtotime("00:00:00");
		$out_medicine_time= date("H:i:s",strtotime($in_medicine_time)+$secs);
		
		//if medicine is prescribed then that time will be out time or the biling time will be the outime
		
		$secs=strtotime("00:01:00")-strtotime("00:00:00");
		$outtime= date("H:i:s",strtotime($out_medicine_time)+$secs);
		
 /// /////////////////////////CHECKING NO OF TOKEN IS GREATER THAN LIMIT /////////////////////////////
      $tokennocheck="SELECT token_no from add_treatment_online ORDER BY token_no DESC LIMIT 1";
        $query_run8 = mysqli_query($con,$tokennocheck);
                if(mysqli_num_rows($query_run8)>0)
                {
                  while($row=mysqli_fetch_assoc($query_run8))
                  {
                      $token_no_check=$row["token_no"];
                  }
                }
		$tokenn=$token_no_check ;

      if($token_no_check==10)
      {
        echo '<script type="text/javascript">alert("No of entries for Today is full.Register Tomorrow")</script>';
      }

      else
      {
        $query2= "insert into mri_cabin_entry_table (token_no,lab_mri,date,dist_lab_from,in_time,time_to_lab,treat_time,treat_start_lab_mri,actual_treat_start_mri,out_time_lab_mri,actual_treat_out_mri,wait_time_lab_mri,billing_time,medicine_time,out_time,wait_time_billing) values('$tokenn','on','$date','$distlabfrom','$time','$timetolab','$treattime','$indoctime','$indoctime', '$outdoctime','$outdoctime','$waittime','$in_billing_time','$in_medicine_time','$outtime','$waittimebill')";
        $query_run3 = mysqli_query($con,$query2);
		$query="insert into billing_time(token_no,date,phone,in_time,out_time) values('$tokenn','$date','$phone','$in_billing_time','$out_billing_time')"; 
        $query_run = mysqli_query($con,$query);
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
              /* $textcombine= "Your treatment :".$treatment."||".
                      "Your booking time is :".$time."||".
                      "Your booking date is :".$date."||".
                      "Your treatment start at :".$indoctime."||".
                      "Your outimelab is :".$outdoctime."||".
					  "Your waittime for treatment is :".$waittime."||".
                      "Your billing time is :".$in_billing_time."||".
					  "Your waittime for biling is :".$waittimebill."||".
                      "Your medicine counter time is :".$in_medicine_time."||".
					  "Your hospital outtime is: ".$outtime."||".
					  "HOPE FOR SPEEDY RECOVERY. THANKS FOR VISITING.";

        $url="https://www.sms4india.com/api/v1/sendCampaign";
		$message = urlencode($textcombine);// urlencode your message
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
		curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=G1GN03WDKK99HKLG5VLGIJ9XKI8159OH&secret=5QCS2L9AA75KUYXP&usetype=stage&phone=$phone&senderid=huzefa5263@gmail.com&message=$message");// post data
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
	
		// $treattime="00:05:30";

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

/////////////////now to calculate billing time we have to add distlabfrom  (means lab to first registration desk then from there to medicine counter time)  and 3min etc

		$lab="00:02:00";
		$timelab=strtotime($lab)-strtotime('00:00:00');
		$time_to_bill=date("H:i:s",strtotime($outdoctime)+$timelab);
		
		$billing= "select in_time,out_time from billing_time where in_time <= '$time_to_bill' ORDER BY in_time DESC LIMIT 1  ";
			$query_runnn = mysqli_query($con,$billing);
			if(mysqli_num_rows($query_runnn)>0){
				while($row=mysqli_fetch_assoc($query_runnn)){
					$in_billingprev1=$row["in_time"];
					$out_billingprev1=$row["out_time"];
				}
			}
		if($time_to_bill > $in_billingquery && $time_to_bill < $out_billingquery && date("Y-m-d")==$datequerybill){
			$billtime="00:02:00";
			$secs = strtotime($billtime)-strtotime("00:00:00");
			$in_billing_time= date('H:i:s',strtotime("00:00:30")+$out_billing_strtime);
			$out_billing_time= date("H:i:s",strtotime($in_billing_time)+$secs);
			}
		else if($time_to_bill < $in_billingquery && $time_to_bill <= $out_billingprev1 && date("Y-m-d")==$datequerybill){
			
			$billing_strtime=strtotime($out_billingprev1)-strtotime('00:00:00');
			$billtime="00:02:00";
			$secs = strtotime($billtime)-strtotime("00:00:00");
			$in_billing_time= date('H:i:s',strtotime("00:00:30")+$billing_strtime);
			$out_billing_time= date("H:i:s",strtotime($in_billing_time)+$secs);
		}
		else{
			$billtime="00:02:00";	
			$secs = strtotime($billtime)-strtotime("00:00:00");
			$in_billing_time=date("H:i:s",strtotime($outdoctime)+$timelab);
			$out_billing_time= date("H:i:s",strtotime($in_billing_time)+$secs);	
			}
		$timetobillstr=strtotime($time_to_bill)-strtotime("00:00:00");	
		$waittimebill=date("H:i:s",strtotime($in_billing_time) - $timetobillstr);

///////////////////////if medicine is prescribed then that time will be out time or the biling time will be the outime
		$in_medicine_time= date("H:i:s",strtotime($out_billing_time)+$medlabfrombilling); 
		$secs=strtotime("00:03:00")-strtotime("00:00:00");
		$out_medicine_time= date("H:i:s",strtotime($in_medicine_time)+$secs);
		
		$secs=strtotime("00:01:00")-strtotime("00:00:00");
		$outtime= date("H:i:s",strtotime($out_medicine_time)+$secs);
		

/////////////////////////CHECKING NO OF TOKEN IS GREATER THAN LIMIT /////////////////////////////
        $tokennocheck="SELECT token_no from add_treatment_online ORDER BY token_no DESC LIMIT 1";
        $query_run8 = mysqli_query($con,$tokennocheck);
                if(mysqli_num_rows($query_run8)>0)
                {
                  while($row=mysqli_fetch_assoc($query_run8))
                  {
                      $token_no_check=$row["token_no"];
                  }
                }
		$tokenn=$token_no_check;
		
		
        if($token_no_check==30)
        {
          echo '<script type="text/javascript">alert("No of entries for Today is full.Register Tomorrow")</script>';
        }
        else
        {

        $query2= "insert into blood_cabin_entry_table (token_no,lab_blood,date,dist_lab_from,in_time,time_to_lab,treat_time,treat_start_lab_blood,actual_treat_start_blood,out_time_lab_blood,actual_treat_out_mri,wait_time_lab_blood,billing_time,medicine_time,out_time,wait_time_billing) values('$tokenn','on','$date','$distlabfrom','$time','$timetolab','$treattime','$indoctime','$indoctime', '$outdoctime','$outdoctime','$waittime','$in_billing_time','$in_medicine_time','$outtime','$waittimebill')";
        $query_run3 = mysqli_query($con,$query2);
		$query="insert into billing_time(token_no,date,phone,in_time,out_time) values('$tokenn','$date','$phone','$in_billing_time','$out_billing_time')"; 
        $query_run = mysqli_query($con,$query);
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
                      "Your treatment start at :".$indoctime."||".
                      "Your outimelab is :".$outdoctime."||".
					  "Your waittime for treatment is :".$waittime."||".
                      "Your billing time is :".$in_billing_time."||".
					  "Your waittime for biling is :".$waittimebill."||".
                      "Your medicine counter time is :".$in_medicine_time."||".
					  "Your hospital outtime is: ".$outtime."||".
					  "HOPE FOR SPEEDY RECOVERY. THANKS FOR VISITING.";

        $url="https://www.sms4india.com/api/v1/sendCampaign";
		$message = urlencode($textcombine);// urlencode your message
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
		curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=G1GN03WDKK99HKLG5VLGIJ9XKI8159OH&secret=5QCS2L9AA75KUYXP&usetype=stage&phone=$phone&senderid=huzefa5263@gmail.com&message=$message");// post data
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
			
		$datequery= "select date from sono_cabin_entry_table ORDER BY token_no DESC LIMIT 1 ";
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
		
		$waittime= date("H:i:s",strtotime($indoctime)-$timetolabstr);

//////////////billing///////////////////////////////////////////////////////////////////      

       $lab="00:02:00";
		$timelab=strtotime($lab)-strtotime('00:00:00');
		$time_to_bill=date("H:i:s",strtotime($outdoctime)+$timelab);
		
		$billing= "select in_time,out_time from billing_time where in_time <= '$time_to_bill' ORDER BY in_time DESC LIMIT 1  ";
			$query_runnn = mysqli_query($con,$billing);
			if(mysqli_num_rows($query_runnn)>0){
				while($row=mysqli_fetch_assoc($query_runnn)){
					$in_billingprev1=$row["in_time"];
					$out_billingprev1=$row["out_time"];
				}
			}
		if($time_to_bill > $in_billingquery && $time_to_bill < $out_billingquery && date("Y-m-d")==$datequerybill){
			$billtime="00:02:00";
			$secs = strtotime($billtime)-strtotime("00:00:00");
			$in_billing_time= date('H:i:s',strtotime("00:00:30")+$out_billing_strtime);
			$out_billing_time= date("H:i:s",strtotime($in_billing_time)+$secs);
			}
		else if($time_to_bill < $in_billingquery && $time_to_bill <= $out_billingprev1  && date("Y-m-d")==$datequerybill){
			
			$billing_strtime=strtotime($out_billingprev1)-strtotime('00:00:00');
			$billtime="00:02:00";
			$secs = strtotime($billtime)-strtotime("00:00:00");
			$in_billing_time= date('H:i:s',strtotime("00:00:30")+$billing_strtime);
			$out_billing_time= date("H:i:s",strtotime($in_billing_time)+$secs);
		}
		else{
			$billtime="00:02:00";	
			$secs = strtotime($billtime)-strtotime("00:00:00");
			$in_billing_time=date("H:i:s",strtotime($outdoctime)+$timelab);
			$out_billing_time= date("H:i:s",strtotime($in_billing_time)+$secs);	
			}
		$timetobillstr=strtotime($time_to_bill)-strtotime("00:00:00");	
		$waittimebill=date("H:i:s",strtotime($in_billing_time) - $timetobillstr);
        
///////////////////////if medicine is prescribed then that time will be out time or the biling time will be the outime
		$in_medicine_time= date("H:i:s",strtotime($out_billing_time)+$medlabfrombilling); 
		$secs=strtotime("00:03:00")-strtotime("00:00:00");
		$out_medicine_time= date("H:i:s",strtotime($in_medicine_time)+$secs);
		
		$secs=strtotime("00:01:00")-strtotime("00:00:00");
		$outtime= date("H:i:s",strtotime($out_medicine_time)+$secs);
		

      /////////////////////////CHECKING NO OF TOKEN IS GREATER THAN LIMIT /////////////////////////////
        $tokennocheck="SELECT token_no from add_treatment_online ORDER BY token_no DESC LIMIT 1";
        $query_run8 = mysqli_query($con,$tokennocheck);
                if(mysqli_num_rows($query_run8)>0)
                {
                  while($row=mysqli_fetch_assoc($query_run8))
                  {
                      $token_no_check=$row["token_no"];
                  }
                }
		$tokenn=$token_no_check ;
        if($token_no_check==10)
        {
          echo '<script type="text/javascript">alert("No of entries for Today is full.Register Tomorrow")</script>';
        }

        else
        {
        $query2= "insert into sono_cabin_entry_table (token_no,lab_sono,date,dist_lab_from,in_time,time_to_lab,treat_time,treat_start_lab_sono,actual_treat_start_sono,out_time_lab_sono,actual_treat_out_sono,wait_time_lab_sono,billing_time,medicine_time,out_time,wait_time_billing) values('$tokenn','on','$date','$distlabfrom','$time','$timetolab','$treattime','$indoctime','$indoctime','$indoctime
		
		', '$outdoctime','$waittime','$in_billing_time','$in_medicine_time','$outtime','$waittimebill')";
        $query_run3 = mysqli_query($con,$query2);
        $query="insert into billing_time(token_no,date,phone,in_time,out_time) values('$tokenn','$date','$phone','$in_billing_time','$out_billing_time')"; 
        $query_run = mysqli_query($con,$query);
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
                      "Your treatment start at :".$indoctime."||".
                      "Your outimelab is :".$outdoctime."||".
					  "Your waittime for treatment is :".$waittime."||".
                      "Your billing time is :".$in_billing_time."||".
					  "Your waittime for biling is :".$waittimebill."||".
                      "Your medicine counter time is :".$in_medicine_time."||".
					  "Your hospital outtime is: ".$outtime."||".
					  "HOPE FOR SPEEDY RECOVERY. THANKS FOR VISITING.";

        $url="https://www.sms4india.com/api/v1/sendCampaign";
		$message = urlencode($textcombine);// urlencode your message
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
		curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=G1GN03WDKK99HKLG5VLGIJ9XKI8159OH&secret=5QCS2L9AA75KUYXP&usetype=stage&phone=$phone&senderid=huzefa5263@gmail.com&message=$message");// post data
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
	
	/////////////////////declaring values in session///////////////////////////////
	$_SESSION['date']=$date;
	$_SESSION['treatment']=$treatment;
	$_SESSION['waittime']=$waittime;
	$_SESSION['indoctime']=$indoctime;
	$_SESSION['outdoctime']=$outdoctime;
	$_SESSION['inbilling']=$in_billing_time;
	$_SESSION['outbilling']=$out_billing_time;
	$_SESSION['token']=$tokenn;
	$_SESSION['text']=$textcombine;
	if($query_run3){
	$_SESSION['timer']="time";	
	header("location:tracktimer.php");
	exit;
	}	

}

?>

<!doctype html>
<html lang="en">
  <head>
	<script type="text/javascript">
	function noBack(){window.history.forward()}
	noBack();
	window.onload=noBack;
	window.onpageshow=function(evt){if(evt.persisted)noBack()}
	window.onunload=function(){void(0)}
	
	</script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="css.css">
    <title>Add Treatment </title>
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
		
    </style>
  </head>
  <body>
	
	<div class="title1" >ADD TREATMENT</div> <div class="subtitle1" >Hello <?php echo htmlspecialchars($name); ?></div>
			
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
    
      <br><br><br>
    
    
    <!----registration form making -->

<div class="main" align="center">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="wrapper">
			<p>Please fill the form to book & confirm your appointment.</p>
			<p>The details of your timings will be messaged to you on the phone number you fill below</p>  
			</div>
			<div class="wrapper">
			Treatment Type:<br>
            <select id="treaty" name="treatment"  required autofocus onchange="timechange()" />
				<option value="none" selected disabled hidden>Select an option</option>
                <option value="1">bloodtest</option>
		      <!-----<option value="2">checkup</option>  -->
		      <option value="3">ctscan</option>
		      <option value="4">fracture</option>
		      <!----<option value="5">medicime</option>--->
		      <option value="6">mri</option>
		      <option value="7">xray</option>

			</select>
            <br>
			Previous Medical History if any:<br>
			<input type="text" name="medhist">
			<br>
			Name:<br>
			<input type="text" name="name" required> 
			<br>
            Age:<input type="text" name="age" list="ages">
		<datalist id = "ages">
			  <option value="0">adult</option>
			  <option value="1">child</option>
			  <option value="2">old</option>
		</datalist>
		<br>
            Gender:<br>
            <input type="text" name="gender" list="genders">
		<datalist id = "genders">
			  <option value="0">Female</option>
    		  <option value="1">Male</option>
		</datalist>
		<br>
            Date:<br>
            <select name="date" >
			<option value="<?php echo date("Y-m-d");?>"><?php echo date("Y-m-d");?></option>
			</select>
            <br>
			Avail Time:<br>
			<p id="timedoc" class="subtitle2" >Your time is:</p>
            Phone Number:<br>
            <input type="tel"  name="phone" pattern="[0-9]{5}[0-9]{5}" required>
            <br>
            <!--Choose Time:<br>
            <input type="time" name="time" >
            <br>-->
            
        <br>
        <input type="submit" id="sub" value="Register" name="btnclick" class='enableOnInput' disabled='disabled' onclick="track.php" />
		</div>
		<div id="hh"></div>
		<div id="h1"><?php print(@$textcombine); ?></div>
      </form>

<script type='text/javascript' src='http://code.jquery.com/jquery.min.js'></script>

<script>
function timechange() {
var x = document.getElementById("treaty").value;
alert('Treatment Changed to '+x);
   //Create date object and set the time to that
var startTimeObject = new Date();
 startTimeObject.setHours(10, 0, 0);

 //Create date object and set the time to that
 var endTimeObject = new Date(startTimeObject);
 endTimeObject.setHours(21, 0, 0);
	
 var curr = new Date();
 
 var docstart1 = <?php echo json_encode($docstart1, JSON_HEX_TAG); ?>;
 var datequery1 = <?php echo json_encode($datequery1,JSON_HEX_TAG); ?>;
 var docstart1dt = new  Date(datequery1 +' '+docstart1);
 
 var xray = <?php echo json_encode($xray,JSON_HEX_TAG); ?>;
 var datequery2 = <?php echo json_encode($datequery2,JSON_HEX_TAG); ?>;
 var xraydt = new  Date(datequery2 +' '+xray);
 
 
 var mri = <?php echo json_encode($mri,JSON_HEX_TAG); ?>;
 var datequery3 = <?php echo json_encode($datequery3,JSON_HEX_TAG); ?>;
 var mridt = new  Date(datequery3 +' '+mri);
 
 var bloodcheck = <?php echo json_encode($bloodcheck,JSON_HEX_TAG); ?>;
 var datequery4 = <?php echo json_encode($datequery4,JSON_HEX_TAG); ?>;
 var bloodcheckdt = new  Date(datequery4 +' '+bloodcheck);
 
 var sono = <?php echo json_encode($sono,JSON_HEX_TAG); ?>;
 var datequery5 = <?php echo json_encode($datequery5,JSON_HEX_TAG); ?>;
 var sonodt = new  Date(datequery5 +' '+sono);
 
 
 
 //Now we are ready to compare both the dates
 if(startTimeObject < curr &&  endTimeObject > curr){	
	if(x=='fever' || x=='fracture' || x=="checkup"){
		if(curr < docstart1dt){
			var docavail = docstart1;
		}
		else{
			var hours = curr.getHours();
			var minutes = curr.getMinutes();
			var seconds = curr.getSeconds();
			var docavail = hours + ":" + minutes + ":" + seconds;
		}
	}
	if(x=='xray'){
		if(curr < xraydt){
			var docavail = xray;
		}
		else{
			var hours = curr.getHours();
			var minutes = curr.getMinutes();
			var seconds = curr.getSeconds();
			var docavail = hours + ":" + minutes + ":" + seconds;
		}
	} 
	if(x=='mri'){
		if(curr < mridt){
			var docavail = mri;
		}
		else{
			var hours = curr.getHours();
			var minutes = curr.getMinutes();
			var seconds = curr.getSeconds();
			var docavail = hours + ":" + minutes + ":" + seconds;
		}
	}
	if(x=='bloodtest'){
		if(curr < bloodcheckdt){
			var docavail = bloodcheck;
		}
		else{
			var hours = curr.getHours();
			var minutes = curr.getMinutes();
			var seconds = curr.getSeconds();
			var docavail = hours + ":" + minutes + ":" + seconds;
		}
	}
	if(x=='ct-scan'){
		if(curr < sonodt){
			var docavail = sono;		
		}
		else{
			var hours = curr.getHours();
			var minutes = curr.getMinutes();
			var seconds = curr.getSeconds();
			var docavail = hours + ":" + minutes + ":" + seconds;
		}
	}
	
 }
 else{
	 var docavail = "Booking not allowed now";
	
}
	document.getElementById("timedoc").innerHTML = docavail;
	
	if(docavail!=="Booking not allowed now"){
	$('.enableOnInput').prop('disabled', false); 
	
}
	else{
	$('.enableOnInput').prop('disabled', true);	
	}
}

</script>
</div>
</body>
</html>