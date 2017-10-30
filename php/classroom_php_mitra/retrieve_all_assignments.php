<!-- 
     This will simply display all the teacher-course assignments
     It does not need any user input -- so not called ..._UI.php
-->
<?php
require('teach_cn.inc'); 
require('all_teaching_assignments_ui.inc'); 

// Main control logic 
get_all_teaching_assignments(); 


//------------------------------------------------------
function get_all_teaching_assignments() 
{ 
  // Connect to db 
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME); 

  //Construct an SQL statement
  $sql_stmt = "SELECT Lastname, Firstname, Discipline, CourseTitle 
               FROM Teacher, Course, TeachingAssignment
               WHERE TeachingAssignment.CourseId = Course.CourseId
               AND   TeachingAssignment.TeacherId = Teacher.TeacherId";
  
  //Execute the query
  $result =   mysql_query($sql_stmt);

  //Test whether the query was successful
  if (!$result)
  {
     echo "The retrieval was unsuccessful: ".mysql_error();
     exit;
  }

  //$result is non-empty. So count the rows
  $numrows = mysql_num_rows($result);

  //Create an appropriate message
  $message = "";
  if ($numrows == 0)
     $message = "No teaching assignments found in database";
  
  //Display the results
  show_all_teaching_assignments($message, $result);

  //Free the result set
  mysql_free_result($result);
     
}

function connect_and_select_db($server, $username, $pwd, $dbname)
{
	// Connect to db server
	$conn = mysql_connect($server, $username, $pwd);

	if (!$conn) {
	    echo "Unable to connect to DB: " . mysql_error();
    	    exit;
	}

	// Select the database	
	$dbh = mysql_select_db($dbname);
	if (!$dbh){
    		echo "Unable to select ".$dbname.": " . mysql_error();
		exit;
	}
}

?>
