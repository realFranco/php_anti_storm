<?php
/**
 * http://localhost/php_anti_storm/index.php
 */
// use php_anti_storm\Connection as Connection;
require_once 'app/Connection.php';
require_once 'app/P2P_manage_tables.php';

header("Content-Type: Application/json");

try {
    // connect to the PostgreSQL database
    $pdo = Connection::get()->connect();
    
    $table_creator = new P2PCreateTable( $pdo );

    // create tables
    $table_creator->manage_tables('./db/1_create_db.sql');

    // delete tables
    // $table_creator->manage_tables('./db/drop_db.sql.no');

    // echo "ok";
    $out = array("msg" => "ok");
    echo json_encode($out);

} catch (\PDOException $e) {
    // echo $e->getMessage();
    $out = array("msg" => $e->getMessage());
    echo json_encode($out);
}

?>