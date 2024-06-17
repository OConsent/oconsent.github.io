<?php
  
if($_POST) {
    $visitor_name = "";
    $visitor_email = "";
    $email_title = "";
    $concerned_department = "";
    $visitor_message = "";
    $email_body = "<div>";
    $recipient = "hi@oconsent.io";
      
    if(isset($_POST['visitor_name'])) {
        $visitor_name = filter_var($_POST['visitor_name'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Visitor Name:</b></label>&nbsp;<span>".$visitor_name."</span>
                        </div>";
    }
 
    if(isset($_POST['visitor_email'])) {
        $visitor_email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['visitor_email']);
        $visitor_email = filter_var($visitor_email, FILTER_VALIDATE_EMAIL);
        $email_body .= "<div>
                           <label><b>Visitor Email:</b></label>&nbsp;<span>".$visitor_email."</span>
                        </div>";
    }
      
    if(isset($_POST['email_title'])) {
        $email_title = filter_var($_POST['email_title'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Reason For Contacting Us:</b></label>&nbsp;<span>".$email_title."</span>
                        </div>";
    }
      
    if(isset($_POST['visitor_message'])) {
        $visitor_message = htmlspecialchars($_POST['visitor_message']);
        $email_body .= "<div>
                           <label><b>Visitor Message:</b></label>
                           <div>".$visitor_message."</div>
                        </div>";
    }
      
    $email_body .= "</div>";
 
    $headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . $visitor_email . "\r\n";
      
    if(mail($recipient, $email_title, $email_body, $headers)) {
        echo "<p style='font-family: Arial; font-size: 16px; text-align: center; padding: 24px; border: 1px solid #16a085; background: #1abc9c; color: #fff; border-radius: 4px;'>Thank you for contacting us, $visitor_name. We will get back to you at the earliest.</p>";
    } else {
        echo '<p style="font-family: Arial; font-size: 16px; text-align: center; padding: 24px; border: 1px solid #c0392b; background: #e74c3c; color: #fff; border-radius: 4px;">We are sorry but the email did not go through. Please retry.</p>';
    }
      
} else {
    echo '<p style="font-family: Arial; font-size: 16px; text-align: center; padding: 24px; border: 1px solid #c0392b; background: #e74c3c; color: #fff; border-radius: 4px;">Something went wrong.</p>';
}
?>