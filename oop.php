<?php
/**
 * Dev: f97gp1@gmail.com
 * Date May 6th, 2020
 * Filename: oop.php
 * 
 * Description: Customer class, client class
 *  */ 

class Customer{
    private $name = '';
    private $last_name = '';
    private $id_customer = '';
    private $nation_id = '';

    function __construct($name, $last_name, $id_custom, $nation_id){
        $this->name = $name;
        $this->last_name = $last_name;
        $this->id_custom = $id_custom;
        $this->nation_id = $nation_id;
    }

    public function get_full_name(){
        return $this->name.", ".$this->last_name;
    }

    public function get_id_customer(){
        return "$this->id_customer";
    }

    public function get_id_nation(){
        return "$this->nation_id";
    }

    public function get_customer(){
        return array(
            "name"      => $this->name,
            "last_name" => $this->last_name,
            "id_custom" => $this->id_custom,
            "nation_id" => $this->nation_id
        );
    }
}

class Bank_Account{
    private $bank_name = '';
    private $owner = '';
    private $id_account = '';

    /**
     * owner will contain the nation_id from the Customer
     */
    function __construct($bank_name, $owner){
        $this->bank_name = $bank_name;
        $this->owner = $owner;
        $this->gen_account_number();
    }

    private function gen_account_number(){
        $this->id_account = uniqid();
    }

    public function get_account(){
        return array(
            "bank_name"     => $this->bank_name,
            "owner"         => $this->owner,
            "id_account"    => $this->id_account
        );
    }
}

$franco = new Customer("franco", "gil", "u1", 26879366);

// Prints human-readable information about a variable
print_r($franco->get_customer());
echo "<br>";

$f_bank = new Bank_Account("banesco", 26879366);

// Prints human-readable information about a variable
print_r($f_bank->get_account());
echo "<br>";
?>
