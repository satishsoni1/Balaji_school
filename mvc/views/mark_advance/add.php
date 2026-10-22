<?php if ($siteinfos->note == 1) { ?>
    <div class="callout callout-danger">
        <p><b>Note:</b> Create exam, class, section & subject before add mark</p>
    </div>
<?php } ?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-flask"></i> <?= $this->lang->line('panel_title') ?></h3>
        <ol class="breadcrumb">
            <li><a href="<?= base_url("home/index") ?>"><i class="fa fa-laptop"></i> <?= $this->lang->line('menu_dashboard') ?></a></li>
            <li><a href="<?= base_url("markAdvance/index") ?>"><?= $this->lang->line('menu_mark') ?></a></li>
            <li class="active"><?= $this->lang->line('menu_add') ?> <?= $this->lang->line('menu_mark') ?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">

                <form method="POST">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="<?php echo form_error('classesID') ? 'form-group has-error' : 'form-group'; ?>">
                                        <label for="classesID" class="control-label">
                                            <?= $this->lang->line('mark_classes') ?> <span class="text-red">*</span>
                                        </label>
                                        <?php
                                        $array = array("0" => $this->lang->line("mark_select_classes"));
                                        foreach ($classes as $classa) {
                                            $array[$classa->classesID] = $classa->classes;
                                        }
                                        echo form_dropdown("classesID", $array, set_value("classesID"), "id='classesID' class='form-control select2 classesID'");
                                        ?>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="<?php echo form_error('examID') ? 'form-group has-error' : 'form-group'; ?>">
                                        <label for="examID" class="control-label">
                                            <?= $this->lang->line('mark_exam') ?> <span class="text-red">*</span>
                                        </label>
                                        <?php
                                        $array = array("0" => $this->lang->line("mark_select_exam"));
                                        foreach ($exams as $exam) {
                                            $array[$exam->examID] = $exam->exam;
                                        }
                                        echo form_dropdown("examID", $array, set_value("examID"), "id='examID' class='form-control select2 examID'");
                                        ?>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="<?php echo form_error('sectionID') ? 'form-group has-error' : 'form-group'; ?>">
                                        <label class="control-label"><?= $this->lang->line('mark_section') ?> <span class="text-red">*</span></label>
                                        <?php
                                        $arraysection = array('0' => $this->lang->line("mark_select_section"));
                                        if (customCompute($sections)) {
                                            foreach ($sections as $section) {
                                                $arraysection[$section->sectionID] = $section->section;
                                            }
                                        }
                                        echo form_dropdown("sectionID", $arraysection, set_value("sectionID"), "id='sectionID' class='form-control select2'");
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-12">
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success col-md-12 col-xs-12" style="margin-top: 20px;"><?= $this->lang->line('add_mark') ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>


                <?php if (customCompute($sendExam) && customCompute($sendClasses) && customCompute($sendSection)) { ?>
                    <div class="col-sm-4 col-sm-offset-4 box-layout-fame">
                        <?php
                        echo '<h5><center>' . $this->lang->line('mark_details') . '</center></h5>';
                        echo '<h5><center>' . $this->lang->line('mark_exam') . ' : ' . $sendExam->exam . '</center></h5>';
                        echo '<h5><center>' . $this->lang->line('mark_classes') . ' : ' . $sendClasses->classes . '</center></h5>';
                        echo '<h5><center>' . $this->lang->line('mark_section') . ' : ' . $sendSection->section . '</center></h5>';
                        ?>
                    </div>
                <?php } ?>
            </div>
            <div class="col-sm-12">
                <?php if (customCompute($students) && customCompute($subjects)) { ?>
                    <div id="hide-table">
                        <table class="table table-striped table-bordered table-hover dataTable no-footer">
                            <thead>
                                <tr>
                                    <th><?= $this->lang->line('mark_name') ?></th>
                                    <th><?= $this->lang->line('mark_roll') ?></th>

                                    <?php
                                    // Print one header column per subject
                                    foreach ($subjects as $subject) {
                                        echo "<th data-subjectid='{$subject->subjectID}'>" . $subject->subject . "</th>";
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($students as $student) { ?>
                                    <tr>
                                        <td data-title="<?= $this->lang->line('mark_name') ?>"><?= $student->name ?></td>
                                        <td data-title="<?= $this->lang->line('mark_roll') ?>"><?= $student->srroll ?></td>

                                        <?php
                                        // For each subject show inputs (one or multiple markpercentages)
                                        foreach ($subjects as $subject) {
                                            echo "<td data-title='{$subject->subject}'>";

                                            // Find markID and markrelationIDs for this student+subject
                                            // We rely on markRelations and markwr arrays prepared by controller:
                                            // $markRelations[studentID][markpercentageID] = mark
                                            // $markwr[studentID][markpercentageID] = markrelationID

                                            // For this subject, iterate through markpercentages that apply.
                                            // The controller previously provided $this->data['markpercentages'] as array keyed by markpercentageID (or get them from marksetting)
                                            // Here we will iterate $markpercentages (global) and check presence in markwr
                                            foreach ($markpercentages[$subject->subjectID] as $mp) {
                                                // mp is object (markpercentage) — ensure it applies to this subject in controller; if not, you can filter.
                                                $mpid = $mp->markpercentageID;
                                                // If markrelation exists for this student+subject+mp, print input
                                                $relationID = isset($markwr[$student->studentID][$mpid]) ? $markwr[$student->studentID][$mpid] : NULL;
                                                // If your $markwr is structured by student->markpercentageID (as your getMarkRelationArray does),
                                                // it may not include subjectID, so ensure markrelation indexing in controller includes subject context.
                                                if ($relationID) {
                                                    $value = isset($markRelations[$subject->subjectID][$student->studentID][$mpid]) ? $markRelations[$subject->subjectID][$student->studentID][$mpid] : '';
                                                    // Name format: mark-<studentID>-<subjectID>-<markpercentageID>-<markrelationID>
                                                    echo "<div style='margin-bottom:4px;'>";
                                                    echo "<label style='font-weight:normal;font-size:11px;'>$mp->markpercentagetype ($mp->percentage)</label>";
                                                    echo "<input class='form-control mark-input' type='number' min='0' max='{$mp->percentage}' ";
                                                    echo "name='mark-{$student->studentID}-{$subject->subjectID}-{$mpid}-{$relationID}' ";
                                                    echo "data-studentid='{$student->studentID}' data-subjectid='{$subject->subjectID}' data-mpid='{$mpid}' data-relationid='{$relationID}' ";
                                                    echo "value='" . htmlentities($value, ENT_QUOTES) . "' />";
                                                    echo "</div>";
                                                }
                                            }
                                            echo "</td>";
                                        }
                                        ?>
                                    </tr>
                                <?php $i++;
                                } ?>
                            </tbody>
                        </table>
                    </div>

                    <input type="button" class="btn btn-success col-sm-2 col-xs-12" id="add_mark" name="add_mark" value="<?= $this->lang->line("add_sub_mark") ?>" />
                <?php } ?>


                <script type="text/javascript">
                    $(document).on("keyup", ".mark-input", function() {
                        var val = $(this).val();
                        var min = parseInt($(this).attr('min')) || 0;
                        var max = parseInt($(this).attr('max')) || 999999;
                        if (val !== '') {
                            var n = parseFloat(val);
                            if (isNaN(n) || n < min || n > max) {
                                $(this).addClass('input-error');
                            } else {
                                $(this).removeClass('input-error');
                            }
                        } else {
                            $(this).removeClass('input-error');
                        }
                    });

                    $("#add_mark").click(function() {
                        var markInputs = [];
                        $('input[name^="mark-"]').each(function() {
                            var name = $(this).attr('name'); // mark-<studentID>-<subjectID>-<mpid>-<relationID>
                            var parts = name.split('-');
                            if (parts.length === 5) {
                                var studentID = parts[1];
                                var subjectID = parts[2];
                                var mpid = parts[3];
                                var relationID = parts[4];
                                var val = $(this).val();
                                markInputs.push({
                                    studentID: studentID,
                                    subjectID: subjectID,
                                    markpercentageID: mpid,
                                    markrelationID: relationID,
                                    value: val
                                });
                            }
                        });

                        $.ajax({
                            type: 'POST',
                            url: "<?= base_url('mark_advance/mark_send') ?>",
                            data: {
                                "examID": "<?= $set_exam ?>",
                                "classesID": "<?= $set_classes ?>",
                                "subjectID": "<?= $set_subject ?>",
                                "inputs": JSON.stringify(markInputs) // send as JSON string
                            },
                            dataType: "json",
                            success: function(response) {
                                if (response.status) {
                                    toastr.success(response.message);
                                } else {
                                    if (response.inputs) {
                                        toastr.error(response.inputs);
                                    } else if (response.message) {
                                        toastr.error(response.message);
                                    } else {
                                        toastr.error("Error while saving marks.");
                                    }
                                }
                            },
                            error: function(xhr, status, error) {
                                toastr.error("Ajax error: " + error);
                            }
                        });
                    });
                </script>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.select2').select2();
    $("#classesID").change(function() {
        var classesID = $(this).val();
        if (parseInt(classesID)) {
            $.ajax({
                type: 'POST',
                url: "<?= base_url('markAdvance/examcall') ?>",
                data: {
                    "classesID": classesID
                },
                dataType: "html",
                success: function(data) {
                    $('#examID').html(data);
                }
            });

            $.ajax({
                type: 'POST',
                url: "<?= base_url('markAdvance/subjectcall') ?>",
                data: {
                    "id": classesID
                },
                dataType: "html",
                success: function(data) {
                    $('#subjectID').html(data);
                }
            });

            $.ajax({
                type: 'POST',
                url: "<?= base_url('markAdvance/sectioncall') ?>",
                data: {
                    "id": classesID
                },
                dataType: "html",
                success: function(data) {
                    $('#sectionID').html(data);
                }
            });
        }
    });
</script>