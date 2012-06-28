<?php
class LineSegment  {
	/**
	 * @var Vertex
	 */
	var $v1;
	/**
	 * @var Vertex
	 */
	var $v2;
	function __construct($v1,$v2) {
		$this->v1 = $v1;
		$this->v2 = $v2;
	}
	/**
	 * 
	 * Gives length of line segment
	 * @return number
	 */
	function length() {
		return $this->v1->distanceTo($this->v2);
	}
}