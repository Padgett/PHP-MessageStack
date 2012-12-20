<?php
/*
 * Class: MessageStack
 * @author Joshua Padgett
 * @date 2012-12-18
 * @desc Simple, lightweight message stack for PHP
 * @ver 1
 *
 * @notes
 * Dependencies: Message class
 * 
 * If you wish to make this stateful you'll need to store it somewhere.
 * The session is probably the easiest, although YMMV
 * If you'd like to use a database backend, extend the class and create/override the necessary methods
 * 
 * Examples: 
 * $_SESSION['messageStack'] = serialize($messageStack);
 * $messageStack = deserialize($_SESSION['messageStack'];
 */
class MessageStack {
	private $msgs;
	
	public function __sleep() {
	 return array('msgs');
	}
	
	/*
	 * Function: add
	 * Adds a new message to the stack
	 */
	public function add($msg,$level = null) {
		$this->msgs[] = new Message($msg, $level);
	}
	
	/*
	 * Function: getMessages
	 * Returns nested array of messages
	 * If level is passed, restricts to just those messages
	 */
	public function getMessages($level = null) {
		
	}
	
	/*
	 * Function: pop
	 * Returns first message array in stack
	 */
	public function pop() {
		
	}
	
	/*
	 * Function: clear
	 * Clears the message stack
	 */
	public function clear() {
		
	}
	
	/*
	 * Private Function: removeOne
	 * Removes message from the stack
	 */
	private function removeOne($i) {
		
	}

}

/*
 * Class: Message
 * The meat of the message stack
 */
class Message {
	private $_msg;
	private $_level;
	const INFO = 10;
	const WARNING = 20;
	const ERROR = 30;

	public function __construct($msg,$level = null) {
		$this->_msg = $msg;
		$this->_level = (is_null($level)) ? INFO : $level;
	}
	
	public function getArray() {
		return array(
				'msg'		=> $this->_msg,
				'level'	=> $this->_level
		);
	}
	
	public function getMsg() {
		return $this->_msg;
	}
	
	public function getLevel() {
		return $this->_level;
	}
		
}