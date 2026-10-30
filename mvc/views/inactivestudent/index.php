<?php
    $canEdit   = permissionChecker('student_edit');
    $hasAction = permissionChecker('student_edit') || permissionChecker('student_delete') || permissionChecker('student_view');
    $canManageYear = ($siteinfos->school_year == $this->session->userdata('defaultschoolyearID')) || ($this->session->userdata('usertypeID') == 1);
    $total = customCompute($students);

    // One row of the student table; $tabActions adds edit/delete as on the section tabs.
    $renderRow = function ($student, $i, $showClass, $tabActions) use ($canEdit, $hasAction, $canManageYear, $set) {
        $id = $student->srstudentID;
        ob_start(); ?>
        <tr data-student-row="<?=$id?>">
            <td data-title="<?=$this->lang->line('slno')?>" class="ia-num"><?=$i?></td>
            <td data-title="<?=$this->lang->line('student_name')?>">
                <div class="ia-student">
                    <img src="<?=imagelink($student->photo)?>" alt="" loading="lazy">
                    <div>
                        <strong><?=htmlspecialchars($student->srname)?></strong>
                        <small>GR No: <?=htmlspecialchars($student->registerNO)?></small>
                    </div>
                </div>
            </td>
            <?php if ($showClass) { ?>
                <td data-title="<?=$this->lang->line('student_classes')?>">
                    <?php
                        // Section names here usually include the class already (e.g. "I-B"), so avoid "I · I-B".
                        $section = (string) $student->srsection;
                        $classLabel = ($section !== '' && stripos($section, (string) $student->srclasses) === 0)
                            ? $section
                            : trim($student->srclasses.($section !== '' ? ' · '.$section : ''));
                    ?>
                    <span class="ia-chip"><?=htmlspecialchars($classLabel)?></span>
                </td>
            <?php } ?>
            <td data-title="<?=$this->lang->line('student_roll')?>"><?=htmlspecialchars($student->srroll)?></td>
            <td data-title="<?=$this->lang->line('student_phone')?>">
                <?php if ($student->phone) { ?>
                    <a class="ia-phone" href="tel:<?=htmlspecialchars($student->phone)?>"><i class="fa fa-phone"></i> <?=htmlspecialchars($student->phone)?></a>
                <?php } else { ?>
                    <span class="text-muted">—</span>
                <?php } ?>
            </td>
            <?php if ($canEdit) { ?>
                <td data-title="<?=$this->lang->line('student_status')?>">
                    <label class="ia-switch" title="Reactivate this student">
                        <input type="checkbox" data-student-status="<?=$id?>" <?=$student->sris_active === '1' ? 'checked' : ''?>>
                        <span class="ia-switch__track"></span>
                        <span class="ia-switch__label" data-on="Active" data-off="Inactive"></span>
                    </label>
                </td>
            <?php } ?>
            <?php if ($hasAction) { ?>
                <td data-title="<?=$this->lang->line('action')?>" class="ia-actions">
                    <?php
                        if ($tabActions) {
                            echo btn_view('inactivestudent/view/'.$id."/".$set, $this->lang->line('view'));
                            if ($canManageYear) {
                                echo btn_edit('inactivestudent/edit/'.$id."/".$set, $this->lang->line('edit'));
                                echo btn_delete('inactivestudent/delete/'.$id."/".$set, $this->lang->line('delete'));
                            }
                        } else {
                            echo btn_view('inactivestudent/view/'.$id."/".$student->classesID."/".$student->schoolyearID, $this->lang->line('view'));
                        }
                    ?>
                </td>
            <?php } ?>
        </tr>
        <?php return ob_get_clean();
    };

    $renderHead = function ($showClass) use ($canEdit, $hasAction) { ?>
        <thead>
            <tr>
                <th class="ia-num"><?=$this->lang->line('slno')?></th>
                <th><?=$this->lang->line('student_name')?></th>
                <?php if ($showClass) { ?><th><?=$this->lang->line('student_classes')?> / <?=$this->lang->line('student_section')?></th><?php } ?>
                <th><?=$this->lang->line('student_roll')?></th>
                <th><?=$this->lang->line('student_phone')?></th>
                <?php if ($canEdit) { ?><th><?=$this->lang->line('student_status')?></th><?php } ?>
                <?php if ($hasAction) { ?><th><?=$this->lang->line('action')?></th><?php } ?>
            </tr>
        </thead>
    <?php };
?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-student"></i> <?=$this->lang->line('panel_title')?></h3>
        <ol class="breadcrumb">
            <li><a href="<?=base_url("home/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_inactivestudent')?></li>
        </ol>
    </div>

    <div class="box-body">
        <div class="ia-toolbar">
            <div class="ia-summary">
                <span class="ia-summary__icon"><i class="fa fa-user-times"></i></span>
                <div>
                    <strong><?=$total?> inactive <?=$total == 1 ? 'student' : 'students'?></strong>
                    <small><?=$canEdit ? 'Switch a student to Active to move them back to Admission.' : 'Students who are not currently active in the selected year.'?></small>
                </div>
            </div>

            <?php if ($this->session->userdata('usertypeID') != 3) { ?>
                <div class="ia-filters">
                    <div class="ia-filter">
                        <label for="classesID"><?=$this->lang->line('student_classes')?></label>
                        <?php
                            $array = array("0" => $this->lang->line("student_select_class"));
                            if (customCompute($classes)) {
                                foreach ($classes as $classa) {
                                    $array[$classa->classesID] = $classa->classes;
                                }
                            }
                            echo form_dropdown("classesID", $array, set_value("classesID", $set), "id='classesID' class='form-control select2'");
                        ?>
                    </div>
                    <div class="ia-filter">
                        <label for="schoolyearID">Academic year</label>
                        <?php
                            $array = array('0' => $this->lang->line("student_all_accademic_year"));
                            if (customCompute($schoolyears)) {
                                foreach ($schoolyears as $schoolyear) {
                                    $array[$schoolyear->schoolyearID] = $schoolyear->schoolyear;
                                }
                            }
                            echo form_dropdown("schoolyearID", $array, set_value("schoolyearID", $schoolyearID), "id='schoolyearID' class='form-control select2'");
                        ?>
                    </div>
                </div>
            <?php } ?>
        </div>

        <?php if ($total > 0) { ?>
            <div class="nav-tabs-custom ia-tabs">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#all" aria-expanded="true"><?=$this->lang->line("student_all_students")?> <span class="ia-count"><?=$total?></span></a></li>
                    <?php foreach ($sections as $section) { ?>
                        <li><a data-toggle="tab" href="#tab<?=$section->classesID.$section->sectionID?>" aria-expanded="false"><?=$this->lang->line("student_section")?> <?=htmlspecialchars($section->section)?> <small>(<?=htmlspecialchars($section->category)?>)</small></a></li>
                    <?php } ?>
                </ul>

                <div class="tab-content">
                    <div id="all" class="tab-pane active">
                        <div id="hide-table">
                            <table id="example1" class="table table-hover dataTable no-footer ia-table">
                                <?php $renderHead($set == 0); ?>
                                <tbody>
                                    <?php $i = 1; foreach ($students as $student) { echo $renderRow($student, $i++, $set == 0, FALSE); } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <?php foreach ($sections as $section) { ?>
                        <div id="tab<?=$section->classesID.$section->sectionID?>" class="tab-pane">
                            <div class="hide-table">
                                <table class="table table-hover dataTable no-footer ia-table">
                                    <?php $renderHead(FALSE); ?>
                                    <tbody>
                                        <?php
                                            $i = 1;
                                            if (customCompute($allsection[$section->sectionID])) {
                                                foreach ($allsection[$section->sectionID] as $student) {
                                                    if ($section->sectionID === $student->srsectionID) {
                                                        echo $renderRow($student, $i++, FALSE, TRUE);
                                                    }
                                                }
                                            }
                                            if ($i === 1) { ?>
                                                <tr><td colspan="7" class="ia-empty-row">No inactive students in this section.</td></tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } else { ?>
            <div class="ia-empty">
                <span class="ia-empty__icon"><i class="fa fa-check-circle-o"></i></span>
                <h4>No inactive students</h4>
                <p><?=$set ? 'Every student in this class is active for the selected academic year.' : 'Choose a class or academic year above to look for inactive students.'?></p>
            </div>
        <?php } ?>
    </div>
</div>

<script type="text/javascript">
    $(".select2").select2();

    function reloadStudentList() {
        $.ajax({
            type: 'POST',
            url: "<?=base_url('inactivestudent/student_list')?>",
            data: "id=" + $("#classesID").val() + "&schoolyearID=" + $("#schoolyearID").val(),
            dataType: "html",
            success: function(data) { window.location.href = data; }
        });
    }

    $('#classesID').change(function() {
        if ($(this).val() == 0) {
            $('#hide-table, .nav-tabs-custom').hide();
        } else {
            reloadStudentList();
        }
    });
    $('#schoolyearID').change(reloadStudentList);

    toastr.options = { closeButton: true, positionClass: "toast-top-right", timeOut: 4000 };

    $(document).on('change', '[data-student-status]', function() {
        var box = $(this);
        var id = box.data('student-status');
        var active = box.prop('checked');
        var rows = $('[data-student-row="' + id + '"]');
        box.prop('disabled', true);

        $.ajax({
            type: 'POST',
            url: "<?=base_url('inactivestudent/active')?>",
            data: "id=" + id + "&status=" + (active ? 'chacked' : 'unchacked'),
            dataType: "html"
        }).done(function(data) {
            if (data == 'Success') {
                // Keep every copy of this student's switch (All + section tab) in sync.
                $('[data-student-status="' + id + '"]').prop('checked', active);
                rows.toggleClass('is-activated', active);
                toastr.success(active ? 'Student reactivated — now listed under Admission.' : 'Student marked inactive again.');
            } else {
                box.prop('checked', !active);
                toastr.error('Could not update the status. Please try again.');
            }
        }).fail(function() {
            box.prop('checked', !active);
            toastr.error('Network error. The status was not changed.');
        }).always(function() {
            box.prop('disabled', false);
        });
    });
</script>
