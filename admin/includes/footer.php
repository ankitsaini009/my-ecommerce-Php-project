</div>
      <!-- /.row -->
    </div><!--/. container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper --><!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>

  </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="<?php echo SITEURL; ?>assets/admin/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="<?php echo SITEURL; ?>assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?php echo SITEURL; ?>assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo SITEURL; ?>assets/admin/dist/js/adminlte.js"></script>

  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="<?php echo SITEURL; ?>assets/admin/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
  <script src="<?php echo SITEURL; ?>assets/admin/plugins/raphael/raphael.min.js"></script>
  <script src="<?php echo SITEURL; ?>assets/admin/plugins/jquery-mapael/jquery.mapael.min.js"></script>
  <script src="<?php echo SITEURL; ?>assets/admin/plugins/jquery-mapael/maps/usa_states.min.js"></script>
  <!-- ChartJS -->
  <script src="<?php echo SITEURL; ?>assets/admin/plugins/chart.js/Chart.min.js"></script>
  <script src="<?php echo SITEURL; ?>assets/bootbox.all.min.js"></script>



  <!-- AdminLTE for demo purposes -->
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?php echo SITEURL; ?>assets/admin/dist/js/pages/dashboard2.js"></script>
  <script src="<?php echo SITEURL; ?>assets/admin/plugins/summernote/summernote-bs4.min.js"></script>
  <script>
    function detleterecord(recordid, id) {
      bootbox.confirm({
        message: recordid,
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
            window.location.href = id;
          }
        }
      });

    }

    function getsubcategory(categoryid){
          $.ajax({
            type: "POST",
            url: "<?php echo SITEADMIN;?>ajax/ajaxsubcategory.php",
            data: {catid:categoryid,type:'user'},
            success: function(data){
              //console.log(data);
              //alert(data);
              $(".subcategorydata").html(data);
            }
          });
    }

    function checkcode(code){
      $('.codeerr').text('');
      $.ajax({
            type: "GET",
            url: "<?php echo SITEADMIN;?>ajax/checkproductcode.php",
            data: {code:code},
            success: function(data){
              if(data !=0){
                $('.codeerr').text('This code already taken');
                $('#code').val('');
              }
            }
          });
    }
  </script>

  </body>

  </html>