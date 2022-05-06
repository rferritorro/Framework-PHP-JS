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
                    $token_user= common::generate_token_secure(20);
                    
                    $sql = "INSERT INTO User(username,password,email,type,avatar,UID,activate,token) VALUES ('$username','$password','$mail',0,'$avatar','$uid',false,'$token_user')";
                    $stmt = $db->ejecutar($sql);

                    if ($stmt) {
                         $obj = [$token_user,$mail];
                        return $obj;
                    } else {
                        return 2;
                    }

                } else {
                    return 1;
                }
            } else {
                return 0;
            }

        }

        function select_new_user($db,$token_user) {

            $sql = "SELECT * FROM User WHERE token = '$token_user'";
            $stmt = $db->ejecutar($sql);
            $row_select = $stmt->num_rows;
            if ($row_select == 1) {
                $sql = "UPDATE User SET activate = 1 WHERE token = '$token_user'";
                $stmt = $db->ejecutar($sql);
                return true;
            } else {
                return false;
            }

        }

        function select_logg_user($db,$username,$password) {

            $sql = "SELECT password FROM User WHERE username = '$username' AND activate = 1";
            $stmt = $db->ejecutar($sql);
            $row_select = $stmt->num_rows;
            if ($row_select == 1) {
                $data = $db->listar($stmt);
                if (password_verify($password,$data[0]["password"])) {
                    return middleware_auth::encode_jwt($username);
                } else {
                    return 1;
                }
            } else {
                return 0;
            }

        }
        function select_charge_user($db,$token) {

            $username = middleware_auth::decode_jwt($token);
            $sql = "SELECT username,avatar,uid FROM User WHERE username = '$username'";
            $stmt = $db->ejecutar($sql);
            return $db->listar($stmt);
        }

        function select_check_mail($db,$email) {

            $sql = "SELECT * FROM User WHERE email = '$email' AND activate = 1 AND token NOT LIKE 'Google%' AND token NOT LIKE 'Github%'";
            $stmt = $db->ejecutar($sql);
            $row_select = $stmt->num_rows;
            if ($row_select == 1) {
                $sql = "UPDATE User SET activate = 0 WHERE email = '$email'";
                $stmt = $db->ejecutar($sql);
                return true;
            } else {
                return false;
            }

        }
    }