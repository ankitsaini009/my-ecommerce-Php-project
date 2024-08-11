<?php
include('../../config.php');
if(isset($_POST['sizeid']) && !empty('sizeid')){
  $config = $conn->query(" SELECT GROUP_CONCAT(`color_id`) as `colorids` FROM `configration` WHERE `size_id`= '" . $_POST['sizeid'] . "' && `product_id`= '" . $_POST['productid'] . "'");
  $configdata = $config->fetch_assoc();
  $colordata = $conn->query('SELECT * FROM `color` WHERE `color_id` IN(' . $configdata['colorids'] . ')');
}
?>
<span>Color:</span>
<?php while ($singcolor = $colordata->fetch_assoc()) { ?>
  <label style="background:<?php echo $singcolor['hex_value']; ?> !important" class="colorids" colorid="<?php echo $singcolor['color_id'] ?>">
    <input type="radio" id="<?php echo $singcolor['color_id'] ?>" value="<?php echo $singcolor['hex_value']; ?>" />
  </label>
<?php } ?>