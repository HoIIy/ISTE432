<?php

require_once('../src/models/Stations.Model.php');

function buildStationList($stations) {
    $html = '';

    foreach ($stations as $value) {
        $station = new Station($value);

        $html .= $station->buildElement();
    }

    return $html;
}