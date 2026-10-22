<div id="printablediv">
    <div class="box">
        <div class="box-header bg-gray">
            <h3 class="box-title text-navy"><i class="fa fa-clipboard"></i>
                <?= $this->lang->line('certificatereport_report_for'); ?> <?= $this->lang->line('certificatereport_report'); ?> -
                <?= $this->lang->line('certificatereport_class') ?> <?= isset($classes[$classesID]) ? $classes[$classesID] : '' ?> <?= isset($sections[$sectionID]) ? "( " . $sections[$sectionID] . " )" : '' ?> </h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a data-toggle="tab" href="#new" aria-expanded="true">New Leaving Certificate</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#old" aria-expanded="true">Old Leaving Certificate</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="new">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <h5 class="pull-left">
                                            <?php
                                            echo $this->lang->line('certificatereport_class') . " : ";
                                            echo isset($classes[$classesID]) ? $classes[$classesID] : $this->lang->line('balancefeesreport_all_class');
                                            ?>
                                        </h5>
                                        <h5 class="pull-right">
                                            <?php
                                            echo $this->lang->line('certificatereport_section') . " : ";
                                            echo isset($sections[$sectionID]) ? $sections[$sectionID] : $this->lang->line('certificatereport_all_section');
                                            ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                
                                    <?php if (customCompute($students)) { ?>
                                        <form class="form-horizontal">
                                        <div class="col-sm-7" style="margin-top:2rem"  id="studentDiv">
                                        <div class='form-group'>
                                            <label for="studentID" class="col-sm-4 control-label">Select Student<span class="text-red"> * </span></label>
                                            <div class="col-sm-6">
                                                <?php
                                                
                                                $array = array("0" => $this->lang->line("certificatereport_please_select"));
                                                if (customCompute($students)) {
                                                    foreach ($students as $student) {
                                                        if(existsInArray($student,$studentstc)) {
                                                        }else{
                                                            $array[$student->srstudentID] = $student->srname;
                                                        }
                                                    }
                                                }
                                                echo form_dropdown("studentID", $array, set_value("studentID"), "id='studentID' class='form-control select2'");
                                                ?>
                                            </div>
                                            </div>
                                        </div>
                                        </form>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12" id="studentinfo" style="display: none;">
                                    </div>

                                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" id="generate_tc_form">
                                        <div class="col-sm-7" id="tcinfo"  style="display: none;">

                                            <?php
                                            if (form_error('lc_no'))
                                                echo "<div class='form-group has-error' >";
                                            else
                                                echo "<div class='form-group' >";
                                            ?>
                                            <label for="lc_no" class="col-sm-4 control-label">
                                                <?= $this->lang->line("lc_no") ?> <span class="text-red">*</span>
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="lc_no" name="lc_no" value="<?= set_value('form_no') ?>">
                                            </div>
                                            <span class="col-sm-4 control-label">
                                                <?php echo form_error('lc_no'); ?>
                                            </span>
                                        </div>
                                        <?php
                                        if (form_error('progress'))
                                            echo "<div class='form-group has-error' >";
                                        else
                                            echo "<div class='form-group' >";
                                        ?>
                                        <label for="progress" class="col-sm-4 control-label">
                                            <?= $this->lang->line("progress") ?> <span class="text-red">*</span>
                                        </label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="progress" name="progress" value="<?= set_value('progress') ?>">
                                        </div>
                                        <span class="col-sm-4 control-label">
                                            <?php echo form_error('progress'); ?>
                                        </span>
                                </div>
                                <?php
                                        if (form_error('conduct'))
                                            echo "<div class='form-group has-error' >";
                                        else
                                            echo "<div class='form-group' >";
                                ?>
                                <label for="conduct" class="col-sm-4 control-label">
                                    <?= $this->lang->line("conduct") ?> <span class="text-red">*</span>
                                </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="conduct" name="conduct" value="<?= set_value('conduct') ?>">
                                </div>
                                <span class="col-sm-4 control-label">
                                    <?php echo form_error('conduct'); ?>
                                </span>
                            </div>
                            <?php
                                        if (form_error('date_of_leaving_school'))
                                            echo "<div class='form-group has-error' >";
                                        else
                                            echo "<div class='form-group' >";
                            ?>
                            <label for="date_of_leaving_school" class="col-sm-4 control-label">
                                <?= $this->lang->line("date_of_leaving_school") ?> <span class="text-red">*</span>
                            </label>
                            <div class="col-sm-6">
                                <input type="date" class="form-control date" id="date_of_leaving_school" name="date_of_leaving_school" value="<?= set_value('date_of_leaving_school') ?>">
                            </div>
                            <span class="col-sm-4 control-label">
                                <?php echo form_error('date_of_leaving_school'); ?>
                            </span>
                        </div>
                        <?php
                                        if (form_error('reason_of_leaving'))
                                            echo "<div class='form-group has-error' >";
                                        else
                                            echo "<div class='form-group' >";
                        ?>
                        <label for="reason_of_leaving" class="col-sm-4 control-label">
                            <?= $this->lang->line("reason_of_leaving") ?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="reason_of_leaving" name="reason_of_leaving" value="<?= set_value('reason_of_leaving') ?>">
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('reason_of_leaving'); ?>
                        </span>
                    </div>
                    <?php
                                        if (form_error('standred_in_which_admission'))
                                            echo "<div class='form-group has-error' >";
                                        else
                                            echo "<div class='form-group' >";
                            ?>
                            <label for="standred_in_which_admission" class="col-sm-4 control-label">
                                <?= $this->lang->line("standred_in_which_admission") ?> <span class="text-red">*</span>
                            </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="standred_in_which_admission" name="standred_in_which_admission" value="<?= set_value('standred_in_which_admission') ?>">
                            </div>
                            <span class="col-sm-4 control-label">
                                <?php echo form_error('standred_in_which_admission'); ?>
                            </span>
                        </div>
                        <?php
                                        if (form_error('date_of_admission'))
                                            echo "<div class='form-group has-error' >";
                                        else
                                            echo "<div class='form-group' >";
                            ?>
                            <label for="date_of_admission" class="col-sm-4 control-label">
                                <?= $this->lang->line("date_of_admission") ?> <span class="text-red">*</span>
                            </label>
                            <div class="col-sm-6">
                                <input type="date" class="form-control date" id="date_of_admission" name="date_of_admission" value="<?= set_value('date_of_admission') ?>">
                            </div>
                            <span class="col-sm-4 control-label">
                                <?php echo form_error('date_of_admission'); ?>
                            </span>
                        </div>
                        <?php
                                        if (form_error('standred_in_which_studing'))
                                            echo "<div class='form-group has-error' >";
                                        else
                                            echo "<div class='form-group' >";
                            ?>
                            <label for="standred_in_which_studing" class="col-sm-4 control-label">
                                <?= $this->lang->line("standred_in_which_studing") ?> <span class="text-red">*</span>
                            </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="standred_in_which_studing" name="standred_in_which_studing" value="<?= set_value('standred_in_which_studing') ?>">
                            </div>
                            <span class="col-sm-4 control-label">
                                <?php echo form_error('standred_in_which_studing'); ?>
                            </span>
                        </div>
                        <?php
                                        if (form_error('since_when'))
                                            echo "<div class='form-group has-error' >";
                                        else
                                            echo "<div class='form-group' >";
                            ?>
                            <label for="since_when" class="col-sm-4 control-label">
                                <?= $this->lang->line("since_when") ?> <span class="text-red">*</span>
                            </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="since_when" name="since_when" value="<?= set_value('since_when') ?>">
                            </div>
                            <span class="col-sm-4 control-label">
                                <?php echo form_error('since_when'); ?>
                            </span>
                        </div>
                    <?php
                                        if (form_error('remarks'))
                                            echo "<div class='form-group has-error' >";
                                        else
                                            echo "<div class='form-group' >";
                    ?>
                    <label for="remarks" class="col-sm-4 control-label">
                        <?= $this->lang->line("remarks") ?> <span class="text-red">*</span>
                    </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="remarks" name="remarks" value="<?= set_value('remarks') ?>">
                    </div>
                    <span class="col-sm-4 control-label">
                        <?php echo form_error('remarks'); ?>
                    </span>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8">
                    <button id="generate_tc" class="btn btn-success" style="margin-top:23px;"> <?=$this->lang->line("add_certificate")?></button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    <?php } else { ?>
        <div class="callout callout-danger">
            <p><b class="text-info"><?= $this->lang->line('certificatereport_student_not_found') ?></b></p>
        </div>
    <?php } ?>
    </div>
    <div class="tab-pane" id="old">

        <div class="row">
            <div class="col-sm-12">
                <h5 class="pull-left">
                    <?php
                    echo $this->lang->line('certificatereport_class') . " : ";
                    echo isset($classes[$classesID]) ? $classes[$classesID] : $this->lang->line('balancefeesreport_all_class');
                    ?>
                </h5>
                <h5 class="pull-right">
                    <?php
                    echo $this->lang->line('certificatereport_section') . " : ";
                    echo isset($sections[$sectionID]) ? $sections[$sectionID] : $this->lang->line('certificatereport_all_section');
                    ?>
                </h5>
            </div>
        </div>
        <?php if (customCompute($studentstc)) { ?>
            <div id="hide-table">
                <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                    <thead>
                        <tr>
                            <th class="col-sm-1">#</th>
                            <th class="col-sm-1"><?= $this->lang->line('certificatereport_photo') ?></th>
                            <th class="col-sm-2"><?= $this->lang->line('certificatereport_name') ?></th>
                            <th class="col-sm-2"><?= $this->lang->line('certificatereport_class') ?></th>
                            <th class="col-sm-1"><?= $this->lang->line('certificatereport_section') ?></th>
                            <th class="col-sm-1"><?= $this->lang->line('certificatereport_roll') ?></th>
                            <th class="col-sm-1"><?= $this->lang->line('certificatereport_action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($studentstc as $student) { ?>
                            <tr>
                                <td data-title="#">
                                    <?= $i ?>
                                </td>

                                <td data-title="<?= $this->lang->line('certificatereport_photo') ?>">
                                    <?= profileimage($student->photo) ?>
                                </td>
                                <td data-title="<?= $this->lang->line('certificatereport_name') ?>">
                                    <?= $student->srname; ?>
                                </td>
                                <td data-title="<?= $this->lang->line('certificatereport_class') ?>"><?= $classes[$student->srclassesID]; ?></td>
                                <td data-title="<?= $this->lang->line('certificatereport_section') ?>"><?= $sections[$student->srsectionID]; ?></td>

                                <td data-title="<?= $this->lang->line('certificatereport_roll') ?>">
                                    <?= $student->srroll; ?>
                                </td>

                                <td data-title="<?= $this->lang->line('certificatereport_action') ?>">
                                    <a class="btn btn-success btn-sm" target="_blank" href="<?= base_url('leavingcertificate/generate_certificate/' . $student->srstudentID . '/' . $student->usertypeID . '/' . $templateID . '/' . $student->srclassesID) ?>"><?= $this->lang->line('certificatereport_generate_certificate') ?></a>
                                </td>
                            </tr>
                        <?php $i++;
                        } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div class="callout callout-danger">
                <p><b class="text-info"><?= $this->lang->line('certificatereport_student_not_found') ?></b></p>
            </div>
        <?php } ?>
    </div>
</div>
</div>
</div>
</div><!-- row -->
</div><!-- Body -->
</div>
</div>
<script type="text/javascript">
 $('#studentID').select2();
    $("#studentID").change(function() {

        var id = $(this).val();

        if (id == '0') {

        } else {
            $.ajax({
                type: 'POST',
                url: "<?= base_url('leavingcertificate/getStudentInfo') ?>",
                data: {
                    "id": id
                },
                dataType: "json",
                success: function(data) {
                    if(data.due > 0)
                        $('#studentinfo').html('<div class="callout callout-danger"><p><b class="text-info">Note: This student\'s fee is not yet paid. '+data.due+' INR is owed.</b></p></div>');
                    else
                        $('#studentinfo').html('<div class="callout callout-success"><p><b class="text-info">Note: No dues</b></p></div>');
                    
                    $('#studentinfo').show();
                    $('#tcinfo').show();
                }
            });
        }
    });
    $(document).on('click','#generate_tc', function(e) {
        e.preventDefault();
        var error = 0 ;
        var field = $('#generate_tc_form').serialize()+ '&studentID=' + $("#studentID").val();
        if(error === 0) {
            makingPostDataPreviousofAjaxCallTc(field);
        }
    });
    function makingPostDataPreviousofAjaxCallTc(field) {
        passData = field;
        ajaxCallTc(passData);
    }
    function ajaxCallTc(passData) {

        $.ajax({
            type: 'POST',
            url: "<?=base_url('leavingcertificate/generate_tc')?>",
            data: passData,
            dataType: "html",
            success: function(data) {
                var response = JSON.parse(data);
                renderLoderTc(response, passData);
            }
        });
    }
    function renderLoderTc(response, passData) {
        if(response.status) {
           // $('#load_certificatereport').html(response.render);
            for (var key in passData) {
                if (passData.hasOwnProperty(key)) {
                    $('#'+key).parent().removeClass('has-error');
                }
            }
            window.open(response.tc, "_blank");
            $('#get_student_list').trigger('click');
        } else {
            for (var key in passData) {
                if (passData.hasOwnProperty(key)) {
                    $('#'+key).parent().removeClass('has-error');
                }
            }

            for (var key in response) {
                if (response.hasOwnProperty(key)) {
                    $('#'+key).parent().addClass('has-error');
                }
            }
        }
    }
</script>