<?php
session_start();
if(function_exists('date_default_timezone_set')) date_default_timezone_set("Asia/Kolkata");
$g_marks_scheme=array(0,10,0);
$g_url="http://localhost/chalkst/";
$g_version = "online";

$g_cf_course_img_url = "http://d3didb0pan6arl.cloudfront.net/";
$g_cf_user_url = "http://d18y8zqk5gegwi.cloudfront.net/";
$g_cf_videos_url = "https://dllcg5ttt3xpt.cloudfront.net/";

//$g_url="http://www.chalkstreet.com/";

/* facebook app */
//$fb_client_id="1550487598507138";
//$fb_client_secret="831201d1351ec665a676fb1d8b7795f2";
//$fb_authorized_access_token='1550487598507138|0wINTUsPaYhdAmA5kGFBcEaHbro';
/* facebook app for online version chalkst*/
$fb_client_id="900560363336941";
$fb_client_secret="976a6cf7ac9cc9e265afe63d49df67f0";
$fb_authorized_access_token="900560363336941|eAJ3rwXk1dsP1MgJfxr5FhgdQ1M";

/* gplus app */
//$gp_client_id='802019223878-i3h7li5kaseulc2fbi0jamb75d7jqamc.apps.googleusercontent.com';
//$gp_client_secret='6y-KClX0viSwfThC6HSh5zdC';
/* gplus app for online version chalkst */
$gp_client_id='132214080453-m1gqtp8i3ncgar3ihe27rn03a06aoq2f.apps.googleusercontent.com';
$gp_client_secret='OXSguw7FNknq5WVWXvaIrnLK';

/** ccavenue **/
$cc_merchant_id = "65631";
$cc_access_code = "AVHX05CE11AN47XHNA";
$cc_encryption = "9737895543F74A270B70CD0A246E6F31";
$cc_ccavenue_url = 'https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction';
$cc_ccavenue_url = 'https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction';



function connectDB($db_no=0)// ADMIN DATABASE
{
	$db_no=0;


	$dbname = array("chalkchallenge");
	$dbhost = array("localhost");
	$dbuser = array("root");
	$dbpass = array("sparrow");
	/*
	$dbname = array("chalkstv40");
	$dbhost = array("chalkst.cd1oc4bclwhk.ap-southeast-1.rds.amazonaws.com");
	$dbuser = array("chalkst");
	$dbpass = array("chalkst100");
	*/

	$db1=mysqli_connect($dbhost[$db_no],$dbuser[$db_no],$dbpass[$db_no]) ;
	mysqli_select_db($db1,$dbname[$db_no]);
	return $db1;
}// ADMIN DATABASE
//IS SAFE
function isSafe($data,$mode)
{
	$data=trim($data);
	$regex='/\w*((\%27)|(\'))((\%6F)|o|(\%4F))((\%72)|r|(\%52))/ix';
	if(!preg_match($regex,$data))
	{
		if($mode==1)
		return 1;
		else if($mode==2 && $data!="")
		return 1;
		else
		return 0;
	}
	else
	return 0;
}// is Safe

//GET IP
function getIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}// getIP

// GENERATE PASSWORD
function generate_pswd($uid)
{
	return strtoupper(substr(dechex($uid*7919),-4));

}


//
function perm_redirect($mode=0)
{
  global $g_url;
	if($mode==0)
	{
		if(!isset($_SESSION['uid']))
		header("location:$g_url?c=demo");
	}
}
/* rememebr me function */
function rememberMe($lg_uid)
{
	$db=connectDB(0);
	$session_id=mt_rand(1000,1000000000);
	$hash_val=hash('sha256',$session_id);
	setcookie('session_id',$hash_val,(time()+2592000),'/');
	/** update session id **/
	$sql_u="UPDATE `user` SET `remember_me`='$hash_val' WHERE `uid`='".$lg_uid."'";
	mysqli_query($db,$sql_u);
}

//Top Banner
function top_banner($login_same_page=1,$login_enable=1,$course_info=0,$navbar_fixed=0)
{
	global $g_url;
	/* checking cookie */
	$db=connectDB(0);
	if(isset($_COOKIE['session_id'])){
		$session_id=$_COOKIE['session_id'];
		$sql_u="SELECT * FROM `user` WHERE `remember_me`='".$session_id."'";
		$res=mysqli_query($db,$sql_u);
		if(mysqli_num_rows($res)>0)
		{
			$user=mysqli_fetch_assoc($res);
			rememberMe($user['uid']);
			$_SESSION['uid']=$user['uid'];
			$_SESSION['pswd']=$user['pswd'];
			$_SESSION['usr']=$user['usr'];
			$_SESSION['email']=$user['email'];
			$_SESSION['usr_type']=$user['usr_type'];
		}
	}
?>
	<!--Nav bar begin -->
	<nav class="navbar navbar-chalk <?php echo $navbar_fixed==1?'navbar-fixed-top':'';?>"
   data-uid="<?php echo isset($_SESSION['uid'])?$_SESSION['uid']:'';?>">
  		<div class="">
    		<div class="navbar-header">
    				<a class="logo logo_black" href="<?php echo isset($_SESSION['uid'])?$g_url.'users/dashboard/':$g_url;?>">
						</a>
      			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar_top_functions">
        			<span class="sr-only">Toggle navigation</span>
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
      			</button>
    		</div>
    		<div class="collapse navbar-collapse" id="navbar_top_functions">
	      		<ul class="nav navbar-nav navbar-right navbar_top_right    ">
	        		<li class="navbar_top_adjust"><a href="<?php echo $g_url.'teach.php';?>">Become an Instructor</a></li>
							<li class=""><a href="<?php echo $g_url.'courses/index.php';?>">Browse Courses</a></li>
	        		<?php if(isset($_SESSION['uid'])) {?>
								<li class=""><a href="<?php echo $g_url.'users/dashboard/index.php';?>">My Courses</a></li>
          		<li class="dropdown">
          			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
          				<div class="profile" style="background:url(<?php echo $g_url; ?>users/profile/picture.php?<?php echo $_SESSION['uid'];?>) no-repeat center center;"><div class="arrow"></div></div>
          			</a>
          			<ul class="dropdown-menu" role="menu">
									<li class="navbar-text"> <h4><?php echo "Welcome ".$_SESSION['usr']; ?></h4></li>
									<li class=""><a href="<?php echo $g_url.'users/dashboard/index.php';?>">My Courses</a></li>
            			<li class="divider"></li>
            			<li><a href="<?php echo $g_url; ?>users/accounts/logout.php">Log Out</a></li>
          			</ul>
        			</li>
							<?php }
							else if($login_enable==1){
								?>
							<li class=""><a href="#" onclick="login_signup(1);">Login</a></li>
							<li class=""><a href="#" onclick="login_signup(2);">Sign Up</a></li>
							<?php } ?>
            </ul>
          </div>
  		</div>
	</nav>
	<?php if(!isset($_SESSION['uid']) && $login_enable==1)
	{
		if(!isset($_SESSION['reg_session']))
		{ $_SESSION['reg_session']=md5(rand());}
		loginPage(1,$login_same_page,$course_info);
	}
		?>
<?php
}
/* login popup */
/* login popup */
function loginPage($popup=1,$login_same_page=1,$course_info)
{
	global $g_url;
	global $fb_client_id;
	global $gp_client_id;
	$r_url=urlencode('http://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."&login_same_page=".$login_same_page."&course_info=".$course_info);
	$str=base64_encode($r_url);
	/* added client id */
	$authurl="https://accounts.google.com/o/oauth2/auth?scope=https://www.googleapis.com/auth/plus.me+https://www.googleapis.com/auth/userinfo.profile+https://www.googleapis.com/auth/userinfo.email&response_type=code&access_type=offline&redirect_uri=".$g_url."users/accounts/login_backend.php&client_id=".$gp_client_id."&hl=en&from_login=1&as=-6136765567898e9e&authuser=0&state=".$str;
	$login_str='
	<div class="clearfix login_signup_box ">


		<div class="col-xs-12 " >

					<div class="signup_box  hidden"  >
					<div class="text-center"><h4>Sign up to start learning!</h4></div>
					<br/>
					<div class="login_social_header clearfix " style="margin:0px -5px 0px -5px;">
					<div class="col-sm-5  col-xs-10 col-xs-push-1">
						<a href="'.$authurl.'" class="btn btn-block btn-social btn-google "><i class="fa fa-google text-center"></i>Login with Google</a><br/><br/>
						</div>
						<div class="col-sm-5  col-xs-10 col-xs-push-1">

						<a href="https://www.facebook.com/dialog/oauth?%20client_id='.$fb_client_id.'&scope=email&redirect_uri='.$g_url.'users/accounts/login_backend.php&state='.$str.'" class="btn btn-block btn-social btn-facebook center-block"><i class="fa fa-facebook text-center"></i>Login with Facebook</a>
						</div>
					</div>
					<div class="hidden-sm"><br/></div>
					<div class="splitting_line" class="col-xs-12">
						<span class="or_styling">
						OR
						</span>
					</div>
					<br/>	<br/>
					<div style="margin:0px 35px 0px 35px;">
						<form class="form clearfix" >
						<input type="hidden" class="redirect_url" name="m" value="'.$r_url.'" />
						<div class="col-xs-6">
							<input type="text" onfocus="clearInputError($(this))" class="form-control add-form-control first_name" placeholder="First Name" name="fname" required >
							<span class="form-control-feedback hidden" aria-hidden="true" style="  margin-right: 10px;"></span>
						</div>
						<div class="col-xs-6">
							<input type="text" onfocus="clearInputError($(this))" class="form-control add-form-control last_name" placeholder="Last Name" name="lname" required >
							<span class="form-control-feedback hidden" aria-hidden="true" style="  margin-right: 10px;"></span>
						</div>
						<br/><br/>
						<br/>

						<div class="col-xs-12">
						<input type="email" onfocus="clearInputError($(this))" class="form-control add-form-control email" placeholder="Email ID" onchange="validateEmail();" name="email" required >
						<span class="form-control-feedback hidden" aria-hidden="true" style="  margin-right: 10px;"></span>
						</div><br/>
						<br/>	<br/>


						<div class="col-xs-12">
							<input type="password" onfocus="clearInputError($(this))" class="form-control add-form-control pswd" placeholder="Password"  name="pswd" required>
							<span class="form-control-feedback hidden" aria-hidden="true" style="  margin-right: 10px;"></span>
						</div>
						<br/><br/><br/>
						<p align="center" class="status"></p>
						<div class="col-xs-12 signup_button">
						<input type="checkbox" onclick="changePswdType(this.checked)" class="let_me_know col-xs-push-1"  name="show pswd"/>&nbsp;<span>Show password</span>
						<button class="btn btn-primary pull-right " onclick="createUser();return false;">Sign Up  </button><br/>
						</div>
						</form>
						<div class="col-xs-12" style="text-align:right;">
						<span class="pull-left"><input type="checkbox" class="remember_me"  name="remember_me"/><span>&nbsp;Remember me</span></span>
						Already have an account ? <a class="signup_style" onclick="login_signup(1);" >Log in</a>
						</div>
						</div>
					</div>




					<div class="login_box active  hidden" >

					<div class="text-center banner_login"><h4>Login to start learning!</h4></div>
					<br/>
					<div class="login_social_header clearfix " style="margin:0px 18px 0px -5px;">
					<div class="col-sm-5  col-xs-10 col-xs-push-1">
						<a href="'.$authurl.'" class="btn btn-block btn-social btn-google "><i class="fa fa-google text-center"></i>Login with Google</a><br/><br/>
						</div>
						<div class="col-sm-5  col-xs-10 col-xs-push-1">

						<a href="https://www.facebook.com/dialog/oauth?%20client_id='.$fb_client_id.'&scope=email&redirect_uri='.$g_url.'users/accounts/login_backend.php&state='.$str.'" class="btn btn-block btn-social btn-facebook center-block"><i class="fa fa-facebook text-center"></i>Login with Facebook</a>
						</div>
					</div>
					<div class="hidden-sm"><br/></div>
					<div class="splitting_line" class="col-xs-12">
					  <span class="or_styling">
						OR
					  </span>
					</div>
					<br/>	<br/>
				<div style="margin:0px 35px 0px 35px;">
				  <form class="form clearfix" >
						<input type="hidden" class="redirect_url" name="m" value="'.$r_url.'" />
						<div class="col-xs-12">
				    		<input type="email" onfocus="clearInputError($(this))" class="form-control add-form-control email" placeholder="Email ID" onchange="validateEmail();" name="email" required >
					    	<span class="form-control-feedback hidden" aria-hidden="true" style="  margin-right: 10px;"></span>
						</div><br/>
						<br/>	<br/>
						<div class="col-xs-12">
							<input type="password" onfocus="clearInputError($(this))" class="form-control add-form-control pswd" placeholder="Password"  name="pswd" required>
							<span class="form-control-feedback hidden" aria-hidden="true" style="  margin-right: 10px;"></span>
						</div>
						<br/>	<br/><br/>
						<p align="center" class="status"></p>
						<div class="col-xs-12 signin_button">
						<input type="checkbox" class="remember_me col-xs-push-1"  name="remember_me" />&nbsp;<span>Remember me</span>
						<button class="btn btn-primary pull-right " onclick="validateLogin();return false;">Login </button><br/>
						</div>
						</form>
						<div class="col-xs-12" style="text-align:right;">
						<a class="forgot_style pull-left" style="text-decoration:none;" href="'.$g_url.'users/accounts/reset.php">Forgot password?</a>
						<span class="signup_text ">Don\'t have an account?<a class="signup_style" onclick="login_signup(2);" >Sign Up</a></span>
						</div>
						</div>

					</div>

					</div>

			</div>

	</div>';


	if($popup==1)
	{
	 echo '<div id="loginModal" class="modal fade">
	    <div class="modal-dialog">
	        <div class="modal-content loginModal_content">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times; &nbsp;</span></button>
	        	<div class="row">
	        		<div class="panel-body  clearfix">'.$login_str.'
	            </div><!-- LOGIN PANEL -->
	          </div>
	      </div>
	  </div>
	  </div>';

	}
	else{
		echo $login_str;
	}
}

//REFERRAL CODE
function inform_referral_code($cookie_name)
{
	if(isset($_COOKIE[$cookie_name]))
	{
		$refcode_banner = '<div class="refcode">Welcome FACE student! Use coupon code '.$_COOKIE[$cookie_name].' to get 60% off on your first paid course
		<button class="close_referral_banner" style="background-color:transparent;border:none;float:right;"><i class="glyphicon glyphicon-remove" onclick="hide_referral_banner()"></i></button></div>';
		echo $refcode_banner;
	}
}

// COURSE PERMISSION
function course_permission($db,$uid,$course_id)
{
	$course_q="SELECT * FROM `order_details` WHERE `uid`='".$uid."'
	AND `course_id`='".$course_id."'
	AND `status`=2";
	$course_res=mysqli_query($db,$course_q);
	if(mysqli_num_rows($course_res)>0)
	return 1;

	return 0;
}

// COURSE PERMISSION
function course_content_permission($db,$box_id)
{
	$perm=array('preview_status'=>0,'download_status'=>0);
	$course_q="SELECT * FROM `course_box` WHERE `box_id`='".$box_id."'";
	$course_res=mysqli_query($db,$course_q);
	//echo $course_q;
	while($course_r=mysqli_fetch_array($course_res))
	{
		$perm=array('preview_status'=>$course_r['preview_status'],'download_status'=>$course_r['download_status']);
	}

	return $perm;
}

//COURSE DENIED MSG

function course_denied($course_id,$db)
{
	global $g_url;
	$course_q = "SELECT `course_fee` FROM `course` WHERE `course_id`=$course_id";
	$course_res = mysqli_query($db,$course_q);
	while($course_r=mysqli_fetch_array($course_res))
	{
		if($course_r['course_fee']==0)
			$course_price = " for FREE";
		else
			$course_price = " - ₹".$course_r['course_fee'];
	}
	$msg = 'This video can only be viewed after you<span class="clearfix"></span>join this course
	       <span class="clearfix"></span><button type="button" class="btn btn-primary join_button" style="font-size:1em;margin-top:1em">Join course'.$course_price.'</button>
	       <script>$(".join_button").click(function(){document.cookie = "buy2=1;path=/"; window.location = "'.$g_url.'learn/index?cid='.$course_id.'";});</script>';
	$result=array("status"=>0,"css"=>"course_access_denied","msg"=>$msg);
	return $result;
}


function footer()
{
	global $g_url;
?>
	<footer class="clearfix">
	  <nav id="footer" class="navbar navbar-inverse navbar-chalk-black clearfix">
	  	<div class="">
		  <div class="navbar-header">
		    <a class="navbar-brand logo_white" href="<?php echo $g_url;?>">
				</a>
	        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-2">
	          <span class="sr-only">Toggle navigation</span>
	          <span class="icon-bar"></span>
	          <span class="icon-bar"></span>
	          <span class="icon-bar"></span>
	      	</button>
		  </div>
		  <div class="collapse navbar-collapse" id="navbar-collapse-2">
		    <ul class="nav navbar-nav navbar-right">
		      <li class=""><a href="<?php echo $g_url.'resources/pages/about.php';?>">About Us</a></li>
		      <li class=""><a href="http://www.chalkstreet.com/blog/" target="_blank">Blog</a></li>
		      <li class=""><a href="<?php echo $g_url.'resources/pages/privacy.php';?>">Privacy Policy</a></li>
		      <li class=""><a href="<?php echo $g_url.'resources/pages/authorterms.php';?>">Course Author Terms</a></li>
		      <li class=""><a href="<?php echo $g_url.'resources/pages/refund.php';?>">Refund & Cancellation</a></li>
		      <li class=""><a href="<?php echo $g_url.'resources/pages/terms.php';?>">T & C</a></li>
		      <li class=""><a href="<?php echo $g_url.'resources/pages/contact.php';?>">Contact Us</a></li>
		  	</ul>
		  </div>
			<div class="fc1">
				<br/>
				ChalkStreet is an online learning marketplace which provides affordable high quality micro-courses from the best teachers. ChalkStreet aspires to make learning a habit.
			</div>
		</div>
	  </nav>
	</footer>
<?php
}
?>
