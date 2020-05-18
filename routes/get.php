
<?php

// http://localhost/php_anti_storm/db/get.php
header("Content-Type: Application/json");

$a = array("name" => "f");
$j = json_encode($a);

echo json_encode($a);
?>
