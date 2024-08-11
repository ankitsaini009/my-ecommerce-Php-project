<?php
include("../../config.php");
$states = $conn->query("SELECT * FROM `state` WHERE country_id = '" . $_POST['cantid'] . "' ");

$html = '<option value="">Select State</option>';
while ($sglstate = $states->fetch_assoc()){
  $html .= '<option value="' . $sglstate['id'] . '">' . ucfirst($sglstate['state_name']) . '</option> ';
}
echo $html;exit;
?>