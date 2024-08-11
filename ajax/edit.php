<?php
include('../config.php');

$addata = $conn->query("SELECT * FROM user_address WHERE ld = '" . $_POST['aadid'] . "' ")->fetch_assoc();

$countries = $conn->query("SELECT * FROM `country`");
$states = $conn->query("SELECT * FROM `state` WHERE `country_id`='" . $addata['country_id'] . "'");
$citys = $conn->query("SELECT * FROM `city` WHERE `country_id`='" . $addata['country_id'] . "' && `state_id`='" . $addata['state_id'] . "'");
$options = array();
$options['country_id'] = '<select class="form-select custome-form-select stateSelect" id="state" name="stateid" onchange="mycity(this.value)">
<option value="">Choose...</option>';
while ($row = $countries->fetch_assoc()) {
  $sel = '';
  if ($row['id'] == $addata['country_id']) {
    $sel = 'selected';
  }
  $options['country_id'] .= "<option value={$row['id']} {$sel}>{$row['country_name']}</option> </select>";
}
$options['state_id'] = '<select class="form-select custome-form-select stateSelect" id="state" name="stateid" onchange="mycity(this.value)"><option value="">Choose...</option>';
while ($row = $states->fetch_assoc()) {
  $sel = '';
  if ($row['id'] == $addata['state_id']) {
    $sel = 'selected';
  }
  $options['state_id'] .= "<option value={$row['id']} {$sel}>{$row['state_name']}</option></select>";
}
$options['city_id'] = '<select class="form-select custome-form-select stateSelect" id="state" name="stateid" onchange="mycity(this.value)"><option value="">Choose...</option>';
while ($row = $citys->fetch_assoc()) {
  $sel = '';
  if ($row['id'] == $addata['city_id']) {
    $sel = 'selected';
  }
  $options['city_id'] .= "<option value={$row['id']} {$sel}>{$row['city_name']}</option></select>";
}
echo json_encode(['edit' => $addata, 'options' => $options]);
exit;
