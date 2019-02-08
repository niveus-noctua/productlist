<?php

class Model {

	private $db;
	private $count;

	public function __construct($db) {
		$this->db = $db;
		$this->count = $this->getCount();
	}

	public function getCount() {
		$query = "SELECT COUNT(vendor_code) AS num FROM products;";
		$result = $this->db->query($query);
		$row = $result->fetch_assoc();
		$result->close();
		return $row['num'];
	}

	public function getPage($number, $sort = 'date') {
		$left_border = ($number > 1) ? intval($number - 1 . '0') : 0;
		$query = 'SELECT * FROM products ORDER BY ' . $sort . ' DESC ' . 'LIMIT ' . $left_border . "," . 10;
		$result = $this->db->query($query);
		$data = $result->fetch_all();
		return $data;
	}

	public function fill() {
		for ($i = 50; $i < 1000; $i++) {
			$j = $i + 1;
			$query = 'INSERT INTO products(`vendor_code`,`name`,`brand`,`type`,`color`,`discount`,`price`,`date`)
				VALUES (' . "'abc-{$j}','name-{$j}','brand-{$j}','type-{$j}','color-{$j}', " . rand(0, 50) . "," . rand(100, 40000)
				. "," . date('ymd') . ')';
			$this->db->query($query);
		}
	}

	public function search($number, $sort = 'date') {
		$query = 'SELECT * FROM products WHERE ';
		$left_border = ($number > 1) ? intval($number - 1 . '0') : 0;
		$i = 0;
		foreach ($_POST as $item=>$value) {
			if ($value != null) {
				if ($i++ != 0)
					$query .= ' OR ' . $item . ' LIKE ' . "'%$value%'";
				else
					$query .= $item . ' LIKE ' . "'%$value%'";
			} else {
				continue;
			}
		}
		$query .= ' LIMIT ' . $left_border . ',' . ' 10';
		$result = $this->db->query($query);
		$data = $result->fetch_all();
		return $data;
	}
}