<?php
	class controller_contact {
		function view(){
			common::load_view('top_page_contact.php', Module_contact . 'contact.html');
		}
		
		// function send_contact_us(){
		// 	$message = ['type' => 'contact',
		// 				'inputName' => $_POST['name'], 
		// 				'fromEmail' => $_POST['email'], 
		// 				'inputMatter' => $_POST['matter'], 
		// 				'inputMessage' => $_POST['message']];
		// 	$email = json_decode(mail::send_email($message), true);
		// 	if (!empty($email)) {
		// 		echo json_encode('Done!');
		// 		return;  
		// 	} 
		// 	echo json_encode('Error!');
		// }
	}
?>