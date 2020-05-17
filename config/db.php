<pre> 
<!-- The pre tag defines preformated text -->
<?php
/**
 * Franco Gil
 * First Configuration for a database connection
 * pgsql - php
 * 
 * To open this file, go to:
 * 
 * http://localhost/php_anti_storm/config/db.php
 * 
 */
 
// define a set of named constant
define('PGHOST','localhost');
define('PGDB','php_t');
define('PGPORT','5432');
define('PGUSER','system');
define('PGPASS','system');

$br = "<br> <br>";

// ofg topic

$a = array ('a' => 'apple', 'b' => 'banana', 'c' => array ('x', 'y', 'z'));
print_r($a);
echo $br;

echo "db configuration connection$br";


$psql_conn = "host=" . PGHOST . " port=" . PGPORT . " dbname=" . PGDB;
$psql_conn = $psql_conn . " user=" . PGUSER . " password=" . PGPASS;


// Connecting
$dbconn = pg_connect($psql_conn)
    or die('Could not connect: ' . pg_last_error());


// Check connecition status
$stat = pg_connection_status($dbconn);


// return PGSQL_CONNECTION_OK | BAD
if ($stat === PGSQL_CONNECTION_OK) {
    echo 'Connection PASS';
    // die("Finish the execution here"); // the script finish here with a message
} else {
    echo 'Connection NOT PASS | You can reconnec';
}   
echo $br;


// Performing SQL query
$query = 'SELECT * FROM car';

$result = pg_query($dbconn, $query) 
    or die('Query failed: ' . pg_last_error());


// Printing results in HTML
echo "Printing results in HTML$br";
echo "<table>\n";
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>$br";


// Free resultset
pg_free_result($result);


// Closing connection
pg_close($dbconn);

?>
</pre>
