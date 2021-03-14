<?php

require 'vendor/autoload.php';
use Mailgun\Mailgun;

if($_POST) {
    $visitor_name = "";
    $visitor_email = "";
    $rsvp = "";
    $visitor_number = "";
    $visitor_message = "";
    $email_body = "<div>";

    if(isset($_POST['visitor_name'])) {
        $visitor_name = filter_var($_POST['visitor_name'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Guest Name:</b></label>&nbsp;<span>".$visitor_name."</span>
                        </div>";
    }

    if(isset($_POST['visitor_email'])) {
        $visitor_email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['visitor_email']);
        $visitor_email = filter_var($visitor_email, FILTER_VALIDATE_EMAIL);
        $email_body .= "<div>
                           <label><b>Guest Email:</b></label>&nbsp;<span>".$visitor_email."</span>
                        </div>";
    }

    if(isset($_POST['rsvp'])) {
        $rsvp = filter_var($_POST['rsvp'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>RSVP:</b></label>&nbsp;<span>".$rsvp."</span>
                        </div>";
    }

    if(isset($_POST['visitor_number'])) {
        $visitor_number = filter_var($_POST['visitor_number'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Number of Guests:</b></label>&nbsp;<span>".$visitor_number."</span>
                        </div>";
    }

    if(isset($_POST['visitor_message'])) {
        $visitor_message = htmlspecialchars($_POST['visitor_message']);
        $email_body .= "<div>
                           <label><b>Guest Message:</b></label>
                           <div>".$visitor_message."</div>
                        </div>";
    }

    $email_body .= "</div>";

    $recipient = "elbuck2010@gmail.com";
    // $recipient = "tommyjmarshall@gmail.com";

    $mg = Mailgun::create('key-136adf4ea75b6f7f57adfe967ab5f2af'); // For US servers

    // Now, compose and send your message.
    $result = $mg->messages()->send('mx.eliseandbenedict.com', [
        'from'  => $visitor_email,
        'to'    => $recipient,
        'subject' => "RSVP from $visitor_name",
        'text'  => '',
        'html'  => $email_body
    ]);

    if($result) {
        header('Location: /thankyou.html');
    } else {
        echo '<p>We are sorry but the email did not go through.</p>';
    }

} else {
    echo '<p>Something went wrong</p>';
}