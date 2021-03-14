<?php

require 'vendor/autoload.php';
use Mailgun\Mailgun;

if($_POST) {
    $guest_name = "";
    $guest_email = "";
    $rsvp = "";
    $guest_message = "";
    $email_body = "<div>";

    if(isset($_POST['guest_name'])) {
        $guest_name = filter_var($_POST['guest_name'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Guest Name:</b></label>&nbsp;<span>".$guest_name."</span>
                        </div>";
    }

    if(isset($_POST['guest_email'])) {
        $guest_email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['guest_email']);
        $guest_email = filter_var($guest_email, FILTER_VALIDATE_EMAIL);
        $email_body .= "<div>
                           <label><b>gGuest Email:</b></label>&nbsp;<span>".$guest_email."</span>
                        </div>";
    }

    if(isset($_POST['rsvp'])) {
        $rsvp = filter_var($_POST['rsvp'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>RSVP:</b></label>&nbsp;<span>".$rsvp."</span>
                        </div>";
    }

    // if(isset($_POST['number_guests'])) {
    //     $rsvp = filter_var($_POST['number_guests'], FILTER_SANITIZE_STRING);
    //     $email_body .= "<div>
    //                        <label><b>RSVP:</b></label>&nbsp;<span>".$rsvp."</span>
    //                     </div>";
    // }

    if(isset($_POST['guest_message'])) {
        $guest_message = htmlspecialchars($_POST['guest_message']);
        $email_body .= "<div>
                           <label><b>Guest Message:</b></label>
                           <div>".$guest_message."</div>
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