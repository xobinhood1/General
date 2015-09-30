<?php
include_once('config.php');
if(isset($_SESSION['uid']))
{
    if(isset($_REQUEST['pcid']) && isSafe($_REQUEST['pcid'],2))
    {
      echo "string";
      $db=connectDB(0);
      $uid=$_SESSION['uid'];
      $pcid=$_REQUEST['pcid'];
      $sql11=  "SELECT * FROM course_initial_info WHERE uid=$uid AND pcid=$pcid";
      $post_sql=mysqli_query($db,$sql11);
      $r=mysqli_fetch_assoc($post_sql);
      //check if this pcid belongs to this user or not (check is array has some value//)
      $_SESSION['pcid']=$_REQUEST['pcid'];
      header('Location: http://localhost/guruchallenge/challenge/creator.php?create=OldCourse');

    }
    else{

      if(isset($_REQUEST['create']) && isSafe($_REQUEST['create'],2)){

        if($_REQUEST['create']=='NewCourse'){
          $status = "new";
        }
        elseif($_REQUEST['create']=='OldCourse') {
          $status = "edit";
        }
        else{
          header('Location: http://localhost/guruchallenge/challenge/');

        }
      }

    }
}

else{
  header('Location: http://localhost/guruchallenge/challenge/index.php');
  //login
}
?>


<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>ChalkStreet : Affordable online courses</title>
        <meta name="description" content="Online learning platform. Provides free or affordably priced, high quality courses by experts and professionals. Start learning today!">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link href='static/libs/bootstrap/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="static/css/common.css">

  	<link rel="stylesheet" href="static/css/bootstrap-social.css">
    <link rel="stylesheet" type="text/css" href="challenge.css">

		<link href='http://fonts.googleapis.com/css?family=Architects+Daughter' rel='stylesheet' type='text/css'>
        <link rel="icon" type="image/x-icon" href="static/imgs/favicon.ico">
    </head>
  <body>

    <?php top_banner(0,1,0,1);?>

    <div class="container">
      <br/>  <br/> <br/> <br/>

      <div class="save_button">
        <button type="button" name="button" class="btn btn-success col-sm-2 col-sm-push-11 submit disabled" onclick="submit();">
        SUBMIT</button>
      </div>
</div>
<br/>
  <div class="main_workplace col-sm-10 col-sm-push-1">
    <div class="row all_titles">
      <div class="col-sm-4 headers_1 stage_1" id="stage_1">
      Step 1
      </div>
      <div class="col-sm-4 headers_1 stage_2" id="stage_2">
      Step 2
      </div>
      <div class="col-sm-4 headers_1 stage_3" id="stage_3">
      Step 3
      </div>
    </div>
    <div class="forms_content">
      <div class="contents stage_1_content hidden" >
            <div class="title_content text-center"><h2>  Basic Information</h2></div>
          <p>
          <label for="Coursename">Course Name : </label>
          <input class="col-sm-12 course_name" type="text"  name="name" >
          </p>
          <br />
          <br />
          <br />

          <p>
          <label for="CourseDescription">Course Description : </label></br>
          <textarea name="Coursedesc" class="col-sm-12 course_desc" cols="50" rows="5">

          </textarea>

        </p>

          <p>
          <label for="category" class="nb1" >Course Category : </label>
          <select name="course_category" class="course_category hidden">
          <option value="technology">Technology</option>
          <option value="hobby">Hobby</option>
          <option value="langauge">Language</option>
          <option value="other">course_categoryOthers</option>
          </select>
          </p>

    <p>
    <label for="category" >Course Category : </label>

    <select name="course_category" class="course_category">
    <option value="technology">Technology</option>
    <option value="hobby">Hobby</option>
    <option value="langauge">Language</option>
    <option value="other">course_categoryOthers</option>
    </select>
    </p>

          <br />

          <p>
          <label for="language">Language : </label>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;
          <select name="language" class="language">
          <option value="English">English</option>
          <option value="Hindi">Hindi</option>
          <option value="Tamil">Tamil</option>
          <option value="Telgu">Telgu</option>
          <option value="Kannada">Kannada</option>
          <option value="others">Others</option>
          </select>
          </p>
          <br />
          <p>
          <label for="difficulty">Level of Difficulty : </label>
          <select name="course_level" class="course_level">
          <option value="Easy">Easy</option>
          <option value="Intermediate">Intermedite</option>
          <option value="hard">Hard</option>

          </select>
          </p>
          <br />

          <p>
          <label for="CourseType">Course Type : </label>
          Free <input type="radio" name="type" value="free" class="course_type">
          Paid <input type="radio" name="type" value="paid" class="course_type">
          </p>
        </div>
      <div class="contents stage_2_content hidden">
                <div class="title_content text-center"><h2>  Detailed Course Information</h2></div>
               <p>
          <label>What are the learning outcomes for this course?</label><br>
          <textarea name = "outcomes"
                  rows = "5"
                  cols = "80" class="col-sm-12 outcome"></textarea>
          </p>
          <p>
          <label>Who is this course for ?</label><br>
          <textarea name = "audience"
                  rows = "5"
                  cols = "80" class="col-sm-12 course_for"></textarea>
          </p>
          <p>
          <label>What are the prerequisites from students,if any? </label><br>
          <textarea name = "prerequisites"
                  rows = "5"
                  cols = "80" class="col-sm-12 prerequisite"></textarea>
          </p>

          <label>What is your expertise for authoring this course? </label><br>
          <textarea name = "expertise"
                  rows = "5"
                  cols = "80" class="col-sm-12 expertise"></textarea>
          </p>
          <label>Other details about the course </label><br>
          <textarea name = "details"
                  rows = "5"
                  cols = "80" class="col-sm-12 details"></textarea>
          </p>

      </div>
      <div class="contents stage_3_content hidden">
        <h1>  Upload a test video</h1>
        <input type="file" name="file" name="file" id="fileToUpload" >
        <input type="submit" name="name" value="upload" onclick="upload();">
        <div class="loader hidden">
          <img src="loader.gif" alt="" />
        </div>
        <video width="600" class="videos_l center-block hidden" controls>
          <source src="mov_bbb.mp4" type="video/mp4">
          Your browser does not support HTML5 video.
        </video>

      </div>
    </div>
    <div class="invisible_footer">
      <button class="btn btn-success center-block save_content col-sm-2 col-sm-push-5"
      type="button" name="button" onclick="save();">Save</button>
      <br/>
      <br/>
      <br/>

      <div class="last_saved text-center hidden">

      </div>
    </div>
    <br/><br/>
  </div>





<div class="modal fade" id="user_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">User details</h4>
      </div>
<div class="modal_con">


      Choose how you wish to create the course: <br>
      <input type="radio"  name="background" class="background" onClick="dshowOrganization();">
      <B>Individual</B>
      <br> The course will have your name and credentials as the course author. <br>
      </input>
      <input type="radio" name="background" class="background" onClick="showOrganization();"> <B>Organization</B>
      <br> The course will have your organization's name and credentials as the course author. <br>
      </input>
      <hr>
      Which of the following best describes your experience with teaching?<br>
      <div class="experience">
        <input type="checkbox" name="experience"  class="experience">
        I never had an opprtunity to teach others.<br>
        </input>
        <input type="checkbox" name="experience" class="experience">
        I have shared my knowledge but not in a formal context.<br>
        </input>
        <input type="checkbox" name="experience" class="experience">
        I have taught people as a part of their academic curriculum.<br>
        </input>
        <input type="checkbox" name="experience" class="experience">
        I have taught people online before through classes.<br>
        </input>
        <input type="checkbox" name="experience" class="experience">
        I have authored courses online before.<br>
        </input>
      </div>
<div class="organisation_details hidden">

      <hr>
      Name of the institute:
      <input type="text" name="institute_name" class="institute_name">
      </input>
      <br>

      <br>
      Field&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;

      <select name="field" class="field">
      <option>Computer Science</option>
      <option>Self-help</option>
      <option>Sports</option>
      </select>
      <br>
      <br>

      Website(optional)
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="text" name="website" class="website">
      </input>
      <br>

      <br>
      Bussiness email(optional)
      <input type="text" name="work_email" class="work_email">
      </input>
      <br>

      <br>
    </div>

  </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="save_modal();">SUBMIT</button>

      </div>
  </div>
</div>

</div>




<div class="modal fade" id="user_modal_1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Feedback</h4>
      </div>
<div class="modal_con_feedback">

</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="save_modal();">SUBMIT</button>

      </div>
  </div>
</div>

</div>


    <script src="static/js/jquery/jquery-2.0.2.min.js"></script>
    <script src="static/libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="static/js/homepage.js" type="text/javascript"></script>
	<script src="static/js/common/common.js"></script>
  <script src="challenge.js"></script>

  </body>
    <!--Start of Tawk.to Script-->
<script type="text/javascript">
  $(function(){
    <?php
    if($status=="new"){
      echo "build_new();";
    }
    if ($status=="edit") {
      echo "build_old();";


    }
    ?>
  });
</script>
</html>
