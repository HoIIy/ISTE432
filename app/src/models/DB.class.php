<?php

/**
 * Data layer for the Alternafuel Alternative Fuel Station Locator.
 *
 * Connects to the PostgreSQL database "Alternafuel" in the schema "AF" as the user "afadmin".
 */
class DB {
    private $dbh;
	private $stmt;

	/**
	    Connects to a database.
   	 **/
    function __construct() {
        try {
		    $dbPass = hash('sha256', "Dave");
            $this->dbh = pg_connect("host=localhost dbname=alternafuel user=afadmin password=".$dbPass);
        }
        catch(Exception $e) {
		    die("Error in connection: " . pg_last_error());
        }
    }
	
	public function getData($table, $cols="*") {
		
	}

	public function getDataWhere($table, $cols, $searchCols, $searchVals) {
		$searchLine = "";
		for ($i=0; $i<count($searchCols); $i++) {
			if ($i > 0) {
				// second parameter, and onwards...
				$searchLine .= " AND ".$searchCols[$i]."=$".($i+1);
			}
			else {
				// first (and maybe only ) param
				$searchLine .= $searchCols[$i]."=$".($i+1);
			}
		}
		$SQL = "SELECT $cols FROM af.".$table." WHERE $searchLine";
        $preparedStmt = pg_prepare($this->dbh, "getDataWhere", $SQL);
		
		$params = array();
		for ($j=0; $j<count($searchCols); $j++) {
			$params[] = $searchVals[$j];
		}
		
		$foundData = pg_execute($this->dbh, "getDataWhere", $params);
		
		if ($foundData != false && pg_num_rows($foundData) > 0) {
			$finalData = array();
			while($foundDataRow = pg_fetch_array($foundData)) {
				$finalData[] = $foundDataRow;
			}
		    return $finalData;
		}
		return array("error"=>"Error getting data.");
	}
	
    public function updateDataWhere($table, $colsToUpdate, $valsToUpdate, $searchCols, $searchVals){

	}
	
	public function insertInto($table, $cols, $vals){
	
	}
	
	public function deleteDataWhere($table, $searchCols, $searchVals) {

	}
	
	public function test(){
		return "test";
	}

} // DB class

?>
