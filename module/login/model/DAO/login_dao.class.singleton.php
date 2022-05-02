<?php
    class login_dao {
        static $_instance;

        public static function getInstance() {
            if(!(self::$_instance instanceof self)){
                self::$_instance = new self();
            }
            return self::$_instance;
        }
        function select_data_register($db,$username,$password,$mail) {
            $sql = "SELECT * FROM User WHERE username='$username'";
            $stmt = $db->ejecutar($sql);
            $row_select = $stmt->num_rows;
            if ($row_select == 0) {
                
                $sql = "SELECT * FROM User WHERE email='$mail'";
                $stmt = $db->ejecutar($sql);
                $row_select = $stmt->num_rows;
                
                if ($row_select == 0) {
                    $password = password_hash($password,PASSWORD_DEFAULT);
                    $avatar = "https://robohash.org/".$username;
                    
                    $uid= common::generate_token_secure(4);
                    
                    $sql = "INSERT INTO User (username,password,email,type,avatar,UID,activate,token) VALUES ('$username','$password','$mail',0,'$avatar','$uid',1,0)";
                    $stmt = $db->ejecutar($sql);
                    
                    $token = middleware_auth::encode_jwt($username);

                    return $token;

                } else {
                    return 1;
                }
            } else {
                return 0;
            }
        }
    }