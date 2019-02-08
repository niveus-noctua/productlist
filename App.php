<?php

require_once ("Router.php");
require_once ("Model.php");

class App {

	public function __construct() {
		extract(require_once CONF . '/db_config.php');
		$this->connectDatabase($host, $user, $password, $db_name);
	}

	private function connectDatabase($host, $user, $password, $db_name) {
		$db = new mysqli($host, $user, $password, $db_name);
		if (!$db->connect_errno) {
			$model = new Model($db);
			Router::retrieve($model);
		} else {
			echo 'Не удалось соединиться с базой данных';
		}
	}

}