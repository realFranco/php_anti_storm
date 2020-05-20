<?php
/**
 * Router for p2p_user table
 * 
 * Filename: routes/p2p_user.php
 */

require_once 'app/P2P_insertion.php';
require_once 'app/P2P_manage_table.php';


$pdo = Connection::get()->connect();
$uuid = uniqid();

$p2p_user = new P2PInsertContent( $pdo );

$p2p_user->insert_p2p_user($uuid,)


?>