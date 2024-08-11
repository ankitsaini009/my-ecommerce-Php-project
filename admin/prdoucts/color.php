<?php
include('../../config.php');
$pagename = "Colors";
if (isset($_POST['images'])) {
  foreach ($_FILES['gallery']['name'] as $key => $valu) {
    foreach ($valu as $namekey => $filename) {

      $profilename = '';
      $name = $_FILES['gallery']['name'][$key][$namekey];
      if ($name) {
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        $newfilename = "banners_" . time() . "_" . rand(00000, 99999) . "." . $ext;
        if (move_uploaded_file($_FILES['gallery']['tmp_name'][$key][$namekey], '../../uploads/banners/' . $newfilename)) {
          $profilename = $newfilename;
          $mydata = $conn->query("INSERT INTO `galleryimg`(`color_id`, `product_id`, `name`,`created_at`) VALUES ('" . $key . "','" . $_GET['id'] . "','" . $profilename . "','" . date('Y-m-d H:i:s') . "')");
        }
      }
    }
  }
  header("location:" . SITEADMIN . "prdoucts");
}
$color = $conn->query('SELECT DISTINCT(`color_id`) FROM `configration` WHERE `product_id`= "' . $_GET['id'] . '"');
$colourids = [0];
while ($singlecol = $color->fetch_assoc()) {
  $colourids[] = $singlecol['color_id'];
}
$mycolor = $conn->query('SELECT * FROM `color` WHERE `color_id` IN (' . implode(',', $colourids) . ')');

include('../includes/header.php');
?>
<div class="content-wrapper ">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><?php echo $pagename; ?> </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo SITEADMIN; ?>dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?php echo SITEADMIN; ?>Prdoucts">Prdoucts List</a></li>
            <li class="breadcrumb-item active"><?php echo $pagename; ?> Add</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <section class="content">
    <div class="container-fluid">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"><?php echo $pagename; ?> Add</h3>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <input type="hidden" name="images">
                <?php while ($singcolor = $mycolor->fetch_assoc()) {
                  $geimage = $conn->query("select * from galleryimg where product_id = '" . $_GET['id'] . "' && color_id='" . $singcolor['color_id'] . "' ");
                ?>
                  <style>
                    .radio[type="radio"] {
                      width: 1.4em;
                      height: 1.4em;
                      border-radius: 50%;
                      border: 2px solid #adb5bd;
                    }
                  </style>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Color Name : </label><br>
                        <div class="product__details__option__color colordata">
                          <label style="background:<?php echo $singcolor['hex_value']; ?> !important" class="colorids">
                            <input type="radio" id="<?php echo $singcolor['color_id'] ?>" value="<?php echo $singcolor['hex_value']; ?>" class="radio" />
                            </label>
                          <?php echo $singcolor['name'] ?>
                        </div>
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputPassword1">Select Gallery Image</label><br>
                      <div class="input-group">
                        <input type="file" name="gallery[<?php echo  $singcolor['color_id'] ?>][]" multiple>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="row">
                        <?php
                        if ($geimage->num_rows > 0) {
                          while ($singleimg = $geimage->fetch_assoc()) { ?>
                            <div class="col-md-2  mt-2 text-center" id="gallery_<?php echo $singleimg['gallery_id'] ?>">
                              <img src="<?php echo SITEURL ?>uploads/banners/<?php echo $singleimg['name'] ?>" class="imge-responsive" style="width:90%;">
                              <a href="javascript:void(0);" class="text-danger" onclick="removegallery(<?php echo $singleimg['gallery_id'] ?>)">Remove</a>
                            </div>
                        <?php  }
                        } ?>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
          </div>
          <div class="form-group col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </div>
    </div>
</div>
</div>
</div>
</div>
<?php include('../includes/footer.php'); ?>
<script>
  function removegallery(galleryid) {
    bootbox.confirm({
      message: 'Are You sure to delete this  ?',
      buttons: {
        confirm: {
          label: 'Confirm',
          className: 'btn-success'
        },
        cancel: {
          label: 'Cancel',
          className: 'btn-danger'
        }
      },
      callback: function(result) {
        if (result) {
          $.ajax({
            type: "GET",
            url: "<?php echo SITEADMIN; ?>ajax/removegallery.php",
            data: {
              galleryid: galleryid
            },
            success: function(data) {
              $('#gallery_' + galleryid).remove();
            }
          });
        }
      }
    });
  }
</script>