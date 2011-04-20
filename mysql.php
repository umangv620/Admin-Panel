<?
/**
 * @file mysql.php
 * @author Umang Vaish
 * @copyright 2011
 */
 
include_once 'config.php';

class mysql {
    // Sets the necessary variables for the class
    private $connection;
    
    public function __construct() {
		$this->connection = mysql_connect(DB_SERVER,DB_USER,DB_PASS);
		mysql_select_db(DB_NAME,$this->connection);
    }
    /** 
     * To run the MySQL Connection, you need to create a new instance of the class
     * $mysql = new mysql(); //This creates a new instance and connects to the database in the config file
     */
     
    function query($query) {
        return mysql_query($query, $this->connection);
    }
    /**
     * To run a queury on the database
     * $mysql->query("SELECT * FROM table WHERE something='something_else'");
     */
     
    function end() {
        mysql_free_result($this->connection);
    }
    /**
     * To close the MySQL connection 
     * $mysql->end();
     */
}
