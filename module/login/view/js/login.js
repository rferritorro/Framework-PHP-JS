
function panel_user() {
  $(document).on('click','#show_panel',function () {
    $('div#panel_register').attr('hidden',false);
    $('div.layer_user').attr('hidden',false);

  });
  
  $(document).on('click','#logout',function () {
    localStorage.removeItem('token');
    $.when(setTimeout(toastr.info("User just finished session,wait a few seconds.."),5000))
    .then(element => {
      window.location.reload();
    });
  });

  $(document).on('click','#user_login_close',function () {

    $('div#panel_register').attr('hidden',true);
    $('div.layer_user').attr('hidden',true);

  });

}
function change_password() {
  $(document).on('click','#remind',function () {
    $('div#login').empty();
    $('<div></div>').attr({'id':'panel_password'}).appendTo('div#login');
    $('<h3></h3>').html("Write your email").appendTo('#panel_password');
    $('<input></input>').attr({'id':'mail_2','type':'email','placeholder':'Email'}).appendTo('#panel_password');
    $('<br />').appendTo('#panel_password');
    $('<input></input>').attr({'id':'send_email','type':'button','value':'Recover','style':'background-color:red;color:white;border:none'}).appendTo('#panel_password');
  });
  $(document).on('click','#send_email',function () {
    var value = document.getElementById('mail_2').value;

    var regex = /^[A-Z0-9._%+-]+@(?:[A-Z0-9-]+.)+[A-Z]{2,4}$/i;
    var result = regex.test(value);
    if (result) {
      var data = {"email": value};
      ajaxPromise(friendlyURL('?page=login&op=check_mail'), 
      'POST', 'JSON',data)
      .then(function(check) {
        if (check) {
          ajaxPromise(friendlyURL('?page=login&op=recover_mail'), 
          'POST', 'JSON',data)
          .then(function(check) {
            if (check) {
              toastr.info("Revise your mail to change password");
            } else {
              toastr.error("There was an error in the process to change your password");
            }
          }).catch(function(info) {
            // window.location.href = "index.php?exceptions=controller&option=503";
            console.log(info);
          });
        } else {
          toastr.error("Email doens't exist or is vinculated with Google and Github");
        };
      }).catch(function(info) {
        // window.location.href = "index.php?exceptions=controller&option=503";
        console.log(info);
      });
    } else {
      toastr.error("Email ins't correct");
    }
  });
}
function validator_log(check) {
  var boolean = true;
  if (check[0].value) {
    var regex = /^[A-Za-z][A-Za-z0-9_]{2,20}$/;
    var result = new RegExp(regex);
    var result = regex.test(check[0].value);

    if (result == false ) {
      boolean = false;
      toastr.error("Username mustn't be contains less 20 caracters");
      return boolean;
    }
  } else {
        toastr.error("Username is required");
    boolean = false;
    return boolean;
  }

  if (check[1].value) {

    var regex = /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/;
    var result = new RegExp(regex);
    var result = regex.test(check[1].value);

    if (result == false ) {
      boolean = false;
      toastr.error("Passoword must be contains at least one lowercase, uppercase and one digit with limit between 8 and 16 caracters");
      return boolean;
    }
  } else {
    toastr.error("Password is required");
    boolean = false;
    return boolean;
  }

  return boolean;
}
function give_data_login() {

  $(document).on('click','#login_button',function () {
  
    var check = $('form#login').serializeArray();
    for ( i in check) {
      if (check[i].value == "") {
        $('input#'+check[i].name).css('background-color','black');
        
      } else {
        $('input#'+check[i].name).css('background-color','#363636');
      }
  }
    var data = $('form#login').serialize();

    $.when(validator_log(check))
    .then(element => {
      if (element == false) {
        console.log("Error");
      } else {
        ajaxPromise(friendlyURL('?page=login&op=logg-user'), 
        'POST', 'JSON',data)
        .then(function(data) {
          if (data == 0) {
            toastr.error("Username doesn't exist or is not activate");
          } else if ( data == 1) {
            toastr.error("Password isn't correct");
          } else {
            localStorage.setItem('token',JSON.stringify(data));
          toastr.info("User has logged");
          setTimeout(window.location.reload(),5000);
          }
         console.log(data);
        }).catch(function(info) {
          // window.location.href = "index.php?exceptions=controller&option=503";
          console.log(info);
        });
      }
    });
  });
}
$(document).ready(function () {
   panel_user();
   give_data_login();
   change_password();
});