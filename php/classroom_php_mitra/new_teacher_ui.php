<!-- new_teacher_ui.php -->
<?php

//------------------------------------------------------------
// Main Control Logic: It just calls a function
ui_show_new_fac_form();	

//------------------------------------------------------------
function ui_show_new_fac_form()
{
  //Create an HTML document using the ECHO statements
  echo "<HTML>";
  echo "<HEAD>";

  echo "</HEAD>";
  echo "<BODY>";
    echo "<BR/>";
    echo "<FORM action='insert_teacher.php' method='post'>";
    echo "<table>";

      echo '<tr>';  //
      echo '<TD><SPAN ALIGN=RIGHT>Last Name:</SPAN></TD>';
      echo '<TD><INPUT NAME="lastname" TYPE="text" SIZE=50/></TD>';
      echo '</tr>';

      echo '<tr>';  //
      echo '<TD><SPAN ALIGN=RIGHT>First Name:</SPAN></TD>';
      echo '<TD><INPUT NAME="firstname" TYPE="text" SIZE=50/></TD>';
      echo '</tr>';

      echo '<tr>';  //
      echo '<TD><SPAN ALIGN=RIGHT>Specialization:</SPAN></TD>';
      echo '<TD><INPUT NAME="specialization" TYPE="text" SIZE=50/></TD>';
      echo '</tr>';
      
      echo '<tr>';  //
      echo '<TD><SPAN ALIGN=RIGHT>Highest Degree:</SPAN></TD>';
      echo '<TD><INPUT NAME="highestdegree" TYPE="text" SIZE=50/></TD>';
      echo '</tr>';
  echo "</table>";
  echo '<input type="reset" value="Reset" />';
  echo '<input type="submit" value="Submit New Faculty Data" />';
 
  echo "</FORM>";
  echo "</BODY>";
  echo "</HTML>";
}
?>