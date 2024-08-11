<?php 
include('Stripe-php-master/init.php');

$publishablekey = "pk_test_51OSj0WGlQkVmVwGJcOZF3bLDIdp8ZYjK7XIZksiCp5h6zWXC3EVvSuzzrUuiQImShGkVXZyp0aGrhl71YOcxyEXc00x6VSnEY2";
$secretkey = "sk_test_51OSj0WGlQkVmVwGJxvV5xScmacCfSBAgXXgt5j4CLSGrsS4mYRfhSM3Fx4AfUVaDVO1jx6vYDFE66jeN283Cztog00s3xQzrAy";

\stripe\stripe::setApiKey($secretkey);

session_start();
define('SITEURL','http://localhost/ecommerce/');
define('SITEADMIN',SITEURL.'admin/');
define('SITENAME','Market Plece');
define('CIPINGCHARGE','100');

// Conct Database 

define('severname', 'localhost');
define('username', 'root');
define('password','');
define('dbname','ecommerce');

$conn = new mysqli(severname,username,password,dbname,);
if($conn->connect_errno){
  die("conection Faild" . $conn->connect_errno);
}
function prd($a){
  echo "<pre>";
  print_r($a);die;
}
$statusarray = array(
  '1'=>'Active',
  '2'=>'Inactive'
);
$featuredarray = array(
  '1'=>'YES',
  '2'=>'NO'
);
$usertype = array( 
  '1'=>'Frontend',
  '2'=>'Backend',
);
$protype = array(
  '1'=>'Percentage',
  '2'=>'Fixed amount',
);

$shipping= array(
  '0'=>'Panding',
  '1'=>'Confirmed',
  '2'=>'Delived',
  '3'=>'Cancelled',
);

$order= array(
  '0'=>'Panding',
  '1'=>'Shipped',
);

function price($amount){
return '₹'. number_format($amount,2);
}
?>