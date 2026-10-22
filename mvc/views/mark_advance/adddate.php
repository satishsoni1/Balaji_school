
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-flask"></i> <?= $this->lang->line('panel_title') ?></h3>
        <ol class="breadcrumb">
            <li><a href="<?= base_url("home/index") ?>"><i class="fa fa-laptop"></i> <?= $this->lang->line('menu_dashboard') ?></a></li>
            <li><a href="<?= base_url("mark/index") ?>"><?= $this->lang->line('menu_mark') ?></a></li>
            <li class="active"><?= $this->lang->line('menu_add') ?> <?= $this->lang->line('menu_mark') ?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
        <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
            <div class="col-sm-7">
                
                    <div class="<?php echo form_error('termonedate') ? 'form-group has-error' : 'form-group'; ?>">
                        <label for="termonedate" class="col-sm-4 control-label">
                        Term 1st result date <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                        <input type="text" class="form-control" id="termonedate" name="termonedate" value="<?= set_value('termonedate',date('d-m-Y',strtotime($result->termonedate))) ?>">
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('termonedate'); ?>
                        </span>
                    </div>
                    <div class="<?php echo form_error('termtwodate') ? 'form-group has-error' : 'form-group'; ?>">
                        <label for="termtwodate" class="col-sm-4 control-label">
                        Term 2nd result date <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                        <input type="text" class="form-control" id="termtwodate" name="termtwodate" value="<?= set_value('termtwodate',date('d-m-Y',strtotime($result->termtwodate))) ?>">
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('termtwodate'); ?>
                        </span>
                    </div>
                    <div class="<?php echo form_error('school_opening_date') ? 'form-group has-error' : 'form-group'; ?>">
                        <label for="schoolschool_opening_date" class="col-sm-4 control-label">
                        School Reopening date <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                        <input type="text" class="form-control" id="school_opening_date" name="school_opening_date" value="<?= set_value('school_opening_date',date('d-m-Y',strtotime($result->school_opening_date))) ?>">
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('school_opening_date'); ?>
                        </span>
                    </div>
                    <div class="<?php echo form_error('workingdaysjune') ? 'form-group has-error' : 'form-group'; ?>">
                        <label for="workingdaysjune" class="col-sm-4 control-label">
                        Working Days [June] <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                        <input type="text" class="form-control" id="workingdaysjune" name="workingdaysjune" value="<?= set_value('workingdaysjune',$result->working_days_june) ?>">
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('workingdaysjune'); ?>
                        </span>
                    </div>
                    <div class="<?php echo form_error('workingdaysjuly') ? 'form-group has-error' : 'form-group'; ?>">
                        <label for="workingdaysjuly" class="col-sm-4 control-label">
                        Working Days [July] <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                        <input type="text" class="form-control" id="workingdaysjuly" name="workingdaysjuly" value="<?= set_value('workingdaysjuly',$result->working_days_july) ?>">
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('workingdaysjuly'); ?>
                        </span>
                    </div>
                    <div class="<?php echo form_error('workingdaysaug') ? 'form-group has-error' : 'form-group'; ?>">
                        <label for="workingdaysaug" class="col-sm-4 control-label">
                        Working Days [Aug] <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                        <input type="text" class="form-control" id="workingdaysaug" name="workingdaysaug" value="<?= set_value('workingdaysaug',$result->working_days_aug) ?>">
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('workingdaysaug'); ?>
                        </span>
                    </div>
                    <div class="<?php echo form_error('workingdayssept') ? 'form-group has-error' : 'form-group'; ?>">
                        <label for="workingdayssept" class="col-sm-4 control-label">
                        Working Days [Sept] <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                        <input type="text" class="form-control" id="workingdayssept" name="workingdayssept" value="<?= set_value('workingdayssept',$result->working_days_sept) ?>">
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('workingdayssept'); ?>
                        </span>
                    </div>
                    <div class="<?php echo form_error('workingdaysoct') ? 'form-group has-error' : 'form-group'; ?>">
                        <label for="workingdaysoct" class="col-sm-4 control-label">
                        Working Days [Oct] <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                        <input type="text" class="form-control" id="workingdaysoct" name="workingdaysoct" value="<?= set_value('workingdaysoct',$result->working_days_oct) ?>">
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('workingdaysoct'); ?>
                        </span>
                    </div>
                    <div class="<?php echo form_error('workingdaysnov') ? 'form-group has-error' : 'form-group'; ?>">
                        <label for="workingdaysnov" class="col-sm-4 control-label">
                        Working Days [Nov] <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                        <input type="text" class="form-control" id="workingdaysnov" name="workingdaysnov" value="<?= set_value('workingdaysnov',$result->working_days_nov) ?>">
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('workingdaysnov'); ?>
                        </span>
                    </div>
                    <div class="<?php echo form_error('workingdaysdec') ? 'form-group has-error' : 'form-group'; ?>">
                        <label for="workingdaysdec" class="col-sm-4 control-label">
                        Working Days [Dec] <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                        <input type="text" class="form-control" id="workingdaysdec" name="workingdaysdec" value="<?= set_value('workingdaysdec',$result->working_days_dec) ?>">
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('workingdaysdec'); ?>
                        </span>
                    </div>
                    <div class="<?php echo form_error('workingdaysjan') ? 'form-group has-error' : 'form-group'; ?>">
                        <label for="workingdaysjan" class="col-sm-4 control-label">
                        Working Days [Jan] <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                        <input type="text" class="form-control" id="workingdaysjan" name="workingdaysjan" value="<?= set_value('workingdaysjan',$result->working_days_jan) ?>">
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('workingdaysjan'); ?>
                        </span>
                    </div>
                    <div class="<?php echo form_error('workingdaysfeb') ? 'form-group has-error' : 'form-group'; ?>">
                        <label for="workingdaysfeb" class="col-sm-4 control-label">
                        Working Days [Feb] <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                        <input type="text" class="form-control" id="workingdaysfeb" name="workingdaysfeb" value="<?= set_value('workingdaysfeb',$result->working_days_feb) ?>">
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('workingdaysfeb'); ?>
                        </span>
                    </div>
                    <div class="<?php echo form_error('workingdaysmarch') ? 'form-group has-error' : 'form-group'; ?>">
                        <label for="workingdaysmarch" class="col-sm-4 control-label">
                        Working Days [March] <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                        <input type="text" class="form-control" id="workingdaysmarch" name="workingdaysmarch" value="<?= set_value('workingdaysmarch',$result->working_days_march) ?>">
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('workingdaysmarch'); ?>
                        </span>
                    </div>
                    <div class="<?php echo form_error('workingdaysapril') ? 'form-group has-error' : 'form-group'; ?>">
                        <label for="workingdaysapril" class="col-sm-4 control-label">
                        Working Days [April] <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                        <input type="text" class="form-control" id="workingdaysapril" name="workingdaysapril" value="<?= set_value('workingdaysapril',$result->working_days_apr) ?>">
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('workingdaysapril'); ?>
                        </span>
                    </div>
                    <div class="<?php echo form_error('workingdaysmay') ? 'form-group has-error' : 'form-group'; ?>">
                        <label for="workingdaysmay" class="col-sm-4 control-label">
                        Working Days [May] <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                        <input type="text" class="form-control" id="workingdaysmay" name="workingdaysmay" value="<?= set_value('workingdaysmay',$result->working_days_may) ?>">
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('workingdaysmay'); ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <input type="submit" class="btn btn-success" value="Submit" >
                        </div>
                    </div>
            </div>
        </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.select2').select2();
    $('#termtwodate').datepicker({ startView: 2 });
    $('#termonedate').datepicker({ startView: 2 });
    $('#school_opening_date').datepicker({ startView: 2 });

    
</script>