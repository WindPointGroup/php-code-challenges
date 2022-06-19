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
        $this->date = $data[self::CSV_INDEX_DATE];
        $this->open = $data[self::CSV_INDEX_OPEN];
        $this->high = $data[self::CSV_INDEX_HIGH];
        $this->low = $data[self::CSV_INDEX_LOW];
        $this->close = $data[self::CSV_INDEX_CLOSE];
        $this->volume = $data[self::CSV_INDEX_VOLUME];
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
