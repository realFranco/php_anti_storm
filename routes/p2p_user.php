<?php

// http://localhost/php_anti_storm/routes/p2p_user.php
/*
$out = array("name" => "f");
$out = array("req" => $_REQUEST);

echo json_encode($out);*/
require_once __DIR__.'/../app/Connection.php';
require_once __DIR__.'/../app/P2P_insertion.php';
require_once __DIR__.'/../app/P2P_user_query.php';

header("Content-Type: Application/json");


$pdo = Connection::get()->connect();

/**
 * Given params. incoming from a POST Request,
 * create new user into the database.
 * 
 * This function return the object inserted, in case
 * of succes or an error object in case of failure.
 * @param type $pdo
 */
function create_user( $pdo ){

    if( htmlspecialchars($_POST["name"]) != null && 
        htmlspecialchars($_POST["document_id"]) != null ){

        $id_user = uniqid("49c898d8-8957-40c2-8f3f-", false);
        $id_user = substr($id_user, 0, -1);
        
        $row = array(
            "id_user"       => $id_user,
            "name"          => htmlspecialchars($_POST["name"]),
            "document_id"   => htmlspecialchars($_POST["document_id"])
        );
        // echo json_encode($out);
        $p2p_insert = new P2PInsertContent( $pdo );
        $out = $p2p_insert->insert_p2p_user( $row );
        
        $code = $out["status"] == "ok" ? 200 : 400;
        http_response_code( $code );
        echo json_encode( $out );
    }else{
        http_response_code( 404 );
        echo json_encode( array(
            'status' => 'bad',
            'msg.' => 'params. from the request are not the corrects to proceed'
        ) );
    }
}

/**
 * Given params from a GET request, make a query to
 * the "p2p_user" table. 
 * 
 * This function return the row query, in case
 * of succes or an error object in case of failure.
 * 
 * @param name $pdo
 */
function filter_user( $pdo ){
    
    if( htmlspecialchars( $_GET["document_id"] != null ) ){

        $query = [
            // "name" => htmlspecialchars( $_GET["name"] ),
            "document_id" => htmlspecialchars( $_GET["document_id"] )
        ];
        // echo $query["document_id"];

        $p2p_query = new P2PQueryContent( $pdo );
        $out = $p2p_query->find_by_document_id( $query["document_id"] );

        $code = 400;
        if( $out == False ){
            $out = [
                'status' => 'bad',
                'code' => 'nil',
                'message' => 'content searched by document_id not found'];
            $code = 400;
        }
        
        http_response_code( $code );
        echo json_encode( $out );
    }else{
        http_response_code( 404 );
        echo json_encode( array(
            'status' => 'bad',
            'code' => 'nil',
            'message' => 'params. from the request are not the corrects to proceed'
        ) );
    }   
}

/**
 * Given the type of the Request, trigger/call the correct function.
 * 
 * @param type $REQ
 * @param type $pdo
 */
function p2p_user_router( $REQ, $pdo ){
    switch( $REQ ){
        case "GET":
            filter_user( $pdo );
            break;

        case "POST":
            create_user( $pdo );
            break;

        case "DELETE":
            http_response_code(405);
            echo json_encode( array("status" => "bad") );
            break;
        
        default:
            http_response_code(404);
            echo json_encode(
                array("status" => "request type not allowed") );
    }
}

// Calling the router
p2p_user_router( $_SERVER['REQUEST_METHOD'], $pdo );

?>
