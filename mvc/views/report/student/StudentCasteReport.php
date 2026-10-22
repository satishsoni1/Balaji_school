<div class="row">
    <div class="col-sm-12" style="margin:10px 0px">
        <?php
        $pdf_preview_uri = base_url('studentreport/pdf/' . $reportfor . '/0/0/0/0/0/0/' . $classesID . '/' . $sectionID);
        $xml_preview_uri = base_url('studentreport/xlsx/' . $reportfor . '/0/0/0/0/0/0/' . $classesID . '/' . $sectionID);
        echo btn_pdfPreviewReport('studentreport', $pdf_preview_uri, $this->lang->line('report_pdf_preview'));
        // echo btn_xmlReport('studentreport', $xml_preview_uri, $this->lang->line('report_xlsx'));
        ?>
    </div>
</div>
<div class="box">
    <!-- form start -->
    <div class="box-header bg-gray">
        <h3 class="box-title text-navy"><i class="fa fa-clipboard"></i> Category wise report </h3>
    </div><!-- /.box-header -->
    <div id="printablediv">
        <div class="box-body">
            <div class="row">
                <div class="col-sm-12">
                    <?= reportheader($siteinfos, $schoolyearsessionobj) ?>
                </div>
                <div class="col-sm-12"></div>
                <div class="col-sm-12">
                    <?php if (customCompute($students)) {
                    ?>
                        <div id="hide-table">
                        <table id="example1" class="table table-striped table-bordered table-hover attendance_table dataTable no-footer">
                                <thead>
                                    <tr>
                                        <th rowspan="2">S.No.</th>
                                        <th rowspan="2">Class Teacher Name</th>
                                        <th rowspan="2">Class</th>
                                        <th colspan=2>SC</th>
                                        <th colspan=2>ST</th>
                                        <th colspan=2>OBC</th>
                                        <th colspan=2>VJ</th>
                                        <th colspan=2>NT</th>
                                        <th colspan=2>MUSLIM</th>
                                        <th colspan=2>JAIN</th>
                                        <th colspan=2>OPEN</th>
                                        <th colspan=2>Total</th>
                                        <th rowspan="2">Total</th>
                                        <th rowspan="2">Classes Total</th>
                                    </tr>
                                    <tr>

                                        <th>Girls</th>
                                        <th>Boys</th>
                                        <th>Girls</th>
                                        <th>Boys</th>
                                        <th>Girls</th>
                                        <th>Boys</th>
                                        <th>Girls</th>
                                        <th>Boys</th>
                                        <th>Girls</th>
                                        <th>Boys</th>
                                        <th>Girls</th>
                                        <th>Boys</th>
                                        <th>Girls</th>
                                        <th>Boys</th>
                                        <th>Girls</th>
                                        <th>Boys</th>
                                        <th>Girls</th>
                                        <th>Boys</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php $i = 0;
                                    $sc_male = 0;
                                    $sc_female = 0;

                                    $st_male = 0;
                                    $st_female = 0;

                                    $obc_male = 0;
                                    $obc_female = 0;

                                    $vj_male = 0;
                                    $vj_female = 0;

                                    $nt_male = 0;
                                    $nt_female = 0;

                                    $muslim_male = 0;
                                    $muslim_female = 0;

                                    $jain_male = 0;
                                    $jain_female = 0;

                                    $open_male = 0;
                                    $open_female = 0;
                                    foreach ($students  as $student) {
                                        $category = $student['row'];
                                        $sc_male += $category['SC']['male'];
                                        $sc_female += $category['SC']['female'];
    
                                        $st_male += $category['ST']['male'];
                                        $st_female += $category['ST']['female'];
    
                                        $obc_male += $category['OBC']['male'];
                                        $obc_female += $category['OBC']['female'];
    
                                        $vj_male += $category['VJ']['male'];
                                        $vj_female += $category['VJ']['female'];
    
                                        $nt_male += $category['NT']['male'];
                                        $nt_female += $category['NT']['female'];
    
                                        $muslim_male += $category['MUSLIM']['male'];
                                        $muslim_female += $category['MUSLIM']['female'];
    
                                        $jain_male += $category['JAIN']['male'];
                                        $jain_female += $category['JAIN']['female'];
    
                                        $open_male += $category['OPEN']['male'];
                                        $open_female += $category['OPEN']['female'];

                                        $i++; ?>
                                        <tr>
                                            <td data-title="S.No."><?= $i ?></td>

                                            <td data-title=""><?= $student['teacher_name'] ?></td>

                                            <td data-title=""><?= $student['section'] ?></td>
                                            
                                            <td data-title=""><?= $category['SC']['female'] ?></td>
                                            <td data-title=""><?= $category['SC']['male'] ?></td>

                                            <td data-title=""><?= $category['ST']['female'] ?></td>
                                            <td data-title=""><?= $category['ST']['male'] ?></td>
                                            <td data-title=""><?= $category['OBC']['female'] ?></td>
                                            <td data-title=""><?= $category['OBC']['male'] ?></td>
                                            

                                            <td data-title=""><?= $category['VJ']['female'] ?></td>
                                            <td data-title=""><?= $category['VJ']['male'] ?></td>
                                            
                                            <td data-title=""><?= $category['NT']['female'] ?></td>
                                            <td data-title=""><?= $category['NT']['male'] ?></td>

                                            <td data-title=""><?= $category['MUSLIM']['female'] ?></td>
                                            <td data-title=""><?= $category['MUSLIM']['male'] ?></td>
                                            <td data-title=""><?= $category['JAIN']['female'] ?></td>
                                            <td data-title=""><?= $category['JAIN']['male'] ?></td>
                                            <td data-title=""><?= $category['OPEN']['female'] ?></td>
                                            <td data-title=""><?= $category['OPEN']['male'] ?></td>

                                            
                                            
                                            

                                            <td data-title=""><?= $category['JAIN']['female']+$category['MUSLIM']['female']+$category['NT']['female']+$category['VJ']['female']+$category['SC']['female']+$category['ST']['female']+$category['OBC']['female']+$category['OPEN']['female'] ?></td>
                                            <td data-title=""><?= $category['JAIN']['male']+$category['MUSLIM']['male']+$category['NT']['male']+$category['VJ']['male']+$category['SC']['male']+$category['ST']['male']+$category['OBC']['male']+$category['OPEN']['male'] ?></td>

                                            <td data-title=""><?= $category['JAIN']['female']+$category['MUSLIM']['female']+$category['NT']['female']+$category['VJ']['female']+$category['SC']['female']+$category['ST']['female']+$category['OBC']['female']+$category['OPEN']['female']+$category['JAIN']['male']+$category['MUSLIM']['male']+$category['NT']['male']+$category['VJ']['male']+$category['SC']['male']+$category['ST']['male']+$category['OBC']['male']+$category['OPEN']['male'] ?></td>
                                            <td data-title=""><?= $category['JAIN']['female']+$category['MUSLIM']['female']+$category['NT']['female']+$category['VJ']['female']+$category['SC']['female']+$category['ST']['female']+$category['OBC']['female']+$category['OPEN']['female']+$category['JAIN']['male']+$category['MUSLIM']['male']+$category['NT']['male']+$category['VJ']['male']+$category['SC']['male']+$category['ST']['male']+$category['OBC']['male']+$category['OPEN']['male'] ?></td>
                                            
                                        </tr>
                                    <?php } ?>

                                </tbody>
                                <tfooter>
                                <tr>
                                <td colspan="3">Total</td>
                                <th><?= $sc_female ?></th>
                                <td><?= $sc_male ?></td>
                                <td><?= $st_female ?></td>
                                <td><?= $st_male ?></td>
                                <td><?= $obc_female ?></td>
                                <td><?= $obc_male ?></td>
                                <td><?= $vj_female ?></td>
                                <td><?= $vj_male ?></td>
                                <td><?= $nt_female ?></td>
                                <td><?= $nt_male ?></td>
                                <td><?= $muslim_female ?></td>
                                <td><?= $musilm_male ?></td>
                                <td><?= $jain_female ?></td>
                                <td><?= $jain_male ?></td>
                                <td><?= $open_female ?></td>
                                <td><?= $open_male ?></td>
                                <td><?= $muslim_female+$open_female+$jain_female+$nt_female+$vj_female+$obc_female+$st_female+$sc_female ?></td>
                                <td><?= $muslim_male+$open_male+$jain_male+$nt_male+$vj_male+$obc_male+$st_male+$sc_male ?></td>
                                <td><?= $muslim_male+$open_male+$jain_male+$nt_male+$vj_male+$obc_male+$st_male+$sc_male+$muslim_female+$open_female+$jain_female+$nt_female+$vj_female+$obc_female+$st_female+$sc_female ?></td>
                                <td><?= $muslim_male+$open_male+$jain_male+$nt_male+$vj_male+$obc_male+$st_male+$sc_male+$muslim_female+$open_female+$jain_female+$nt_female+$vj_female+$obc_female+$st_female+$sc_female ?></td>
                                
                                
                                </tr>
                                </tfooter>
                            </table>
                        </div>
                </div>
            <?php } else { ?>
                <div class="callout callout-danger">
                    <p><b class="text-info"><?= $this->lang->line('studentreport_student_not_found') ?></b></p>
                </div>
            <?php } ?>
            <div class="col-sm-12 text-center footerAll">
                <?= reportfooter($siteinfos, $schoolyearsessionobj) ?>
            </div>

            </div><!-- row -->
        </div><!-- Body -->
    </div>
</div>

<!-- email modal starts here -->
<form class="form-horizontal" role="form" action="<?= base_url('attendanceoverviewreport/send_pdf_to_mail'); ?>" method="post">
    <div class="modal fade" id="mail">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('attendanceoverviewreport_close') ?></span></button>
                    <h4 class="modal-title"><?= $this->lang->line('attendanceoverviewreport_mail') ?></h4>
                </div>
                <div class="modal-body">

                    <?php
                    if (form_error('to'))
                        echo "<div class='form-group has-error' >";
                    else
                        echo "<div class='form-group' >";
                    ?>
                    <label for="to" class="col-sm-2 control-label">
                        <?= $this->lang->line("attendanceoverviewreport_to") ?> <span class="text-red">*</span>
                    </label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control" id="to" name="to" value="<?= set_value('to') ?>">
                    </div>
                    <span class="col-sm-4 control-label" id="to_error">
                    </span>
                </div>

                <?php
                if (form_error('subject'))
                    echo "<div class='form-group has-error' >";
                else
                    echo "<div class='form-group' >";
                ?>
                <label for="subject" class="col-sm-2 control-label">
                    <?= $this->lang->line("attendanceoverviewreport_subject") ?> <span class="text-red">*</span>
                </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="subject" name="subject" value="<?= set_value('subject') ?>">
                </div>
                <span class="col-sm-4 control-label" id="subject_error">
                </span>

            </div>

            <?php
            if (form_error('message'))
                echo "<div class='form-group has-error' >";
            else
                echo "<div class='form-group' >";
            ?>
            <label for="message" class="col-sm-2 control-label">
                <?= $this->lang->line("attendanceoverviewreport_message") ?>
            </label>
            <div class="col-sm-6">
                <textarea class="form-control" id="message" style="resize: vertical;" name="message" value="<?= set_value('message') ?>"></textarea>
            </div>
        </div>


    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" style="margin-bottom:0px;" data-dismiss="modal"><?= $this->lang->line('close') ?></button>
        <input type="button" id="send_pdf" class="btn btn-success" value="<?= $this->lang->line("attendanceoverviewreport_send") ?>" />
    </div>
    </div>
    </div>
    </div>
</form>
<!-- email end here -->

<script type="text/javascript">
              $(document).ready(function () {
            
          

          $(document).ready(function () {
            $('#example3, #example1, #example2').DataTable({
              dom : 'Bfrtip',
              buttons : [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
              ],
            });
          });
        });
    function check_email(email) {
        var status = false;
        var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
        if (email.search(emailRegEx) == -1) {
            $("#to_error").html('');
            $("#to_error").html("<?= $this->lang->line('attendanceoverviewreport_mail_valid') ?>").css("text-align", "left").css("color", 'red');
        } else {
            status = true;
        }
        return status;
    }


    $('#send_pdf').click(function() {
        var field = {
            'to': $('#to').val(),
            'subject': $('#subject').val(),
            'message': $('#message').val(),
            'usertype': '<?= $usertype ?>',
            'classesID': '<?= $classesID ?>',
            'sectionID': '<?= $sectionID ?>',
            'subjectID': '<?= $subjectID ?>',
            'userID': '<?= $userID ?>',
            'monthID': '<?= $monthdays ?>'
        };

        var to = $('#to').val();
        var subject = $('#subject').val();
        var error = 0;

        $("#to_error").html("");
        $("#subject_error").html("");

        if (to == "" || to == null) {
            error++;
            $("#to_error").html("<?= $this->lang->line('attendanceoverviewreport_mail_to') ?>").css("text-align", "left").css("color", 'red');
        } else {
            if (check_email(to) == false) {
                error++
            }
        }

        if (subject == "" || subject == null) {
            error++;
            $("#subject_error").html("<?= $this->lang->line('attendanceoverviewreport_mail_subject') ?>").css("text-align", "left").css("color", 'red');
        } else {
            $("#subject_error").html("");
        }

        if (error == 0) {
            $('#send_pdf').attr('disabled', 'disabled');
            $.ajax({
                type: 'POST',
                url: "<?= base_url('attendanceoverviewreport/send_pdf_to_mail') ?>",
                data: field,
                dataType: "html",
                success: function(data) {
                    var response = JSON.parse(data);
                    if (response.status == false) {
                        $('#send_pdf').removeAttr('disabled');
                        $.each(response, function(index, value) {
                            if (index != 'status') {
                                toastr["error"](value)
                                toastr.options = {
                                    "closeButton": true,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": false,
                                    "positionClass": "toast-top-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "500",
                                    "hideDuration": "500",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                }
                            }
                        });
                    } else {
                        location.reload();
                    }
                }
            });
        }
    });
</script>