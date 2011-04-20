<?php

/**
 * include/config.php
 *
 * Stores config info and preferences to be accessed globally
 */

/* Database details */
define ("DB_SERVER", "localhost");
define ("DB_USER",   "umangv_admin");
define ("DB_PASS",   "my8523");
define ("DB_NAME",   "umangv_admin");

/* Database tables */
define ("T_PREFIX",     "");

define ("TAB_SETTINGS", T_PREFIX . "settings");
define ("TAB_PAGES",    T_PREFIX . "pages");
define ("TAB_USERS",    T_PREFIX . "login");

/* User levels */
define ("GUEST_LEVEL",  0);
define ("USER_LEVEL",   1);
define ("EDITOR_LEVEL", 5);
define ("ADMIN_LEVEL",  9);

?>