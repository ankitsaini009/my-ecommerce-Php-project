<?php require('../../config.php');
$pagename = "product";
$id = ($_GET['id']);

if($conn->query("delete from configration  where id='".$id."'")){
echo 1;exit;
}
?>