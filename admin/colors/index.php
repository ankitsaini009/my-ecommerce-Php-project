<?php require('../../config.php');
$pagename = "Colors";

if (isset($_GET['pageno'])) {
  $pageno = $_GET['pageno'];
} else {
  $pageno = 1;
}//echo 11;die;
$no_of_records_per_page = 6;
$offset = ($pageno-1) * $no_of_records_per_page;


$addsearch = '';
if(isset($_GET['keyword']) && !empty($_GET['keyword'])){
  $addsearch .= ' && name Like "%'.trim($_GET['keyword']).'%"';
}
if(isset($_GET['status']) && !empty($_GET['status'])){
  $addsearch .= ' && status = "'.$_GET['status'].'"';
}
$countrecord = $conn->query("SELECT * FROM `color` WHERE dstatus=0".$addsearch);


$total_rows = $countrecord->num_rows;

$total_pages = ceil($total_rows / $no_of_records_per_page);


$getdata = $conn->query("SELECT * FROM `color` WHERE dstatus=0".$addsearch." LIMIT ".$offset.",".$no_of_records_per_page);
  require('../includes/header.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo $pagename;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo SITEADMIN;?>dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active"><?php echo $pagename;?></li>
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
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-8">
                    <h3 class="card-title"><?php echo $pagename;?> List</h3>
                  </div>
                  <div class="col-md-4 text-right">
                      <a href="<?php echo SITEADMIN;?>colors/add.php" class="btn btn-success ">Add More</a>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form action="" method="get">
                <div class="row">
                 
                    <div class="col-md-4">
                      <div class="form-group">
                        <input type="text" class="form-control" name="keyword" placeholder="Enter to Search" value="<?php echo isset($_GET['keyword'])?$_GET['keyword']:''?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <select name="status" class="form-control" id="status">
                            <option value="">Select Status</option>
                            <?php foreach ($statusarray as $stkey => $stvalue) {
                              $sel = (isset($_GET['status']) && $_GET['status']==$stkey)?'selected':'';
                              echo '<option value="' . $stkey . '" '.$sel.'>' . $stvalue . '</option>';
                            } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                            <button class="btn btn-success">Search</button>
                            <a href="<?php echo SITEADMIN;?>brands" class="btn btn-danger">Reset</a>
                      </div>
                    </div>
                
                </div>
                </form>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">NO.</th>
                      <th>Color Name</th>
                      <th>Status</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $startno = ($pageno -1)*$no_of_records_per_page; 
                    while($data = $getdata->fetch_assoc()){ ?>
                    <tr>
                      <td><?php echo ++$startno; ?></td>
                      <td><?php echo $data['name']; ?></td>
                      <td><?php echo $data['status']==1?'<span class="badge bg-success">Active</span>':'<span class="badge bg-danger">Inactive</span>'; ?></td>
                      <td style="width: 150px;">
                      <a href="<?php echo SITEADMIN ;?>colors/edit.php?id=<?php echo $data['color_id'] ?>" class="btn-sm btn-success">Edit</a>
                        <a href="javascript:void(0);" onclick="detleterecord('Are You Delete This Brand','<?php echo SITEADMIN;?>colors/delete.php?id=<?php echo $data['color_id'] ?>')" class="btn-sm btn-danger">Delete</a>
                      </td>
                    </tr>
                    <?php } ?>
               
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <!-- /.card-body -->
              <div class="card-footer clearfix">

                <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>

                    <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">

                        <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>

                    </li>
                    <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                        <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
                    </li>

                    <li class="page-item"><a class="page-link" href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
                </ul>

         
              </div>
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

<?php require('../includes/footer.php');?>
