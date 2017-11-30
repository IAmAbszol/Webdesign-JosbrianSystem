<?php

require ('server_connection.inc');

function updateToAdEvent() {
  connect_to_db($DB_SERVER, $DB_UN, $DB_PWD, $DB_NAME);
  if(!empty($_POST['adEventAddCheckbox'])) {
      foreach($_POST['adEventAddCheckbox'] as $check) {
        $tmp_statement = "insert AdEventPromotion (EventCode, PromoCode, Notes) values ";
      }
  }
}

function connect_to_db($server, $username, $pwd, $dbname) {
  $conn = mysql_connect($server, $username, $pwd);
  if(!$conn) {
    echo "Unable to connect to DB: " . mysql_error();
      exit;
  }
  $dbh = mysql_select_db($dbname);
  if(!$dbh) {
    echo "Unable to select " .$dbname. ": " . mysql_error();
    exit;
  }
}

 ?>
