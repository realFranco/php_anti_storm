<?php

/**
 * Dev: f97gp1@gmail.com
 * Date: May 23th, 2020
 * 
 * Router for the endpoint "/p2p_user.php"
 */

require_once __DIR__.'/../app/Connection.php';
require_once __DIR__.'/../model/P2P_user.php';

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
function create( $pdo ){

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
        $p2p_insert = new P2P_user( $pdo );
        $out = $p2p_insert->insert_p2p_user( $row );
        
        $code = $out["status"] == "ok" ? 200 : 400;
        http_response_code( $code );
        echo json_encode( $out );
    }else{
        http_response_code( 404 );
        echo json_encode( array(
            'status' => 'bad',
            'msg.' => 'empty body, incorect request'
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
function filter( $pdo ){
    
    if( htmlspecialchars( $_GET["document_id"] != null ) ){

        $query = [
            // "name" => htmlspecialchars( $_GET["name"] ),
            "document_id" => htmlspecialchars( $_GET["document_id"] )
        ];
        // echo $query["document_id"];

        $p2p_query = new P2P_user( $pdo );
        $out = $p2p_query->find_by_document_id( $query["document_id"] );

        $code = 200;
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
 * Delete a row from the table "p2p_user" if the "document_id"
 * is present in the query, if not, all rows will be deleted.
 * 
 */
function delete( $pdo){
    $code = 200;
    $document_id = $_REQUEST['document_id'];
    $p2p_user_delete = new P2P_user( $pdo );

    $out = $p2p_user_delete->p2p_user_delete( $document_id );

    if( $out == False ){
        $out = [
            'status' => 'bad',
            'code' => 'nil',
            'message' => 'content searched by document_id not found'];
        $code = 400;
    }
    
    http_response_code( $code );
    echo json_encode( $out );
    // echo $document_id;
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
            filter( $pdo );
            break;

        case "POST":
            create( $pdo );
            break;

        case "DELETE":
            delete( $pdo );
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
