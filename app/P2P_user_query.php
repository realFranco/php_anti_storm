<?php
/**
 * Dev: f97gp1@gmail.com
 * Date: May 23th, 2020
 * 
 * Query content into the "p2p_user" table.
 * 
 */

class P2PQueryContent {
    /**
     * PDO object
     * @var \PDO
     */
    private $pdo;


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
}

 ?>