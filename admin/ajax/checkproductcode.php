<?php require('../../config.php');
$checkproductcode = $conn->query("select `id` from prdoucts where code='".$_GET['code']."'");
echo $checkproductcode->num_rows;

?>