PHP-MessageStack
================

Lightweight Message Stack for PHP.

Documentation
=============
Example Use Case:
````PHP
$messageStack = new MessageStack;
$messageStack->add('You\'re doing it wrong.',  Message::WARNING);
$messageStack->add('Hi there.',  Message::INFO);
$messageStack->add('Something blew up.',  Message::ERROR);

echo $messageStack->pop()->getMessage();
echo $messageStack->pop()->getMessage();
````
If you wish to make this stateful you'll need to store it somewhere.  
The session is probably the easiest, although YMMV  
If you'd like to use a database backend, extend the class and create/override the necessary methods  
  
Examples:  
$_SESSION['messageStack'] = serialize($messageStack);  
$messageStack = deserialize($_SESSION['messageStack'];  
