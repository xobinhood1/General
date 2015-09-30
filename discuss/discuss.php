<?php
//error_reporting(E_ALL); ini_set('display_errors', '1');
include_once("../../config.php");
$result=array('status'=>0,'css'=>'alert alert-danger','msg'=>'<strong> Oh Snap !
</strong>Something went wrong !');
if(isset($_REQUEST['mode']) && isSafe($_REQUEST['mode'],2))
{
	$mode=$_REQUEST['mode'];
	$db=connectDB(0);
	switch($mode)
	{
    case "ADD_POST":

    $uid=$_SESSION['uid'];
    $code=$_REQUEST['code'];
    $type=$_REQUEST['type'];
    $content=$_REQUEST['content'];
		$namer=$_SESSION['usr'];

		$time= time();

    /* SQL Query to add post */

    $sql="INSERT INTO `discuss`(`id`, `uid`, `code`, `type`,`content`,
    `time`,`name`) VALUES (NULL, $uid, '$code', $type, '$content', '$time','$namer')";
		mysqli_query($db,$sql);
    $last=mysqli_insert_id($db);
    /* SQL Query ends */
		$code_split = explode("_", $code);
		$box_id = $code_split[2];

		$sql1="UPDATE `course_box` SET `box_comments`= `box_comments`+ 1  WHERE `box_id` = $box_id";

		mysqli_query($db,$sql1);


    $result=array('status'=>1,'css'=>'alert alert-success','msg'=>$last,'namer'=>$namer);

		break;
/*______________________________________________________________________________*/
		case "ADD_REPLY":

    $uid=$_SESSION['uid'];
    $code=$_REQUEST['code'];
    $type=$_REQUEST['type'];
    $content=$_REQUEST['content'];
    $time=$_REQUEST['time'];
    $related=$_REQUEST['related'];
		$namer=$_SESSION['usr'];
		$time= time();

    /* SQL Query to add post */

    $sql2="INSERT INTO `discuss`(`id`, `uid`, `code`, `type`,`content`,
    `time`, `related`,`name`) VALUES (NULL, $uid, '$code', $type, '$content', '$time',
    $related,'$namer')";

    /* SQL Query ends */
    mysqli_query($db,$sql2);
    $last=mysqli_insert_id($db);

		$code_split = explode("_", $code);
		$box_id = $code_split[2];

		$sql1="UPDATE `course_box` SET `box_comments`= `box_comments`+ 1  WHERE `box_id` = $box_id";

		mysqli_query($db,$sql1);

    $result=array('status'=>1,'css'=>'alert alert-success','msg'=>$namer,'rec_id'=>$last);
		break;
  /*______________________________________________________________________________*/

		case "LIKE":
		$time= time();
    $coder=$_REQUEST['code'];
    $id=$_REQUEST['id'];
    $uid=$_SESSION['uid'];
    /*SQL*/
    $sql3=  " UPDATE `discuss` SET `likes` = `likes` + 1 WHERE `id`=".$id;
    $sqli1="INSERT INTO  `discuss_activity_log` (`uid` ,`liked`,`time`,`code`) VALUES ( $uid,  $id,'$time','$coder')";
    mysqli_query($db,$sql3);
    mysqli_query($db,$sqli1);
    $result=array('status'=>1,'css'=>'alert alert-success','msg'=>'like added');
    break;
    /*______________________________________________________________________________*/

		case "FOLLOW":
    $id=1;
		$coder=$_REQUEST['code'];
		$uid=$_SESSION['uid'];
		$time= time();

    $id=$_REQUEST['id'];
    /*SQL*/
    $sql4=  " UPDATE discuss SET follow = follow + 1 WHERE id=".$id;
    mysqli_query($db,$sql4);

		$sqli1="INSERT INTO  `discuss_activity_log` (`uid` ,`followed`,`time`,`code`) VALUES ( $uid,  $id,'$time','$coder')";
		mysqli_query($db,$sqli1);

    $result=array('status'=>1,'css'=>'alert alert-success','msg'=>'follow added');

		break;
    /*______________________________________________________________________________*/

    case 'DELETE_POST_REPLY':
    $id=1;

    /*SQL*/
    $sql5=  " UPDATE discuss SET type = '2' WHERE id=".$id;
    mysqli_query($db,$sql5);
    $result=array('status'=>1,'css'=>'alert alert-success','msg'=>'post deleted');


    break;

    /*______________________________________________________________________________*/

    case 'UNLIKE':
    $id=1;

    /*SQL*/
    $sql6=  " UPDATE discuss SET likes = likes - 1 WHERE id=".$id;
    mysqli_query($db,$sql6);
    $result=array('status'=>1,'css'=>'alert alert-success','msg'=>'unliked');


		break;
    /*______________________________________________________________________________*/

		case "UNFOLLOW":
    $id=1;


    /*SQL*/
    $sql7=  " UPDATE discuss SET follow = follow - 1 WHERE id=".$id;
    mysqli_query($db,$sql7);

    $result=array('status'=>1,'css'=>'alert alert-success','msg'=>'unfollowed');


		break;
    /*_______________________________________________________________________________*/
    case "RETRIEVE_ALL_POSTS":
    /*SQL*/

		$code=$_REQUEST['code'];
    $sql8=  "SELECT * FROM `discuss` WHERE `code`= '$code' AND `type`=0 ORDER BY `id` ASC";

		$posts=array();
    $contents=array();
    $likes=array();
    $follows=array();
    $uids=array();
		$codes=array();
		$liked_new=array();
		$namers=array();
		$namers_r=array();
		$posts_r=array();
		$contents_r=array();
		$likes_r=array();
		$uids_r=array();
		$related_r=array();
		$liked_by=array();
		$all_likes=array();

    $post_sql=mysqli_query($db,$sql8);
    $c =0;
    while($r=mysqli_fetch_array($post_sql))
    {

      $posts[$c]=$r['id'];
      $likes[$c]=$r['likes'];
      $follows[$c]=$r['follow'];
      $uids[$c]=$r['uid'];
      $contents[$c]=$r['content'];
			$liked_new[$c]=$r['likes'];
			$namers[$c]=$r['name'];
			$codes[$c]=$r['code'];

      $c=$c+1;
    }
		$sql9=  "SELECT * from (SELECT * FROM `discuss` WHERE `code`= '$code' AND `type`=1 order by id desc) as t1 group by related order by id ASC";


    $reply_sql=mysqli_query($db,$sql9);
    $c =0;
    while($r=mysqli_fetch_array($reply_sql))
    {

      $posts_r[$c]=$r['id'];
      $likes_r[$c]=$r['likes'];
      $uids_r[$c]=$r['uid'];
      $related_r[$c]=$r['related'];
      $contents_r[$c]=$r['content'];
			$namers_r[$c]=$r['name'];

      $c=$c+1;
    }

		$sql10="SELECT liked,COUNT(*) as count FROM discuss_activity_log WHERE code='$code' GROUP BY liked ORDER BY liked desc";
		$like_post_sql=mysqli_query($db,$sql10);
		$c=0;
		while($r=mysqli_fetch_array($like_post_sql))
		{
			$all_likes[$c]=$r['count'];
			$c=$c+1;
		}
		$uid=$_SESSION['uid'];

		$sql11="SELECT `liked` FROM `discuss_activity_log` WHERE `uid`=$uid AND `code`='$code'";
		$like_post_sql=mysqli_query($db,$sql11);

		$c=0;
		while($r=mysqli_fetch_array($like_post_sql))
		{
			$liked_by[$c]=$r['liked'];
			$c=$c+1;
		}



    $result=array('status'=>1,'css'=>'alert alert-success','msg'=>'retrieved',
                  'posts'=>$posts,
                  'likes'=>$likes,
                  'follows'=>$follows,
                  'uids'=>$uids,
                  'contents'=>$contents,
                  'posts_r'=>$posts_r,
                  'likes_r'=>$likes_r,
                  'uids_r'=>$uids_r,
                  'related_r'=>$related_r,
									'namers_r'=>$namers_r,
                  'contents_r'=>$contents_r,
									'all_likes'=>$all_likes,
									'liked_by'=>$liked_by,
									'namers'=>$namers,
									'liked_new'=>$liked_new,
									'codes'=>$codes

                  );

    break;

    /*__________________________________________________________________________*/


		/*_________________________________________________________________*/

    case "RETRIEVE_REPLIES":

    /*SQL*/
    $code=$_REQUEST['code'];
    $related=$_REQUEST['related'];
		$uid=$_SESSION['uid'];

    $sql9=  "SELECT * FROM `discuss` WHERE `code`= '$code' AND `type`=1 AND `related`=".$related;
    $posts=array();
    $contents=array();
    $likes=array();
    $uids=array();
		$namer_r=array();
    $post_sql=mysqli_query($db,$sql9);
    $c =0;
    while($r=mysqli_fetch_array($post_sql))
    {

      $posts[$c]=$r['id'];
      $likes[$c]=$r['likes'];
      $uids[$c]=$r['uid'];
      $contents[$c]=$r['content'];
			$namer_r[$c]=$r['name'];

      $c=$c+1;
    }
		$liked_by=array();
		$sql11="SELECT `liked` FROM `discuss_activity_log` WHERE `uid`=$uid AND `code`='$code'";
		$like_post_sql=mysqli_query($db,$sql11);
		$c=0;
		while($r=mysqli_fetch_array($like_post_sql))
		{
			$liked_by[$c]=$r['liked'];
			$c=$c+1;
		}
		$current_post_name=array();
		$current_post_like=array();
		$current_post_content=array();


		$sql12=  "SELECT * FROM `discuss` WHERE `id`=".$related;
		$current_pos=mysqli_query($db,$sql12);
		$c=0;
		while($r=mysqli_fetch_array($current_pos))
		{
			$current_post_name[$c]=$r['name'];
			$current_post_like[$c]=$r['likes'];
			$current_post_content[$c]=$r['content'];

			$c=$c+1;
		}

		$sql11="SELECT `liked` FROM `discuss_activity_log` WHERE `uid`=$uid AND `code`='$code'";
		$like_post_sql=mysqli_query($db,$sql11);
		$c=0;
		while($r=mysqli_fetch_array($like_post_sql))
		{
			$liked_by[$c]=$r['liked'];
			$c=$c+1;
		}
    $result=array('status'=>1,'css'=>'alert alert-success','msg'=>'retrieved',
									'code'=>$code,
                  'posts'=>$posts,
                  'likes'=>$likes,
                  'uids'=>$uids,
                  'contents'=>$contents,
									'namer_r'=>$namer_r,
									'liked_by'=>$liked_by,
									'current_post_name'=>$current_post_name,
									'current_post_like'=>$current_post_like,
									'current_post_content'=>$current_post_content,
									'current_post_id'=>$related
                  );

    break;

/*___________________________________________________________________________________*/
CASE "RETRIEVE_SINGLE":
	$posts=array();
	$contents=array();
	$likes=array();
	$follows=array();
	$uids=array();
	$codes=array();
	$liked_new=array();
	$last_name=array();
	$last_reply=array();
	$liked_by=array();
	$namers=array();
	$code=$_REQUEST['code'];
	$uid=$_SESSION['uid'];
	$sql8=  "SELECT * FROM `discuss` WHERE `code`= '$code' AND `type`=2";
	$current_pos=mysqli_query($db,$sql8);
	$c=0;
	while($r=mysqli_fetch_array($current_pos))
	{
		$posts[$c]=$r['id'];
		$likes[$c]=$r['likes'];
		$uids[$c]=$r['uid'];
		$contents[$c]=$r['content'];
		$liked_new[$c]=$r['likes'];
		$namers[$c]=$r['name'];
		$codes[$c]=$r['code'];

		$c=$c+1;
	}
	$sql9="SELECT * from (SELECT * FROM `discuss` WHERE `code`= '$code' AND `type`=1 order by id desc) as t1 group by related order by id ASC";

	$current_pos=mysqli_query($db,$sql9);
	$c=0;
	while($r=mysqli_fetch_array($current_pos))
	{
		$last_name=$r['name'];
		$last_reply=$r['content'];

		$c=$c+1;
	}

	$sql11="SELECT `liked` FROM `discuss_activity_log` WHERE `uid`=$uid AND `code`='$code'";
	$like_post_sql=mysqli_query($db,$sql11);
	$c=0;
	while($r=mysqli_fetch_array($like_post_sql))
	{
		$liked_by[$c]=$r['liked'];
		$c=$c+1;
	}

	$result=array('status'=>1,'css'=>'alert alert-success','msg'=>'retrieved',
								'posts'=>$posts,
								'likes'=>$likes,
								'liked_by'=>$liked_by,
								'uids'=>$uids,
								'contents'=>$contents,
								'namers'=>$namers,
								'liked_new'=>$liked_new,
								'last_name'=>$last_name,
								'last_reply'=>$last_reply,
								'codes'=>$codes
								);


 break;

/*_______________________________________________________________________________*/
CASE "RETRIEVE_COMMENT_COUNT":
	$code= $_REQUEST['code'];
	$sql9="SELECT COUNT(code) as total FROM discuss WHERE code='$code'";
	$current_pos=mysqli_query($db,$sql9);
	$data=mysqli_fetch_assoc($current_pos);

	$result=array('status'=>1,'css'=>'alert alert-success','msg'=>'retrieved',
								'count'=>$data['total'],
								);


 break;

	}

}
echo json_encode($result);



?>
