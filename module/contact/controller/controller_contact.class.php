<?php
	class controller_contact {
		function view(){
			common::load_view('top_page_contact.php', Contact_view . '/contact.html');
		}
		function email() {
			$check = mail::send_email($_POST);
			echo json_encode($check);
		
		}
	}
?>
