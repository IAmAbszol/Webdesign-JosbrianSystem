<?php

  // l33t hack hopefully
  // idea is to use this as a middle man between php and javascript using ajax

  require('new_search.php');

  $code = $_GET['c'];

    $item_Data = grab_linked_promotions_to_item($code);
    echo "<table class='table' id='selectPromoItemTable'>";
    echo "<thead><tr>";
    for($i = 0; $i < mysql_num_fields($item_Data); $i++) {
      $field_infos = mysql_fetch_field($item_Data, $i);
      echo "<th>{$field_infos->name}</th>";
    }
    echo "<th>Remove Linked Promotion</th>
    </tr></thead>";

    echo "<tbody>";

    // Print the data
    $increment = 0;
    while($row = mysql_fetch_assoc($item_Data)) {
      $bounce_back = 0;
      $link_code = $row['ItemNumber'];
      echo "<tr data-toggle='modal' data-target='#itemDetailModal'>";
      foreach($row as $_column) {
        echo "<td><p><div name='removepromo$increment' id='removepromo$increment'>{$_column}</div></p></td>";
        $bounce_back++;
        $increment++;
      }
      // should readjust back to itemNumber designated index value
      // then simply iterate 5 times in evaluateData to grab all fields
      $adjust=$increment - $bounce_back;
      echo "<td><input type='checkbox' name='itemRemoveCheckbox[]' id='itemRemoveCheckbox[]' value='$link_code'></td>

      </tr>";
    }

    echo "</tbody>";
    echo "</table>";

 ?>
