<?php
/**
 * Configuration for database connection
 *
 */
 //Not sure if these fields are right
$host       = "csdb.brockport.edu";
$username   = "kdarl1";
$password   = "webdesign";
$dbname     = "test";
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );
