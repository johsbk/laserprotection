<?php
class Line  {
	var $a;
	var $b;
	var $c;
	/**
	 * 
	 * Construct Line
	 * @param LineSegment $lineSegment Optional
	 */
	function __construct($lineSegment=null) {
		if ($lineSegment) {
			$v1 = $lineSegment->v1;
			$v2 = $lineSegment->v2;
			if ($v2->x-$v1->x==0) {
				$this->a = 1;
				$this->b = 0;
				$this->c = $v2->x;
			} else {
				$this->a = ($v2->y-$v1->y)/($v2->x-$v1->x);
				$this->b = -1;
				$this->c = -1*$this->a*$v1->x-$this->b*$v1->y;
			}
		}
	}
	/**
	 * 
	 * Determines if a point lies on the line
	 * @param Vertex $v1
	 * @return boolean
	 */
	function isPointOnLine($v1) {
		return abs($v1->x*$this->a+$v1->y*$this->b+$this->c)<0.000001;
	}
	/**
	 * 
	 * Distance to a point
	 * @param unknown_type $v1
	 * @return number
	 */
	function distanceToPoint($v1) {
		return abs($v1->x*$this->a+$v1->y*$this->b+$this->c)/sqrt(pow($this->a, 2)+pow($this->b,2));
	}
	/**
	 * 
	 * Determines if two lines is perpendicular to each other
	 * @param Line $line
	 */
	function isPerpendicular($line) {
		return abs($this->a*$line->a+$this->b*$line->b)<0.000001;
	}
	/**
	 * 
	 * Find the intersection between to lines
	 * @param Line $line
	 * @return Vertex
	 */
	function findIntersection($line) {
		if ((-1*$this->a*$line->b+$line->a*$this->b)==0) {
			throw new Exception('div by 0');
		}
		$x = (-1*$line->c*$this->b+$this->c*$line->b)/(-1*$this->a*$line->b+$line->a*$this->b);
		if ($x<0) {
			$x = $this->c;
		}
		if ($this->b==0) {
			$y = (-$line->a*$x-$line->c)/$line->b;
		}else {
			$y = (-$this->a*$x-$this->c)/$this->b;
		}
		return new Vertex($x, $y);
	}
	/**
	 * 
	 * Find perpendicular line going through given vertex
	 * @param Vertex $v
	 * @return Line
	 */
	function findPerpendicularLine($v) {
		$line = new Line();
		$line->b = $this->a;
		$line->a = $this->b*-1;
		$line->c = -1*$line->a*$v->x-$line->b*$v->y;
		return $line;
	}
}