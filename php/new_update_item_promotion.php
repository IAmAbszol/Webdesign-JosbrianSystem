<!--
  Adds the item to the specified promotionitem table
-->
<?php
require('server_connection.inc');

require('display_result.inc');

update_item_promtion();

function update_item_promotion() {

	// connect to the main database where the items are stored
	connect_to_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);
  display_result_item("hello");

  // grab item retail price via query
  // grab promo discount via query, calculate
  // insert into promoitem


}

function str_lreplace($search, $replace, $subject)
{
    $pos = strrpos($subject, $search);

    if($pos !== false)
    {
        $subject = substr_replace($subject, $replace, $pos, strlen($search));
    }

    return $subject;
}

function connect_to_db($server, $username, $pwd, $dbname) {
	$conn = mysql_connect($server, $username, $pwd);
	if(!$conn) {
			display_result_item("Unable to connect to DB: " . mysql_error());
			exit;
	}
	$dbh = mysql_select_db($dbname);
	if(!$dbh) {
		display_result_item("Unable to select " .$dbname. ": " . mysql_error());
		exit;
	}
}

?>
