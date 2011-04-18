<?
/**
 * @file mysql.php
 * @author Umang Vaish
 * @copyright 2011
 */
 
class mysql {
    // Sets the necessary variables for the class
    public $connection;
    public $select;
    public $query;
    public $result;

    function connect($db) {
    $connection = mysql_connect("localhost","umangv_admin","my8523");
    $select = mysql_select_db($db,$connection);
    }
    /** 
     * To run the MySQL Connection, you need to create a new instance of the class
     * $mysql = new mysql(); //This creates a new instance
     * $mysql->connect($db); //This connects to the database
     */
     
    function query($query) {
        $result = mysql_query($query);
        if (!$result) {
            echo 'Could not run query: ' . mysql_error();
            exit;
        }
		return $result;
    }
    /**
     * To run a queury on the database
     * $mysql->query("SELECT * FROM table WHERE something='something_else'");
     */
     
    function end() {
        mysql_free_result($connection);
    }
    /**
     * To close the MySQL connection 
     * $mysql->end();
     */
}