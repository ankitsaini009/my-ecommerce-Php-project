<?php require('../../config.php');
$pagename = "product";
$id = ($_GET['galleryid']);

if($conn->query("delete from galleryimg  where gallery_id='".$id."'")){
echo 1;exit;
}
?>