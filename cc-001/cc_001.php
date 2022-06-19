<?php

class NeighborhoodPlantData{

    // indexes
    const CSV_INDEX_YEAR = 0;
    const CSV_INDEX_MONTH = 1;
    const CSV_INDEX_NEIGHBORHOOD = 2;
    const CSV_INDEX_NEW_TREES = 3;
    const CSV_INDEX_NEW_FLOWERBEDS = 4;

    // fields
    public $year;
    public $month;
    public $neighborhood;
    public $new_trees_planted;
    public $new_flowerbeds_planted;

    function __construct($csv_string) {
        // validate has commas
        if(strpos($csv_string, ",") !== false){
            $dataParts = explode(",", $csv_string);

            // set data
            $this->year = (int)$dataParts[self::CSV_INDEX_YEAR];
            $this->month = (int)$dataParts[self::CSV_INDEX_MONTH];
            $this->neighborhood = $dataParts[self::CSV_INDEX_NEIGHBORHOOD];
            $this->new_trees_planted = (int)$dataParts[self::CSV_INDEX_NEW_TREES];
            $this->new_flowerbeds_planted = (int)$dataParts[self::CSV_INDEX_NEW_FLOWERBEDS];
        }
    }

    function isValidYear(){
        return (int)$this->year > 0;
    }

}

// all data
$plantData = [];

// open file
$handle = fopen(__DIR__ . "/../assets/trees_planted.csv", "r");
if ($handle) {

    // read each line
    while (($line = fgets($handle)) !== false) {

        // process the line
        $neighborhoodPlantData = new NeighborhoodPlantData($line);

        // if valid year, then add to array
        if($neighborhoodPlantData->isValidYear()){
            if(!isset($plantData[$neighborhoodPlantData->neighborhood])){
                $plantData[$neighborhoodPlantData->neighborhood] = 0;
            }
            $plantData[$neighborhoodPlantData->neighborhood] += $neighborhoodPlantData->new_trees_planted;
        }

    }

    // close file
    fclose($handle);
}

// sort neighborhoods
ksort($plantData);

// print out results
foreach($plantData AS $neighborhood => $tree_planted_count){
    echo $neighborhood . ": " . $tree_planted_count . PHP_EOL;
}
