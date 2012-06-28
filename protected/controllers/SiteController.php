<?php
/**
 * 
 * Main controller for the site
 * @author johs
 *
 */
class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
		);
	}
	/**
	 * 
	 * run tests
	 */
	public function actionTest() {
		$size = 7;
		$its = 10;
		set_time_limit(300);
		$fails = 0;
		$stats = array();
		for ($i=0;$i<$its;$i++) {
			try {
				$cost = array();
				while (true) {
					$vs = $this->generatePolygon($size);
					$hull = $this->convexHull($vs);
					if (count($hull)==$size) break;
				}
				$cost['lb'] = $this->lowerbound($hull);
				
				$hulldefense = $this->hullAsDefense($hull);
				$cost['hull'] = $this->measureDefense($hulldefense);
				
				$mst = $this->mstDefense($hull);
				$cost['mst'] = $this->measureDefense($mst);
				
				//$smt = $this->smtDefense($hull);
				//$cost['smt'] = $this->measureDefense($smt);
				
				$akman = $this->myDefense2($hull);
				$cost['akman'] = $this->measureDefense($akman);
				
				$shermer = $this->shermanDefense($hull);
				$cost['shermer'] = $this->measureDefense($shermer);
				
				$new = $this->myDefense3($hull);
				$cost['new'] = $this->measureDefense($new);
				foreach ($cost as $k=>$v) {
					if (!isset($stats[$k])) $stats[$k] = 0;
					$stats[$k] += $v / $cost['lb'] * 100;
				}
			} catch(Exception $e) {
				$fails++;
			}
		}
		echo '<table>';
		foreach ($stats as $k=>$v) {
			echo '<tr><td>'.$k.'</td><td>'.str_replace('.',',',($v/($its-$fails))).'</td></tr>';
		}
		echo '</table>';
	}
	/**
	 * 
	 * Ajax call to get the Beam Detector given a set of vertices
	 */
	public function actionGetDefense() {
		$vs = array();
		foreach ($_POST['points'] as $p) {
			$vs[] = new Vertex($p['x'], $p['y']);
		}
		$hull = $this->convexHull($vs);
		switch($_POST['defense']) {
			case 'akman':
				$defense = $this->myDefense2($hull);
				break;
			case 'shermer':
				$defense = $this->shermerDefense($hull);
				break;
			case 'hull':
				$defense = $this->hullAsDefense($hull);
				break;
			case 'smt':
				$defense = $this->smtDefense($hull);
				break;
			case 'new':
				$defense = $this->myDefense3($hull);
				break;
			case 'mst':
				$defense = $this->mstDefense($hull);
				break;
			case 'halfcover':
				$defense = $this->coverRange(0, count($hull)-1, $hull);
				break;
			
		}
		$c['defense'] = $defense;
		$c['ch'] = $hull;
		$c['lb'] = $this->lowerbound($hull);
		echo json_encode($c);
	}
	/**
	 * Main page
	 */
	public function actionIndex()
	{
		
		$vs = $this->generatePolygon(7);
		$c['vs'] = $vs;
					
		//$this->serializePolygon($vs);
		#$this->calculateAngles($vs);
				
		$hull = $this->convexHull($vs);		
		$c['ch'] = $hull;
		$c['defenses'] = array(
			'akman','shermer','smt','mst','hull','new','halfcover'
		);
		
		$c['lb'] = $this->lowerbound($hull);
		$this->render('index',$c);
	}
	/**
	 * 
	 * Provide lowerbound for a Beam Detector given a convex hull
	 * @param unknown_type $hull
	 */
	private function lowerbound(&$hull) {
		$count = count($hull);
		$length=$hull[0]->distanceTo($hull[$count-1]);
		for ($i=1;$i<$count;$i++) {
			$v1 = $hull[$i];
			$v2 = $hull[$i-1];
			/* @var $v2 Vertex */
			$length += $v2->distanceTo($v1);
		}
		return $length/2;
	}
	/**
	 * 
	 * Serializes a polygon
	 * @param unknown_type $vs
	 */
	private function serializePolygon(&$vs) {
		echo '$points = array(<br />';
		foreach ($vs as $v) {
			echo '('.($v->x).','.$v->y.'),<br />';
		}
		echo ');<br />';
	}
	/**
	 * 
	 * Calculates angles given a polygon of up to 4 corners
	 * @param unknown_type $vs
	 */
	public function calculateAngles($vs) {
		$corners = array('A','B','C','D');
		$c = count($vs);
		$angles = array();
		for ($i=0;$i<$c;$i++) {
			for ($j=0;$j<$c;$j++) {
				for ($k=0;$k<$c;$k++) {
					if ($i!=$j && $j!=$k && $i!=$k) 
						$angles[$corners[$j].$corners[$i].$corners[$k]] = $this->calculateAngleA($vs[$i], $vs[$j], $vs[$k]);
				}
			}
		}
		/*
		echo $angles['ABC'].'<br />';
		echo $angles['BCD'].'<br />';
		echo $angles['ABD'].'<br />';
		echo $angles['ACD'].'<br />';*/
	}
	/**
	 * 
	 * Calculate angle of a triangle ABC of the perspective of B
	 * @param Vertex $A
	 * @param Vertex $B
	 * @param Vertex $C
	 */
	private function calculateAngleA($A,$B,$C) {
		$b = $A->distanceTo($C);
		$c = $A->distanceTo($B);
		$a = $B->distanceTo($C);
		$upper = pow($b, 2)+pow($c,2)-pow($a,2);
		$lower = 2*$b*$c;
		return rad2deg(acos($upper/$lower));
	}
	/**
	 * 
	 * Exsample polygon 1
	 */
	public function polygon1() {
		$points = array(
			array(149,57),
			array(149,131),
			array(55,99),
			array(65,56),
			array(119,53),
			array(58,64),
			//array(96,59),
			//array(107,54),
			//array(103,60),
			//array(80,88),
		);
		$vs = array();
		foreach ($points as $point) {
			$v = new Vertex($point[0],$point[1]);
			$vs[] = $v;
		}
		return $vs;
	}
	/**
	 * 
	 * Example polygon 2
	 */
	public function polygon2() {
		$points = array(
			array(79,137),
			array(136,85),
			array(69,52),
			array(147,137),
			array(81,54),
			array(115,135),
			array(104,57),
			array(115,146),
			array(109,96),
			array(135,90),
		);
		$vs = array();
		foreach ($points as $point) {
			$v = new Vertex($point[0],$point[1]);
			$vs[] = $v;
		}
		return $vs;
	}
	/**
	 * 
	 * Example polygon 3
	 */
	public function polygon3() {
		$points = array(
		array(61,121),
		array(129,143),
		array(57,87),
		array(91,90),
		);
		$vs = array();
		foreach ($points as $point) {
			$v = new Vertex($point[0],$point[1]);
			$vs[] = $v;
		}
		return $vs;
	}
	/**
	 * 
	 * Example for coverRange 1
	 */
	public function halfHull1() {
		$points = array(
			array(0,0),
			array(70,50),
			array(80,40),
			array(49,41),
			array(40,35),
			array(100,1),
		);
		$vs = array();
		foreach ($points as $point) {
			$v = new Vertex($point[0],$point[1]);
			$vs[] = $v;
		}
		return $vs;
	}
	/**
	 * 
	 * Example a circle
	 */
	public function circle() {
		$r = 20;
		$intervals = 10;
		$delta_theta = 2.0 * pi() / $intervals;
		$theta = 0;
		$vs = array();
		for($i = 0; $i < $intervals-5;$i++)
		{
			$vs[] = new Vertex( $r * cos($theta) +50, $r * sin($theta)+50);
			$theta += $delta_theta;
		}
		return $vs;
	}
	/**
	 * 
	 * Example from Marcus, gives incoherent results compared to Marcus
	 */
	public function example1() {
		$points = array(
		array(-2030,33),
		array(-2018,15),
		array(-2000,5),
		array(-1199.3837,39.1531),
		array(0,0),
		array(1199.3837,39.1531),
		array(2000,5),
		array(2018,15),
		array(2030,33),
		);
		$vs = array();
		foreach ($points as $point) {
			$v = new Vertex(($point[0]+2030),$point[1]);
			$vs[] = $v;
		}
		return $vs;
	}
	/**
	 * 
	 * Solution offered by Marcus
	 */
	public function example1solution1() {
		$points = array(
		array(-2030,33),
		array(-2018,15),
		array(-2000,5),
		array(-1144.1117,35.4295),
		array(0,0),
		array(1144.1117,35.4295),
		array(2000,5),
		array(2018,15),
		array(2030,33),
		array(-1199.3837,39.1531),
		array(1199.3837,39.1531),
		array(-2030.01,35),
		array(2030.01,35),
		);
		$vs = array();
		foreach ($points as $point) {
			$v = new Vertex(($point[0]+2030),$point[1]);
			$vs[] = $v;
		}
		$lines = array();
		$lines[] = new LineSegment($vs[0],$vs[1]);
		$lines[] = new LineSegment($vs[1],$vs[2]);
		$lines[] = new LineSegment($vs[0],$vs[11]);
		$lines[] = new LineSegment($vs[2],$vs[9]);
		$lines[] = new LineSegment($vs[9],$vs[4]);
		$lines[] = new LineSegment($vs[4],$vs[10]);
		$lines[] = new LineSegment($vs[10],$vs[6]);
		$lines[] = new LineSegment($vs[6],$vs[7]);
		$lines[] = new LineSegment($vs[7],$vs[8]);
		$lines[] = new LineSegment($vs[8],$vs[12]);
		return $lines;
	}
	/**
	 * 
	 * Other solution offered by marcus
	 */
	public function example1solution2() {
		$points = array(
		array(-2030,33),
		array(-2018,15),
		array(-2000,5),
		array(-1144.1117,35.4295),
		array(0,0),
		array(1144.1117,35.4295),
		array(2000,5),
		array(2018,15),
		array(2030,33),
		array(-2030,35.4295),
		array(2030,35.4295),
		);
		$vs = array();
		foreach ($points as $point) {
			$v = new Vertex(($point[0]+2030),$point[1]);
			$vs[] = $v;
		}
		$lines = $this->mstDefense($vs);
		return $lines;
	}
	/**
	 * 
	 * Some example
	 */
	public function example2() {
		$points = array(
			array(0,50),
			array(50,0),
			array(20,20),
			array(50,50),
		);
		$vs = array();
		foreach ($points as $point) {
			$v = new Vertex(($point[0]),$point[1]);
			$vs[] = $v;
		}
		return $vs;
	}
	/**
	 * 
	 * Another example
	 */
	public function example3() {
		$points = array(
		array(0,50),
		array(50,0),
		array(50,50),
		);
		$vs = array();
		foreach ($points as $point) {
			$v = new Vertex(($point[0]),$point[1]);
			$vs[] = $v;
		}
		return $vs;
	}
	/**
	 * 
	 * Shermers counter example to Akman
	 */
	public function antiExample1() {
		$points = array(
			array(50,50),
			array(80,130),
			array(50,130),
			array(80,50),
		);
		$vs = array();
		foreach ($points as $point) {
			$v = new Vertex($point[0],$point[1]);
			$vs[] = $v;
		}
		return $vs;
	}
	/**
	 * 
	 * Counter example to shermer
	 */
	public function antiExample2() {
		$height = 2;
		$points = array(
			array(0,$height/2),
			array(8,0),
			array(16,$height/2),
			array(8,$height),
		);
		$vs = array();
		foreach ($points as $point) {
			$v = new Vertex($point[0]*8,$point[1]*8);
			$vs[] = $v;
		}
		return $vs;
	}
	/**
	 * 
	 * Connected solution for counter example to Shermer
	 */
	public function antiExample2Solution1() {
		// connected
		$points = array(
			array(0,1),
			array(8,0),
			array(16,1),
			array(8,2),
			array(13+1/3,2),
			array(2+2/3,2),
		);
		$vs = array();
		foreach ($points as $point) {
			$v = new Vertex($point[0]*8,$point[1]*8);
			$vs[] = $v;
		}
		$lines = array();
		$lines[] = new LineSegment($vs[0],$vs[5]);
		$lines[] = new LineSegment($vs[5],$vs[1]);
		$lines[] = new LineSegment($vs[4],$vs[1]);
		$lines[] = new LineSegment($vs[4],$vs[2]);
		return $lines;
	}
	/**
	 * 
	 * Interior disconnected solution to counter example to Shermer
	 */
	public function antiExample2Solution2() {
		// interior disconnected
		$points = array(
		array(0,1),
		array(8,0),
		array(16,1),
		array(8,2),
		array(13.9365,1.5328),
		array(2.0635,1.5328),
		array(8,1.5328),
		);
		$vs = array();
		foreach ($points as $point) {
			$v = new Vertex($point[0]*8,$point[1]*8);
			$vs[] = $v;
		}
		$lines = array();
		$lines[] = new LineSegment($vs[0],$vs[5]);
		$lines[] = new LineSegment($vs[5],$vs[1]);
		$lines[] = new LineSegment($vs[4],$vs[1]);
		$lines[] = new LineSegment($vs[4],$vs[2]);
		$lines[] = new LineSegment($vs[3],$vs[6]);
		return $lines;
	}
	/**
	 * 
	 * Disconnected counter example to Shermer
	 */
	public function antiExample2Solution3() {
		// disconnected
		$points = array(
		array(0,1),
		array(8,0),
		array(16,1),
		array(8,2),
		array(13.5741,1.3032),
		array(2.4259,1.3032),
		array(8,1.3032),
		);
		$vs = array();
		foreach ($points as $point) {
			$v = new Vertex($point[0]*8,$point[1]*8);
			$vs[] = $v;
		}
		$lines = array();
		$lines[] = new LineSegment($vs[0],$vs[5]);
		$lines[] = new LineSegment($vs[5],$vs[1]);
		$lines[] = new LineSegment($vs[4],$vs[1]);
		$lines[] = new LineSegment($vs[4],$vs[2]);
		$lines[] = new LineSegment($vs[3],$vs[6]);
		return $lines;
	}
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
	/**
	 * 
	 * Beam Detector that just takes an edge an applies coverRange for rest
	 * @param unknown_type $hull
	 */
	private function myDefense1(&$hull) {
		
		$count = count($hull);
		$bestSolution = null;
		$bestSolutionCost = null;
		for($j=0;$j<$count;$j++) {
			$lines = array();
			
			$l = new LineSegment( $hull[$j], $hull[($count-1+$j)%$count]);
			$lines[] = $l;
			for ($i=1;$i<$count-1;$i++) {
				/* @var $v1 Vertex */
				$v1 = $hull[($i-1+$j)%$count];
				/* @var $v2 Vertex */
				$v2 = $hull[($i+$j)%$count];
				/* @var $v3 Vertex */
				$v3= $hull[($j+$count-1)%$count];
				$l = $this->getHeightLineSegment($v1, $v3, $v2);
				
				$lines[] = $l;
			}
			$cost = $this->measureDefense($lines);
			if ($bestSolution==null || $cost < $bestSolutionCost) {
				$bestSolution = $lines;
				$bestSolutionCost = $cost;
			}
		}
		return $bestSolution;
	}
	/**
	 * 
	 * The new optimal developed algorithm
	 * @param unknown_type $hull
	 */
	function myDefense3(&$hull) {
		$solution = $this->shermanDefense($hull);
		$bestSolution = $solution;
		$bestSolutionCost = $this->measureDefense($solution);
		$points = array();
		foreach ($solution as $line) {
			if (!in_array($line->v1,$points))
				$points[] = $line->v1;
			if (!in_array($line->v2,$points))
				$points[] = $line->v2;
		}
		$criticallines = array();
		$count = count($points);
		for ($i=0;$i<$count;$i++) {
			for ($j=$i+1;$j<$count;$j++) {
				$v1 = $points[$i];
				$v2 = $points[$j];
				$line = new Line(new LineSegment($v1,$v2));
				for ($k=$j+1;$k<$count;$k++) {
					$v3 = $points[$k];
					if ($line->isPointOnLine($v3)) {
						
						$criticallines[] = $line;
					}
				}
					
			}
		}
		
		// works only with one
		foreach ($criticallines as $line) {
			$unaffectededges = array();
			$affectededges = array();
			foreach ($solution as $edge) {
				if ($line->isPointOnLine($edge->v1)) {
					$edge->v1->usable=true;
					$edge->v2->usable=false;
					$affectededges[] = $edge;
				} elseif ($line->isPointOnLine($edge->v2)) {
					$edge->v1->usable=false;
					$edge->v2->usable=true;
					$affectededges[] = $edge;
				} else {
					$unaffectededges[] = $edge;
				}
			}
			
			//$orgc = $line->c;
			$first = true;
			$delta = 0.1;
			while (true) {
				// moveup
				$line->c += $delta;
				$newedges= array();
				foreach ($affectededges as $edge) {
					$edgeline = new Line($edge);
					$tmpedge = new LineSegment($edge->v1, $edge->v2);
					if ($tmpedge->v1->usable) {
						
						$tmpedge->v1 = $edgeline->findIntersection($line);
					} else {
						$tmpedge->v2 = $edgeline->findIntersection($line);
					}
					if ($line->isPerpendicular($edgeline)) {
						$newedges[] = $tmpedge;
					} else {
						$a1 = $line->distanceToPoint($edge->v1);
						$a2 = $line->distanceToPoint($edge->v2);
						$ratio = $a1/$a2;
						
						// position of 90degree corners
						$pl1 = $line->findPerpendicularLine($edge->v1);
						$point1 = $pl1->findIntersection($line);
						$pl2 = $line->findPerpendicularLine($edge->v2);
						$point2 = $pl2->findIntersection($line);
						$vector = $point1->getVector($point2);
						
						if ($ratio>1) {
							
							$vector = $vector->multiplyScalar(1/$ratio);
							$v = $point2->add($vector->multiplyScalar(-1));
						} else {
							$vector = $vector->multiplyScalar($ratio);
							$v = $point1->add($vector);
						}
						$newedges[] = new LineSegment($edge->v1,$v);
						$newedges[] = new LineSegment($edge->v2,$v);
					}
					
				}
				$solution= array_merge($newedges,$unaffectededges);
				
				$cost = $this->measureDefense($solution);
				//return $solution;
				if ($cost < $bestSolutionCost) {
					$bestSolution = $solution;
					$bestSolutionCost = $cost;
				} elseif ($first) {
					$delta = -0.1;
					$line->c -=0.1;
				} else {
					break;
				}
				$first=false;
			}
		}
		
		return $bestSolution;
	}
	/**
	 * 
	 * Shermers algorithm
	 * @param unknown_type $hull
	 */
	function shermerDefense(&$hull) {
	
		$count = count($hull);
		$bestSolution = null;
		$bestSolutionCost = null;
		$combinations = $this->powerSet(array_keys($hull));
		
		foreach ($combinations as $c) {
			if (count($c)>1) {
				$subset = array();
				foreach ($c as $i) {
					$subset[] = $hull[$i];
				}
				if (count($c)==2) {
					$solution= array(new LineSegment($subset[0], $subset[1]));
				} else {
					$solution = $this->getFullSteinerTree($subset);
				}
				$tmp = array_reverse($c);
				for ($i=0;$i<count($tmp);$i++) {
					if ($i==0) {
						$cover = $this->coverRange($tmp[count($tmp)-1], $tmp[$i], $hull);
					} else {
						$cover = $this->coverRange($tmp[$i-1], $tmp[$i], $hull);
					}
					$solution = array_merge($solution,$cover);
				}
				$cost = $this->measureDefense($solution);
				if ($bestSolution==null || $bestSolutionCost>$cost) {
					$bestSolution = $solution;
					$bestSolutionCost = $cost;	
				}
			}
		}
		return $bestSolution;
	}
	/**
	 * 
	 * My first algorithm, which happened to be the same as Akmans
	 * @param unknown_type $hull
	 */
	function myDefense2(&$hull) {
		
		$count = count($hull);
		$bestSolution = null;
		$bestSolutionCost = null;
		for ($i=0;$i<$count;$i++) {
			for ($j=$i+1;$j<$count;$j++) {
				for ($k=$j+1;$k<$count;$k++) {
					$lines = array();
					$v1 = $hull[$i];
					$v2 = $hull[$j];
					$v3 = $hull[$k];
					$fermatPoint = $this->findFermatPoint($v1, $v2, $v3);
					if ($this->inhull($fermatPoint, $hull)) {
						$lines[] = new LineSegment($v1,$fermatPoint);
						$lines[] = new LineSegment($v2,$fermatPoint);
						$lines[] = new LineSegment($v3,$fermatPoint);
					} else {
						$v1v2 = $v1->distanceTo($v2);
						$v2v3 = $v2->distanceTo($v3);
						$v1v3 = $v1->distanceTo($v3);
						if (($v1v2+$v2v3)<($v2v3+$v1v3)) {
							if (($v1v2+$v2v3)<($v1v2+$v1v3)) {
								$lines[] = new LineSegment($v1,$v2);
								$lines[] = new LineSegment($v2,$v3);
							} else {
								$lines[] = new LineSegment($v1,$v2);
								$lines[] = new LineSegment($v1,$v3);
							}
						} else {
							if (($v2v3+$v1v3)<($v1v2+$v1v3)) {
								$lines[] = new LineSegment($v1,$v3);
								$lines[] = new LineSegment($v2,$v3);
							} else {
								$lines[] = new LineSegment($v1,$v2);
								$lines[] = new LineSegment($v1,$v3);
							}
						}
						
					}
					$lines = array_merge($this->coverRange($i, $j, $hull),$lines);
					$lines = array_merge($this->coverRange($j, $k, $hull),$lines);
					$lines = array_merge($this->coverRange($k, $i, $hull),$lines);
					$cost = $this->measureDefense($lines);
					if ($bestSolution==null || $cost < $bestSolutionCost) {
						$bestSolution = $lines;
						$bestSolutionCost = $cost;
					}
				}
			}
		}
		return $bestSolution;
	}
	/**
	 * 
	 * CoverRange, also refered to as coverHalf subroutine
	 * @param unknown_type $i
	 * @param unknown_type $j
	 * @param unknown_type $hull
	 */
	private function coverRange($i,$j,&$hull) {
		$count = count($hull);
		$lines = array();
		//if ($i-$j<2) return $lines;
	
		$left = $hull[$i];
		$right = $hull[$j];
		$bestlines = array();
		$bestlinescost = null;
		for ($k=($i+1)%$count;$k!=$j;$k=($k+1)%$count) {
			$solution = array();
			/* @var $v1 Vertex */
			/* @var $v2 Vertex */
			$c1 = $hull[$k];
			/* @var $v3 Vertex */
			//
			$l = $this->getHeightLineSegment($left, $right, $c1);
			$solution[] = $l;
			$solution =array_merge($solution,$this->coverRange($i, $k, $hull));
			
			$solution = array_merge($solution,$this->coverRange($k, $j, $hull));
			
			$cost = $this->measureDefense($solution);
			if ($bestlinescost==null || $cost < $bestlinescost) {
				$bestlinescost = $cost;
				$bestlines = $solution;
			}
			
		}
		return $bestlines;
	}
	/**
	 * 
	 * Returns power set of given set
	 * @param unknown_type $vs
	 */
	private function powerSet($vs) {
		$results = array(array());
		foreach ($vs as $j=>$e) {
			$num = count($results);
			for ($i=0;$i<$num;$i++) {
				array_push($results,
				array_merge(array($e),
				$results[$i]));
			}
		}
		return $results;
	}
	/**
	 * 
	 * Minimum Steiner Tree algorithm
	 * @param unknown_type $hull
	 */
	function smtDefense(&$hull) {
		//First generate all subsets
		$powerset = $this->powerSet(array_keys($hull));
		// Generate Full Steiner Tree on all subsets
		
		$fst = array();
		for ($i=0;$i<count($powerset);$i++) {
			$c = count($powerset[$i]);
			$vs = array();
			foreach ($powerset[$i] as $j) $vs[] = $hull[$j];
			if ($c>=3)
				$fst[$i] = $this->getFullSteinerTree($vs);
			elseif ($c==2) {
				$fst[$i] =array(new LineSegment($vs[0], $vs[1]));
				
			}
		}
		
		// Try all full combinations of full steiner tree to find minimal
		return $this->smtFindOptimalFor($hull,$powerset,$fst);
	}
	/**
	 * 
	 * Subroutine for Minimum Steiner Tree
	 * @param unknown_type $vs
	 * @param unknown_type $powerset
	 * @param unknown_type $fst
	 */
	private function smtFindOptimalFor($vs,&$powerset,&$fst) {
		$prudedpowerset = array();
		foreach ($powerset as $k=>$set) {
			if (isset($fst[$k])) {
				$prudedpowerset[] = $k;
			}
		}
		$combinations = $this->powerSet($prudedpowerset);
		
		$optimal = array();
		$optimalcost = null;
		foreach ($combinations as $c) {
			//contains all vertices
			$found = array();
			foreach ($vs as $k=>$v) $found[$k]=0;
			$numbercomponents = 0;
			foreach ($c as $sk) if (count($powerset[$sk])>1) $numbercomponents++;
			foreach ($vs as $k=>$v) {
				foreach ($c as $sk) {
					$s = $powerset[$sk];
					if (count($s) >1 && in_array($k,$s))  {
						$found[$k]++;
					}
				}
			} 
			$ok =true;
			$connections = 0;
			foreach ($found as $f) {
				if ($f>1) $connections+=$f-1;
				elseif ($f< 1) $ok = false;
			}
			if ($connections!=$numbercomponents-1) {
				$ok = false;
			}
			if ($ok) {
				$solution = array();
				foreach ($c as $sk) {
					if (count($powerset[$sk])>1) {
						// find s in powerset
						$solution = array_merge($solution,$fst[$sk]);
					}
				}
				$cost = $this->measureDefense($solution);
				if ($optimalcost==null || $cost<$optimalcost) {
					$optimal = $solution;
					$optimalcost = $cost;
				}
			}
		}
		return $optimal;
	}
	/**
	 * 
	 * Provide, if possible, full steiner tree given vertices
	 * @param unknown_type $vs
	 */
	private function getFullSteinerTree($vs) {
		$count = count($vs);
		$bestsolution = array();
		$bestsolutioncost = null;
		if ($count==3) {
			$fp = $this->findFermatPoint($vs[0], $vs[1], $vs[2]);
			for ($i=0;$i<3;$i++)
				$bestsolution[] = new LineSegment($vs[$i], $fp);
		} else {
			for ($i1=0;$i1<$count;$i1++) {
				for ($i2=$i1+1;$i2<$count;$i2++) {
					/* @var $a Vertex */
					$a = $vs[$i1];
					$b = $vs[$i2];
					if ($a->usable && $b->usable) {
						$v = $a->normal($b);
						$c =  $a->meanPoint($b);
						$c1 =$c->add($v);
						$c1->usable = false;
						for ($j=0;$j<2;$j++) {
							$solution = array();
							$reducedvs = array();
							$reducedvs[]= $c1;
							for ($i=0;$i<$count;$i++) {
								if ($i!=$i1 && $i!=$i2)
									$reducedvs[] = $vs[$i];
							}
							$solution = array_merge($this->getFullSteinerTree($reducedvs),$solution);
							/* @var $simpsonline LineSegment */
							$simpsonline = array_shift($solution);
							if ($simpsonline) {
								$steinerpoint = $simpsonline->v2;
								$fp = $this->findFermatPoint($a, $b, $steinerpoint);
								$solution[] = new LineSegment($a, $fp);
								
								$solution[] = new LineSegment($b, $fp);
								$solution[] = new LineSegment($steinerpoint, $fp);
								$c1 =$c->add($v->multiplyScalar(-1));
								$c1->usable = false;
								$cost = $this->measureDefense($solution);
								if ($bestsolutioncost == null || $cost < $bestsolutioncost) {
									$bestsolution = $solution;
									$bestsolutioncost = $cost;
								}
							}
						}
					}
				}
			}
		}
		return $bestsolution;
	}
	/**
	 * 
	 * Get the height of triangle given two points forming the base line and the last point.
	 * @param unknown_type $left
	 * @param unknown_type $right
	 * @param unknown_type $top
	 * @throws Exception
	 */
	private function getHeightLineSegment($left,$right,$top) {
		$v1=$left;
		$v2=$top;
		$v3=$right;
		$c = $v2->distanceTo($v3);
		$a = $v1->distanceTo($v3);
		$b = $v1->distanceTo($v2);
		if ($a==0 || $b==0) {
			throw new Exception ('stop');
		}
		$C = acos((pow($a,2)+pow($b,2)-pow($c,2))/(2*$a*$b));
			
			
		$h = sin($C)*$b;
		$v = new Vertex(
		$v3->y-$v1->y,
		-1*($v3->x-$v1->x)
		);
		$v = $v->normalize()->multiplyScalar($h);
		$l = new LineSegment($v2,$v2->add($v));
		
		if ($v1->distanceTo($l->v2) > $v1->distanceTo($v3) || $v3->distanceTo($l->v2) > $v1->distanceTo($v3)) {
			if ($b < $c) {
				$l = new LineSegment($v2,$v1);
			} else {
				$l = new LineSegment($v2,$v3);
			}
		}
		return $l;
	}
	/**
	 * 
	 * Build walls on the convex hull
	 * With trivial optimization of removing the longest wall
	 * @param unknown_type $hull
	 * @return multitype:\main\models\LineSegment
	 */
	private function hullAsDefense(&$hull) {
		$lines = array();
		$c = count($hull);
		// Full hull
		$longesti =0;
		$longestcost = 0;
		for ($i=0;$i<$c;$i++) {
			$l = new LineSegment($hull[$i],$hull[($i+1)%$c]);
			$lines[] = $l;
			if (($cost =$l->length()) > $longestcost) {
				$longesti = $i;
				$longestcost = $cost;
			}			
		}
		
		$this->swap($lines,0,$longesti);
		array_shift($lines);
		return $lines;
		
		
		
		return $finallines;
	}
	/**
	 * 
	 * Find Fermat point given the three vertices of a triangle
	 * @param Vertex $v1
	 * @param Vertex $v2
	 * @param Vertex $v3
	 */
	private function findFermatPoint($v1,$v2,$v3) {
		// p1
		$m = $v1->meanPoint($v2);
		$v = $v1->normal($v2);
		// normalize and extend with height, height is sin(60)*vectorlength and normalize with /vectorlength
		//$v[0]=$v[0]*sin(60);
		//$v[1]=$v[1]*sin(60);
		$p1 = $m->add($v);
		
		
		if ($this->isLeftturn($v1, $v2, $p1) == $this->isLeftturn($v1, $v2, $v3)) {
			$p1 = new Vertex($m->x+$v->x*-1,$m->y+$v->y*-1);
		}
		
		
		// p2
		$m = $v1->meanPoint($v3);
		$v = $v1->normal($v3);
		// normalize and extend with height, height is sin(60)*vectorlength and normalize with /vectorlength
		//$v[0]=$v[0]*sin(60);
		//$v[1]=$v[1]*sin(60);
		$p2 = $m->add($v);
		if ($this->isLeftturn($v1, $v3, $p2) == $this->isLeftturn($v1, $v3, $v2)) {
			$p2 = new Vertex($m->x+$v->x*-1,$m->y+$v->y*-1);
		}
		
		if ($p1->x-$v3->x==0)  {
			$x1 = $p1->x;
		} else {
			$alpha1 = ($p1->y-$v3->y)/($p1->x-$v3->x);
			$c1 = $p1->y-$alpha1*$p1->x;
		}
		
		
		if ($p2->x-$v2->x==0) {
			$x2 = $p2->x;
		} else {
			$alpha2 = ($p2->y-$v2->y)/($p2->x-$v2->x);
			$c2 = $p2->y-$alpha2*$p2->x;
		}
		if(isset($x1)) {
			$x = $x1;
			$y = $alpha2*$x+$c2;
		} elseif(isset($x2)) {
			$x = $x2;
			$y = $alpha1*$x+$c1;
		} elseif ($alpha1-$alpha2==0) {
			$y = 0;
			$x = 1;
		} else {
			$x = ($c2-$c1)/($alpha1-$alpha2);
			$y = $alpha1*$x+$c1;
		}
		return new Vertex($x,$y);
		
	}
	/**
	 * 
	 * Minimum Spanning Tree Beam Detector
	 * @param unknown_type $hull
	 */
	private function mstDefense(&$hull) {
		$edges = array();
		$verts = array();
		$i=0;
		foreach ($hull as $k1=> $v1) {
			foreach ($hull as $k2=> $v2) {
				if ($k1!=$k2) {
					$l = new LineSegment($v1,$v2);
					$cost = $l->length();
					$e = array($cost,$k1,$k2,$l);
					$edges[] = $e;
				}
			}
			$verts[$k1]=$i++;
		}
		$n = count($hull);
		$edges =$this->quicksort($edges, 0);
		$lines = array();
		$i = 0;
		foreach ($edges as $e) {
			list($cost,$v1,$v2,$line) = $e;
			if ($i < $n-1) {
				if ($verts[$v1] != $verts[$v2]) {
					if ($verts[$v1] > $verts[$v2]) {
						$m = $verts[$v2];
						$im = $verts[$v1];
					} else {
						$m = $verts[$v1];
						$im = $verts[$v2];
					}
					foreach ($verts as $k=>$v) {
						if ($v==$m) {
							$verts[$k]=$im;
						}
					}
					$lines[] =$line;
					$i++;
				}
			} else {
				break;
			}
		}
		return $lines;
	}
	/**
	 * 
	 * Measure a given set of line segments
	 * @param unknown_type $defense
	 */
	private function measureDefense(&$defense) {
		$sum =0;
		foreach ($defense as $l) {
			$sum += $l->length();
		}
		return $sum;
	}
	/**
	 * 
	 * Generate a random polygon
	 * @param unknown_type $size
	 */
	private function generatePolygon($size=4) {
		//$p = new Polygon();
		//$p->save();
		$vs = array();
		for ($i=0;$i<$size;$i++) {
			$v = new Vertex(rand(50,150),rand(50,150));
			$vs[] = $v;
		}
		return $vs;
	}
	/**
	 * 
	 * Sub routine that determines whether a vertex lies inside a hull
	 * @param unknown_type $v
	 * @param unknown_type $hull
	 * @return boolean
	 */
	private function inhull($v,&$hull) {
		$c = count($hull);
		for ($i=0;$i<$c;$i++) {
			if ($this->isLeftturn($hull[$i], $hull[($i+1)%$c],$v)) {
				return false;
			}
		}
		return true;
	}
	/**
	 * 
	 * Gives the convex hull of a set of vertices
	 * @param unknown_type $vs
	 */
	private function convexHull($vs) {
		// find lowest y
		$lowestyi = 0;
		$count = count($vs);
		for ($i=0;$i<$count;$i++) {
			if ($vs[$i]->y < $vs[$lowestyi]->y || ($vs[$i]->y==$vs[$lowestyi]->y && $vs[$i]->x < $vs[$lowestyi]->x)) {
				$lowestyi = $i;
			}
		}
		$this->swap($vs,0,$lowestyi);
		// calculate angles
		$angles = array();
		$angles[0] = array('angle'=>-1,'v'=>$vs[0]);
		for ($i=1;$i<$count;$i++) {
			$b = abs($vs[$i]->x-$vs[0]->x);
			$a = abs($vs[$i]->y-$vs[0]->y);
			$c = sqrt(pow($b,2)+pow($a,2));
			$angles[$i] = array(
				'angle' =>($vs[$i]->x < $vs[0]->x) ? -1*$b/$c : ($vs[$i]->x == $vs[0]->x ? 0 : $b/$c),
				'v' => $vs[$i],
			);
		}
		$angles = $this->quicksort($angles,'angle');
		
		for ($i=$count;$i>0;$i--) $angles[$i] = $angles[$i-1];
		$angles[0]=$angles[$count];
		
		
		$m = 2;
		for ($i=3;$i<$count+1;$i++) {
			while ($this->isLeftturn($angles[$m-1]['v'], $angles[$m]['v'] , $angles[$i]['v'])) {
				
					$m--;
			}
			$m++;
			$this->swap($angles,$m,$i);
		}
		$vs = array();
		for ($i=0;$i<$m;$i++) $vs[]= $angles[$i]['v'];
		
		return $vs;
	}
	/**
	 * 
	 * Quicksort
	 * @param unknown_type $array
	 * @param unknown_type $index
	 */
	private function quicksort($array,$index) {
	    if(count($array) < 2) return $array;
	 
	    $left = array();
	 	$right = array();
	    $pivot = array_shift($array);
	 
	    foreach($array as $v) {
	        if($v[$index] < $pivot[$index]) {
	            $left[] = $v;
	        } else {
	            $right[] = $v;
	        }
	    }
	    $array =array_merge($this->quicksort($left,$index), array($pivot), $this->quicksort($right,$index));
	 	
	    return $array;
	}
	/**
	 * 
	 * Sub routine for quicksort
	 * @param unknown_type $vs
	 * @param unknown_type $i1
	 * @param unknown_type $i2
	 */
	private function swap(&$vs,$i1,$i2) {
		if ($i1==$i2) return;
		$tmp = $vs[$i1];
		$vs[$i1]=$vs[$i2];
		$vs[$i2]=$tmp;
	}
	/**
	 * 
	 * Determines whether v1,v2,v3 is a left turn
	 * @param unknown_type $v1
	 * @param unknown_type $v2
	 * @param unknown_type $v3
	 * @throws \Exception
	 * @return boolean
	 */
	function isLeftturn($v1,$v2,$v3) {
		if (!$v1 instanceof Vertex) throw new \Exception('Input not vertex');
		return ($v2->x - $v1->x)*($v3->y - $v1->y) - ($v2->y - $v1->y)*($v3->x - $v1->x) >=0;
		//return (p2.x - p1.x)*(p3.y - p1.y) - (p2.y - p1.y)*(p3.x - p1.x)
	}
}