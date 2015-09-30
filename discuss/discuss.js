//var discuss_folder_name="http://www.chalkstreet.com/beta/chalkstv27/discuss/discuss.php";
var discuss_folder_name=g_url+"modules/discuss/discuss.php";

$(function(){
var html_data=["  <div class='modal discuss-modal' id='discuss-modal-replies' tabindex='-1' role='dialog' aria-labelledby='discuss' aria-hidden='true' >",
  "    <div class='modal-dialog modal-lg discuss-modal-holder'>",
  "        <div class='modal-content'>",
  "          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>",
  "            <i class='glyphicon glyphicon-remove' aria-hidden='true' ></i>",
  '          </button>',
  "          <div class='modal-header'>",
  '        </div>',
  "          <div class='discuss-modal-body'>",
  '        </div>',
  '        </div><!-- CONTENT-->',
  '      </div>',
  '    </div>',
  "        <input type='text' name='name' value='' placeholder='Add Discussion' class='discuss_post_input hidden' id='discuss_post_adder1'>",
  "    <div class='discuss_post1 hidden'>",
  "      <div class='col-xs-12'>",
  "        <div class='discuss_namer_post'></div>",
  "        <div class='discuss_content'>",
  '        </div>',
  '      </div>',
  "      <div class='discuss_aminities clearfix'>",
  "        <div class='col-xs-3 discuss_like_value'>",
  "          <a   class='discuss_liker_post' onClick='liker_post($(this))' >Like(<span class='discuss_total_like'>0</span>)</a>",
  '        </div>',
  "        <div class='col-xs-3'>",
  "          <a  class='discuss_follower_post' onClick='follower_post($(this))'>Follow</a>",
  '        </div>',
  '      </div>',
  "      <div class='discuss_last_reply discuss_single_clone clearfix'>",
  '                                                                    ',
  "        <div class='discuss_namer_reply col-xs-11'></div>",
  "          <div class='discuss_last_reply_content col-xs-11'>",
  '                                                             ',
  '          </div>',
  "          <a   class='discuss_show_more col-xs-12 text-center' onClick='discuss_show_more($(this))'>Load more</a>",
  "          <div class='discuss_last_reply_input '>",
  "            <input type='text' name='name' value='' placeholder='Add reply' class='col-xs-12  discuss_new_input_reply'>",
  '          </div>',
  '      </div>',
  '      <br>',
  '    </div>',
  "    <div class='discuss_post2 hidden'>",
  "      <div class='col-xs-12'>",
  "        <div class='discuss_namer_post'></div>",
  "        <div class='discuss_content'>",
  '        </div>',
  '      </div>',
  "      <div class='discuss_aminities clearfix'>",
  "        <div class='col-xs-3 discuss_like_value'>",
  "          <a   class='discuss_liker_post' onClick='liker_post($(this))'>Like(<span class='discuss_total_like'>0</span>)</a>",
  '        </div>',
  "        <div class='col-xs-3'>",
  "          <a  class='discuss_follower_post' onClick='follower_post($(this))'>Follow</a>",
  '        </div>',
  '      </div>',
  "      <div class='discuss_last_reply clearfix'>",
  "        <div class='discuss_replies_full'>",
  '        </div>',
  "          <div class='discuss_last_reply_input '>",
  "            <input type='text' name='name' value='' placeholder='Add reply' class='col-xs-12  discuss_new_input_reply'>",
  '          </div>',
  '      </div>',
  '      <br>',
  '    </div>',
  "  <div class='discuss_reply_part hidden'>",
  "  <div class='discuss_namer_reply col-xs-11'>Will Turner</div>",

  "  <div class='discuss_last_reply_content col-xs-11'>",
  '  <br/>',
  '  </div>',
  "  <div class='discuss_aminities clearfix'>",
  '                                          ',
  "    <div class='col-xs-3 discuss_like_value'>",
  "      <a   class='discuss_liker_reply' onclick='liker_reply($(this))'><br/>Like(<span class='discuss_total_like'>0</span>)</a>",
  '    </div>',
  '  </div>', '  </div>', "  <div class='discuss_reply_part1 hidden'>",
  "  <div class='discuss_namer_reply col-xs-11'>Will Turner</div>",
  "  <div class='discuss_last_reply_content col-xs-11'>", '  .<br/>', '  </div>',
  "  <div class='discuss_aminities clearfix'>", '',
  "    <div class='col-xs-3 discuss_like_value'>",
  "      <a   class='discuss_liker_reply' onclick='liker_reply($(this))'><br/>Like(<span class='discuss_total_like'>0</span>)</a>",
  '    </div>',

   '  </div>', '  </div>', '', '', '']
html_data=html_data.join("");
$("body").append(html_data);



  $(document).on('keypress', '.discuss_reply_input', function(e){
    if(e.which == 13){//Enter key pressed
      create_reply($(this));

    }
  });

  $(document).on('keypress', '.discuss_new_input_reply', function(e){

    if(e.which == 13){//Enter key pressed
      new_create_reply($(this));

    }
  });


  $(document).on('keypress', '.discuss_post_input', function(e){
    if(e.which == 13){//Enter key pressed
      create_post($(this));


    }
  });
});



function build_discuss(json,loc,code){
    var learner_status = $('body').find('.discuss_user_type_general').html();
    var solutions=[];

    for(var j=0;j<json.posts.length;j++)
    {
      var flag=0;

      for(var k=0;k<json.related_r.length;k++)
      {
        if(json.posts[j]==json.related_r[k]){
          solutions.push(json.contents_r[k]);
          flag=1;
        }


      }
      if(flag==0){
        solutions.push("null");
      }
    }

    json.contents_r=solutions;
       var temp = $('<div/>').addClass('posts_wrapper');
       var flag1=0;
       var post_clone_adder = $('#discuss_post_adder1').clone();
       post_clone_adder.attr('id','discuss_post_adder');
       post_clone_adder.removeClass('hidden');
       post_clone_adder.attr('code',code);
       loc.append(post_clone_adder);
         loc.append("<hr/>");

       for (i = 0; i < json.uids.length; i++) {
         var target= json.liked_by.indexOf(json.posts[i]);
         var post_clone = $('.discuss_post1').clone();
         post_clone.attr('class','discuss_post');
            if(json.contents_r[i]=='null'){
              //json.contents_r[i]="No reply";
              flag1=1;
            }
              if(flag1==1){
                post_clone.find('.discuss_namer_reply').html("<br/>");

              }
              else{
                post_clone.find('.discuss_namer_reply').html("<br/>"+json.namers_r[i]);
                post_clone.find('.discuss_last_reply_content').html(json.contents_r[i]);

              }
              post_clone.find('.discuss_total_like').html(json.liked_new[i]);
              if(target>-2){
                post_clone.find('.discuss_liker_post').addClass('discuss_disabling_like');

              }

              post_clone.attr('rec_id',json.posts[i]);
              post_clone.attr('code',json.codes[i]);
              post_clone.find('.discuss_new_input_reply').attr('code',json.codes[i]);
              post_clone.find('.discuss_new_input_reply').attr('rec_id',json.posts[i]);
              post_clone.find('.discuss_show_more').attr('code',json.codes[0]);

              post_clone.find('.discuss_show_more').attr('rec_id',json.posts[i]);
              post_clone.find('.discuss_namer_post').html("<br/>"+json.namers[i]);
              post_clone.find('.discuss_content').html(json.contents[i]);

              temp.append(post_clone);
              temp.append("<br/>");
        }

        loc.append(temp);
        var code_analyze = code.split('_');
        code_analyze=code_analyze[0];
          if($.trim(learner_status)=='false' && code_analyze=='ANC'){
             loc.find('.discuss_post_input').addClass('hidden');
             if(!loc.find('.posts_wrapper').html()){
               loc.find('.discuss_post_input').next().html('<div class="text-center"><h3>There are no new announcements</h3></div>');

             }

           }



}

function discuss_show_more(t){
  var code=t.attr('code');
  var related=t.attr('rec_id');
  prebuild_data_reply(related,code,t);
}



function discuss_retrieve_single(json,loc){
  var target= json.liked_by.indexOf(json.posts[0]);
  var single_clone = $('.discuss_single_clone').clone();
  single_clone.attr('class','discuss_single_clone1')
  single_clone.children().next().next().attr('rec_id',json.posts[0]);
  single_clone.find('.discuss_new_input_reply').attr('code',json.codes[0]);
  single_clone.find('.discuss_show_more').attr('code',json.codes[0]);
  single_clone.find('.discuss_new_input_reply').attr('rec_id',json.posts[0]);
  single_clone.find('.discuss_namer_reply').html("<br/>"+json.last_name);
  single_clone.find('.discuss_last_reply_content').html(json.last_reply);
  if(target>-1){
    single_clone.find('.discuss_show_more').attr('status','disable');

  }
  single_clone.attr('rec_id',json.posts[0]);
  loc.append(single_clone);

}





function reply_build_discuss(json,t){
  var status=t.attr('status');
  $('.discuss-modal-body').empty();
  var temp = $('<div/>');
  var post_clone = $('.discuss_post2').clone();
  post_clone.attr('class','discuss_post');
  post_clone.attr('code',json.code);

    post_clone.find('.discuss_liker_post').addClass('discuss_disabling_like');



  post_clone.find('.discuss_namer_post').html("<br>"+json.current_post_name[0]);
  post_clone.attr('rec_id',json.current_post_id);
  post_clone.find('.discuss_total_like').html(json.current_post_like[0]);
  post_clone.find('.discuss_content').html(json.current_post_content[0]);
  post_clone.find('.discuss_last_reply_input').children().attr('class','discuss_reply_input col-xs-12');

  temp.append(post_clone);
  temp.append("<br/>");
  //$('.discuss_new_box .discuss_emptier_new_box').append(temp);
  $('.discuss-modal-body').append(temp);
  var tempo=$('<div/>');

  for(var i=0;i<json.uids.length;i++){

    var target= json.liked_by.indexOf(json.posts[i]);
    var reply_clone = $('.discuss_reply_part').clone();
    reply_clone.find('.discuss_total_like').html(json.likes[i]);
  //  reply_clone.find('.discuss_total_like').html(10);

    if(target>-1){
      reply_clone.find('.discuss_liker_reply').addClass('discuss_disabling_like');

    }
    reply_clone.attr('rec_id',json.posts[i]);
    reply_clone.find('.discuss_last_reply_input ').attr('code',json.code);
    reply_clone.attr('class','discuss_reply_part');
    reply_clone.find('.discuss_namer_reply').html("<br/>"+json.namer_r[i]);
    reply_clone.find('.discuss_last_reply_content').html(json.contents[i]+"<br/>");
        tempo.append(reply_clone);
    tempo.append("<hr/>");
  }
$('.discuss-modal-body .discuss_replies_full').append(tempo);

  $('#discuss-modal-replies').modal('show');

}



function create_post(t){

  var loc=t.parent();
  var code=t.attr('code');
  var text_c = t.val();
  var post_clone = $('.discuss_post1').clone();
  post_clone.attr('class','discuss_post');
  post_clone.find('.discuss_content').html(text_c);
  $('.discuss_post_input').val("");

  var type = 0;
  $.ajax(
  {
    url: discuss_folder_name,
    dataType: "json",
    type:"GET",
    data:
    {
      mode:'ADD_POST',
      type:type,
      code:code,
      content:text_c
    },
    success: function( json )
    {
      //alert(json.msg);
      post_clone.attr('rec_id',json.msg);
      post_clone.find('.discuss_namer_post').html("<br/>"+json.namer);
      post_clone.find('.discuss_show_more').attr('rec_id',json.msg);
      post_clone.find('.discuss_show_more').attr('code',code);
      post_clone.find('.discuss_new_input_reply').attr('code',code);
      post_clone.find('.discuss_new_input_reply').attr('rec_id',json.msg);
      loc.find('.posts_wrapper').prepend(post_clone);
      }
  });/* AJAX */


}


function discuss_count_comment(code,loc){
  $.ajax(
  {
    url: discuss_folder_name,
    dataType: "json",
    type:"GET",
    data:
    {
      mode:'RETRIEVE_COMMENT_COUNT',
      code:code
    },
    success: function( json )
    {
        loc.html(json.count+" comments");
      }
  });/* AJAX */
}

function discuss_create_record(uid,code,content,type){
  $.ajax(
  {
    url: discuss_folder_name,
    dataType: "json",
    type:"GET",
    data:
    {
      mode:'ADD_POST',
      uid:uid,
      type:type,
      code:code,
      content:content
    },
    success: function( json )
    {
      }
  });/* AJAX */


}


function create_reply(t){
  var code=t.parent().parent().parent().attr('code');
  var type =1;
  var text_c = $(t).val();
  var tempor=$('<div/>');

  var related =  $(t).parent().parent().parent().attr('rec_id');
  //$('.new_box .emptier_new_box .replies_full').append(tempo);
//  $(t).parent().prev().append(tempo);
  $(t).val("");

  $.ajax(
  {
    url: discuss_folder_name,
    dataType: "json",
    type:"GET",
    data:
    {
      mode:'ADD_REPLY',
      type:type,
      code:code,
      content:text_c,
      related:related
    },
    success: function( json )
    {

      var reply_clone = $('.discuss_reply_part1').clone();
      reply_clone.attr('class','discuss_reply_part');
      reply_clone.attr('rec_id',json.rec_id);
      reply_clone.find('.discuss_namer_reply').html("<br/>"+json.msg);
      reply_clone.find('.discuss_last_reply_content').html(text_c+"<br/>");
      t.parent().prev().append(reply_clone);
    }

  });/* AJAX */




}


function new_create_reply(t){
  //alert('sdfsd');
  var code=t.attr('code');
  var uid = 2;
  var time ='3223423';
  var type =1;
  var text_c = $(t).val();
  var related =  t.attr('rec_id');
  $.ajax(
  {
    url: discuss_folder_name,
    dataType: "json",
    type:"GET",
    data:
    {
      mode:'ADD_REPLY',
      uid:uid,
      type:type,
      code:code,
      content:text_c,
      time:time,
      related:related
    },
    success: function( json )
    {
      $(t).parent().prev().prev().prev().html(json.msg);

      $(t).parent().prev().prev().html(text_c);
      $(t).val("");
      //$('.emptier').empty();
      //  prebuild_data_2();

          }
  });/* AJAX */


  }


function liker_reply(t){

  var id = t.parent().parent().parent().attr('rec_id');
  var code= t.parents('.discuss_post').attr('code');
  $.ajax(
  {
    url: discuss_folder_name,
    dataType: "json",
    type:"GET",
    data:
    {
      mode:'LIKE',
      id:id,
      code:code
    },
    success: function( json )
    {
      t.html('<br/>Liked')
      t.addClass("discuss_disabling_like");
       }
  });/* AJAX */

}

function liker_post(t){
  var id =t.parents('.discuss_post').attr('rec_id');
  var code =t.parents('.discuss_post').attr('code');
  var g= parseInt(t.find('.discuss_total_like').html());
  t.find('.discuss_total_like').html(g+1);
$.ajax(
{
  url: discuss_folder_name,
  dataType: "json",
  type:"GET",
  data:
  {
    mode:'LIKE',
    code:code,
    id:id
  },
  success: function( json )
  {
    t.html('Liked')
    t.addClass("discuss_disabling_like");
$('.discuss_show_more').attr("status","disable");
    }
});/* AJAX */
}

function follower_post(t){
  var id =$(t).parent().parent().parent().attr('rec_id');
  var code='2x3';
  $.ajax(
  {
    url: discuss_folder_name,
    dataType: "json",
    type:"GET",
    data:
    {
      mode:'FOLLOW',
      id:id,
      code:code
    },
    success: function( json )
    {
      t.html("Followed");
      t.addClass("discuss_disabling_like");
      }
  });/* AJAX */
}



function discuss_start(code,loc){
  var res = code.split("_");
  if(res[0]=='ASM'){
    var internal_mode='RETRIEVE_SINGLE';
    var pathname = window.location.pathname;
  }
  else{
    var internal_mode='RETRIEVE_ALL_POSTS';
  }

  $.ajax(
  {
    url: discuss_folder_name,
    dataType: "json",
    type:"GET",
    data:
    {
      mode:internal_mode,
      code:code
    },
    success: function( json )
    {
      loc.empty().html('<br/>');
      if(res[0]=='ASM'){
        discuss_retrieve_single(json,loc);

      }
      else{
        build_discuss(json,loc,code);
      }

      }
  });/* AJAX */
}


function prebuild_data_reply(related,code,t){

  $.ajax(
  {
    url: discuss_folder_name,
    dataType: "json",
    type:"GET",
    data:
    {
      mode:'RETRIEVE_REPLIES',
      code:code,
      related:related

    },
    success: function(json )
    {
      reply_build_discuss(json,t);

      }
  });/* AJAX */
}


function discuss_comments(code,loc){
  $.ajax(
  {
    url: discuss_folder_name,
    dataType: "json",
    type:"GET",
    data:
    {
      mode:'RETRIEVE_COMMENT_COUNT',
      code:code
    },
    success: function( json )
    {
        loc.html(json.count);
      }
  });/* AJAX */
}
