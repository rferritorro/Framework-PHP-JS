<?php

class controller_home {
    function view() {
        common::load_view('top_page_home.php', Home_view . 'home.html');
    }
}