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

header("Content-Type: Application/json");
$br = "<br> <br>";

function connection_type_one()
{
    $psql_conn = "host=" . PGHOST . " port=" . PGPORT . " dbname=" . PGDB;
    $psql_conn = $psql_conn . " user=" . PGUSER . " password=" . PGPASS;


    // Connecting
    $dbconn = pg_connect($psql_conn)
        or die('Could not connect: ' . pg_last_error());


    // Check connection status
    // $stat = pg_connection_status($dbconn);
    // return PGSQL_CONNECTION_OK | BAD


    // Performing SQL query
    $query = 'SELECT * FROM car';

    $result = pg_query($dbconn, $query) 
        or die('Query failed: ' . pg_last_error());

    $all = pg_fetch_all($result);
    $output = json_encode($all);


    // Free resultset
    pg_free_result($result);

    // Closing connection
    pg_close($dbconn);

    echo $output;
}

function connection_type_two()
{
    $output = array("msg" => "");
    // try another wat to connect
    try {
        // postgresql://localhost:5432/sa_cms_db
        // $db = new PDO("postgresql:host=$PGHOST;dbname=$PGDB", $PGUSER, $PGPASS);
        $db = new PDO("psql://$PGHOST:$PGPORT/$PGDB", $PGUSER, $PGPASS);
        echo "<h2>TODO</h2><ol>";
        foreach($db->query("SELECT model FROM $table") as $row) {
            echo "<li>" . $row['model'] . "</li>";
        }
        echo "</ol>";
        $output["msg"] = "ok";
    } catch (PDOException $e) {
        $output["msg"] = "Error!: " . $e->getMessage() . "<br/>";
        echo json_encode($output);
    }
}

// superglobal variable
$type = htmlspecialchars($_GET["conn"]);

switch ($type) {
    case "1":
        connection_type_one(); // ?conn=1
        break;
    case "2":
        connection_type_two();
        break;
}

