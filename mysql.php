<?
/**
 * @file mysql.php
 * @author Umang Vaish
 * @copyright 2011
 */
 
class mysql {
    // Sets the necessary variables for the class
    var $server = "localhost";
    var $conn_username = "root";
    var $conn_password = "GN9JB4fBsKf29RNw";
    var $connection;
    var $select;
    var $query;
    var $db;

    function connect($db) {
    $connection = mysql_connect($server,$conn_username,$conn_password);
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