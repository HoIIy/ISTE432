<?php

require_once('../src/views/TemplateEngine.php');

class Station {
    private $access;
    private $fuelType;
    private $connectorType = '';
    private $vehicleSize = '';
    private $phoneNumber;
    private $latitude;
    private $longitude;
    private $street;
    private $status;
    private $group;
    private $directions = '';

    private $fuelTypes = array(
        'BD' => 'Biodiesel',
        'CNG' => 'Compressed Natural Gas',
        'E85' => 'Ethanol',
        'ELEC' => 'Electric',
        'HY' => 'Hydrogen',
        'LNG' => 'Liquefied Natural Gas',
        'LPG' => 'Liquefied Petroleum Gas'
    );

    private $vehicleSizes = array(
        'LD' => 'Light-duty',
        'MD' => 'Light to Medium-duty',
        'HD' => 'Light to Heavy-duty'
    );

    /**
     * Sets the class variables
     * 
     * @param $station - array containing station's parameters
     */
    public function __construct($station) {
        $this->access = $station['access_days_time'];
        $this->fuelType = $this->fuelTypes[$station['fuel_type_code']];

        if($station['fuel_type_code'] == 'ELEC') {
            $this->connectorType = $station['ev_connector_types'];
        }
        else if($station['fuel_type_code'] == 'CNG' || $station['fuel_type_code'] == 'LNG') {
            $this->vehicleSize = $this->vehicleSizes[$station['ng_vehicle_class']];
        }

        $this->phoneNumber = $station['station_phone'];
        $this->latitude = $station['latitude'];
        $this->longitude = $station['longitude'];
        $this->street = $station['street_address'];
        $this->status = $station['status_code'];
        $this->group = $station['groups_with_access_code'];

        if(isset($station['intersection_directions'])) {
            $this->directions = $station['intersection_directions'];
        }
    }

    /**
     * Constructs a station element for the list section
     * 
     * @return formatted html of this station
     */
    public function buildElement() {
        // Initiate template and set static vars
        $element = new Template('../src/views/stationCard.tpl');
        $element->set('street', $this->street);
        $element->set('access', $this->access);
        $element->set('fuel', $this->fuelType);
        $element->set('group', $this->group);
        $element->set('phone', $this->phoneNumber);
        $element->set('lat', $this->latitude);
        $element->set('long', $this->longitude);

        // Determine fueling information
        if($this->connectorType != '') {
            $element->set('types', $this->buildConnectorList());
        }
        else if($this->vehicleSize != '') {
            $element->set('types', $this->vehicleSize)
        }
        else {
            $element->set('types', '');
        }

        // Set the directions
        if($this->directions == '') {
            $element->set('directions', 'N/A');
        }
        else {
            $element->set('directions', $this->directions);
        }

        return $element->output();
    }

    /**
     * Builds a list of electric connectors
     * 
     * @return html markup for the list of connectors
     */
    private function buildConnectorList() {
        $html = '<li><h5>Connector Types</h5></li>';
        foreach ($this->connectorType as $connector) {
            $html .= '<li>'.$connector.'</li>';
        }

        return $html;
    }
}