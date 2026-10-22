<?php if ($siteinfos->note==1) { ?>
    <div class="callout callout-danger">
        <p><b>Note:</b> Create exam, class, section & subject before add mark</p>
    </div>
<?php } ?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-flask"></i> <?=$this->lang->line('panel_title')?></h3>
        <ol class="breadcrumb">
            <li><a href="<?=base_url("home/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("mark/index")?>"><?=$this->lang->line('menu_mark')?></a></li>
            <li class="active"><?=$this->lang->line('menu_add')?> <?=$this->lang->line('menu_mark')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">

                <form method="POST">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                
                                <div class="col-md-3">
                                    <div class="<?php echo form_error('classesID') ? 'form-group has-error' : 'form-group'; ?>" >
                                        <label for="classesID" class="control-label">
                                            <?=$this->lang->line('mark_classes')?> <span class="text-red">*</span>
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
                                    <div class="<?php echo form_error('sectionID') ? 'form-group has-error' : 'form-group'; ?>" >
                                        <label class="control-label"><?=$this->lang->line('mark_section')?> <span class="text-red">*</span></label>
                                        <?php
                                            $arraysection = array('0' => $this->lang->line("mark_select_section"));
                                            if(customCompute($sections)) {
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
                        <div class="col-md-4 col-xs-12">
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div class="form-group" >
                                        <button type="submit" class="btn btn-success col-md-12 col-xs-12" style="margin-top: 20px;">Add Attendance / Height / Width</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>


                <?php if(customCompute($sendClasses) && customCompute($sendSection)) { ?>
                    <div class="col-sm-4 col-sm-offset-4 box-layout-fame">
                        <?php
                            echo '<h5><center>Attendance</center></h5>';
                            echo '<h5><center>'.$this->lang->line('mark_classes').' : '. $sendClasses->classes.'</center></h5>';
                            echo '<h5><center>'.$this->lang->line('mark_section').' : '. $sendSection->section.'</center></h5>';
                        ?>
                    </div>
                <?php } ?>
            </div>
            <div class="col-sm-12">
                <?php if(customCompute($students)) { ?>
                    <div id="hide-table" class="table-responsive" style="overflow: scroll;">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th><?=$this->lang->line('slno')?></th>
                                    <th><?=$this->lang->line('mark_name')?></th>
                                    <th><?=$this->lang->line('mark_roll')?></th>
                                    <th>Height</th>
                                    <th>Weight</th>
                                    <th>Attendance [June]</th>
                                    <th>Attendance [July]</th>
                                    <th>Attendance [Aug]</th>
                                    <th>Attendance [Sept]</th>
                                    <th>Attendance [Oct]</th>
                                    <th>Attendance [Nov]</th>
                                    <th>Attendance [Dec]</th>
                                    <th>Attendance [Jan]</th>
                                    <th>Attendance [Feb]</th>
                                    <th>Attendance [March]</th>
                                    <th>Attendance [April]</th>
                                    <th>Attendance [May]</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(customCompute($students)) {$i = 1; foreach($students as $student) {  ?>
                                    <tr>
                                        <td data-title="<?=$this->lang->line('slno')?>">
                                            <?php echo $i; ?>
                                        </td>
                                        <td data-title="<?=$this->lang->line('mark_name')?>">
                                            <?php echo $student->name; ?>
                                        </td>
                                        <td data-title="<?=$this->lang->line('mark_roll')?>">
                                            <?php echo $student->roll; ?>
                                        </td>
                                        <td data-title='height'>
                                            <input style="min-width:7rem" class='form-control' type='number' name="height-<?= $student->studentID ?>" id='height' value='<?= (isset($attendances[$student->studentID]) && (int)$attendances[$student->studentID]->height>0)?(int)$attendances[$student->studentID]->height:0 ?>' min='0' />
                                        </td>
                                        <td data-title='weight'>
                                            <input style="min-width:7rem" class='form-control' type='number' name='weight-<?= $student->studentID ?>' id='weight' value='<?= (isset($attendances[$student->studentID]) && (int)$attendances[$student->studentID]->weight>0)?(int)$attendances[$student->studentID]->weight:0 ?>' min='0' />
                                        </td>
                                        <td data-title='attendance_june'>
                                            <input style="min-width:7rem" class='form-control attendance' type='number' name="attendance-<?= $student->studentID ?>" id='working_days_june' value='<?= (isset($attendances[$student->studentID]) && (int)$attendances[$student->studentID]->working_days_june>0)?(int)$attendances[$student->studentID]->working_days_june:0 ?>' min='0' max='30' />
                                        </td>
                                        <td data-title='attendance_july'>
                                            <input style="min-width:7rem" class='form-control attendance' type='number' name='attendance-<?= $student->studentID ?>' id='working_days_july' value='<?= (isset($attendances[$student->studentID]) && (int)$attendances[$student->studentID]->working_days_july>0)?(int)$attendances[$student->studentID]->working_days_july:0 ?>' min='0' max='31' />
                                        </td>
                                        <td data-title='attendance_aug'>
                                            <input style="min-width:7rem" class='form-control attendance' type='number' name='attendance-<?= $student->studentID ?>' id='working_days_aug' value='<?= (isset($attendances[$student->studentID]) && (int)$attendances[$student->studentID]->working_days_aug>0)?(int)$attendances[$student->studentID]->working_days_aug:0 ?>' min='0' max='31' />
                                        </td>
                                        <td data-title='attendance_sept'>
                                            <input style="min-width:7rem" class='form-control attendance' type='number' name='attendance-<?= $student->studentID ?>' id='working_days_sept' value='<?= (isset($attendances[$student->studentID]) && (int)$attendances[$student->studentID]->working_days_sept>0)?(int)$attendances[$student->studentID]->working_days_sept:0 ?>' min='0' max='30' />
                                        </td>
                                        <td data-title='attendance_oct'>
                                            <input style="min-width:7rem" class='form-control attendance' type='number' name='attendance-<?= $student->studentID ?>' id='working_days_oct' value='<?= (isset($attendances[$student->studentID]) && (int)$attendances[$student->studentID]->working_days_oct>0)?(int)$attendances[$student->studentID]->working_days_oct:0 ?>' min='0' max='31' />
                                        </td>
                                        <td data-title='attendance_nov'>
                                            <input style="min-width:7rem" class='form-control attendance' type='number' name='attendance-<?= $student->studentID ?>' id='working_days_nov' value='<?= (isset($attendances[$student->studentID]) && (int)$attendances[$student->studentID]->working_days_nov>0)?(int)$attendances[$student->studentID]->working_days_nov:0 ?>' min='0' max='30' />
                                        </td>
                                        <td data-title='attendance_dec'>
                                            <input style="min-width:7rem" class='form-control attendance' type='number' name='attendance-<?= $student->studentID ?>' id='working_days_dec' value='<?= (isset($attendances[$student->studentID]) && (int)$attendances[$student->studentID]->working_days_dec>0)?(int)$attendances[$student->studentID]->working_days_dec:0 ?>' min='0' max='31' />
                                        </td>
                                        <td data-title='attendance_jan'>
                                            <input style="min-width:7rem" class='form-control attendance' type='number' name='attendance-<?= $student->studentID ?>' id='working_days_jan' value='<?= (isset($attendances[$student->studentID]) && (int)$attendances[$student->studentID]->working_days_jan>0)?(int)$attendances[$student->studentID]->working_days_jan:0 ?>' min='0' max='31' />
                                        </td>
                                        <td data-title='attendance_feb'>
                                            <input style="min-width:7rem" class='form-control attendance' type='number' name='attendance-<?= $student->studentID ?>' id='working_days_feb' value='<?= (isset($attendances[$student->studentID]) && (int)$attendances[$student->studentID]->working_days_feb>0)?(int)$attendances[$student->studentID]->working_days_feb:0 ?>' min='0' max='30' />
                                        </td>
                                        <td data-title='attendance_march'>
                                            <input style="min-width:7rem" class='form-control attendance' type='number' name='attendance-<?= $student->studentID ?>' id='working_days_march' value='<?= (isset($attendances[$student->studentID]) && (int)$attendances[$student->studentID]->working_days_march>0)?(int)$attendances[$student->studentID]->working_days_march:0 ?>' min='0' max='31' />
                                        </td>
                                        <td data-title='attendance_april'>
                                            <input style="min-width:7rem" class='form-control attendance' type='number' name='attendance-<?= $student->studentID ?>' id='working_days_apr' value='<?= (isset($attendances[$student->studentID]) && (int)$attendances[$student->studentID]->working_days_april>0)?(int)$attendances[$student->studentID]->working_days_april:0 ?>' min='0' max='30' />
                                        </td>
                                        <td data-title='attendance_may'>
                                            <input style="min-width:7rem" class='form-control attendance' type='number' name='attendance-<?= $student->studentID ?>' id='working_days_may' value='<?= (isset($attendances[$student->studentID]) && (int)$attendances[$student->studentID]->working_days_may>0)?(int)$attendances[$student->studentID]->working_days_may:0 ?>' min='0' max='31' />
                                        </td>
                                    </tr>
                                <?php $i++;  }} ?>
                            </tbody>
                        </table>
                    </div>
                    <input type="button" class="btn btn-success col-sm-2 col-xs-12" id="add_mark" name="add_mark" value="Add Attendance" />

                    <script type="text/javascript">
                        window.addEventListener('load', function() {
                            setTimeout(lazyLoad, 1000);
                        });

                        function lazyLoad() {
                            var card_images = document.querySelectorAll('.card-image');
                            card_images.forEach(function(card_image) {
                                var image_url = card_image.getAttribute('data-image-full');
                                var content_image = card_image.querySelector('img');
                                content_image.src = image_url;
                                content_image.addEventListener('load', function() {
                                    card_image.style.backgroundImage = 'url(' + image_url + ')';
                                    card_image.className = card_image.className + ' is-loaded';
                                });
                            });
                        }
                        
                        $(document).on("keyup", ".attendance", function() {
                            if(parseInt($(this).val())) {
                                var val = parseInt($(this).val());
                                var minMark = parseInt($(this).attr('min'));
                                var maxMark = parseInt($(this).attr('max'));
                                if(minMark > val || val > maxMark) {
                                    $(this).val('');
                                }
                            } else {
                                if($(this).val() == '0') {
                                } else {
                                    $(this).val('');
                                }
                            }
                        });

                        $("#add_mark").click(function() {
                            var inputs = "";
                            var inputs_value = "";
                            var mark = $('input[name^=attendance]').map(function(){
                                if(this.value>0)
                                return { studentID: this.name, column_name: this.id , value: this.value};
                            }).get();
                            var height = $('input[name^=height]').map(function(){
                                if(this.value>0)
                                return { studentID: this.name, column_name: "height" , value: this.value};
                            }).get();
                            var weight = $('input[name^=weight]').map(function(){
                                if(this.value>0)
                                return { studentID: this.name, column_name: "weight" , value: this.value};
                            }).get();
                            $.ajax({
                                type: 'POST',
                                url: "<?=base_url('mark/attendance_send')?>",
                                data: {"classesID" : "<?=$set_classes?>", "inputs" : mark, "heights" : height, "weights" : weight},
                                dataType: "html",
                                success: function(data) {
                                    var response = jQuery.parseJSON(data);
                                    if(response.status) {
                                        toastr["success"](response.message)
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
                                    } else {
                                        if(response.inputs) {
                                            toastr["error"](response.inputs)
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
                                    }
                                }
                            });
                        });
                    </script>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $('.select2').select2();
    $("#classesID").change(function() {
        var classesID = $(this).val();
        if(parseInt(classesID)) {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('mark/examcall')?>",
                data: {"classesID" : classesID},
                dataType: "html",
                success: function(data) {
                   $('#examID').html(data);
                }
            });

            $.ajax({
                type: 'POST',
                url: "<?=base_url('mark/subjectcall')?>",
                data: {"id" : classesID},
                dataType: "html",
                success: function(data) {
                   $('#subjectID').html(data);
                }
            });

            $.ajax({
                type: 'POST',
                url: "<?=base_url('mark/sectioncall')?>",
                data: {"id" : classesID},
                dataType: "html",
                success: function(data) {
                   $('#sectionID').html(data);
                }
            });
        }
    });

</script>
