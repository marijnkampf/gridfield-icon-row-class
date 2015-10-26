<?php
class GridFieldIconRowClass extends DataObject {
	public function requireTable(){
		DB::dontRequireTable($this->class);
	}

	private static $db = array(
		'Icon' => 'Varchar(255)',
		'Title' => 'Varchar(255)',
		'Class' => 'Varchar(255)'
	);
}

