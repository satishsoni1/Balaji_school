<style>
.table-bordered > thead > tr > th, .table-bordered > tbody > tr > td {
    font-size: 14px !important;
}
</style>
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-student"></i> <?=$this->lang->line('panel_title')?></h3>


        <ol class="breadcrumb">
            <li><a href="<?=base_url("home/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_student')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">

                <?php if((($siteinfos->school_year == $this->session->userdata('defaultschoolyearID')) || ($this->session->userdata('usertypeID') == 1)) || ($this->session->userdata('usertypeID') != 3)) { ?>
                    <h5 class="page-header">
                        <?php if(($siteinfos->school_year == $this->session->userdata('defaultschoolyearID')) || ($this->session->userdata('usertypeID') == 1)) { ?>
                            <?php if(permissionChecker('student_add')) { ?>
                                <a href="<?php echo base_url('student/add') ?>">
                                    <i class="fa fa-plus"></i>
                                    <?=$this->lang->line('add_title')?>
                                </a>
                            <?php } ?>
                        <?php } ?>
                        
                        <?php if($this->session->userdata('usertypeID') != 3) { ?>
                            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pull-right drop-marg">
                       
                    <?php
                        $array = [];
                        $array['0'] = $this->lang->line("student_all_accademic_year");
                        if(customCompute($schoolyears)) {
                            foreach ($schoolyears as $schoolyear) {
                                $array[$schoolyear->schoolyearID] = $schoolyear->schoolyear;
                            }
                        }
                        echo form_dropdown("schoolyearID", $array , set_value("schoolyearID",$schoolyearID), "id='schoolyearID' class='form-control select2'");
                     ?>
                            </div>
                        <?php } ?>
                        
                        <?php if($this->session->userdata('usertypeID') != 3) { ?>
                            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pull-right drop-marg">
                                <?php
                                    $array = array("0" => $this->lang->line("student_select_class"));
                                    if(customCompute($classes)) {
                                        foreach ($classes as $classa) {
                                            $array[$classa->classesID] = $classa->classes;
                                        }
                                    }
                                    echo form_dropdown("classesID", $array, set_value("classesID", $set), "id='classesID' class='form-control select2'");
                                ?>
                            </div>
                        <?php } ?>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pull-right">
                        <a href="<?= base_url('student/index/0') ?>" class="btn-cs btn-sm-cs" style="text-decoration: none;" role="button"> All Classes </a>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 pull-right">
                        <?php

                        ?>
                        <a href="<?= base_url('student/export/'.$set) ?>" class="btn-cs btn-sm-cs" style="text-decoration: none;" role="button"> Export Student </a>
                        </div>
                    </h5>
                <?php } ?>
                

                <?php if(customCompute($students) > 0 ) { ?>

                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#all" aria-expanded="true"><?=$this->lang->line("student_all_students")?></a></li>
                            <?php foreach ($sections as $key => $section) {
                                echo '<li class=""><a data-toggle="tab" href="#tab'.$section->classesID.$section->sectionID .'" aria-expanded="false">'. $this->lang->line("student_section")." ".$section->section. " ( ". $section->category." )".'</a></li>';
                            } ?>
                        </ul>



                        <div class="tab-content">
                            <div id="all" class="tab-pane active">
                                <div id="hide-table">
                                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                                        <thead>
                                            <tr>
                                                <!-- <th class="col-sm-1"><?=$this->lang->line('slno')?></th> -->
                                                <th class="col-sm-1"><?=$this->lang->line('student_roll')?></th>
                                                <th class="col-sm-1">GR No</th>
                                                <th class="col-sm-2"><?=$this->lang->line('student_name')?></th>
                                                <!-- php if($set==0) { ?> -->
                                                <th class="col-sm-1"><?=$this->lang->line('student_classes')?></th>
                                                <th class="col-sm-1"><?=$this->lang->line('student_section')?></th>
                                                <!-- php } ?> -->
                                                
                                                <th class="col-sm-2"><?=$this->lang->line('student_phone')?></th>
                                                <?php if(permissionChecker('student_edit')) { ?>
                                                    <th class="col-sm-1"><?=$this->lang->line('student_status')?></th>
                                                <?php } ?>
                                                <?php if(permissionChecker('student_edit') || permissionChecker('student_delete') || permissionChecker('student_view')) { ?>
                                                    <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(customCompute($students)) {$i = 1; foreach($students as $student) { ?>
                                                <tr>
                                                    <!-- <td data-title="<?=$this->lang->line('slno')?>">
                                                        <?php echo $i; ?>
                                                    </td> -->
                                                    <td class="editable" data-title="<?=$this->lang->line('student_roll')?>">
                                                    <span class="value"><?php echo $student->srroll; ?></span>
                                                    <div student_id="<?= $student->studentrelationID ?>" field_name="roll"></div>
                                                    </td>
                                                    <td class="editable" data-title="GR No">
                                                    <span class="value"><?php echo $student->srregisterNO; ?></span>
                                                    <div student_id="<?= $student->studentrelationID ?>" field_name="registerNO"></div>
                                                    </td>
                                                    <td class="editable" data-title="<?=$this->lang->line('student_name')?>">
                                                        <span><?php echo $student->srname; ?></span>
                                                        
                                                        <div student_id="<?= $student->studentrelationID ?>" field_name="name"></div>
                                                    </td>
                                                    <!-- php if($set==0) { ?> -->
                                                    <td data-title="<?=$this->lang->line('student_classes')?>">
                                                    <span class="value"> <?php echo $student->srclasses; ?></span>
                                                    <div></div>
                                                    </td>
                                                    <td data-title="<?=$this->lang->line('student_section')?>">
                                                    <span class="value"><?php echo $student->srsection; ?></span>
                                                    <div></div>
                                                    </td>
                                                    <!-- php } ?> -->
                                                    
                                                    <td class="editable" data-title="<?=$this->lang->line('student_phone')?>">
                                                    <span class="value"><?php echo $student->phone; ?></span>
                                                    <div student_id="<?= $student->studentID ?>" field_name="phone"></div>                                            
                                                    </td>
                                                    <?php if(permissionChecker('student_edit')) { ?>
                                                    <td data-title="<?=$this->lang->line('student_status')?>">
                                                        <div class="onoffswitch-small" id="<?=$student->srstudentID?>">
                                                            <input type="checkbox" id="myonoffswitch<?=$student->srstudentID?>" class="onoffswitch-small-checkbox" name="paypal_demo" <?php if($student->sris_active === '1') echo "checked='checked'"; ?>>
                                                            <label for="myonoffswitch<?=$student->srstudentID?>" class="onoffswitch-small-label">
                                                                <span class="onoffswitch-small-inner"></span>
                                                                <span class="onoffswitch-small-switch"></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <?php } ?>
                                                    <?php if(permissionChecker('student_edit') || permissionChecker('student_delete') || permissionChecker('student_view')) { ?>
                                                        <td data-title="<?=$this->lang->line('action')?>">
                                                            <?php
                                                                echo btn_view('student/view/'.$student->srstudentID."/".$student->classesID."/".$student->schoolyearID, $this->lang->line('view'));
                                                                if(($siteinfos->school_year == $this->session->userdata('defaultschoolyearID')) || ($this->session->userdata('usertypeID') == 1)) {
                                                                    echo btn_edit('student/edit/'.$student->srstudentID."/".$student->classesID, $this->lang->line('edit'));
                                                                    echo btn_delete('student/delete/'.$student->srstudentID."/".$student->classesID, $this->lang->line('delete'));
                                                                }
                                                            ?>
                                                        </td>
                                                    <?php } ?>
                                               </tr>
                                            <?php $i++; }} ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <?php foreach ($sections as $key => $section) { ?>
                                    <div id="tab<?=$section->classesID.$section->sectionID?>" class="tab-pane">
                                        <div id="hide-table">
                                            
                                            <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <!-- <th class="col-sm-1"><?=$this->lang->line('slno')?></th> -->
                                                        <th class="col-sm-2"><?=$this->lang->line('student_roll')?></th>
                                                        <th class="col-sm-2">GR No</th>
                                                        <th class="col-sm-2"><?=$this->lang->line('student_name')?></th>
                                                        
                                                        <th class="col-sm-2"><?=$this->lang->line('student_phone')?></th>
                                                        <?php if(permissionChecker('student_edit')) { ?>
                                                            <th class="col-sm-1"><?=$this->lang->line('student_status')?></th>
                                                        <?php } ?>
                                                        <?php if(permissionChecker('student_edit') || permissionChecker('student_delete') || permissionChecker('student_view')) { ?>
                                                            <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                                                        <?php } ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(customCompute($allsection[$section->sectionID])) { $i = 1; foreach($allsection[$section->sectionID] as $student) { if($section->sectionID === $student->srsectionID) {
                                                        
                                                        
                                                        ?>
                                                        <tr>
                                                        <!-- <td data-title="<?=$this->lang->line('slno')?>">
                                                        <?php echo $i; ?>
                                                    </td> -->
                                                    <td class="editable" data-title="<?=$this->lang->line('student_roll')?>">
                                                    <span class="value"><?php echo $student->srroll; ?></span>
                                                    <div student_id="<?= $student->studentrelationID ?>" field_name="roll"></div>
                                                    </td>

                                                    <td class="editable" data-title="GR No">
                                                    <span class="value"><?php echo $student->srregisterNO; ?></span>
                                                    <div student_id="<?= $student->studentrelationID ?>" field_name="registerNO"></div>
                                                    </td>
                                                    <td class="editable" data-title="<?=$this->lang->line('student_name')?>">
                                                        <span><?php echo $student->srname; ?></span>
                                                        
                                                        <div student_id="<?= $student->studentrelationID ?>" field_name="name"></div>
                                                    </td>
                                                    
                                                    <td class="editable" data-title="<?=$this->lang->line('student_phone')?>">
                                                    <span class="value"><?php echo $student->phone; ?></span>
                                                    <div student_id="<?= $student->studentID ?>" field_name="phone"></div>                                            
                                                    </td>
                                                    <?php if(permissionChecker('student_edit')) { ?>
                                                    <td data-title="<?=$this->lang->line('student_status')?>">
                                                        <div class="onoffswitch-small" id="<?=$student->srstudentID?>">
                                                            <input type="checkbox" id="myonoffswitch<?=$student->srstudentID?>" class="onoffswitch-small-checkbox" name="paypal_demo" <?php if($student->sris_active === '1') echo "checked='checked'"; ?>>
                                                            <label for="myonoffswitch<?=$student->srstudentID?>" class="onoffswitch-small-label">
                                                                <span class="onoffswitch-small-inner"></span>
                                                                <span class="onoffswitch-small-switch"></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <?php } ?>
                                                            <?php if(permissionChecker('student_edit') || permissionChecker('student_delete') || permissionChecker('student_view')) { ?>
                                                                <td data-title="<?=$this->lang->line('action')?>">
                                                                    <?php
                                                                        echo btn_view('student/view/'.$student->srstudentID."/".$set, $this->lang->line('view'));
                                                                        if(($siteinfos->school_year == $this->session->userdata('defaultschoolyearID')) || ($this->session->userdata('usertypeID') == 1)) {
                                                                            echo btn_edit('student/edit/'.$student->srstudentID."/".$set, $this->lang->line('edit'));
                                                                            echo btn_delete('student/delete/'.$student->srstudentID."/".$set, $this->lang->line('delete'));
                                                                        }
                                                                    ?>
                    
                                                                </td>
                                                            <?php } ?>
                                                       </tr>
                                                    <?php $i++; }}} ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                            <?php } ?>
                        </div>
                    </div> <!-- nav-tabs-custom -->
                <?php } else { ?>
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#all" aria-expanded="true"><?=$this->lang->line("student_all_students")?></a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="all" class="tab-pane active">
                                <div id="hide-table">
                                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                                        <thead>
                                            <tr>
                                                <!-- <th class="col-sm-2"><?=$this->lang->line('slno')?></th> -->
                                                <th class="col-sm-2"><?=$this->lang->line('student_roll')?></th>
                                                <th class="col-sm-2"><?=$this->lang->line('student_photo')?></th>
                                                <th class="col-sm-2"><?=$this->lang->line('student_name')?></th>
                                                
                                                <th class="col-sm-2"><?=$this->lang->line('student_email')?></th>
                                                <?php if(permissionChecker('student_edit')) { ?>
                                                    <th class="col-sm-1"><?=$this->lang->line('student_status')?></th>
                                                <?php } ?>
                                                <?php if(permissionChecker('student_edit') || permissionChecker('student_delete') || permissionChecker('student_view')) { ?>
                                                    <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> <!-- nav-tabs-custom -->
                <?php } ?>
            </div> <!-- col-sm-12 -->
        </div><!-- row -->
    </div><!-- Body -->
</div><!-- /.box -->

<script type="text/javascript">
    $(".select2").select2();

    $('#classesID').change(function() {
        var classesID = $(this).val();
        var schoolyearID = $("#schoolyearID").val();
        
        if(classesID == 0) {
            $('#hide-table').hide();
            $('.nav-tabs-custom').hide();
        } else {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('student/student_list')?>",
                data: "id=" + classesID+"&schoolyearID="+schoolyearID,
                dataType: "html",
                success: function(data) {
                    window.location.href = data;
                }
            });
        }
    });
    $('#schoolyearID').change(function() {
        var schoolyearID = $(this).val();
        var classesID = $("#classesID").val();
        
            $.ajax({
                type: 'POST',
                url: "<?=base_url('student/student_list')?>",
                data: "id=" + classesID+"&schoolyearID="+schoolyearID,
                dataType: "html",
                success: function(data) {
                    window.location.href = data;
                }
            });
        
    });


    var status = '';
    var id = 0;
    $('.onoffswitch-small-checkbox').click(function() {
        if($(this).prop('checked')) {
            status = 'chacked';
            id = $(this).parent().attr("id");
        } else {
            status = 'unchacked';
            id = $(this).parent().attr("id");
        }

        if((status != '' || status != null) && (id !='')) {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('student/active')?>",
                data: "id=" + id + "&status=" + status,
                dataType: "html",
                success: function(data) {
                    if(data == 'Success') {
                        toastr["success"]("Success")
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
                        toastr["error"]("Error")
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
            });
        }
    });
</script>
<script>
    

$('table tbody').on('dblclick', 'td.editable', function(){
  var valCell = $(this).find('span').text();
  
  $(this).find('span').hide();
  $(this).find('div').show().html('\
    <div class="input-group">\
      <input type="text" class="form-control" value="'+valCell+'" style="width:100px">\
      <span class="input-group-btn">\
        <button id="save" class="btn btn-default" type="button"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>\
        <button id="close" class="btn btn-default" type="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>\
      </span>\
    </div>');
  $(this).find('input').focus();
  $(this).closest('tbody').find('td').not($(this)).each(function(){
    $(this).find('span').show();
    $(this).find('div').hide();
  });
}); 

$('table').on('click','#close',function(){
  $(this).closest('td').find('span.value').show();
  $(this).closest('div').hide();
});
$('table').on('click','#save', function(){
   var getValueInput = $(this).closest('div').find('input').val();
  $(this).closest('td').find('span.value').text(getValueInput);
  
  $(this).closest('td').find('span.value').show();
  $(this).closest('div').hide();
  var field_name = $(this).closest('td').find('div').attr('field_name');
  var student_id = $(this).closest('td').find('div').attr('student_id');

  $.ajax({
                type: 'POST',
                url: "<?=base_url('student/update_inline_data')?>",
                data: "field_name="+field_name+"&value="+getValueInput+"&student_id="+student_id,
                dataType: "html",
                success: function(data) {
                    //window.location.href = data;
                }
    });
});
  </script>


