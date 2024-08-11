<?php
include('../config.php');
$mystate = $conn->query("SELECT * FROM `city` WHERE state_id = '" . $_POST['city'] . "' ");

$html = '<select class="form-select custome-form-select stateSelect" id="city" name="city" >
<option vlaue="" > Select City </option>';
while ($sglstate = $mystate->fetch_assoc()) {
  $html .= '<option value="' . $sglstate['id'] . '">' . $sglstate['city_name'] . '</option>
  </select>
  ';
}
echo $html;
exit;
