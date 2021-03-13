<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

# Include the Autoloader (see "Libraries" for install instructions)
require 'vendor/autoload.php';
use Mailgun\Mailgun;
# Instantiate the client.
$mg = Mailgun::create('key-136adf4ea75b6f7f57adfe967ab5f2af'); // For US servers

// Now, compose and send your message.
$mg->messages()->send('mx.eliseandbenedict.com', [
  'from'    => 'bob@example.com',
  'to'      => 'elise.buckley@my.avemaria.edu ',
  'subject' => 'The PHP SDK is awesome!',
  'text'    => 'It is so simple to send a message.'
]);