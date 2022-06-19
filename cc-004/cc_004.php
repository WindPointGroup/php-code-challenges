<?php

class StockDailyData{

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
        $this->volume = str_replace(",","", $data[self::CSV_INDEX_VOLUME]);
    }

    function getDatePart($datePart){
        return date($datePart, strtotime( $this->date ));
    }

    function getMonth(){
        return $this->getDatePart("m");
    }

}


class StockData{


    // fields
    public $symbol;
    public $stockDailyDatas;

    function __construct($symbol) {
        // set data
        $this->symbol = $symbol;
        $this->stockDailyDatas = [];
    }

    function addStockDailyData($stockDailyData){
        $this->stockDailyDatas[] = $stockDailyData;
    }

    function getAverageFieldValueForMonth($field, $month, $pretty = false, $decimals = 0){
        $values = [];
        foreach ($this->stockDailyDatas AS $stockDailyData){
            if((int)$month === (int)$stockDailyData->getMonth()){
                $values[] = $stockDailyData->$field;
            }
        }

        $value = count($values) > 0 ? array_sum($values) / count($values) : 0;
        return $pretty ? number_format($value, $decimals) : $value;
    }
}


// all data
$stockData = new StockData('MSFT');

// open file
$handle = fopen(__DIR__ . "/../assets/microsoft_stock_data.csv", "r");
if ($handle) {

    // read each line
    while (($data = fgetcsv($handle)) !== FALSE) {

        // ignore header
        if(strpos(strtolower($data[StockDailyData::CSV_INDEX_DATE]), "date") !== false){
            continue;
        }


        // process the line
        $stockData->addStockDailyData(new StockDailyData($data));
    }

    // close file
    fclose($handle);
}

// print out results
echo "Average volume for " . $stockData->symbol . " during June was " .$stockData->getAverageFieldValueForMonth('volume', 6, true). PHP_EOL;
