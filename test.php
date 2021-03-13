<?php

# Include the Autoloader (see "Libraries" for install instructions)
require 'vendor/autoload.php';
use Mailgun\Mailgun;
# Instantiate the client.
$mgClient = new Mailgun('key-136adf4ea75b6f7f57adfe967ab5f2af');
$domain = "eliseandbenedict.com";
# Make the call to the client.
$result = $mgClient->sendMessage($domain, array(
    'from'  => 'Excited User <mailgun@eliseandbenedict.com>',
    'to'    => 'Elise <elise.buckley@my.avemaria.edu >',
    'subject' => 'Hello',
    'text'  => 'Testing some Mailgun awesomness!'
));