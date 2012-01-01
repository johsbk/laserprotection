<?php
namespace main\models;
use \templates\model\BaseModel;
use \templates\model\IdField;
use \templates\model\VarcharField;
class Polygon extends BaseModel {
	static $id;
	static $name;
	protected static function localinit() {
		self::$id = new IdField();
		self::$name = new VarcharField();
		self::addHas("Vertex");
	}
}