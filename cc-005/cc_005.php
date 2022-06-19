<?php

function getPostParamSafely($key, $default = null){
    return isset($_POST[$key]) ? $_POST[$key] : $default;
}

// url params
$file_name = getPostParamSafely('file_name');
$file_contents = getPostParamSafely('file_contents');

// if params
if(!empty($file_name) && !empty($file_contents)){

    // create temp file
    $temp = tempnam('/tmp', 'txt');
    $handle = fopen($temp, 'w');

    // write content
    fwrite($handle, $file_contents);

    // export file
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.$file_name.'.txt"');
    readfile($temp);

    // close
    fclose($handle);
    unlink($temp);
    exit;

}

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

<form method="POST">
    <label class="form-element">File Name</label>
    <input class="form-element mb-25" type="text" name="file_name" id="file_name" value="<?php echo $file_name; ?>"/>

    <label class="form-element">Hours</label>
    <textarea class="form-element mb-25" name="file_contents" id="file_contents" rows="8"><?php echo $file_contents; ?></textarea>

    <button class="form-element">Create File</button>

</form>

</body>
</html>
