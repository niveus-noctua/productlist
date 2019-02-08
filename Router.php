<?php

require_once ("View.php");

class Router {

	private static $model;
	private static $pages;
	private static $view;

	public static function retrieve($model) {
		self::$view = new View();
		self::$model = $model;
		$count = self::$model->getCount();
		self::$pages = self::calculatePages($count);
		if (isset($_GET['action'])) {
			$action = $_GET['action'];
			if (method_exists(Router::class, $action))
				Router::$action();
		} else {
			Router::main();
		}


	}

	private static function main() {
		$page_number = (isset($_GET['page'])) ? $_GET['page'] : 1;
		if (isset($_GET['sort'])) {
			$table = self::$model->getPage($page_number, $_GET['sort']);
			$sort = $_GET['sort'];
		} else {
			$table = self::$model->getPage($page_number);
			$sort = 'date';
		}

		self::$view->setData($table);
		self::$view->setPagination(self::$pages, $page_number, $sort);
		self::$view->renderTemplate('main');
	}

	private static function fill() {
		self::$model->fill();
		self::main();
	}

	private static function search() {
		if (isset($_POST)) {
			$page_number = (isset($_GET['page'])) ? $_GET['page'] : 1;
			echo $page_number;
			if (isset($_GET['sort'])) {
				$table = self::$model->search($page_number, $_GET['sort']);
				$sort = $_GET['sort'];
			} else {
				$table = self::$model->search($page_number);;
				$sort = 'date';
			}

			self::$pages = self::calculatePages(count($table));

			self::$view->setData($table);
			self::$view->setPagination(self::$pages, $page_number, $sort);
			self::$view->renderTemplate('main');
			$table = self::$model->search();
		}
	}

	private static function calculatePages($count) {
		return $pages = ($count % 10 > 0) ? intval($count / 10) + 1 : $count / 10;
	}




}