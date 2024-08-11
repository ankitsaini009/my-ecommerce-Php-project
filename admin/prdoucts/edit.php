<?php
require('../../config.php');
$pagename = "Products";
$getdata = $conn->query("SELECT * from prdoucts where id = '" . ($_GET["id"]) . "' ");
$olddata = $getdata->fetch_assoc();
$name = $olddata['name'];
$code = $olddata['code'];
$description = $olddata['description'];
$categoryid = $olddata['category_id'];
$subcategoryid = $olddata['subcategory_id'];
$brand_id = $olddata['brand_id'];
$mrp_price = $olddata['mrp_price'];
$price = $olddata['price'];
$qty = $olddata['qty'];
$main_image = $olddata['main_image'];
$status = $olddata['status'];
$is_featured = $olddata['is_featured'];
$is_latest = $olddata['is_latest'];
$product_type = $olddata['product_type'];


if (isset($_POST['name'])) {

  $isvalid = 1;
  if (empty($_POST['name'])) {
    $isvalid = 0;
    $titleerr = "Plese enter name";
  }
  if (empty($_POST['status'])) {
    $isvalid = 0;
    $statuserr = "Select status";
  }
  if (empty($_POST['description'])) {
    $isvalid = 0;
    $descriptionerr = "Plese enter description";
  }
  if (empty($_POST['price'])) {
    $isvalid = 0;
    $priceerr = 'Add price';
  }
  if (empty($_POST['mrp_price'])) {
    $isvalid = 0;
    $mrperr = 'Add mrp_price';
  }
  if (empty($_POST['qty'])) {
    $isvalid = 0;
    $qtyerr = 'Add qty';
  }
  if (empty($_POST['code'])) {
    $isvalid = 0;
    $codeerr = 'Add category';
  }

  if ($isvalid == 1) {
    $profilepic = $_POST['oldimgprofile'];
    if (!empty($_FILES['img']['name'])) {
      $saininame = $_FILES['img']['name'];
      $ext = pathinfo($saininame, PATHINFO_EXTENSION);
      $newfilename = "Products_" . time() . "_" . rand(00000, 99999) . "." . $ext;
      if (move_uploaded_file($_FILES['img']['tmp_name'], '../../uploads/banners/' . $newfilename)) {
        $profilepic = $newfilename;
        unlink('../../uploads/banners/' . $_POST['oldimgprofile']);
      }
    }
    $updatdata = " update prdoucts set name = '" . $_POST['name'] . "', code = '" . $_POST['code'] . "',  description = '" . $_POST['description'] . "',  category_id = '" . $_POST['category_id'] . "',  subcategory_id = '" . $_POST['subcategory_id'] . "',  brand_id = '" . $_POST['brands'] . "', mrp_price = '" . $_POST['mrp_price'] . "', qty = '" . $_POST['qty'] . "', qty = '" . $_POST['qty'] . "', main_image='" . $profilepic . "', updated_at='" . date('Y-m-d H:i:s') . "' where id='" . $_GET["id"] . "' ";


    if ($conn->query($updatdata) === true) {
      if (isset($_FILES['productgalleryimg']['name'][0])) {
        $galleryimgarry = array();
        foreach ($_FILES['productgalleryimg']['name'] as $key => $filename) {
          $ext = pathinfo($filename, PATHINFO_EXTENSION);
          $newfilename = "product_gallery_" . time() . "_" . rand(00000, 99999) . "." . $ext;
          if (move_uploaded_file($_FILES['productgalleryimg']['tmp_name'][$key], '../../uploads/banners/' . $newfilename)) {
            $insertgallery = $conn->query("INSERT INTO galleryimg (product_id, name, created_at) VALUES ('" .  $_GET["id"] . "','" . $newfilename . "','" . date('Y-m-d H:i:s') . "')");
          }
        }
      }
      if ($_POST['product_type'] == 2) {
        // /prd($_POST);
        if (isset($_POST['addsize']) && count($_POST['addsize']) > 0) {
          foreach ($_POST['addsize'] as $key => $size) {
            if ($_POST['allreadyadded'][$key] == 0) {
              $config = $conn->query("INSERT INTO configration(product_id, size_id, color_id, qty) VALUES ('" . $_GET["id"] . "','" . $size . "','" . $_POST['addcolor'][$key] . "','" . $_POST['addqty'][$key] . "')");
            } else {
              $config = $conn->query("Update configration set size_id='" . $size . "',color_id= '" . $_POST['addcolor'][$key] . "',qty = '" . $_POST['addqty'][$key] . "' where id='" . $_POST['allreadyadded'][$key] . "'");
            }
          }
        }
      }


      $_SESSION['success_msg'] = "Products Edit Successfully";
      header("location:" . SITEADMIN . "prdoucts");
    }
  }
}

$getcategory = $conn->query("select * from category where dstatus=0 && status=1 order by name asc");
$getsubcategory = $conn->query("select * from sub_category where dstatus=0 && status=1 order by name asc");
$getbrands = $conn->query("select * from brands where dstatus=0 && status=1 order by name asc");
$geimage = $conn->query("select * from galleryimg where product_id = '" . $_GET['id'] . "' && color_id=0 ");
$size = $conn->query("select * from size where dstatus=0 && status=1");
$color = $conn->query("select * from color where dstatus=0 && status=1");
$sizedata = array();
while ($singsazi = $size->fetch_assoc()) {
  $sized = array();
  $sized['id'] = $singsazi['size_id'];
  $sized['name'] = $singsazi['size_name'];

  $sizedata[] = $sized;
}

$colordata = array();
while ($singlecolor = $color->fetch_assoc()) {
  $singlecol = array();
  $singlecol['id'] = $singlecolor['color_id'];
  $singlecol['name'] = $singlecolor['name'];
  $colordata[] = $singlecol;
}

include('../includes/header.php');
?>

<!-- Content Wrapper. Contains page content -->
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
            <li class="breadcrumb-item"><a href="<?php echo SITEADMIN; ?>prdoucts">Products List</a></li>
            <li class="breadcrumb-item active"><?php echo $pagename; ?> Edit</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"><?php echo $pagename; ?> Edit</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">name</label>
                      <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name" value="<?php echo isset($_POST['title']) ? $_POST['title'] : $name ?>">
                      <p class="text-danger"><?php echo isset($titleerr) ? $titleerr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Code</label>
                      <input name="code" type="text" class="form-control" id="subject" placeholder="Enter Sub code" value="<?php echo isset($_POST['subject']) ? $_POST['subject'] : $code ?>">
                      <p class="text-danger codeerr"><?php echo isset($codeerr) ? $codeerr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Description</label>
                      <textarea name="description" class="form-control" id="description" placeholder=" Enter Description"><?php echo isset($_POST['description']) ? $_POST['description'] : $description ?></textarea>
                    </div>
                    <p class="text-danger"><?php echo isset($descriptionerr) ? $descriptionerr : '' ?></p>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Category</label>
                      <select name="category_id" class="form-control" id="category_id">
                        <option value="">Select Category</option>
                        <?php while ($singlecategory = $getcategory->fetch_assoc()) { ?>
                          <?php $selected = '';
                          if ($singlecategory['id'] == $categoryid) {
                            $selected = 'selected';
                          }
                          ?>
                          <option value="<?php echo $singlecategory['id']; ?>" <?php echo $selected; ?>><?php echo ucfirst($singlecategory['name']); ?></option>
                        <?php } ?>
                      </select>
                      <p class="text-danger"><?php echo isset($Categoryerr) ? $Categoryerr : '' ?></p>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">SubCategory</label>
                      <select name="subcategory_id" class="form-control" id="category_id">
                        <option value="">Select SubCategory</option>
                        <?php while ($singlecategory = $getsubcategory->fetch_assoc()) { ?>
                          <?php $selected = '';
                          if ($singlecategory['id'] == $subcategoryid) {
                            $selected = 'selected';
                          }
                          ?>
                          <option value="<?php echo $singlecategory['id']; ?>" <?php echo $selected; ?>><?php echo ucfirst($singlecategory['name']); ?></option>
                        <?php } ?>
                      </select>
                      <p class="text-danger"><?php echo isset($subcategoryerr) ? $subcategoryerr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">brands</label>
                      <select name="brands" class="form-control" id="category_id">
                        <option value="">Select brands</option>
                        <?php while ($singlebrands = $getbrands->fetch_assoc()) { ?>
                          <?php $selected = '';
                          if ($singlebrands['id'] == $brand_id) {
                            $selected = 'selected';
                          }
                          ?>
                          <option value="<?php echo $singlebrands['id']; ?>" <?php echo $selected ?>><?php echo ucfirst($singlebrands['name']); ?></option>
                        <?php } ?>
                      </select>
                      <p class="text-danger"><?php echo isset($Branderr) ? $Branderr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Price</label>
                      <input name="price" type="price" class="form-control" id="exampleInputEmail1" placeholder="Enter Your price" value="<?php echo isset($price) ? $price : '' ?>">
                      <p class="text-danger"><?php echo isset($priceerr) ? $priceerr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">mrp_price </label>
                      <input name="mrp_price" type="text" class="form-control" id="mrp_price" placeholder=" Enter Button Text" value="<?php echo isset($_POST['mrp_price']) ? $_POST['mrp_price'] : $mrp_price ?>">
                      <p class="text-danger"><?php echo isset($mrperr) ? $mrperr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">qty </label>
                      <input name="qty" type="text" class="form-control" id="qty" placeholder=" Enter Button Text" value="<?php echo isset($_POST['qty']) ? $_POST['qty'] : $qty ?>">
                      <p class="text-danger"><?php echo isset($qtyerr) ? $qtyerr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Is featured</label>
                      <select name="is_latest" class="form-control" id="is_latest">
                        <option value="">Select featured</option>
                        <?php foreach ($featuredarray as $fekey => $fevalue) {
                          $asv = ($is_featured == $fekey) ? 'selected' : '';

                          echo '<option value="' . $fekey . '"' . $asv . '>' . $fevalue . '</option>';
                        } ?>
                      </select>
                      <p class="text-danger"><?php echo isset($featurederr) ? $featurederr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Is latest</label>
                      <select name="is_latest" class="form-control" id="is_latest">
                        <option value="">Select latest</option>
                        <?php foreach ($featuredarray as $fekey => $fevalue) {
                          $asl = ($is_latest == $fekey) ? 'selected' : '';

                          echo '<option value="' . $fekey . '"' . $asl . '>' . $fevalue . '</option>';
                        } ?>
                      </select>
                      <p class="text-danger"><?php echo isset($latesterr) ? $latesterr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Status</label>
                      <select name="status" class="form-control" id="status">
                        <option value="">Select Status</option>
                        <?php foreach ($statusarray as $stkey => $stvalue) {
                          $sel = ($status == $stkey) ? 'selected' : '';
                          echo '<option value="' . $stkey . '" ' . $sel . '>' . $stvalue . '</option>';
                        } ?>
                      </select>
                    </div>
                    <p class="text-danger"><?php echo isset($statuserr) ? $statuserr : '' ?></p>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Product Type</label>
                      <select name="product_type" class="form-control" id="product_type">
                        <option value="">Select Product Type</option>
                        <option value="1" <?php echo $product_type == 1 ? 'selected' : '' ?>>Simple</option>
                        <option value="2" <?php echo $product_type == 2 ? 'selected' : '' ?>>Configurable</option>


                      </select>
                    </div>
                    <p class="text-danger"><?php echo isset($statuserr) ? $statuserr : '' ?></p>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Image</label>
                      <input name="img" type="file" class="form-control" id="button_txt">
                      <input name="oldimgprofile" type="hidden" value="<?php echo $main_image ?>"><br>
                      <img src="<?php echo SITEURL ?>uploads/banners/<?php echo $main_image ?>" width="70">
                    </div>
                  </div>
                  <div class="form-group col-6">
                    <label for="exampleInputFile">Product Gallery Images</label>
                    <div class="input-group">
                      <input type="file" id="productgalleryimg" name="productgalleryimg[]" class="form-control col-12" multiple>
                    </div>
                  </div>
                  <div class="form-group col-md-12">
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

                    <div class="addmoresize" style="display: block  ;">
                      <?php if ($product_type == 2) {
                        $getconfig = $conn->query("select * from configration where product_id='" . $_GET['id'] . "'");
                        if ($getconfig->num_rows > 0) {
                          $start = 0;
                          while ($singlerecd = $getconfig->fetch_assoc()) { ?>

                            <div class="row" id="addmore_<?php echo $singlerecd['id'] ?>">
                              <input type="hidden" name="allreadyadded[]" value="<?php echo $singlerecd['id']; ?>">
                              <div class="form-group col-3">
                                <label for="exampleInputFile">Product Size</label>
                                <div class="input-group">
                                  <select class="form-control" name="addsize[]" id="addsize">
                                    <option value="">Product Size</option>
                                    <?php foreach ($sizedata as $singlesize) { ?>

                                      <option value="<?php echo $singlesize['id'] ?>" <?php echo ($singlerecd['size_id'] == $singlesize['id']) ? 'selected' : '' ?>> <?php echo  strtoupper($singlesize['name']) ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                                <p class="text-danger" id="sizerr"></p>
                              </div>
                              <div class="form-group col-3">
                                <label for="exampleInputFile">Product Color</label>
                                <div class="input-group">
                                  <select class="form-control" name="addcolor[]" id="addcolor">
                                    <option value=""> Product Color</option>
                                    <?php foreach ($colordata as $singlecolordd) { ?>

                                      <option value="<?php echo $singlecolordd['id'] ?>" <?php echo ($singlerecd['color_id'] == $singlecolordd['id']) ? 'selected' : '' ?>> <?php echo  strtoupper($singlecolordd['name']) ?></option>
                                    <?php } ?>
                                  </select>
                                  <br>
                                  <p class="text-danger" id="colorrr"></p>
                                </div>
                              </div>
                              <div class="form-group col-3">
                                <label for="exampleInputFile">Qty</label>
                                <div class="input-group">
                                  <input type="number" name="addqty[]" class="form-control" value="<?php echo $singlerecd['qty']; ?>">
                                  <br>
                                  <p class="text-danger" id="colorrr"></p>
                                </div>
                              </div>
                              <div class="form-group col-3" id="">
                                <label for="exampleInputFile" style="visibility: hidden;">Action</label><br>
                                <?php if ($start == 0) { ?>
                                  <a class="btn btn-success rounded-pill addmore" href="javascript:void(0);">Add More</a>
                                <?php } else { ?>
                                  <a class="btn btn-danger rounded-pill removeadded" href="javascript:void(0);" onclick="removeid(<?php echo $singlerecd['id'] ?>)">Remove</a>
                                <?php } ?>

                              </div>
                            </div>

                          <?php $start++;
                          }
                        } else { ?>
                          <div class="row">
                            <input type="hidden" name="allreadyadded[]" value="0">
                            <div class="form-group col-3">
                              <label for="exampleInputFile">Product Size</label>
                              <div class="input-group">
                                <select class="form-control" name="addsize[]" id="addsize">
                                  <option value="">Product Size</option>
                                  <?php foreach ($sizedata as $singlesize) { ?>

                                    <option value="<?php echo $singlesize['id'] ?>"> <?php echo  strtoupper($singlesize['name']) ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <p class="text-danger" id="sizerr"></p>
                            </div>
                            <div class="form-group col-3">
                              <label for="exampleInputFile">Product Color</label>
                              <div class="input-group">
                                <select class="form-control" name="addcolor[]" id="addcolor">
                                  <option value=""> Product Color</option>
                                  <?php foreach ($colordata as $singlecolordd) { ?>

                                    <option value="<?php echo $singlecolordd['id'] ?>"> <?php echo  strtoupper($singlecolordd['name']) ?></option>
                                  <?php } ?>
                                </select>
                                <br>
                                <p class="text-danger" id="colorrr"></p>
                              </div>
                            </div>
                            <div class="form-group col-3">
                              <label for="exampleInputFile">Qty</label>
                              <div class="input-group">
                                <input type="number" name="addqty[]" class="form-control" value="1">
                                <br>
                                <p class="text-danger" id="colorrr"></p>
                              </div>
                            </div>
                            <div class="form-group col-3">
                              <label for="exampleInputFile" style="visibility: hidden;">Action</label><br>
                              <a class="btn btn-success rounded-pill addmore" href="javascript:void(0);">Add More</a>
                            </div>
                          </div>

                        <?php  }
                        ?>

                      <?php } else { ?>
                        <div class="row">
                          <input type="hidden" name="allreadyadded[]" value="0">
                          <div class="form-group col-3">
                            <label for="exampleInputFile">Product Size</label>
                            <div class="input-group">
                              <select class="form-control" name="addsize[]" id="addsize">
                                <option value="">Product Size</option>
                                <?php foreach ($sizedata as $singlesize) { ?>

                                  <option value="<?php echo $singlesize['id'] ?>"> <?php echo  strtoupper($singlesize['name']) ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <p class="text-danger" id="sizerr"></p>
                          </div>
                          <div class="form-group col-3">
                            <label for="exampleInputFile">Product Color</label>
                            <div class="input-group">
                              <select class="form-control" name="addcolor[]" id="addcolor">
                                <option value=""> Product Color</option>
                                <?php foreach ($colordata as $singlecolordd) { ?>

                                  <option value="<?php echo $singlecolordd['id'] ?>"> <?php echo  strtoupper($singlecolordd['name']) ?></option>
                                <?php } ?>
                              </select>
                              <br>
                              <p class="text-danger" id="colorrr"></p>
                            </div>
                          </div>
                          <div class="form-group col-3">
                            <label for="exampleInputFile">Qty</label>
                            <div class="input-group">
                              <input type="number" name="addqty[]" class="form-control" value="1">
                              <br>
                              <p class="text-danger" id="colorrr"></p>
                            </div>
                          </div>
                          <div class="form-group col-3">
                            <label for="exampleInputFile" style="visibility: hidden;">Action</label><br>
                            <a class="btn btn-success rounded-pill addmore" href="javascript:void(0);">Add More</a>
                          </div>
                        </div>

                      <?php } ?>
                    </div>
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary"> Update </button>
                  </div>
            </form>
          </div>
          <!-- /.card -->


        </div>
      </div>

      <!-- /.row -->
    </div><!--/. container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php require('../includes/footer.php'); ?>
<script>
  $('.addmore').click(function() {
    var html = `<div class="row">
                      <input type="hidden" name="allreadyadded[]" value="0">
                      <div class="form-group col-3">
                        <label for="exampleInputFile">Product Size</label>
                        <div class="input-group">
                          <select class="form-control" name="addsize[]" id="addsize">
                            <option value="">Select Product Size</option>
                            <?php foreach ($sizedata as $singlesize) { ?>
                              <option value="<?php echo $singlesize['id'] ?>"> <?php echo  strtoupper($singlesize['name']) ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <p class="text-danger" id="sizerr"></p>
                      </div>
                      <div class="form-group col-3">
                        <label for="exampleInputFile">Product Color</label>
                        <div class="input-group">
                          <select class="form-control" name="addcolor[]" id="addcolor">
                            <option value="">Select Product Color</option>
                            <?php foreach ($colordata as $singlecolordd) { ?>
                              <option value="<?php echo $singlecolordd['id'] ?>"> <?php echo  strtoupper($singlecolordd['name']) ?></option>
                            <?php } ?>
                          </select>
                          <br>
                          <p class="text-danger" id="colorrr"></p>
                        </div>
                      </div>
                      <div class="form-group col-3">
                        <label for="exampleInputFile">Qty</label>
                        <div class="input-group">
                              <input type="number" name="addqty[]" class="form-control" value="1">
                          <br>
                          <p class="text-danger" id="colorrr"></p>
                        </div>
                      </div>

                      <div class="form-group col-3">
                      <label for="exampleInputFile" style="visibility: hidden;">Action</label><br>
                        <a class="btn btn-danger rounded-pill removemore" href="javascript:void(0);">Remove</a>
                      </div>
                    </div>`;
    $('.addmoresize').append(html);
  });

  $(document).on("click", ".removemore", function() {
    $(this).parent().parent().remove();
  });
</script>


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

<script>
  function removeid(galleryid) {
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
            url: "<?php echo SITEADMIN; ?>ajax/removeid.php",
            data: {
              id: galleryid
            },
            success: function(data) {
              $('#addmore_' + galleryid).remove();
            }
          });
        }
      }
    });
  }
</script>