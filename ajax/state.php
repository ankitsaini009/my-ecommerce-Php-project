<?php
include('../config.php');
$mystate = $conn->query("SELECT * FROM `state` WHERE country_id = '" . $_POST['cantid'] . "' ");

$html = '<select class="form-select custome-form-select stateSelect" id="state" name="stateid" onchange="mycity(this.value)" >
           <option vlaue="" > Select State </option>';
while ($sglstate = $mystate->fetch_assoc()) {
  $html .= '<option value="' . $sglstate['id'] . '">' . $sglstate['state_name'] . '</option> 
  </select>
  ';
}
echo $html;
exit;
