<?php
include('../config.php');

if (isset($_POST['colorid']) && !empty($_POST['colorid'])) {

    $colorimg = $conn->query('SELECT GROUP_CONCAT(`name`) as imgname  FROM  `galleryimg` where color_id = "' . $_POST['colorid'] . '" && product_id = "' . $_POST['proid'] . '" ');
    $colorimg2 = $conn->query('SELECT GROUP_CONCAT(`name`) as imgname  FROM  `galleryimg` where color_id = "' . $_POST['colorid'] . '" && product_id = "' . $_POST['proid'] . '" ');
}

$products = $conn->query("select * from prdoucts where dstatus=0 && status=1 && id = '" . $_POST['proid'] . "' ");
$datapro = $products->fetch_assoc();
?>
<div class="product__single__item_details  ">

    <ul class="nav nav-tabs img-thumb-wrapper " role="tablist">
        <?php while ($sglimge = $colorimg->fetch_assoc()) { ?>
            <li class="nav-item">
                <a class="nav-link img-thumb active" data-toggle="tab" href="#tab-<?php echo $sglimge['imgname'] ?>" role="tab">
                    <div class="product__thumb__pic set-bg" data-setbg="<?php echo SITEURL; ?>uploads/banners/<?php echo $sglimge['imgname']?>">
                    </div>
                </a>
            </li>
        <?php } ?>
    </ul>
    <div class="tab-content">
        <?php
        $statkey = 0;
        while ($sglimg = $colorimg2->fetch_assoc()){
        ?>
            <div class="tab-pane <?php echo $statkey == 0 ? 'active' : '' ?>" role="tabpanel">
                <div class="product__details__pic__item">
                    <a class="grouped_elements" href="<?php echo SITEURL; ?>uploads/banners/<?php echo $sglimg['imgname'] ?>">
                        <img onerror="" src="<?php echo SITEURL; ?>uploads/banners/<?php echo $sglimg['imgname'] ?>" alt="" />
                    </a>
                </div>
            </div>
        <?php $statkey++;
        } ?>
    </div>
</div>
<script>
    $(".set-bg").each(function() {
        var bg = $(this).data("setbg");
        $(this).css("background-image", "url(" + bg + ")");
    });
</script>