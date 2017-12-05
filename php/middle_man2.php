<?php

  require('new_search.php');

echo "<table class='table' id='selectPromoItemTable'>
<!-- Listing Search -->";

  $code = $_GET['c'];
                          $item_Data = grab_linked_promotions_to_ad($code);
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
                            $link_code = $row['PromoCode'];
                            echo "<tr data-toggle='modal' data-target='#itemDetailModal'>";
                            foreach($row as $_column) {
                              echo "<td><p><div name='promo$increment' id='promo$increment'>{$_column}</div></p></td>";
                              $bounce_back++;
                              $increment++;
                            }
                            // should readjust back to itemNumber designated index value
                            // then simply iterate 5 times in evaluateData to grab all fields
                            $adjust=$increment - $bounce_back;
                            echo "<td><input type='checkbox' name='promoRemoveCheckbox[]' id='promoRemoveCheckbox[]' value='$link_code'></td>

                            </tr>";
                          }

                          echo "</tbody>

</table>";

?>
