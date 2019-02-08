<?php

require_once 'config/init.php';

class View {

	public $table;
	public $page_count;
	public $current_page;
	private $sort;

	public function setData($data) {
		$this->table = $data;
	}

	public function setPagination($page_count, $current_page, $sort) {
		$this->page_count = $page_count;
		$this->current_page = $current_page;
		$this->sort = $sort;
	}

	public function renderTemplate($template_name) {
		$filepath = TEMPLATES . "/$template_name";
		ob_start();
		require $filepath . ".php";
		$content = ob_get_clean();
		require_once TEMPLATES . "/layout.php";
	}



}