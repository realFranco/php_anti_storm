<?php
/**
 * Insert content into tables
 * 
 * 
 */

class P2PInsertContent {
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
     * insert a new row into the p2p_user table
     * @param type $id_user
     * @param type $name
     * @param type $document_id
     */
    public function insert_p2p_user($id_user, $name, $document_id){
        // prepare the stament for insert
        $sql = 'INSERT INTO p2p_user(id_user, name, document_id)
                VALUES(:id_user, :name, :document_id)';
        
        $stmt = $this->pdo->prepare($sql);

        // pass the vales to the stament
        $stmt->bindValue(':id_user', $id_user);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':document_id', $document_id);

        // execute the insert stament
        $stmt->execute();

        // return generated name
        $out = array("msg" => "User inserted");
        return json_encode($out);
    }

}
?>