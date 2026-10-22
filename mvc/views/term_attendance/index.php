<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-calendar-check-o"></i> Term 1 & Term 2 Attendance</h3>
        <ol class="breadcrumb">
            <li><a href="<?=base_url("home/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active">Term Attendance</li>
        </ol>
    </div>

    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <form method="POST" action="<?=base_url('term_attendance/index')?>" class="form-inline" style="margin-bottom: 20px;">
                    <div class="form-group">
                        <label>Class: </label>
                        <?php
                            $array = array("0" => "Select Class");
                            if(customCompute($classes)) {
                                foreach ($classes as $classa) {
                                    $array[$classa->classesID] = $classa->classes;
                                }
                            }
                            echo form_dropdown("classesID", $array, set_value("classesID", $set_classesID), "id='classesID' class='form-control select2' required");
                        ?>
                    </div>
                    <div class="form-group" style="margin-left: 15px;">
                        <label>Section: </label>
                        <?php
                            $secArray = array("0" => "Select Section");
                            if(isset($sections) && customCompute($sections)) {
                                foreach ($sections as $sec) {
                                    $secArray[$sec->sectionID] = $sec->section;
                                }
                            }
                            echo form_dropdown("sectionID", $secArray, set_value("sectionID", $set_sectionID), "id='sectionID' class='form-control select2' required");
                        ?>
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin-left: 15px;">Get Students</button>
                </form>

                <hr>

                <?php if(customCompute($students) > 0) { 
                    
                    // Grab the first existing record to populate the Total Days fields (since it's identical for the whole class)
                    $global_term1_total = 0;
                    $global_term2_total = 0;
                    if(customCompute($existing_attendance)) {
                        $first_record = reset($existing_attendance);
                        $global_term1_total = $first_record->term1_total_days;
                        $global_term2_total = $first_record->term2_total_days;
                    }
                ?>
                <form method="POST" action="<?=base_url('term_attendance/save')?>">
                    <input type="hidden" name="classesID" value="<?=$set_classesID?>">
                    <input type="hidden" name="sectionID" value="<?=$set_sectionID?>">
                    <input type="hidden" name="save_attendance" value="1">

                    <div class="row" style="margin-bottom: 20px; background: #f9f9f9; padding: 15px; border-radius: 4px;">
                        <div class="col-sm-4">
                            <label>Total Days in Term 1</label>
                            <input type="number" class="form-control" name="term1_total_days" value="<?=$global_term1_total?>" required>
                        </div>
                        <div class="col-sm-4">
                            <label>Total Days in Term 2</label>
                            <input type="number" class="form-control" name="term2_total_days" value="<?=$global_term2_total?>" required>
                        </div>
                    </div>

                    <div id="hide-table">
                        <table class="table table-striped table-bordered table-hover dataTable no-footer">
                            <thead>
                                <tr>
                                    <th class="col-sm-1"><?=$this->lang->line('student_roll')?></th>
                                    <th class="col-sm-3"><?=$this->lang->line('student_name')?></th>
                                    <th class="col-sm-4">Term 1 Present Days</th>
                                    <th class="col-sm-4">Term 2 Present Days</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($students as $student) { 
                                    $t1_present = isset($existing_attendance[$student->srstudentID]) ? $existing_attendance[$student->srstudentID]->term1_present_days : 0;
                                    $t2_present = isset($existing_attendance[$student->srstudentID]) ? $existing_attendance[$student->srstudentID]->term2_present_days : 0;
                                ?>
                                    <tr>
                                        <td data-title="<?=$this->lang->line('student_roll')?>">
                                            <?php echo $student->srroll; ?>
                                        </td>
                                        <td data-title="<?=$this->lang->line('student_name')?>">
                                            <?php echo $student->srname; ?>
                                            <input type="hidden" name="studentID[]" value="<?=$student->srstudentID?>">
                                        </td>
                                        <td data-title="Term 1 Present">
                                            <input type="number" class="form-control" name="term1_present[]" value="<?=$t1_present?>" min="0">
                                        </td>
                                        <td data-title="Term 2 Present">
                                            <input type="number" class="form-control" name="term2_present[]" value="<?=$t2_present?>" min="0">
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group" style="margin-top:20px;">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save Attendance</button>
                    </div>
                </form>
                <?php } elseif($_POST && $set_classesID > 0) { ?>
                    <div class="alert alert-warning">No students found for the selected Class and Section.</div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(".select2").select2();

    // AJAX call to fetch sections dynamically when a class is selected
    $('#classesID').change(function() {
        var classesID = $(this).val();
        if(classesID === '0') {
            $('#sectionID').html("<option value='0'>Select Section</option>");
        } else {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('term_attendance/sectioncall')?>",
                data: "id=" + classesID,
                dataType: "html",
                success: function(data) {
                   $('#sectionID').html(data);
                }
            });
        }
    });
</script>