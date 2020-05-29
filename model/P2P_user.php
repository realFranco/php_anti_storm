<?php

/**
 * Dev: f97gp1@gmail.com
 * Date: May 24th, 2020
 * 
 * Model from the table "p2p_user"
 * 
 * This class will manage the queries related with the
 * table described abcve.
 */

class P2P_user{

    /**
     * PDO object
     * @var \PDO
     */
    private $pdo;

    /**
     * Attributes from the table
     * @var \UUID
     * @var \STRING
     * @var \STRING
     */
    private $id_user;
    private $name;
    private $document_id;

    /**
     * init the object with a PDO object
     * @param type $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Query row from table "p2p_user" using the document_id
     * 
     * @param type $document_id
     */
    public function find_by_document_id( $document_id ){

        // prepare SELECT statement
        $stmt = $this->pdo->prepare(
            'SELECT id_user, name, document_id
            FROM p2p_user
            WHERE document_id = :document_id');

        $stmt->bindValue(':document_id', $document_id);

        $stmt->execute();

        return $stmt->fetchObject();
    }


     /**
     * insert a new row into the p2p_user table.
     * 
     * @param type $id_user
     * @param type $name
     * @param type $document_id
     * @return Array
     */
    public function insert_p2p_user( $row ){
        $out = null;
        try{
            // prepare the stament for insert
            $sql = 'INSERT INTO p2p_user(id_user, name, document_id)
                    VALUES(:id_user, :name, :document_id)';
            
            $stmt = $this->pdo->prepare( $sql );
        
            // pass the vales to the stament
            $stmt->bindValue(':id_user',        $row["id_user"]);
            $stmt->bindValue(':name',           $row["name"]);
            $stmt->bindValue(':document_id',    $row["document_id"]);
        
            // execute the insert stament
            $stmt->execute();
        
            // return generated name
            $out = array(
                'status' => 'ok',
                'msg' => 'user inserted',
                
            );
            
        }catch (\PDOException $e) {
            $out = array(
                'status' => 'bad',
                'msg' => $e->getMessage()
            );
        }

        return $out;
    }


    public function p2p_user_delete( $document_id ){

        if( $document_id == null ){
            // Delete all rows from the table "p2p_user"
            
            $stmt = $this->pdo->prepare('DELETE FROM p2p_user');
        }
        else{
            // document_id exist, delete that row
            $stmt = $this->pdo->prepare(
                'DELETE FROM p2p_user
                WHERE document_id = :document_id');

            $stmt->bindValue(':document_id', $document_id);
        }

        $stmt->execute();    
        return [
            'status' => 'ok',
            'msg.' => 'element(s) deleted'
        ];
    }
}

?>