<!DOCTYPE HTML> 
<html>
<head>
</head>
<body> 
<?php
if(isset($_POST["value"])) {
    $data = $_POST["value"];
    $ret = file_put_contents('c:/Users/JSEIDEL/Desktop/speak.txt', $data, LOCK_EX);
    if($ret === false) {
        die('There was an error writing this file');
    }
    else {
        echo "You said $data. I'll respond shortly";
    }
}
else {
   die('no post data to process');
}
exec("speak.bat");
?>

</body>
</html>