<?php require('../../config.php');
  $cateres = $conn->query("select * from sub_category where category_id='".$_POST['catid']."' && status=1 && dstatus=0 order by name asc");

  $html = '<option value="">Select subcategory</option>';
  while($singlecate = $cateres->fetch_assoc()){
    $html .= '<option value="'.$singlecate['id'].'">'.ucfirst($singlecate['name']).'</option>';
  }
  echo $html;exit;
?>