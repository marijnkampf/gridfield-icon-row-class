GridField Icon and Row Class
=================
Adds icons and CSS row classes to DataObjects displayed in GridFields. Enables styling of rows depending on conditions. Example at bottom of README.md uses different colours for rows.

## Maintainer Contact
* Marijn Kampf ([Exadium](https://github.com/marijnkampf/GridField-Icon-Row-Class))

## Requirements
* SilverStripe CMS 3.1.x
or 
* SilverStripe CMS 3.2.x

## Installation
* composer require "exadium/gridfield-icon-row-class": "dev-master"

## Notes
I have added a pull request https://github.com/silverstripe/silverstripe-framework/pull/4711 to GridField.php, but until it's accepted you need to add a line to enable styling of rows. Adding icons works without any changes to core files.

Add line:
````
		$this->owner->extend('getRowClasses', $classes, $total, $index, $record);
````
to framework/form/gridfield/GridField.php
````
	/**
	 * @param int $total
	 * @param int $index
	 * @param DataObject $record
	 *
	 * @return array
	 */
	protected function newRowClasses($total, $index, $record) {
		$classes = array('ss-gridfield-item');

		if($index == 0) {
			$classes[] = 'first';
		}

		if($index == $total - 1) {
			$classes[] = 'last';
		}

		if($index % 2) {
			$classes[] = 'even';
		} else {
			$classes[] = 'odd';
		}
		
		// Add line here:
		$this->owner->extend('getRowClasses', $classes, $total, $index, $record);

		return $classes;
	}
````

## Usage
The example below adds icons for Members in the Administrators and Content Authors groups in the Security page of the default SilverStripe CMS installation. It also adds colour (using CSS class) to Member rows depending on their group. Note that the order of the CSS declarations ensures that high priority colours are shown even when multiple groups are assigned.

mysite\_config\config.yml
````
Member:
  extensions:
    - CustomMember
    - DataObjectIconRowClassExtension
````

mysite\code\CustomMembers.php
````
<?php

class CustomMember extends DataExtension {
	function __construct() {
		$self = $this;
    parent::__construct();
Requirements::customCSS(<<<CSS
	table.ss-gridfield-table tr.blue.odd { background-color: #D9EDF7; }
	table.ss-gridfield-table tr.blue.even { background-color: #BCE8F1; }
	table.ss-gridfield-table tr.amber.odd { background-color: #FAEBCC; }
	table.ss-gridfield-table tr.amber.even { background-color: #FCF8E3; }
	table.ss-gridfield-table tr.red.odd { background-color: #F2DEDE; }
	table.ss-gridfield-table tr.red.even { background-color: #EBCCD1; }
	.menu-icon { padding: 0 0.25rem; }
	.col-GridFieldIconRowClass { text-align: center; }
CSS
);
	}

	public function GridFieldIconRowClasses() {
		if ($this->owner->inGroup("administrators")) $this->owner->addGridFieldIconRowClass("user-plus", "Administrator", "red");
		if ($this->owner->inGroup("content-authors")) $this->owner->addGridFieldIconRowClass("pencil-square-o", "Content author", "amber");
		return $this->owner->gridFieldIconColour;
	}
}
````