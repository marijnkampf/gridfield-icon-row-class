<?php

class GridFieldRowClass extends DataExtension
{
    public function updateNewRowClasses(&$classes, &$total, &$index, &$record)
    {
        if ($record->hasMethod("GridFieldIconRowClasses")) {
            $alerts = array();
            if ($record->GridFieldIconRowClasses()) {
                foreach ($record->GridFieldIconRowClasses() as $alert) {
                    $classes[] = $alert->Class;
                }
            }
        }
    }
}
