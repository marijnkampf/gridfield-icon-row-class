<?php

class GridFieldRowClass extends DataExtension {
	public function getRowClasses(&$classes, &$total, &$index, &$record) {
		if ($record->hasMethod("GridFieldIconRowClasses")) {
			$alerts = array();
			if ($record->GridFieldIconRowClasses()) foreach($record->GridFieldIconRowClasses() as $alert) $classes[] = $alert->Class;
		}
//Debug::Show(print_r($classes, true));
	}
}
