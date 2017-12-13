<?php

require_once('../models/Stations.Model.php');

/**
 * Constructs a JSON list of the station elements
 * 
 * @param $stations - Array of stations
 * @return the json list of station elements
 */
function buildStationList($stations) {
    $html = '';

    foreach ($stations as $value) {
        $station = new Station($value);

        $html .= $station->buildElement();
    }

    return $html;
}