<?php
    class common {
        public static function load_error() {
   
            require_once (View_inc . 'top_page.php');
            require_once (View_inc . 'header.php');
            require_once (View_inc . 'error404.html');
            #require_once (View_inc . 'footer.html');
        }
        
        public static function load_view($topPage, $view) {
            $topPage = View_inc . $topPage;
            if ((file_exists($topPage)) && (file_exists($view))) {
                require_once ($topPage);
                require_once (View_inc . 'header.php');
                require_once ($view);
                //require_once (View_inc . 'footer.html');
            }else {
                self::load_error();
            }
        }

        public static function load_model($model, $function = null, $args = null) {

            $dir = explode('_', $model);
            $path = Module . $dir[0] . '/' . $dir[1] . '/' . $dir[1] . '/' .  $model . '.class.singleton.php';
            if (file_exists($path)) {
                require_once ($path);
                if (method_exists($model, $function)) {
                    $obj = $model::getInstance();
                    if ($args != null) {
                        return call_user_func(array($obj, $function), $args);
                    }
                    return call_user_func(array($obj, $function));
                }
            }
            throw new Exception();
        }
        
        public static function generate_token_secure($long){
            return bin2hex(openssl_random_pseudo_bytes($long));
        }
    }