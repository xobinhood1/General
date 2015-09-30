<?php
//error_reporting(E_ALL); ini_set('display_errors', '1');
$g_s3_bucket="chalkst-challenge";
$g_cf_duration=10*60;

include_once("config.php");
$result=array('status'=>0,'css'=>'alert alert-danger','msg'=>'<strong> Oh Snap !
</strong>Something went wrong !');
if(isset($_REQUEST['mode']) && isSafe($_REQUEST['mode'],2))
{
	$mode=$_REQUEST['mode'];
	$db=connectDB(0);
	switch($mode)
	{
    case "SAVE_STEP1":

		$uid=$_SESSION['uid'];
		$pcid= $_SESSION['pcid'];
		$course_name = $_REQUEST['course_name'];
		$course_desc = $_REQUEST['course_desc'];
		$course_category = $_REQUEST['course_category'];
		$language = $_REQUEST['language'];
		$course_level = $_REQUEST['course_level'];
		$course_type = $_REQUEST['course_type'];


    /* SQL Query to insert into table course_initial_info */


		$sql = "INSERT INTO course_initial_info ".
					"(pcid,uid,course_name, course_desc, course_category,language,course_level,course_type) ".
					"VALUES($pcid,$uid,'$course_name','$course_desc','$course_category','$language','$course_level','$course_type') ON DUPLICATE KEY UPDATE course_name='$course_name' ,course_desc='$course_desc' ,course_category='$course_category' ,language='$language' ,course_level='$course_level' ,course_type='$course_level'";
					mysqli_query($db,$sql);
					$last=mysqli_insert_id($db);
					/* SQL Query ends */
					$_SESSION['pcid']=$last;


    $result=array('status'=>1,'css'=>'alert alert-success','msg'=>$last);

		break;

/*______________________________________________________________________________*/
		case "SAVE_STEP2":

    $uid=$_SESSION['uid'];
    $pcid=$_SESSION['pcid'];
    $outcome= $_REQUEST['outcome'];
    $audience = $_REQUEST['audience'];
    $prerequisite = $_REQUEST['prerequisite'];
    $expertise = $_REQUEST['expertise'];
    $details = $_REQUEST['details'];


    $sql2 = "INSERT INTO course_initial_info ".
  	"(pcid,uid,outcome,course_for,prerequisite,expertise,details)".
  	"VALUES($pcid,$uid,'$outcome','$audience','$prerequisite','$expertise','$details')".
  	"ON DUPLICATE KEY UPDATE  outcome= '$outcome' , course_for= '$audience' , prerequisite= '$prerequisite', expertise= '$expertise',details= '$details' ";

    mysqli_query($db,$sql2);



    $result=array('status'=>1,'css'=>'alert alert-success','msg'=>'Step2 details saved','rec_id'=>$last);
		break;
  /*______________________________________________________________________________*/

		case "SAVE_MODAL":

			$uid=$_SESSION['uid'];
			$background = $_REQUEST['background'];
			$experience = $_REQUEST['experience'];
			$institute_name = $_REQUEST['institute_name'];
			$field = $_REQUEST['field'];
			$website= $_REQUEST['website'];
			$work_email = $_REQUEST['work_email'];



    /* SQL Query to insert into table course_initial_info */


	$sql3 = "INSERT INTO author_initial_info ".
       "(uid,background,experience,institute_name,field,website,work_email) ".
       "VALUES($uid,'$background',$experience,'$institute_name','$field','$website','$work_email')";



echo $sql3;
    mysqli_query($db,$sql3);
    /* SQL Query ends */
    $result=array('status'=>1,'css'=>'alert alert-success','msg'=>' step 0 added');
    break;
    /*______________________________________________________________________________*/



    case "RETRIEVE_ALL_COURSES":


		$uid=$_SESSION['uid'];

    /*SQL*/
    $sql4=  "SELECT course_name,course_status,feedback,pcid FROM course_initial_info WHERE uid=$uid";

		$course_name=array();
    $course_status=array();
    $course_feedback=array();
		$pcid=array();


    $post_sql=mysqli_query($db,$sql4);

    while($r=mysqli_fetch_array($post_sql))
    {
			$pcid[]=$r['pcid'];

      $course_name[]=$r['course_name'];
      $course_status[]=$r['course_status'];
      $course_feedback[]=$r['feedback'];


    }


    $result=array('status'=>1,'css'=>'alert alert-success','msg'=>'retrieved',
                  'course_name'=>$course_name,
                  'course_status'=>$course_status,
                  'course_feedback'=>$course_feedback,
									'pcid'=>$pcid

                  );

    break;

    /*__________________________________________________________________________*/


    case "RETRIEVE_ALL_COURSE_INFO":


		$uid=$_SESSION['uid'];
    $pcid=$_SESSION['pcid'];
     /*SQL*/
    $sql5=  "SELECT * FROM course_initial_info WHERE pcid=$pcid";
    $post_sql=mysqli_query($db,$sql5);
     $r=mysqli_fetch_assoc($post_sql);


    $course_name=$r['course_name'];
    $course_desc=$r['course_desc'];
    $course_category=$r['course_category'];
    $language=$r['language'];
    $course_level=$r['course_level'];
	  $course_type=$r['course_type'];
	  $outcome=$r['outcome'];
	  $course_for=$r['course_for'];
	  $prerequisite=$r['prerequisite'];
	  $expertise=$r['expertise'];
	  $details=$r['details'];

    $result=array('status'=>1,'css'=>'alert alert-success','msg'=>'retrieved',
                  'course_name'=>$course_name,
                  'course_desc'=>$course_desc,
                  'course_category'=>$course_category,
                  'language'=>$language,
                  'course_level'=>$course_level,
                  'course_type'=>$course_type,
                  'outcome'=>$outcome,
                  'course_for'=>$course_for,
                  'prerequisite'=>$prerequisite,
				  				'expertise'=>$expertise,
                  'details'=>$details
                  );

    break;

		/*_________________________________________________________________*/

		case "CHECK":

				$uid=$_SESSION['uid'];
		    $pcid=$_SESSION['pcid'];
		    /*SQL*/
		    $sql6=  "SELECT * FROM course_initial_info WHERE pcid=$pcid";
		    $post_sql=mysqli_query($db,$sql6);
		    $r=mysqli_fetch_assoc($post_sql);


		      if ((strcmp($r['course_name'],'NULL')==0) || empty($r['course_name'])|| (strcmp($r['course_desc'],'NULL')==0) || empty($r['course_desc']) ||
		       (strcmp($r['language'],'NULL')==0) || empty($r['language']) ||
		      (strcmp($r['course_level'],'NULL')==0) || empty($r['course_level']) || (strcmp($r['course_type'],'NULL')==0) || empty($r['course_type']) ||
		      (strcmp($r['outcome'],'NULL')==0) || empty($r['outcome'])|| (strcmp($r['video_name'],'NULL')==0) || empty($r['video_name']))
		      {
		      	$check=false;
		      }

		      else
		      {
		        $check=true;
		      }


		    $result=array('status'=>1,'css'=>'alert alert-success','msg'=>'Checking all the fields are filled',
		                  'course_name'=>$r['course_name'],
		                  'course_desc'=>$r['course_desc'],
		                  'course_category'=>$r['course_category'],
		                  'language'=>$r['language'],
		                  'course_level'=>$r['course_level'],
		                  'course_type'=>$r['course_type'],
		                  'outcome'=>$r['outcome'],
		                  'course_for'=>$r['course_for'],
		                  'prerequisite'=>$r['prerequisite'],
						  				'expertise'=>$r['expertise'],
		                  'details'=>$r['details'],
		                  'check_status'=>$check
		                  );

		    break;

		/*_________________________________________________________________*/

 case "LAST_TAB":
    /*SQL*/
    $last_tab=$_REQUEST['last_tab'];

    $pcid=$_SESSION['pcid'];
    $sql7=  "INSERT INTO course_initial_info ".
       "(pcid,last_tab) ".
       "VALUES($pcid,$last_tab) ON DUPLICATE KEY UPDATE last_tab=$last_tab";


    $post_sql=mysqli_query($db,$sql7);

    $result=array('status'=>1,'css'=>'alert alert-success','msg'=>'retrieved',
                  'last_tab'=>$last_tab

                  );

    break;

    /*__________________________________________________________________________*/


 case "SAVE_ALL":

  $uid=$_SESSION['uid'];
    $pcid=$_SESSION['pcid'];
		$t = time();
		$course_name = IsEmptyString($_REQUEST['course_name']);
    $course_desc = IsEmptyString($_REQUEST['course_desc']);
    $course_category = IsEmptyString($_REQUEST['course_category']);
    $language =IsEmptyString($_REQUEST['language']);
    $course_level = IsEmptyString($_REQUEST['course_level']);
    $course_type = IsEmptyString($_REQUEST['course_type']);
    $outcome= IsEmptyString($_REQUEST['outcome']);
    $audience = IsEmptyString($_REQUEST['course_for']);
    $prerequisite = IsEmptyString($_REQUEST['prerequisite']);
    $expertise = IsEmptyString($_REQUEST['expertise']);
    $details = IsEmptyString($_REQUEST['details']);


    /* SQL Query to insert into table course_initial_info */


  $sql8 = "INSERT INTO course_initial_info ".
       "(pcid,uid,course_name, course_desc, course_category,language,course_level,course_type,outcome,course_for,prerequisite,expertise,details,DateOfSubmission) ".
       "VALUES($pcid,$uid,'$course_name','$course_desc','$course_category','$language','$course_level','$course_type','$outcome','audience','prerequisite','expertise','details','t')".
       " ON DUPLICATE KEY UPDATE course_name='$course_name' ,course_desc='$course_desc' ,course_category='$course_category' ,language='$language' ,course_level='$course_level' ,".
       "course_type='$course_type',outcome='$outcome',course_for='$audience',prerequisite='$prerequisite',expertise='$expertise',details='$details',DateOfSubmission=$t";

	  mysqli_query($db,$sql8);
    $last=mysqli_insert_id($db);
    /* SQL Query ends */



    $result=array('status'=>1,'css'=>'alert alert-success','msg'=>$last);

    break;

    /*__________________________________________________________________________*/
   case "CREATE_EMPTY":

    $uid=$_SESSION['uid'];
    /*SQL*/
    $sql9=  "INSERT INTO course_initial_info ".
       "(uid) ".
       "VALUES($uid) ON DUPLICATE KEY UPDATE uid=$uid";


    $post_sql=mysqli_query($db,$sql9);
    $last=mysqli_insert_id($db);
    $_SESSION['pcid']=$last;

    $result=array('status'=>1,'css'=>'alert alert-success','msg'=>'empty row is created',
                  'pcid'=>$last
                 );

    break;

    /*__________________________________________________________________________*/
		case "CHECK_USER":

		    $uid=$_SESSION['uid'];
		    /*SQL*/
		    $sql9=  "SELECT * FROM author_initial_info WHERE uid=$uid";
		    $post_sql=mysqli_query($db,$sql9);
		    $r=mysqli_fetch_assoc($post_sql);



		    if(mysqli_num_rows($post_sql) > 0 )
		    {
		      if (is_null($r['uid']) || empty($r['uid']))
		      {
		        $check='false';
		      }

		      else
		      {
		        $check='true';
		      }
		    }
		    else
		    {
					$check='false';
		    }
		    $result=array('status'=>1,'css'=>'alert alert-success','msg'=>'Checking whether user exists',
		                  'exist'=>$check
		                 );

		    break;

    /*__________________________________________________________________________*/
    case "SHOW_STATUS":

    $uid=$_SESSION['uid'];
    $pcid=$_SESSION['pcid'];
    //$pcid= $_REQUEST['pcid'];
    /*SQL*/
    $sql10=  "SELECT * FROM course_initial_info WHERE  pcid=$pcid AND uid=$uid";
    $post_sql=mysqli_query($db,$sql10);
    $r=mysqli_fetch_assoc($post_sql);
     //$course_name=$r['course_name'];

    $result=array('status'=>1,'css'=>'alert alert-success','msg'=>'status',
                  'course_name'=>$r['course_name'],
                  'course_status'=>$r['course_status']);

    break;

    /*__________________________________________________________________________*/

    case "SHOW_FEEDBACK":

    //$uid=$_SESSION['uid'];
    $pcid=$_REQUEST['pcid'];
    //$pcid= $_REQUEST['pcid'];
    /*SQL*/
    $sql11=  "SELECT * FROM course_initial_info WHERE pcid=$pcid";
    $post_sql=mysqli_query($db,$sql11);
     $r=mysqli_fetch_assoc($post_sql);

    $result=array('status'=>1,'css'=>'alert alert-success','msg'=>'feedback',
                  'course_name'=>$r['course_name'],
                  'feedback'=>$r['feedback']);

    break;

    /*__________________________________________________________________________*/
    case "SAVE_VIDEO":

    $uid=$_SESSION['uid'];
    $pcid=$_SESSION['pcid'];
				$video_name = $pcid.'.mp4';
        $sql12="UPDATE course_initial_info SET video_name='$video_name' WHERE pcid=$pcid";
        $post_sql=mysqli_query($db,$sql12);


    $result=array('status'=>1,'css'=>'alert alert-success','msg'=>'Saved video');

    break;

    /*__________________________________________________________________________*/
    case "INPUT_STATUS":

    $uid=$_SESSION['uid'];
    $pcid=$_SESSION['pcid'];
    $course_status=$_REQUEST['course_status'];
    /*SQL*/
    $sql13=  "INSERT INTO course_initial_info (pcid,course_status) VALUES ($pcid,$course_status) ON DUPLICATE KEY UPDATE course_status=$course_status";
    $post_sql=mysqli_query($db,$sql13);


    $result=array('status'=>1,'css'=>'alert alert-success','msg'=>'Status updated' );

    break;

    /*__________________________________________________________________________*/
    case "INPUT_FEEDBACK":

    $uid=$_SESSION['uid'];
    $pcid=$_SESSION['pcid'];
    $feedback=$_REQUEST['feedback'];
    /*SQL*/
    $sql14=  "INSERT INTO course_initial_info (pcid,feedback) VALUES ($pcid,'$feedback') ON DUPLICATE KEY UPDATE feedback='$feedback'";
    $post_sql=mysqli_query($db,$sql14);


    $result=array('status'=>1,'css'=>'alert alert-success','msg'=>'Feedback updated');

    break;

		/*__________________________________________________________________________*/

		case "COUNTER":

		/*SQL*/
		$sql14=  "select count(1) as count FROM course_initial_info";
		$post_sql=mysqli_query($db,$sql14);

		$r=mysqli_fetch_assoc($post_sql);

		$result=array('status'=>1,'css'=>'alert alert-success','msg'=>'Feedback updated','count'=>$r['count']);

		break;

		/*__________________________________________________________________________*/
    case "SIGNED_VIDEO":
			$pcid = $_SESSION['pcid'];
			$resource = "http://d3os84qokpy7ug.cloudfront.net/uploads/".$pcid.".mp4";
			$timeout = 30;
			global $g_s3_bucket,$g_cf_duration;
			//This comes from key pair you generated for cloudfront
			$keyPairId = "APKAJOVNMHJ2N45UWB2A";

			$expires = time() + $timeout; //Time out in seconds
			$json = '{"Statement":[{"Resource":"'.$resource.'","Condition":{"DateLessThan":{"AWS:EpochTime":'.$expires.'}}}]}';

			//Read Cloudfront Private Key Pair
			$fp=fopen("pk-APKAJOVNMHJ2N45UWB2A.pem","r");
			$priv_key=fread($fp,8192);
			fclose($fp);

			//Create the private key
			$key = openssl_get_privatekey($priv_key);
			if(!$key)
			{
				echo "<p>Failed to load private key!</p>";
				return;
			}

			//Sign the policy with the private key
			if(!openssl_sign($json, $signed_policy, $key, OPENSSL_ALGO_SHA1))
			{
				echo '<p>Failed to sign policy: '.openssl_error_string().'</p>';
				return;
			}

			//Create url safe signed policy
			$base64_signed_policy = base64_encode($signed_policy);
			$signature = str_replace(array('+','=','/'), array('-','_','~'), $base64_signed_policy);

			//Construct the URL
			$url = $resource.'?Expires='.$expires.'&Signature='.$signature.'&Key-Pair-Id='.$keyPairId;

    $result=array('status'=>1,'css'=>'alert alert-success','url'=>$url);

    break;
	}

}

function IsEmptyString($val){
    if (trim($val) === ''){$val = "NULL";}
    return $val;
}



//echo getSignedURL("http://d3os84qokpy7ug.cloudfront.net/uploads/video.mp4",30);
echo json_encode($result);



?>
