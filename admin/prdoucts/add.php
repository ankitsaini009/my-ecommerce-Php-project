<?php require('../../config.php');
ini_set('upload_max_size', '256M');
$pagename = "Products";
//prd($_POST);die;
if (isset($_POST['name'])) {
  $isvalid = 1;
  if (empty($_POST['name'])) {
    $isvalid = 0;
    $titleerr = "Plese enter name";
  } else {
    $proname = $conn->query("select * from prdoucts where name = '" . $_POST['name'] . "' ");
    if ($proname->num_rows > 0) {
      $titleerr = "This name is alredy taken";
    }
  }
  if (empty($_POST['status'])) {
    $isvalid = 0;
    $statuserr = "Select status";
  }
  if (empty($_POST['description'])) {
    $isvalid = 0;
    $descriptionerr = "Plese enter description";
  }
  if (empty($_POST['category_id'])) {
    $isvalid = 0;
    $Categoryerr = 'Add category';
  }
  if (empty($_POST['subcategory_id'])) {
    $isvalid = 0;
    $subcategoryerr = 'Add subcategory';
  }
  if (empty($_POST['brand_id'])) {
    $isvalid = 0;
    $Branderr = 'Add brand';
  }
  if (empty($_POST['price'])) {
    $isvalid = 0;
    $priceerr = 'Add price';
  }
  if (empty($_POST['mrp_price'])) {
    $isvalid = 0;
    $mrperr = 'Add mrp_price';
  }
  if (intval($_POST['price']) > intval($_POST['mrp_price'])) {
    $isvalid = 0;
    $priceerr = "Please Add Correct Price For Product.";
  }
  if (empty($_POST['qty'])) {
    $isvalid = 0;
    $qtyerr = 'Add qty';
  }
  if (empty($_POST['featured'])) {
    $isvalid = 0;
    $featurederr = 'Add featured';
  }
  if (empty($_POST['latest'])) {
    $isvalid = 0;
    $latesterr = 'Add latest';
  }
  if (empty($_POST['code'])) {
    $isvalid = 0;
    $codeerr = 'Add code';
  } else {
    $procode = $conn->query("select * from prdoucts where code = '" . $_POST['code'] . "' ");
    if ($procode->num_rows > 0) {
      $codeerr = 'This code is already taken';
    }
  }
  if ($isvalid == 1) {
    $profilename = '';
    $saininame = $_FILES['main_image']['name'];
    $ext = pathinfo($saininame, PATHINFO_EXTENSION);
    $newfilename = "banners_" . time() . "_" . rand(00000, 99999) . "." . $ext;
    if (move_uploaded_file($_FILES['main_image']['tmp_name'], '../../uploads/banners/' . $newfilename)) {
      $profilename = $newfilename;
    }
    $alldata = "insert into prdoucts ( `name`,`code`,`description`, `category_id`, `subcategory_id`, `brand_id`, `price`, `mrp_price`, `qty`, `status`,`main_image`,`is_featured`,`is_latest`,`created_at`,`updated_at`,`product_type`) VALUES ('" . $_POST['name'] . "','" . $_POST['code'] . "','" . $_POST['description'] . "','" . $_POST['category_id'] . "','" . $_POST['subcategory_id'] . "','" . $_POST['brand_id'] . "','" . $_POST['price'] . "','" . $_POST['mrp_price'] . "','" . $_POST['qty'] . "','" . $_POST['status'] . "','" . $profilename . "','" . $_POST['featured'] . "','" . $_POST['latest'] . "','" . date('Y-m-d H:i:s') . "' , '" . date('Y-m-d H:i:s') . "', '" .  $_POST['product_type'] . "')";

    if ($conn->query($alldata) == true) {
      $last_id = $conn->insert_id;
      if ($_POST['product_type'] == 2) {
        if (isset($_POST['addsize']) && count($_POST['addsize']) > 0) {
          foreach ($_POST['addsize'] as $key => $size) {
            $config = $conn->query("INSERT INTO configration(product_id, size_id, color_id, qty) VALUES ('" . $last_id . "','" . $size . "','" . $_POST['addcolor'][$key] . "','" . $_POST['addqty'][$key] . "')");
          }
        }
      }
      if (isset($_FILES['productgalleryimg']['name'][0])) {
        $galleryimgarry = array();
        foreach ($_FILES['productgalleryimg']['name'] as $key => $filename) {
          $ext = pathinfo($filename, PATHINFO_EXTENSION);
          $newfilename = "product_gallery_" . time() . "_" . rand(00000, 99999) . "." . $ext;
          if (move_uploaded_file($_FILES['productgalleryimg']['tmp_name'][$key], '../../uploads/banners/' . $newfilename)) {
            $insertgallery = $conn->query("INSERT INTO galleryimg (product_id, name, created_at) VALUES ('" . $last_id . "','" . $newfilename . "','" . date('Y-m-d H:i:s') . "')");
          }
        }
      }
      header("location:" . SITEADMIN . "prdoucts");
    }
  }
}
$getcategory = $conn->query("select * from category where dstatus=0 && status=1 order by name asc");
$getsubcategory = $conn->query("select * from sub_category where dstatus=0 && status=1 order by name asc");
$getbrands = $conn->query("select * from brands where dstatus=0 && status=1 order by name asc");
$size = $conn->query("select * from size where dstatus=0 && status=1");
$color = $conn->query("select * from color where dstatus=0 && status=1");
//prd(("select * from color where dstatus=0 && status=1"));
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
require('../includes/header.php');
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
            <li class="breadcrumb-item"><a href="<?php echo SITEADMIN; ?>Prdoucts">Prdoucts List</a></li>
            <li class="breadcrumb-item active"><?php echo $pagename; ?> Add</li>
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
              <h3 class="card-title"><?php echo $pagename; ?> Add</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input name="name" type="text" class="form-control" id="name" placeholder="Enter Your name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>">
                      <p class="text-danger" id="nameerr"><?php echo isset($titleerr) ? $titleerr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Code</label>
                      <input type="number" name="code" class="form-control" id="code" placeholder=" Enter  code" value="<?php echo isset($_POST['code']) ? $_POST['code'] : '' ?>" onblur="checkcode(this.value)">
                      <p class="text-danger" id="codeerr"><?php echo isset($codeerr) ? $codeerr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Description</label>
                      <textarea name="description" class="form-control" id="description" placeholder=" Enter  Description"><?php echo isset($_POST['description']) ? $_POST['description'] : '' ?></textarea>
                      <p class="text-danger" id="descriptionerr"><?php echo isset($descriptionerr) ? $descriptionerr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Category</label>
                      <select name="category_id" class="form-control" id="categoryid" onchange="getsubcategory(this.value);">
                        <option value="">Select Category</option>
                        <?php while ($singlecategory = $getcategory->fetch_assoc()) { ?>
                          <option value="<?php echo $singlecategory['id']; ?>" <?php echo (isset($_POST['category_id']) && $_POST['category_id'] == $singlecategory['id']) ? 'selected' : '' ?>><?php echo ucfirst($singlecategory['name']); ?></option>
                        <?php } ?>
                      </select>
                      <p class="text-danger" id="categoryiderr"><?php echo isset($Categoryerr) ? $Categoryerr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">SubCategory</label>
                      <select name="subcategory_id" class="form-control subcategorydata" id="subcategoryid">
                        <option value="">Select SubCategory</option>
                        <?php while ($singlecategory = $getsubcategory->fetch_assoc()) { ?>
                          <option value="<?php echo $singlecategory['id']; ?>" <?php echo (isset($_POST['subcategory_id']) && $_POST['subcategory_id'] == $singlecategory['id']) ? 'selected' : '' ?>><?php echo ucfirst($singlecategory['name']); ?></option>
                        <?php } ?>
                      </select>
                      <p class="text-danger" id="subcategoryiderr"><?php echo isset($subcategoryerr) ? $subcategoryerr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Brand</label>
                      <select name="brand_id" id="brandid" class="form-control">
                        <option value="">Select Brand </option>
                        <?php while ($singlebrand = $getbrands->fetch_assoc()) { ?>
                          <option value="<?php echo $singlebrand['id']; ?>" <?php echo (isset($_POST['brand_id']) && $_POST['brand_id'] == $singlebrand['id']) ? 'selected' : '' ?>><?php echo ucfirst($singlebrand['name']); ?></option>
                        <?php } ?>
                      </select>
                      <p class="text-danger" id="brandiderr"><?php echo isset($Branderr) ? $Branderr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">MRP Price</label>
                      <input name="mrp_price" type="number" class="form-control" id="mrp" placeholder=" Enter  MRP Price" value="<?php echo isset($_POST['mrp_price']) ? $_POST['mrp_price'] : '' ?>">
                      <p class="text-danger" id="mrperr"><?php echo isset($mrperr) ? $mrperr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Sell Price</label>
                      <input name="price" type="number" class="form-control" id="price" placeholder=" Enter  price" value="<?php echo isset($_POST['price']) ? $_POST['price'] : '' ?>">
                      <p class="text-danger" id="priceerr"><?php echo isset($priceerr) ? $priceerr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Qty</label>
                      <input name="qty" type="text" class="form-control" id="qty" placeholder=" Enter Qty " value="<?php echo isset($_POST['qty']) ? $_POST['qty'] : '' ?>">
                      <p class="text-danger" id="qtyerr"><?php echo isset($qtyerr) ? $qtyerr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Select Status</label>
                      <select name="status" class="form-control" id="status">
                        <option value="">Select Status</option>
                        <?php foreach ($statusarray as $stkey => $stvalue) {
                          $sel = '';
                          if ($_POST['status'] == $stkey) {
                            $sel = 'selected';
                          }
                          echo '<option value="' . $stkey . '" ' . $sel . '>' . $stvalue . '</option>';
                        } ?>
                      </select>
                    </div>
                    <p class="text-danger" id="statuserr"><?php echo isset($statuserr) ? $statuserr : '' ?></p>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Select Featured</label>
                      <select name="featured" class="form-control" id="Featured">
                        <option value="">Select Featured</option>
                        <?php foreach ($featuredarray as $stkey => $stvalue) {
                          $asl = '';
                          if ($_POST['featured'] == $stkey) {
                            $asl = 'selected';
                          }
                          echo '<option value="' . $stkey . '"' . $asl . '>' . $stvalue . '</option>';
                        } ?>
                      </select>
                      <p class="text-danger" id="Featurederr"><?php echo isset($featurederr) ? $featurederr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Select latest</label>
                      <select name="latest" class="form-control" id="latest">
                        <option value="<?php echo (isset($_POST['latest']) && $_POST['latest'] == $featuredarray) ? 'selected' : '' ?>">Select Featured</option>
                        <?php foreach ($featuredarray as $stkey => $stvalue) {
                          $asl = '';
                          if ($_POST['latest'] == $stkey) {
                            $asl = 'selected';
                          }
                          echo '<option value="' . $stkey . '"' . $asl . '>' . $stvalue . '</option>';
                        } ?>
                      </select>
                      <p class="text-danger" id="latesterr"><?php echo isset($latesterr) ? $latesterr : '' ?></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Image</label>
                      <input name="main_image" type="file" class="form-control" id="myimg" placeholder=" Enter Your Button Text">
                      <p class="text-danger" id="myimgerr"></p>
                    </div>
                  </div>
                  <div class="form-group col-6">
                    <label for="exampleInputFile">Select product Gallery Images</label>
                    <div class="input-group">
                      <input type="file" id="galleryimg" name="productgalleryimg[]" class="form-control col-12" multiple>
                    </div>
                    <p class="text-danger" id="galleryimgerr"></p>
                  </div>
                  <div class="form-group col-6">
                    <label for="exampleInputFile">Product Type</label>
                    <div class="input-group">
                      <select name="product_type" id="product_type" class="form-control">
                        <option value="">Select</option>
                        <option value="1" <?php echo (isset($_POST['product_type']) && $_POST['product_type'] == 1) ? 'selected' : '' ?>>Simple</option>
                        <option value="2" <?php echo (isset($_POST['product_type']) && $_POST['product_type'] == 2) ? 'selected' : '' ?>>Configurable</option>
                      </select>
                    </div>
                  </div>
                  <div class="addmoresize" style="display:<?php echo (isset($_POST['product_type']) && $_POST['product_type'] == 2) ? '' : 'none' ?>;">
                    <?php if (isset($_POST['addsize']) && count($_POST['addsize']) > 0) {
                      foreach ($_POST['addsize'] as $key => $value) {
                    ?>
                        <div class="row">
                          <div class="form-group col-3">
                            <label for="exampleInputFile">Product Size</label>
                            <div class="input-group">
                              <select class="form-control addsize" name="addsize[]" id="">
                                <option value="">Select Product Size</option>
                                <?php foreach ($sizedata as $singlesize) { ?>
                                  <option value="<?php echo $singlesize['id'] ?>" <?php echo ($_POST['addsize'][$key] == $singlesize['id']) ? 'selected' : '' ?>> <?php echo  strtoupper($singlesize['name']) ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <p class="text-danger" id=""></p>
                          </div>
                          <div class="form-group col-3">
                            <label for="exampleInputFile">Product Color</label>
                            <div class="input-group">
                              <select class="form-control addcolor" name="addcolor[]" id="">
                                <option value="">Select Product Color</option>
                                <?php foreach ($colordata as $singlecolordd) { ?>
                                  <option value="<?php echo $singlecolordd['id'] ?>" <?php echo ($_POST['addcolor'][$key] == $singlecolordd['id']) ? 'selected' : '' ?>> <?php echo  strtoupper($singlecolordd['name']) ?></option>
                                <?php } ?>
                              </select>
                              <br>
                              <p class="text-danger" id=colorerr"></p>
                            </div>
                          </div>
                          <div class="form-group col-3">
                            <label for="exampleInputFile">Qty</label>
                            <div class="input-group">
                              <input type="number" name="addqty[]" class="form-control addqty" value="<?php echo $_POST['addqty'][$key]; ?>">
                              <br>
                              <p class="text-danger" id=""></p>
                            </div>
                          </div>
                          <div class="form-group col-3">
                            <label for="exampleInputFile" style="visibility: hidden;">Action</label><br>
                            <a class="btn btn-success rounded-pill addmore" href="javascript:void(0);">Add More</a>
                          </div>
                        </div>
                      <?php }
                    } else { ?>
                      <div class="row">
                        <div class="form-group col-3">
                          <label for="exampleInputFile">Product Size</label>
                          <div class="input-group">
                            <select class="form-control addsize" name="addsize[]" id="">
                              <option value="">Select Product Size</option>
                              <?php foreach ($sizedata as $singlesize) { ?>
                                <option value="<?php echo $singlesize['id'] ?>"> <?php echo  strtoupper($singlesize['name']) ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <p class="text-danger" id=""></p>
                        </div>
                        <div class="form-group col-3">
                          <label for="exampleInputFile">Product Color</label>
                          <div class="input-group">
                            <select class="form-control addcolor" name="addcolor[]" id="">
                              <option value="">Select Product Color</option>
                              <?php foreach ($colordata as $singlecolordd) { ?>
                                <option value="<?php echo $singlecolordd['id'] ?>"> <?php echo  strtoupper($singlecolordd['name']) ?></option>
                              <?php } ?>
                            </select>
                            <br>
                            <p class="text-danger" id=colorerr"></p>
                          </div>
                        </div>
                        <div class="form-group col-3">
                          <label for="exampleInputFile">Qty</label>
                          <div class="input-group">
                            <input type="number" name="addqty[]" class="form-control addqty" value="" id="">
                            <br>
                            <p class="text-danger" id=""></p>
                          </div>
                        </div>
                        <div class="form-group col-3">
                          <label for="exampleInputFile" style="visibility: hidden;">Action</label><br>
                          <a class="btn btn-success rounded-pill addmore" href="javascript:void(0);">Add More</a>
                        </div>
                      </div>
                    <?php }
                    ?>

                  </div>
                  <div class="form-group col-12">
                    <p class="addmoremsg text-danger"></p>
                    <button type="submit" class="btn btn-primary" onclick="return validation()">Submit</button>
                  </div>
            </form>
          </div>
        </div>
        <?php require "../includes/footer.php"; ?>
        <script>
          $('.addmore').click(function() {
            var html = `<div class="row">
                      <div class="form-group col-3">
                        <label for="exampleInputFile">Product Size</label>
                        <div class="input-group">
                          <select class="form-control addsize" name="addsize[]" id="addsize">
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
                          <select class="form-control addcolor" name="addcolor[]" id="addcolor">
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
                              <input type="number" name="addqty[]" class="form-control addqty" value="">
                          <br>
                          <p class="text-danger" id="qtyerr"></p>
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
          $(function() {
            $('#description').summernote({
              placeholder: 'Enter Product Description',
              tabsize: 2,
              height: 300
            });
          });
          $('#product_type').change(function() {
            if ($(this).val() == 1) {
              $('.addmoresize').css('display', 'none');
            } else {
              $('.addmoresize').css('display', 'block');
            }
          });
        </script>
        <script>
          function validation() {
            var valid = 1;
            aname = document.getElementById('name').value;
            if (aname == '') {
              valid = 0;
              document.getElementById('nameerr').innerHTML = '*Plese enter your name';
              document.getElementById('name').focus();
            } else {
              document.getElementById('nameerr').innerHTML = '';
            }
            acode = document.getElementById('code').value;
            if (acode == '') {
              valid = 0;
              document.getElementById('codeerr').innerHTML = '*Plese enter code';
              document.getElementById("code").focus();
            } else {
              document.getElementById('codeerr').innerHTML = '';
            }
            adescription = document.getElementById('description').value;
            if (adescription == '') {
              valid = 0;
              document.getElementById('descriptionerr').innerHTML = '*Plese enter description';
              document.getElementById('description').focus();
            } else {
              document.getElementById('descriptionerr').innerHTML = '';
            }
            acategoryid = document.getElementById('categoryid').value;
            if (acategoryid == '') {
              valid = 0;
              document.getElementById('categoryiderr').innerHTML = '*Plese enter category';
              document.getElementById('categoryid').focus();
            } else {
              document.getElementById('categoryiderr').innerHTML = '';
            }
            asubcategoryid = document.getElementById('subcategoryid').value;
            if (asubcategoryid == '') {
              valid = 0;
              document.getElementById('subcategoryiderr').innerHTML = '*Plese enter subcategory';
              document.getElementById('subcategoryid').focus();
            } else {
              document.getElementById('subcategoryiderr').innerHTML = '';
            }
            abrandid = document.getElementById('brandid').value;
            if (abrandid == '') {
              valid = 0;
              document.getElementById('brandiderr').innerHTML = '*Plese enter brand';
              document.getElementById('brandid').focus();
            } else {
              document.getElementById('brandiderr').innerHTML = '';
            }
            amrp = document.getElementById('mrp').value;
            if (amrp == '') {
              valid = 0;
              document.getElementById('mrperr').innerHTML = '*Plese enter mrp';
              document.getElementById('mrp').focus();
            } else {
              document.getElementById('mrperr').innerHTML = '';
            }
            aprice = document.getElementById('price').value;
            if (aprice == '') {
              valid = 0;
              document.getElementById('priceerr').innerHTML = '*Plese enter price';
              document.getElementById('price').focus();
            } else {
              document.getElementById('priceerr').innerHTML = '';

              if (parseInt(aprice) > parseInt(amrp)) {
                valid = 0;
                document.getElementById("priceerr").innerHTML = "Product Price Cannot Greater Than M.R.P"
                document.getElementById("price").focus();
              } else {
                document.getElementById("priceerr").innerHTML = "";
              }
            }
            aqty = document.getElementById('qty').value;
            if (aqty == '') {
              valid = 0;
              document.getElementById('qtyerr').innerHTML = '*Plese enter qty';
              document.getElementById('qty').focus();
            } else {
              document.getElementById('qtyerr').innerHTML = '';
            }
            astatus = document.getElementById('status').value;
            if (astatus == '') {
              valid = 0;
              document.getElementById('statuserr').innerHTML = '*Plese select status';
              document.getElementById('status').focus();
            } else {
              document.getElementById('statuserr').innerHTML = '';
            }
            astatus = document.getElementById('Featured').value;
            if (astatus == '') {
              valid = 0;
              document.getElementById('Featurederr').innerHTML = '*Plese select Featured';
              document.getElementById('Featured').focus();
            } else {
              document.getElementById('Featurederr').innerHTML = '';
            }
            alatest = document.getElementById('latest').value;
            if (alatest == '') {
              valid = 0;
              document.getElementById('latesterr').innerHTML = '*Plese select latest';
              document.getElementById('latest').focus();
            } else {
              document.getElementById('latesterr').innerHTML = '';
            }
            myimg = document.getElementById('myimg').value;
            if (myimg == '') {
              valid = 0;
              document.getElementById('myimgerr').innerHTML = '*Plese select image';
              document.getElementById('myimg').focus();
            } else {
              document.getElementById('myimgerr').innerHTML = '';
            }
            galleryimg = document.getElementById('galleryimg').value;
            if (galleryimg == '') {
              valid = 0;
              document.getElementById('galleryimgerr').innerHTML = '*Plese select galleryimg';
              document.getElementById('galleryimg').focus();
            } else {
              document.getElementById('galleryimgerr').innerHTML = '';
            }
            product_type = document.getElementById('product_type').value;
            $('.addmoremsg').text('');
            if (product_type == 2) {
              $('.addsize').each(function() {
                if ($(this).val() == '') {
                  valid = 0;
                  $('.addmoremsg').text('Please select all size,color,qty from add more section');
                }
              });
              $('.addcolor').each(function() {
                if ($(this).val() == '') {
                  valid = 0;
                  $('.addmoremsg').text('Please select all size,color,qty from add more section');
                }
              });
              $('.addqty').each(function() {
                if ($(this).val() == '') {
                  valid = 0;
                  $('.addmoremsg').text('Please select all size,color,qty from add more section');
                }
              });
            }

            if (valid == 0) {
              return false;
            }

          }
        </script>