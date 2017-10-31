
<!--
This will display the results of all_teaching_assignments retrieval
-->
<?php

function show_all_teaching_assignments($message, $result)
{
  //----------------------------------------------------------
  // Start the html page
  echo "<HTML>";
  echo "<HEAD>";
  echo "</HEAD>";
  echo "<BODY>";

  // If the message is non-null and not an empty string print it
  // message contains the lastname and firstname

  if ($message)
  {
    if ($message != "")
       {
	 echo '<center><font color="blue">'.$message.'</font></center><br />';
       }
  }
  echo '<table border="1" align="center" width="98%">';
  echo '<th width="20%">Last Name</th>';
  echo '<th width="20%">First Name</th>';
  echo '<th width="10%">Discipline</th>';
  echo '<th width="50%">Course Title</th>';
  echo '<thead>'; 
  echo '</thead>'; 
  echo '<tbody>'; 


   //While there are more rows in the $result, get the next row
   //as an associative array
   while ($row = mysql_fetch_assoc($result)) 
   {
     $lastname = $row['Lastname']; 
     $firstname = $row['Firstname']; 
     $discipline = $row['Discipline']; 
     $coursetitle = $row['CourseTitle'];  
 
      //Put these in a table row. The htmlentities function converts any
      //special chars in the string to a html-displayable form.
      echo '<tr>'; 
      echo '<TD><SPAN ALIGN=CENTER>'.htmlentities($lastname).'</SPAN></TD>'; 
      echo '<TD><SPAN ALIGN=CENTER>'.htmlentities($firstname).'</SPAN></TD>'; 
      echo '<TD><SPAN ALIGN=CENTER>'.htmlentities($discipline).'</SPAN></TD>'; 
      echo '<TD><SPAN ALIGN=CENTER>'.htmlentities($coursetitle).'</SPAN></TD>'; 
      echo '</tr>'; 
   } 
    
   echo '</TBODY>'; 
   echo '</table>'; 
    
//finish up the html code, and put the return button to go back to main menu
  echo <<<UPTOEND
  <BR/><BR/>
  <center>
  <input type="button" value="Return to Main Menu" 
	onClick="window.location='TeachOptions.html'"/>
  </center>
UPTOEND;

  echo "</BODY>";
  echo "</HTML>";
}

?>
