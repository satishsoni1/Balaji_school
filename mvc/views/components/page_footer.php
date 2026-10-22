        </div>
        <script type="text/javascript" src="<?php echo base_url('assets/bootstrap/bootstrap.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/inilabs/style.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/datatables/tools/jquery.dataTables.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/datatables/tools/dataTables.buttons.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/datatables/tools/jszip.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/datatables/tools/pdfmake.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/datatables/tools/vfs_fonts.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/datatables/tools/buttons.html5.min.js'); ?>"></script>
        <script type="text/javascript" src="//cdn.datatables.net/buttons/1.5.3/js/buttons.colVis.js"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/inilabs/inilabs.js'); ?>"></script>
        <script type="text/javascript">
          $(document).ready(function () {
            $(document).ajaxStart(function () {
              $("#loading").show();
            }).ajaxStop(function () {
              $("#loading").hide();
            });
          });

          $(document).ready(function () {
            $('#example3, #example1, #example2').DataTable({
              dom : 'Bfrtip',
              buttons : [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                {
      extend: 'pdfHtml5',
      pageSize: 'A4', // optional
      customize: function (doc) {
        // Add custom header on every page
        doc.content.splice(0, 0, {
          text: 'Shri Balaji English Primary and Secondary School, Wadegao\nAcademic Year : 2025-2026', // <<-- change this to your school name or title
          fontSize: 14,
          alignment: 'center',
          margin: [0, 0, 0, 20], // left, top, right, bottom
          bold: true
        });
      }
    }
              ],
            });
          });
        </script>

        <script type="text/javascript">
          $(function () {
            $("#withoutBtn").dataTable();
          });
        </script>

        <?php if ($this->session->flashdata('success')): ?>
            <script type="text/javascript">
              toastr[ "success" ]("<?=$this->session->flashdata('success');?>");
              toastr.options = {
                "closeButton" : true,
                "debug" : false,
                "newestOnTop" : false,
                "progressBar" : false,
                "positionClass" : "toast-top-right",
                "preventDuplicates" : false,
                "onclick" : null,
                "showDuration" : "500",
                "hideDuration" : "500",
                "timeOut" : "5000",
                "extendedTimeOut" : "1000",
                "showEasing" : "swing",
                "hideEasing" : "linear",
                "showMethod" : "fadeIn",
                "hideMethod" : "fadeOut"
              }
            </script>
        <?php endif ?>
        <?php if ($this->session->flashdata('error')): ?>
            <script type="text/javascript">
              toastr[ "error" ]("<?=$this->session->flashdata('error');?>");
              toastr.options = {
                "closeButton" : true,
                "debug" : false,
                "newestOnTop" : false,
                "progressBar" : false,
                "positionClass" : "toast-top-right",
                "preventDuplicates" : false,
                "onclick" : null,
                "showDuration" : "500",
                "hideDuration" : "500",
                "timeOut" : "5000",
                "extendedTimeOut" : "1000",
                "showEasing" : "swing",
                "hideEasing" : "linear",
                "showMethod" : "fadeIn",
                "hideMethod" : "fadeOut"
              }
            </script>
        <?php endif ?>

        <?php
            if ( isset($footerassets) ) {
                foreach ( $footerassets as $assetstype => $footerasset ) {
                    if ( $assetstype == 'css' ) {
                        if ( customCompute($footerasset) ) {
                            foreach ( $footerasset as $keycss => $css ) {
                                echo '<link rel="stylesheet" href="' . base_url($css) . '">' . "\n";
                            }
                        }
                    } elseif ( $assetstype == 'js' ) {
                        if ( customCompute($footerasset) ) {
                            foreach ( $footerasset as $keyjs => $js ) {
                                echo '<script type="text/javascript" src="' . base_url($js) . '"></script>' . "\n";
                            }
                        }
                    }
                }
            }
        ?>
        
        <script type="text/javascript">
            $("ul.sidebar-menu li").each(function() {
                if($(this).attr('class') === 'active') {
                    $(this).parents('li').addClass('active');
                }
            });

            $(document).ready(function () {
              setTimeout(function () {
                $.ajax({
                  type : 'GET',
                  dataType : "html",
                  async : false,
                  url : "<?=base_url('alert/alert')?>",
                  success : function (data) {
                    $(".my-push-message-list").html(data);
                    var alertNumber = 0;
                    $('.my-push-message-list li').each(function () {
                      alertNumber++;
                    });
                    if (alertNumber > 0) {
                      $('.my-push-message-ul').removeAttr('style');
                      $('.my-push-message-a').append('<span class="label label-danger"><lable class="alert-image">' + alertNumber + '</lable> </span>');
                      $('.my-push-message-number').html('<?=$this->lang->line("la_fs") . " "?>' + alertNumber + '<?=" " . $this->lang->line("la_ls")?>');
                    } else {
                      $('.my-push-message-ul').remove();
                    }
                  }
                });
              }, 5000);
            });
        </script>
    </body>
</html>
