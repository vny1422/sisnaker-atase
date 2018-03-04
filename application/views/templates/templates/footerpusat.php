<div>
  <br><br><br>
</div>
<!-- footer content -->
        <footer>
          <div class="pull-right">
            SISNAKER-ATASE | Kementerian Ketenagakerjaan Republik Indonesia
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <script src="<?php echo base_url('assets/js/md5.min.js'); ?>" ></script>

    <script src="<?php echo base_url('assets/js/jquery.fileDownload.js'); ?>" ></script>

    <script src="<?php echo base_url('assets/js/jquery-ui.js'); ?>" ></script>

    <!-- FastClick -->
    <script src="<?php echo base_url('assets/vendors/fastclick/lib/fastclick.js'); ?>"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url('assets/vendors/nprogress/nprogress.js'); ?>"></script>
    <!-- jQuery custom content scroller -->
    <script src="<?php echo base_url('assets/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>
    <!-- icheck -->
    <script src="<?php echo base_url('assets/js/icheck/icheck.min.js'); ?>"></script>
    <!-- Datatables-->
        <script src="<?php echo base_url('assets/js/datatables/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/datatables/dataTables.bootstrap.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/datatables/dataTables.buttons.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/datatables/buttons.bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/datatables/jszip.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/datatables/pdfmake.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/datatables/vfs_fonts.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/datatables/buttons.html5.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/datatables/buttons.print.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/datatables/dataTables.fixedHeader.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/datatables/dataTables.keyTable.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/datatables/dataTables.responsive.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/datatables/responsive.bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/datatables/dataTables.scroller.min.js'); ?>"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url('assets/build/js/custom.min.js'); ?>"></script>

    <!-- JS Endoresement Table -->
    <script src="<?php echo base_url('assets/js/underscore-min.js'); ?>"></script>

    <!-- Loadmask JS for loading -->
    <script src="<?php echo base_url('assets/js/jquery.loadmask.min.js'); ?>"></script>

    <!-- Ladda -->
    <script src="<?php echo base_url('assets/js/spin.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/ladda.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/ladda.jquery.min.js'); ?>"></script>

    <!-- Select -->
    <script src="<?php echo base_url('assets/js/select/select2.full.min.js'); ?>"></script>
    <!-- Bootstrap Progressbar JavaScript -->
    <script src="<?php echo base_url('assets/js/progressbar/bootstrap-progressbar.min.js') ?>"></script>

    <!-- Datatables -->
    <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        $('#datatable').dataTable();

        $('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
          'order': [[ 1, 'asc' ]],
          'columnDefs': [
            { orderable: false, targets: [0] }
          ]
        });
        $datatable.on('draw.dt', function() {
          $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green'
          });
        });

        TableManageButtons.init();
      });
    </script>
    <!-- /Datatables -->

    <!-- Tambahan ++ JS -->
    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>
  </body>
</html>
