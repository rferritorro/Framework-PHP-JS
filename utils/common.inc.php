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
    }