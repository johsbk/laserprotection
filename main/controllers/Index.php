<?php
namespace main\controllers;

use main\models\Line;

use templates\sort\Sort;

use main\models\Polygon;
use main\models\Vertex;
use templates\mvc\Template;

use templates\mvc\Registry;

use templates\mvc\BaseController;


class Index extends BaseController {
	static $urls = array(
		'main.Index',
		array('^$','index'),
	);
	function index($args) {
		$c = array();
		$vs = $this->generatePolygon();
		$c['vs'] = $vs;
		$hull = $this->convexHull($vs);
		$c['ch'] = $hull;	
		
		$c['testpts'] = $this->generateTestpoints($hull);
		$hulldefense = $this->hullAsDefense($hull);
		echo "Hull cost: ".$this->measureDefense($hulldefense)."<br />";
		
		$mstdefense = $this->mstDefense($vs);
		echo "MST cost: ".$this->measureDefense($mstdefense)."<br />";
		
		
		$myd1 = $this->myDefense1($hull);
		echo "MyD1 cost: ".$this->measureDefense($myd1)."<br />";
		
		$c['defense'] = $hulldefense;
		
		$t = Registry::getInstance()->twig->loadTemplate('main\index.tpl');
		$t->display($c);
	}
	private function myDefense1(&$hull) {
		$lines = array();
		$count = count($hull);
		$l = new Line( $hull[0], $hull[$count-1]);
		$lines[] = $l;
		for ($i=1;$i<$count-1;$i++) {
			/* @var $v1 Vertex */
			$v1 = $hull[$i-1];
			/* @var $v2 Vertex */
			$v2 = $hull[$i];
			/* @var $v3 Vertex */
			$v3= $hull[$count-1];
			// 
			$c = $v2->distanceTo($v3);
			$a = $v1->distanceTo($v3);
			$b = $v1->distanceTo($v2);
			$C = acos((pow($a,2)+pow($b,2)-pow($c,2))/(2*$a*$b));
			
			
			$h = sin($C)*$b;			
			$v = new Vertex(
				$v3->y-$v1->y,
				-1*($v3->x-$v1->x)
			);
			$v = $v->normalize()->multiplyScalar($h);
			$l = new Line($v2,$v2->add($v));
			$a1 = $l->v2->distanceTo($v3);
			$a2 = $l->v2->distanceTo($v1);
			if ($a!=$a1+$a2 ) {
				if ($v2->distanceTo($v1) < $v2->distanceTo($v3)) {
					$l = new Line($v2,$v1);
				} else {
					$l = new Line($v2,$v1);
				}
			}
			
			$lines[] = $l;
		}
		return $lines;
	}
	/**
	 * 
	 * Build walls on the convex hull
	 * With trivial optimization of removing the longest wall
	 * @param unknown_type $hull
	 * @return multitype:\main\models\Line
	 */
	private function hullAsDefense(&$hull) {
		$lines = array();
		$c = count($hull);
		// Full hull
		$longesti =0;
		$longestcost = 0;
		for ($i=0;$i<$c;$i++) {
			$l = new Line($hull[$i],$hull[($i+1)%$c]);
			$lines[] = $l;
			if (($cost =$l->length()) > $longestcost) {
				$longesti = $i;
				$longestcost = $cost;
			}			
		}
		
		$this->swap($lines,0,$longesti);
		array_shift($lines);
		return $lines;
		
		// TODO: make following optimization work
		$finallines = array();
		// optimize with steiner points
		for ($i=0;$i<$c-1;$i++) {		
			$nexti = $i+1;	
			if ($i!=$longesti && $nexti !=$longesti) {
				$v1 = $lines[$i]->v1;
				$v2 = $lines[$i]->v2;
				$v3 = $lines[$nexti]->v2;
				$fp = $this->findFermatPoint($v1, $v2, $v3);
				if (($fp->distanceTo($v1)+$fp->distanceTo($v2)+$fp->distanceTo($v3)) < ($lines[$i]->length()+$lines[$nexti]->length())) {
					$l = new Line($fp,$v1);
					$finallines[] = $l;
					$l = new Line($fp,$v2);
					$finallines[] = $l;
					$l = new Line($fp,$v3);
				} else {
					$finallines[] = $lines[$i];
					$finallines[] = $lines[$nexti];
				}
				$i++;
			}
		}
		return $finallines;
	}
	/**
	 * 
	 * Enter description here ...
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
		$alpha1 = ($p1->y-$v3->y)/($p1->x-$v3->x);
		$c1 = $p1->y-$alpha1*$p1->x;
		
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
		$alpha2 = ($p2->y-$v2->y)/($p2->x-$v2->x);
		$c2 = $p2->y-$alpha2*$p2->x;
		$x = ($c2-$c1)/($alpha1-$alpha2);
		$y = $alpha1*$x+$c1;
		return new Vertex($x,$y);
		
	}
	private function mstDefense(&$hull) {
		$edges = array();
		$verts = array();
		$i=0;
		foreach ($hull as $k1=> $v1) {
			foreach ($hull as $k2=> $v2) {
				if ($k1!=$k2) {
					$l = new Line($v1,$v2);
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
	private function measureDefense(&$defense) {
		$sum =0;
		foreach ($defense as $l) {
			$sum += $l->length();
		}
		return $sum;
	}
	private function generatePolygon() {
		//$p = new Polygon();
		//$p->save();
		$vs = array();
		for ($i=0;$i<10;$i++) {
			$v = new Vertex(rand(50,150),rand(50,150));
			$vs[] = $v;
		}
		return $vs;
	}
	private function generateTestpoints(&$hull) {
		$testpts = array();
		for ($i=0;$i<100;$i++) {
			$v = new Vertex(rand(0,200),rand(0,200));
			if (!$this->inhull($v,$hull)) {
				$testpts[] = $v;
			}
		}
		return $testpts;
	}
	private function inhull($v,&$hull) {
		$c = count($hull);
		for ($i=0;$i<$c;$i++) {
			if ($this->isLeftturn($hull[$i], $hull[($i+1)%$c],$v)) {
				return false;
			}
		}
		return true;
	}
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
	private function swap(&$vs,$i1,$i2) {
		if ($i1==$i2) return;
		$tmp = $vs[$i1];
		$vs[$i1]=$vs[$i2];
		$vs[$i2]=$tmp;
	}
	function isLeftturn($v1,$v2,$v3) {
		if (!$v1 instanceof Vertex) throw new \Exception('Input not vertex');
		return ($v2->x - $v1->x)*($v3->y - $v1->y) - ($v2->y - $v1->y)*($v3->x - $v1->x) >=0;
		//return (p2.x - p1.x)*(p3.y - p1.y) - (p2.y - p1.y)*(p3.x - p1.x)
	}
}