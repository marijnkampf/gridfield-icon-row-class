<?php
class DataObjectIconRowClassExtension extends DataExtension {
	protected $GridFieldIconRowClasses = null;

	function __construct() {
		$self = $this;
    parent::__construct();
		Requirements::css("https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css");
	}

	public function updateSummaryFields(&$fields) {
		$fields = array('GridFieldIconRowClass' => '') + $fields;
	}

	public function GridFieldIconRowClass() {
		$this->owner->GridFieldIconRowClasses();
		return $this->owner->IconsHTML();
	}

	public function GridFieldIconRowClasses() {
		if (!is_null($this->owner->GridFieldIconRowClasses)) return $this->owner->GridFieldIconRowClasses;
		$this->owner->GridFieldIconRowClasses = $this->owner->initGridFieldIconRowClass();
		$this->owner->extend('GridFieldIconRowClasses', $this->owner->GridFieldIconRowClasses);
	}

	public function addGridFieldIconRowClass($icon, $title = null, $class = null) {
		$this->owner->GridFieldIconRowClasses->add(GridFieldIconRowClass::create(array("Icon" => $icon, "Title" => $title, "Class" => $class)));
		return $this->owner->GridFieldIconRowClasses;
	}

	public function GridFieldIcons() {
		return $this->owner->gridFieldIcons;
	}

	public function IconsHTML() {
		$obj= HTMLText::create();
		$html = "";
		if ($this->owner->GridFieldIconRowClasses()) foreach($this->owner->GridFieldIconRowClasses() as $icon) {
			$html .= (new ArrayData(array('Icon' => $icon)))->renderWith('GridFieldIcon');
	 	}
	 	$obj->setValue($html);
		return $obj;
	}

	public function initGridFieldIconRowClass() {
		$this->owner->GridFieldIconRowClasses = new ArrayList();
		if (Session::get("GridFieldIconRowClasses")) {
			$alerts = Session::get("GridFieldIconRowClasses");
			Session::clear("GridFieldIconRowClasses");
			foreach($alerts as $alert) {
				$this->owner->GridFieldIconRowClasses->add(GridFieldIconRowClass::create(array("Icon" => $icon, "Title" => $title, "Class" => $class)));
			}
		}
		return $this->owner->GridFieldIconRowClasses;
	}

	public function setGridFieldIconRowClassesessionMessage($GridFieldIconRowClass) {
		if (!isset($this->owner->GridFieldIconRowClasses)) $this->owner->GridFieldIconRowClasses = new ArrayList();
		$this->owner->GridFieldIconRowClasses->add($GridFieldIconRowClass);
		Session::set("GridFieldIconRowClasses", $this->owner->GridFieldIconRowClasses);
		return $this->owner->GridFieldIconRowClasses;
	}
}
