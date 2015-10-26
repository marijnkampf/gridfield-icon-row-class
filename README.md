GridField Icon and Row Class
=================
Adds icons and CSS row classes to DataObjects displayed in GridFields.

## Maintainer Contact
* Marijn Kampf ([Exadium](https://github.com/marijnkampf/GridField-Icon-Row-Class))

## Requirements
* SilverStripe CMS 3.1.x
or 
* SilverStripe CMS 3.2.x

## Notes
* Adding row classes only works if you replace GridField call with GridFieldRowClass calls, currently untested as I copied this from an existing project.

## Installation

* composer require "exadium/gridfield-icon-row-class": "dev-master"

## Usage
The example below adds icons for Members in the Administrators and Content Authors groups in the Security page of the default SilverStripe CMS installation.

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
	public function GridFieldIconRowClasses() {
		if ($this->owner->inGroup("administrators")) $this->owner->addGridFieldIconRowClass("user-plus", "Administrator");
		if ($this->owner->inGroup("content-authors")) $this->owner->addGridFieldIconRowClass("pencil-square-o", "Content author");
		return $this->owner->gridFieldIconColour;
	}
}
````