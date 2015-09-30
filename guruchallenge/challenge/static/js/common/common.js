var g_url='http://localhost/chalkst/';
//var g_url="http://www.chalkstreet.com/";
/** Font family **/

  function load_fonts()
  {
    WebFontConfig = {
        google: { families: [ 'Lato:400,700:latin' ] }
      };
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  }

$(function(){
  load_fonts();
});

/** Login Signup **/
function login_signup(mode)
{
  $('#loginModal').modal('show');
  if(mode==1)// LOGIN
  {
    //$('#login_tabs li:eq(0) a').tab('show');
    $('.signup_box').addClass('hidden')
    $('.signup_box').removeClass('active')

    $('.login_box').removeClass('hidden')
    $('.login_box').addClass('active')

  }
  else // SIGNUP
  {
    $('.login_box').addClass('hidden')
    $('.login_box').removeClass('active')

    $('.signup_box').removeClass('hidden')
    $('.signup_box').addClass('active')

    //$('#login_tabs li:eq(1) a').tab('show');
  }
}
function changePswdType(t)
{

  if(t){
    $('.login_signup_box .active .pswd').attr('type','text');
  }
  else
  {
    $('.login_signup_box .active .pswd').attr('type','password');
  }
}
/* checking for availability of email id */
function validateEmail()
{
  var email= $('.login_signup_box .active .email').val();
  var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
  if(pattern.test(email))
  {
    $.ajax(
    {
      url: g_url+"users/accounts/login_backend.php",
      dataType: "json",
      type:"POST",
      data:
      {
        mode:'valid_email',
        email:email,
      },
      success: function(json)
      {
        $('.login_signup_box .active .email').next().removeClass('glyphicon glyphicon-remove').parent().removeClass('has-error has-success');
        if(json.status==1)
        {
          if(json.msg=="valid email")
          {
            $('.login_signup_box .active .email').next().removeClass('hidden').addClass('glyphicon glyphicon-ok').parent().addClass('has-success');
          }
          else
          {

          }
        }
      },
      error : function()
      {
        console.log("something went wrong in email checking!");
      }
    });

  }
  else
  {
    $('.login_signup_box .active .email').next().removeClass('hidden').addClass('glyphicon glyphicon-remove').parent().addClass('has-error');
  }

}
/** clearing input glyphicons **/
function clearInputError(t)
{
  t.next().removeClass('glyphicon glyphicon-remove hidden').parent().removeClass('has-error');
  $('.login_signup_box .active .status').html("")
}
/* creating a new user */
function createUser(){

  var first_name= $('.login_signup_box .active .first_name').val();
  var last_name= $('.login_signup_box .active .last_name').val();
  var email= $('.login_signup_box .active .email').val();
  var pswd= $('.login_signup_box .active .pswd').val();
  var remember_me=$('.login_signup_box .active .remember_me').prop('checked');
  var rurl=$('.login_signup_box .active .redirect_url').val();
  var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
  if(first_name=="" || last_name=="" || email==""|| pswd=="")
  {
    if(first_name==""){$('.login_signup_box .active .first_name').next().removeClass('hidden').addClass('glyphicon glyphicon-remove').parent().addClass('has-error');}
    if(last_name==""){$('.login_signup_box .active .last_name').next().removeClass('hidden').addClass('glyphicon glyphicon-remove').parent().addClass('has-error');}
    if(email==""){$('.login_signup_box .active .email').next().removeClass('hidden').addClass('glyphicon glyphicon-remove').parent().addClass('has-error');}
    if(pswd==""){$('.login_signup_box .active .pswd').next().removeClass('hidden').addClass('glyphicon glyphicon-remove').parent().addClass('has-error');}
    $('.login_signup_box .active .status').html("Please fill all fields").css('color','red');
  }
  else if(pattern.test(email))
  {
    $.ajax(
    {
      url: g_url+"users/accounts/login_backend.php",
      dataType: "json",
      type:"POST",
      data:
      {
        mode:'signup',
        first_name:first_name,
        last_name:last_name,
        email:email,
        pswd:pswd,
        remember_me:remember_me
      },
      success: function( json )
      {
          if(json.status==1)
          {
            $('.login_signup_box .active  .signup_button').addClass('hidden');
            $('.login_signup_box .active .status').html("You have registered successfully,<br/>we are redirecting you to our platform!").css('color','green');
            setTimeout(function(){ window.location = decodeURIComponent(json.r_url); }, 2000);
          }
          else if(json.status==2)
          {
            $('.login_signup_box .active .status').html(json.msg).css('color','red');
          }
      },
      error : function()
      {
        console.log("something went wrong!");
      }
    });

  }
  else
  {
    $('.login_signup_box .active .status').html('Invalid email id').css('color','red');
  }

}

/* validating login credentials */
function validateLogin()
{

  var uname= $('.login_signup_box .active  .email').val();
  var pswd= $('.login_signup_box .active .pswd').val();
  var remember_me=$('.login_signup_box .active .remember_me').prop('checked');
  var r_url=$('.login_signup_box .active .redirect_url').val();
  if(uname=="" || pswd=="" )
  {
    if(uname==""){$('.login_signup_box .active .email').next().removeClass('hidden').addClass('glyphicon glyphicon-remove').parent().addClass('has-error');}
    if(pswd==""){$('.login_signup_box .active .pswd').next().removeClass('hidden').addClass('glyphicon glyphicon-remove').parent().addClass('has-error');}
    $('.login_signup_box .active .status').html("<div>Please fill all fields to login</div>").css('color','red');
  }
  else
  {
    //$('.login_signup_box .active  .status').html("<div class='loading'></div>");
  $.ajax(
  {
    url: g_url+"users/accounts/login_backend.php",
    dataType: "json",
    type:"POST",
    data:
    {
      mode:'Login',
      uname:uname,
      pswd:pswd,
      r_url:r_url,
      remember_me:remember_me
    },
    success: function( json )
    {
        if(json.status==1)
        {
          $('.login_signup_box .active  .status').html("Please wait while we match your credentails...").css('color','');
          $('.login_signup_box .active  .forgot_style').addClass('hidden');
          $('.login_signup_box .active  .forgot_text').addClass('hidden');
          $('.login_signup_box .active  .signup_text').addClass('hidden');
          $('.login_signup_box .active  .signin_button').addClass('hidden');
          setTimeout(function(){ window.location = decodeURIComponent(json.r_url); }, 2000);
        }
        else
        {
          //pswd email
          $('.login_signup_box .active .status').html("You have entered an invalid email id or password!").css('color','red');
          return false;
        }
    },
    error : function()
    {
      console.log("something went wrong!");
    }
  });
}
}
function face_tracking(t){
  var face_college_name = $('.face_college_name').val();
  var face_trainer_name = $('.face_trainer_name').val();
  $.ajax(
  {
    url: "backend.php",
    dataType: "json",
    type:"GET",
    data:
    {
      mode:'FACE_TRACKING',
      face_college_name:face_college_name,
      face_trainer_name:face_trainer_name
    },
    success: function( json )
    {
      $('.face_details_submit').html("Submitting..")
      setTimeout(function(){

        $('.face_details_submit').html("Thanks!")
        }, 2000);

        setTimeout(function(){

        $('.face_banner').remove();
        }, 3000);

      }
  });/* AJAX */




}
function tawkto(){
  var $_Tawk_API={},$_Tawk_LoadStart=new Date();
  (function(){
  var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
  s1.async=true;
  s1.src='https://embed.tawk.to/553359a7970a9a5c23b8fb98/default';
  s1.charset='UTF-8';
  s1.setAttribute('crossorigin','*');
  s0.parentNode.insertBefore(s1,s0);
  })();
}

function hide_referral_banner()
{
  $(".refcode").addClass("hidden");
}
