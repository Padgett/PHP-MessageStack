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
	 * If clear is true, removes returned messages from the stack
	 */
	public function getMessages($clear = false,$level = null) {
		if (is_null($level)) {
			return $this->msgs;
			if ($clear) $this->msgs = array();
		} else {
			for ($i=0;count($this->msgs)<$i;$i++) {
				if ($this->msgs[$i]->getLevel == $level) {
					$return[] = $this->msgs[$i];
					if ($clear) $this->removeOne($i);
				}
			}
			if ($clear) $this->rebase();
			return $return;
		}
	}
	
	/*
	 * Function: pop
	 * Returns first message and removes it from the stack
	 */
	public function pop() {
		$return = $this->msgs[0];
		$this->removeOne(0);
		$this->rebase();
		
		return $return;
	}
	
	/* Function: clearMessages
	 * Clears the message stack
	 * If level is passed, restricts to just hose messages
	 */
	public function clearMessages($level = null) {
		if (is_null($level)) {
			$this->msgs = array();
		} else {
			for ($i=0;count($this->msgs)<$i;$i++) {
				if ($this->msgs[$i]->getLevel == $level) {
					$this->removeOne($i);
				}
			}
			$this->rebase();
		}
	}
	
	
	/*
	 * Private Function: removeOne
	 * Removes message from the stack
	 */
	private function removeOne($i) {
		unset($this->msgs[$i]);
	}
	
	/*
	 * Private Function: rebase
	 * Rebases msgs array
	 */
	private function rebase() {
		$this->msgs = array_values($this->msgs);
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
		return (string)$this->_msg;
	}
	
	public function getLevel() {
		return $this->_level;
	}
		
}