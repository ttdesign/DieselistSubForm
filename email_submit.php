<?php
//modified by Alex Perez from http://www.freecontactform.com/email_form.php

if(isset($_POST['email'])) {
    //DEBUG: change this to the proper address after testing     
    $destination_address = "alexanderlperez@gmail.com"; 

    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }

    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
     
    //get form information
    $email_from = $_POST['email']; // required
    $name = $_POST['name']
    $message = $_POST['message'];

    //validate that expected data exists
    if(!isset($_POST['email'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');      
    }
    
    //validate the email address is in the correct form 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  
    if(!preg_match($email_exp,$email_from)) {
      $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
      died($error_message);
    }

    // create email headers
    $headers = 'From: '.$email_from."\r\n".
               'Reply-To: '.$email_from."\r\n" .
               'X-Mailer: PHP/' . phpversion();

    //construct the message
    $email_to = $destination_address; 
    $email_subject = "Suggestion from " . clean_string($email_from); 

    $email_message = "Form details below.\n\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";    
    $email_message .= "Comments: ".clean_string($message)."\n";

    @mail($email_to, $email_subject, $email_message, $headers); 
?>
 
<!-- include your own success html here -->
 
Thank you for contacting us. We will be in touch with you very soon.
 
<?php
}
?>