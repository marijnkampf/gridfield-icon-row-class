<?php
class GridFieldRowClass extends GridField {
	protected function newRowClasses($total, $index, $record) {
		$classes = array('ss-gridfield-item');

		if($index == 0) {
			$classes[] = 'first';
		}

		if($index == $total - 1) {
			$classes[] = 'last';
		}

		$classes[] = ($index % 2) ? 'even' : 'odd';

		if ($record->hasMethod("GridFieldIconColours")) {
			$alerts = array();
			if ($record->GridFieldIconColours()) foreach($record->GridFieldIconColours() as $alert) $alerts[] = $alert->Level;
			$classes = array_merge($classes, $alerts);
		}
		return $classes;
	}
}
