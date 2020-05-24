<?php
/**
 * Dev: f97gp1@gmail.com
 * Date: May 23th, 2020
 * Insert row(s) into the "p2p_user" table.
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
}

?>