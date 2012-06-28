<?php
class Vertex  {
	var $x;
	var $y;
	var $usable = true;
	function __construct($x,$y) {
		$this->x=$x;
		$this->y=$y;
	}
	/**
	 * 
	 * Distance to another point
	 * @param unknown_type $v2
	 * @return number
	 */
	function distanceTo($v2) {
		return sqrt(pow($this->x-$v2->x,2)+pow($this->y-$v2->y,2));
	}
	/**
	 * 
	 * Returns the mean point given another vertex
	 * @param unknown_type $v2
	 * @return Vertex
	 */
	function meanPoint($v2) {
		return new Vertex(($v2->x-$this->x)/2+$this->x,($v2->y-$this->y)/2+$this->y);
	}
	/**
	 * 
	 * Return normal of vector to another point
	 * @param unknown_type $v2
	 * @return Vertex
	 */
	function normal($v2) {
		return new Vertex($v2->y-$this->y,-($v2->x-$this->x));
	}
	/**
	 * 
	 * Treat self as vector and add another vector
	 * @param \main\models\Vertex $v2
	 * @return \main\models\Vertex
	 */
	function add($v2) {
		return new Vertex($v2->x+$this->x,$v2->y+$this->y);
	}
	/**
	 * 
	 * Treat self as vector and normalize
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
	 * Treat self as vector and multiply a scalar
	 * @param double $a
	 * @return \main\models\Vertex
	 */
	function multiplyScalar($a) {
		return new Vertex(
			$this->x * $a,
			$this->y * $a);
	}
	/**
	 * 
	 * Text representation of self
	 * @return string
	 */
	function __toString() {
		return "($this->x,$this->y)";
	}
	/**
	 * 
	 * Get vector to another point
	 * @param unknown_type $v
	 * @return Vertex
	 */
	function getVector($v) {
		return new Vertex($v->x-$this->x,$v->y-$this->y);
	}
}