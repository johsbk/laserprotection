<?php
namespace main\models;
class Vertex  {
	static $x;
	static $y;
	function __construct($x,$y) {
		$this->x=$x;
		$this->y=$y;
	}
	function distanceTo($v2) {
		return sqrt(pow($this->x-$v2->x,2)+pow($this->y-$v2->y,2));
	}
	function meanPoint($v2) {
		return new Vertex(($v2->x-$this->x)/2+$this->x,($v2->y-$this->y)/2+$this->y);
	}
	function normal($v2) {
		return new Vertex($v2->y-$this->y,-($v2->x-$this->x));
	}
	/**
	 * 
	 * Enter description here ...
	 * @param \main\models\Vertex $v2
	 * @return \main\models\Vertex
	 */
	function add($v2) {
		return new Vertex($v2->x+$this->x,$v2->y+$this->y);
	}
	/**
	 * 
	 * Enter description here ...
	 * @return \main\models\Vertex
	 */
	function normalize() {
		$vlength = sqrt(pow($this->x,2)+pow($this->y,2));
		return new Vertex(
			$this->x / $vlength,
			$this->y / $vlength);
	}
	/**
	 * 
	 * Enter description here ...
	 * @param double $a
	 * @return \main\models\Vertex
	 */
	function multiplyScalar($a) {
		return new Vertex(
			$this->x * $a,
			$this->y * $a);
	}
}