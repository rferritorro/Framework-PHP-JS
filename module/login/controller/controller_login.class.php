<?php
#This has to connect to db for send the data to front-end
class controller_login {
    function register() {
        echo json_encode(common::load_model('login_model', 'get_register',[$_POST["username"],$_POST["Password"],$_POST["email"]]));
    }
}