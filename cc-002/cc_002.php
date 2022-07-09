<?php


class WageEntry{

    // fields
    public $hourly_wage = 0;
    public $hours = 0;

    function __construct($hourly_wage, $hours) {
        // set data
        $this->hourly_wage = $hourly_wage;
        $this->hours = $hours;
    }

    function totalWage(){
        return round($this->hourly_wage*$this->hours, 2);
    }
}

function getUrlParamSafely($key, $default = null){
    return isset($_GET[$key]) ? $_GET[$key] : $default;
}

// url params
$hourly_wage = getUrlParamSafely('hourly_wage', 0);
$hours = getUrlParamSafely('hours', 0);

// get wage entry
$wageEntry = new WageEntry($hourly_wage, $hours);

?>

<!DOCTYPE html>
<html>
<head>
    <style>
        .form-element{
            display: block
        }
        .mb-25{
            margin-bottom: 25px;
        }
    </style>
</head>
<body>

<form>
    <label class="form-element">Hourly Wage</label>
    <input class="form-element mb-25" type="number" name="hourly_wage" id="hourly_wage" step="0.01" value="<?php echo $wageEntry->hourly_wage; ?>"/>

    <label class="form-element">Hours</label>
    <input class="form-element mb-25" type="number" name="hours" id="hours" step="0.01"  value="<?php echo $wageEntry->hours; ?>"/>

    <button class="form-element mb-25">Calculate</button>


    <label class="form-element">Total Wage</label>
    <input class="form-element" type="number" value="<?php echo $wageEntry->totalWage(); ?>"/>
</form>

</body>
</html>
