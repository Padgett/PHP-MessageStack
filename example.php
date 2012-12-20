<?php
session_start();
require_once('MessageStack.class.php');

$msgs = new MessageStack;
$msgs->add('You\'re doing it wrong.',  Message::WARNING);
$msgs->add('Hi there.',  Message::INFO);
$msgs->add('Something blew up.',  Message::ERROR);

/*** We can store state in the _SESSION variable, or anywhere else really ***/
$_SESSION['messageStack'] = serialize($msgs);
unset($msgs);
$msgs = unserialize($_SESSION['messageStack']);
/*** ***/

print_r($msgs->pop());
print_r($msgs->pop());
print_r($msgs->pop());

session_destroy();
exit;
?>