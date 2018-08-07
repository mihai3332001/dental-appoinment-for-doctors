<?php 

	class bassPath {
	private $root;
	public function __construct() {
		$this->root = 'http://' . $_SERVER['HTTP_HOST'] . '/ica/';
	}
	public function Path() {
		return $this->root;
	}
	public function redirect($url) {
		$statusLink = $this->root;
		$statusLink .= $url;
		header('Location: ' . $statusLink, true, 302);
	}

	public function back() {
		$host = header('Location: ' . $_SERVER['HTTP_REFERER']);
		return $host;
	}
} 

?>