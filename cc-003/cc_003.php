<?php

class StockData{

    // indexes
    const CSV_INDEX_DATE = 0;
    const CSV_INDEX_OPEN = 1;
    const CSV_INDEX_HIGH = 2;
    const CSV_INDEX_LOW = 3;
    const CSV_INDEX_CLOSE = 4;
    const CSV_INDEX_VOLUME = 5;

    // fields
    public $date;
    public $open;
    public $high;
    public $low;
    public $close;
    public $volume;

    function __construct($data) {
        // set data
        $this->date = array_key_exists(self::CSV_INDEX_DATE, $data) ? $data[self::CSV_INDEX_DATE] : null;
        $this->open = array_key_exists(self::CSV_INDEX_OPEN, $data) ? $data[self::CSV_INDEX_OPEN] : null;
        $this->high = array_key_exists(self::CSV_INDEX_HIGH, $data) ? $data[self::CSV_INDEX_HIGH] : null;
        $this->low = array_key_exists(self::CSV_INDEX_LOW, $data) ? $data[self::CSV_INDEX_LOW] : null;
        $this->close = array_key_exists(self::CSV_INDEX_CLOSE, $data) ? $data[self::CSV_INDEX_CLOSE] : null;
        $this->volume = array_key_exists(self::CSV_INDEX_VOLUME, $data) ? $data[self::CSV_INDEX_VOLUME] : null;
    }

    function dailyRange(){
        return $this->high - $this->low;
    }

    function dailyRangeDetailString(){
        return "Daily range on " . $this->date . " was $" .$this->dailyRange() . " (High = $" . $this->high .", Low = $" . $this->low . ")";
    }

}

// all data
$stockData = [];

// open file
$handle = fopen(__DIR__ . "/../assets/microsoft_stock_data.csv", "r");
if ($handle) {

    // read each line
    while (($data = fgetcsv($handle)) !== FALSE) {

        // ignore header
        if(strpos(strtolower($data[StockData::CSV_INDEX_DATE]), "date") !== false){
            continue;
        }

        // process the line
        $stockData[] = new StockData($data);
    }

    // close file
    fclose($handle);
}

// sort by daily range
usort($stockData, function($a, $b) {
    return $a->dailyRange() < $b->dailyRange();
});


// print out results
foreach($stockData AS $data){
    echo $data->dailyRangeDetailString(). PHP_EOL;
}
