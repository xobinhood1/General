<?php
include_once('config.php');

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>ChalkStreet : Affordable online courses</title>
        <meta name="description" content="Online learning platform. Provides free or affordably priced, high quality courses by experts and professionals. Start learning today!">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link href='static/libs/bootstrap/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
		<link href='static/css/common.css' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="static/css/bootstrap-social.css">
    <link rel="stylesheet" type="text/css" href="challenge.css">
		<link href='http://fonts.googleapis.com/css?family=Architects+Daughter' rel='stylesheet' type='text/css'>
        <link rel="icon" type="image/x-icon" href="static/imgs/favicon.ico">
    </head>
  <body>

    <?php top_banner(); ?>
    <div class="card_clone hidden">
      <div class="card col-sm-4">
        <div class="card_title">
          Untitled
        </div>
        <div class="card_status">
          You have just started editing your course . Try to complete the course fast
          so that we can evaluate it as fast as we can.
        </div>
        <div class="card_footer">
          <button type="button" class="feedback btn btn-link hidden" name="button" onclick="show_feed($(th));">Submission feed back</button>

          <a href="" class="edit_link hidden">Click here to edit</a>
        </div>



      </div>

      </div>
<div class="top_info">
<div class="sanyasi col-sm-3 col-sm-push-1">
  <img src="sanyas.png" alt="" />
</div>
<div class="t_content col-sm-6">
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
</div>
<div class="new_course col-sm-3">
<div class="nc_box">
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>

<textarea name="name" rows="2" cols="31" placeholder="Enter course title !" class="nc_input" onclick="title_session();"></textarea>
<br/>
<button type="button" name="button" class="col-sm-9  btn btn-warning">Start course!</button>
</div>
</div>
</div>
<?php
if($_SESSION['uid']){
  $sh = "";
  $lh = "hidden";
}
else{
  $sh = "hidden";
  $lh = "";


}
?>
<div class="text-center" <?php echo $sh ?>>
  <h2>Your courses!</h2>

</div>


  <div class='work_place col-sm-10 col-sm-push-2 '<?php echo $sh ?> >


  </div>

  <div class="unlogged" <?php echo $lh ?>  >
    <div class="count_unlogged text-center"></div>
<br/> <br/>
    <div class="img_unlog ">
    <img src="10k.png" class="center-block" alt="" />
    </div>
    <div class="faq_unlog col-sm-10 col-sm-push-1">
      <h2>The FAQs</h2>
        <p>
        10k for 3 courses? Is that it?
        <br/>        <br/>
        As a participant in the 10k Guru Challenge, you would be eligible to win Rs 10,000 in 30 days. In addition to this, you are entitled to earn on every subscription to your course. For this to happen, your course needs to be priced at a certain fee (your courses could be offered for free too), a decision that is completely yours. For further details on the revenue you will earn from your course, do get in touch with the course manager assigned for your assistance.
        <br/>        <br/>

        And what does a course contain?
        <br/>        <br/>

        A course on ChalkStreet is typically 1-3 hours long and consists of various learning elements including lectures, tests, exercises and assignments. A lecture can be in the form of a video, an audio recording or a text document. Also, video lectures need to form at least 60% of the course content.
        <br/>        <br/>
        When will I get paid for completing the challenge?
        <br/>        <br/>

        There are 3 stages in the challenge corresponding to each of the 3 courses. After the completion of each course, the ChalkStreet Instructor Team will review the course. If the course meets the quality standards of the ChalkStreet platform, you will be eligible to receive the payment assigned for the course.</div>
          </p>
        </div>
  </div>








<script type="text/javascript" src="static/js/jquery/jquery-2.0.2.min.js"></script>
    <script src="static/libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="static/js/homepage.js" type="text/javascript"></script>
	<script src="static/js/common/common.js"></script>
  <script src="challenge.js"></script>

  </body>
    <!--Start of Tawk.to Script-->

</html>
