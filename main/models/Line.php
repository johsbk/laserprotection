<?php
namespace main\models;
class Line  {
	/**
	 * 
	 * Enter description here ...
	 * @var Vertex
	 */
	var $v1;
	/**
	 * 
	 * Enter description here ...
	 * @var Vertex
	 */
	var $v2;
	function __construct($v1,$v2) {
		$this->v1 = $v1;
		$this->v2 = $v2;
	}
	function length() {
		return $this->v1->distanceTo($this->v2);
	}
}