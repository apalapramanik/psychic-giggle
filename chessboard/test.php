<?php
echo '<table width="400px" cellspacing="0px" cellpadding="0px" border="1px">';
for ($row = 1; $row <= 8; $row++) {
    echo '<tr>';
    for ($col = 1; $col <= 8; $col++) {
        $color = ($row + $col) % 2 == 0 ? '#FFFFFF' : '#000000';
        echo '<td height="35px" width="30px" bgcolor="' . $color . '"></td>';
    }
    echo '</tr>';
}
echo '</table>';
?>
