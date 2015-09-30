$(function(){
  check_user();
  count_rec();
  card_builder();
  $('.headers_1').click(function(){
  $('.headers_1').removeClass('activex');
  $('.contents').addClass('hidden');
  $(this).addClass("activex");
  var j = $(this).attr('id')+"_content";
  $('.'+j).removeClass("hidden");

});

});

function showOrganization(){
  $('.organisation_details').removeClass('hidden');

}

function dshowOrganization(){
  $('.organisation_details').addClass('hidden');

}


function tab_positioner(val){
  $('.headers_1').removeClass('activex');
  $('.contents').addClass('hidden');
  $('.stage_'+val).addClass("activex");
  $('.stage_'+val+'_content').removeClass("hidden");

}

function build_new(){
  input_status(1);
  tab_positioner(1);
  empty_create();
}

function build_old(){
  $('.videos_l').removeClass('hidden');
  var k = $('.videos_l');
  video_url(k);
    tab_positioner(1);
    get_data();
}


function card_builder(){
  $.ajax(
  {
    url: "backend.php",
    dataType: "json",
    type:"GET",
    data:
    {
      mode:'RETRIEVE_ALL_COURSES'


    },
    success: function( json )
    {
      var p = $('<div/>');
      for(i=0;i<json.course_status.length;i++){
        var clo = $('.card').clone();

        if(json.course_name[i]){
          clo.find('.card_title').html(json.course_name[i]);

        }
        else{
          clo.find('.card_title').html('Untitled');
          clo.find('.feedback').removeClass('hidden');
          clo.find('.feedback').attr('pcid',json.pcid[i]);
        }
        if(json.course_status[i]==0){
          clo.find('.card_status').html("You have started to create a course ! Click on the link below to continue");
          clo.find('.edit_link').removeClass('hidden');
          clo.find('.edit_link').attr("href", "creator.php?pcid="+json.pcid[i]);
        }
        else if(json.course_status[i]==1){
          clo.find('.card_status').html("Hey ! Your course has been submitted and is been reviewed by our team.");
        }
        else if(json.course_status[i]==2){
          clo.find('.feedback').removeClass('hidden');

          clo.find('.card_status').html("CONGRATULATIONS ! Your course has been approved");

        }
        else{

          clo.find('.edit_link').removeClass('hidden');
          clo.find('.card_status').html("This course can be improved a lot. Please read our feed back!");

        }
        p.append(clo);

      }
      $('.work_place').append(p);
       }
  });
}

function save(){
  //first get data
  //then save the current time above the course
  //check the current all field status and
  //step 1
  var course_name = $('.course_name').val();
  var course_desc = $('.course_desc').val();
  var course_category = $('.course_category').val();
  var language = $('.language').val();
  var course_level = $('.course_level').val();
  var course_type = $('input[name=type]:checked').val();

  //step2

  var outcome = $('.outcome').val();
  var course_for = $('.course_for').val();
  var prerequisite = $('.prerequisite').val();
  var expertise = $('.expertise').val();
  var details = $('.details').val();

  //step3
  var video_name = $('.video_name').val();
  var video_type= $('.video_type').val();
  $.ajax(
  {
    url: "backend.php",
    dataType: "json",
    type:"GET",
    data:
    {
      mode:'SAVE_ALL',
      course_name: course_name,
      course_desc: course_desc,
      course_category: course_category,
      language: language,
      course_level: course_level,
      course_type: course_type,
      outcome: outcome,
      course_for: course_for,
      prerequisite: prerequisite,
      expertise: expertise,
      details: details,
      video_name: video_name,
      video_type: video_type


    },
    success: function( json )
    {
      var dt = new Date();
      var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
      $('.last_saved').removeClass('hidden');
      $('.last_saved').html("Last saved on "+time);
      submit_v();
       }
  });/* AJAX */
}

function save_modal(){


  var uid = $('.uid').val();
  //var background=$('input[name=background]:checked').val();
  //var experience=$('input[name=experience]:checked').val();
  var experience=1;
  var background=2;

  var institute_name = $('.institute_name').val();
  var field = $('.field').val();
  var website = $('.website').val();
  var work_email = $('.work_email').val();


  $.ajax(
  {
    url: "backend.php",
    dataType: "json",
    type:"GET",
    data:
    {
      mode:'SAVE_MODAL',
      uid: uid,
      background: background,
      experience: experience,
      institute_name: institute_name,
      field: field,
      website: website,
      work_email:work_email


    },
    success: function( json )
    {
       }
  });/* AJAX */
}

//https://s3-ap-southeast-1.amazonaws.com/chalkst-challenge/uploads/
  function submit_v(){
  $.ajax(
  {
    url: "backend.php",
    dataType: "json",
    type:"GET",
    data:
    {
      mode:'CHECK'


    },
    success: function( json )
    {
    if(json.check_status){
      $('.submit').removeClass('disabled');
    }

       }
  });



}
function check_user(){
  $.ajax(
  {
    url: "backend.php",
    dataType: "json",
    type:"GET",
    data:
    {
      mode:'CHECK_USER'

    },
    success: function( json )
    {

      var n = json.exist;
      if(n=='false'){
        $('#user_modal').modal('show');

            }

       }
  });

}


function submit(){

  input_status(1);
  window.location.replace("http://localhost/guruchallenge/challenge");

}

function empty_create(){
  $.ajax(
  {
    url: "backend.php",
    dataType: "json",
    type:"GET",
    data:
    {
      mode:'CREATE_EMPTY'


    },
    success: function( json )
    {
      input_status(0);
       }
  });

}

function get_data(){
  $.ajax(
  {
    url: "backend.php",
    dataType: "json",
    type:"GET",
    data:
    {
      mode:'RETRIEVE_ALL_COURSE_INFO'


    },
    success: function( json )
    {
      $('.course_name').val(null_remove(json.course_name));
      $('.course_desc').val(null_remove(json.course_desc));
      $('.course_category').val(null_remove(json.course_category));
      $('.language').val(null_remove(json.language));
      $('.course_level').val(null_remove(json.course_level));
      $('input[name=type]:checked').val(null_remove(json.type));
      $('.outcome').val(null_remove(json.outcome));
      $('.course_for').val(null_remove(json.course_for));
      $('.prerequisite').val(null_remove(json.prerequisite));
      $('.expertise').val(null_remove(json.expertise));
      $('.details').val(null_remove(json.details));
       }
  });

}

function null_remove(e){

  if(e=='NULL'){
    return " ";
  }
  else{
    return e;
  }
}





function upload(){
  var file_data = $('#fileToUpload').prop('files')[0];
  var form_data = new FormData();
  form_data.append('file', file_data)

  $.ajax({
              url: 'upload.php', // point to server-side PHP script
              dataType: 'text',  // what to expect back from the PHP script, if anything
              cache: false,
              contentType: false,
              processData: false,
              data: form_data,
              type: 'post',
                  beforeSend: function() {
                 $('.loader').removeClass('hidden');

        },
              success: function(php_script_response){

                 $('.loader').hide();
                 save_video();
                 $('.videos_l').removeClass('hidden');
                 var k = $('.videos_l');
                 video_url(k);
                 // alert(php_script_response); // display response from the PHP script, if any
              }
   });
}

function video_url(loc){


  $.ajax(
  {
    url: "backend.php",
    dataType: "json",
    type:"GET",
    data:
    {
      mode:'SIGNED_VIDEO'


    },
    success: function( json )
    {
      loc.attr('src',json.url);
  }
  });
}

function save_video(){


  $.ajax(
  {
    url: "backend.php",
    dataType: "json",
    type:"GET",
    data:
    {
      mode:'SAVE_VIDEO'


    },
    success: function( json )
    {
  }
  });
}


function input_status(status){

  $.ajax(
  {
    url: "backend.php",
    dataType: "json",
    type:"GET",
    data:
    {
      mode:'INPUT_STATUS',
      course_status:status


    },
    success: function( json )
    {
  }
  });

}

function input_status(status){

  $.ajax(
  {
    url: "backend.php",
    dataType: "json",
    type:"GET",
    data:
    {
      mode:'INPUT_STATUS',
      course_status:status


    },
    success: function( json )
    {
  }
  });

}



function show_feed(t){
  var pcid = t.attr('pcid');
  $.ajax(
  {
    url: "backend.php",
    dataType: "json",
    type:"GET",
    data:
    {
      mode:'SHOW_FEEDBACK',
      pcid:pcid


    },
    success: function( json )
    {
      $('.modal_con_feedback').html(json.feedback);
      $('#user_modal_1').modal('show');
    }
  });

}

function count_rec(){

  $.ajax(
  {
    url: "backend.php",
    dataType: "json",
    type:"GET",
    data:
    {
      mode:'COUNTER'


    },
    success: function( json )
    {
      $('.count_unlogged').html("<h2>"+"Over "+ json.count +" Ideas !</h2>");

    }
  });

}
