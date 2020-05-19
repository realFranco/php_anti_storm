<?php

// namespace PostgreSQLTutorial;
/**
 * Create table in PostgreSQL from PHP demo
 */
class P2PCreateTable {

    /**
     * PDO object
     * @var \PDO
     */
    private $pdo;

    /**
     * init the object with a \PDO object
     * @param type $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Given a .sql file, execute the those staments
     */
    public function manage_tables( $_file ){
        // echo $_file;
        try{

            $sql = file_get_contents($_file);
            
            $sql_statements = explode(";", $sql);

            // execute each sql statement to create new tables
            foreach ($sql_statements as $sql) {
                $this->pdo->exec($sql);
            }
        } catch (Exception $e) {
            $out = array("msg" => $e->getMessage());
            echo json_encode($out);
            die();
        }
    }

    /**
     * return tables in the database
     */
    public function getTables() {
        $stmt = $this->pdo->query("SELECT table_name 
                                   FROM information_schema.tables 
                                   WHERE table_schema= 'public' 
                                        AND table_type='BASE TABLE'
                                   ORDER BY table_name");
        $tableList = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $tableList[] = $row['table_name'];
        }

        return $tableList;
    }
}