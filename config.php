<?php
/**
 * Configuration for database connection
 *
 */
$host       = "localhost"; //???
$username   = "kdarl1";
$password   = "webdesign";
$dbname     = "fal17_csc423_kdarl1";
$dsn        = "mysql:host=$host;dbname=$dbname"; //???
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );
