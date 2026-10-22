<?php $tab = (isset($_GET['tab'])) ? $_GET['tab'] : null; ?> 
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-student"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("home/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("student/index/$set")?>"><?=$this->lang->line('menu_student')?></a></li>
            <li class="active"><?=$this->lang->line('menu_edit')?> <?=$this->lang->line('menu_student')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
    <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="<?= ($tab == 'profile' || $tab == null) ? 'active' : ''; ?>"><a href="#profile" data-toggle="tab"><?= $this->lang->line('student_profile') ?></a></li>
                <li class="<?= ($tab == 'parents') ? 'active' : ''; ?>"><a href="#parents" data-toggle="tab"><?= $this->lang->line('student_parents') ?></a></li>
                <li class="<?= ($tab == 'document') ? 'active' : ''; ?>"><a href="#document" data-toggle="tab"><?= $this->lang->line('student_document') ?></a></li>
                <li class="<?= ($tab == 'invoice') ? 'active' : ''; ?>"><a href="#invoice" data-toggle="tab"><?= $this->lang->line('student_invoice') ?></a></li>
                <li class="<?= ($tab == 'payment') ? 'active' : ''; ?>"><a href="#payment" data-toggle="tab"><?= $this->lang->line('student_payment') ?></a></li>
                
            </ul>

            <div class="tab-content">
                <div class="<?= ($tab == 'profile' || $tab == null) ? 'active' : ''; ?> tab-pane" id="profile">
                    <div class="panel-body profile-view-dis">
        <div class="row">
        <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
            <div class="col-sm-7">

                
                <?php
                        if(form_error('student_type'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="student_type" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_type")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <?php
                                $student_type_array = array(
                                    '0' => $this->lang->line('student_type'),
                                    'Old' => 'Old',
                                    'New' => 'New',
                                    'RTE' => 'RTE',
                                    
                                );
                                echo form_dropdown("student_type", $student_type_array, set_value("student_type",$student->student_type), "id='student_type' class='form-control select2'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('student_type'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('form_no'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="form_no" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_form_no")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="form_no" name="form_no" value="<?=set_value('form_no',$student->form_no)?>" readonly>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('form_no'); ?>
                        </span>
                    </div>
                    <?php 
                        if(form_error('classesID')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="classesID" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_classes")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <?php
                                $classArray = array(0 => $this->lang->line("student_select_class"));
                                foreach ($classes as $classa) {
                                    $classArray[$classa->classesID] = $classa->classes;
                                }
                                echo form_dropdown("classesID", $classArray, set_value("classesID", $student->srclassesID), "id='classesID' class='form-control select2'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('classesID'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('sectionID')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="sectionID" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_section")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <?php
                                $array = array(0 => $this->lang->line("student_select_section"));
                                foreach ($sections as $section) {
                                    $array[$section->sectionID] = $section->section;
                                }
                                echo form_dropdown("sectionID", $array, set_value("sectionID", $student->srsectionID), "id='sectionID' class='form-control select2'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('sectionID'); ?>
                        </span>
                    </div>
                    <?php 
                        if(form_error('registerNO')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="registerNO" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_registerNO")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="registerNO" name="registerNO" value="<?=set_value('registerNO', $student->srregisterNO)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('registerNO'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('student_id'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="student_id" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_studentID")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="student_id" name="student_id" value="<?=set_value('student_id', $student->srstudent_id)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('student_id'); ?>
                        </span>
                    </div>
                    <?php 
                        if(form_error('roll')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="roll" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_roll")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="roll" name="roll" value="<?=set_value('roll', $student->srroll)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('roll'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('aadhar_card'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="aadhar_card" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_aadhar_card")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="aadhar_card" name="aadhar_card" value="<?=set_value('aadhar_card',$student->aadhar_card)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('aadhar_card'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('pen_no'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="pen_no" class="col-sm-4 control-label">
                            PEN NO <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="pen_no" name="pen_no" value="<?=set_value('pen_no',$student->pen_no)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('pen_no'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('packageID'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="packageID" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_package")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                        <?php
                            $packagesArray = array('0' => $this->lang->line("student_select_package"));
                            if(customCompute($packages)) {
                                foreach ($packages as $package) {
                                    $packagesArray[$package->id] = $package->name;
                                }
                            }

                            echo form_dropdown("packageID", $packagesArray, set_value("packageID",$student->packageID), "id='packageID' class='form-control select2'");
                        ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('packageID'); ?>
                        </span>
                    </div>
                    <?php 
                        if(form_error('name')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="name_id" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_name")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="name_id" name="name" value="<?=set_value('name', $student->name)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('name'); ?>
                        </span>
                    </div>
<!-- 
                    <?php 
                        if(form_error('guargianID')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="guargianID" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_guargian")?>
                        </label>
                        <div class="col-sm-6">
                            <?php
                                $array = array('0' => $this->lang->line('student_select_guargian'));
                                foreach ($student_parents as $parent) {
                                    $parentsemail = '';
                                    if($parent->email) {
                                        $parentsemail = " (" . $parent->email ." )";
                                    }
                                    $array[$parent->parentsID] = $parent->name.$parentsemail;
                                }
                                echo form_dropdown("guargianID", $array, set_value("guargianID", $student->parentID), "id='guargianID' class='form-control guargianID select2'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('guargianID'); ?>
                        </span>
                    </div> -->

                    <?php 
                        if(form_error('admission_date')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="admission_date" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_admission_date")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <?php $admission_date = ''; if($student->admission_date) { $admission_date = date("d-m-Y", strtotime($student->admission_date)); }  ?>
                            <input type="text" class="form-control" id="admission_date" name="admission_date" value="<?=set_value('admission_date', $admission_date)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('admission_date'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('dob')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="dob" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_dob")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <?php $dob = ''; if($student->dob) { $dob = date("d-m-Y", strtotime($student->dob)); }  ?>
                            <input type="text" class="form-control" id="dob" name="dob" value="<?=set_value('dob', $dob)?>" >
                            <span></span>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('dob'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('birth_place'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="dob" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_birth_place")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="birth_place" name="birth_place" value="<?=set_value('birth_place',$student->birth_place)?>" >
                            
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('birth_place'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('birth_taluka'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="dob" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_birth_taluka")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="birth_taluka" name="birth_taluka" value="<?=set_value('birth_taluka',$student->birth_taluka)?>" >
                            
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('birth_taluka'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('birth_district'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="dob" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_birth_district")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="birth_district" name="birth_district" value="<?=set_value('birth_district',$student->birth_district)?>" >
                            
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('birth_district'); ?>
                        </span>
                    </div>
                    <!-- <?php
                        if(form_error('birth_city'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="dob" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_birth_city")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="birth_city" name="birth_city" value="<?=set_value('birth_city',$student->birth_city)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('birth_city'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('birth_state'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="dob" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_birth_state")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="birth_state" name="birth_state" value="<?=set_value('birth_state',$student->birth_state)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('birth_state'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('birth_country'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="dob" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_birth_country")?>
                        </label>
                        <div class="col-sm-6">
                        <?php
                                $country['0'] = $this->lang->line('student_select_country');
                                foreach ($allcountry as $allcountryKey => $allcountryit) {
                                    $country[$allcountryKey] = $allcountryit;
                                }
                            ?>
                            <?php
                                echo form_dropdown("birth_country", $country, set_value("birth_country",$student->birth_country), "id='birth_country' class='form-control select2'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('birth_country'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('birth_pincode'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="dob" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_birth_pincode")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="pincode" class="form-control" id="birth_pincode" name="birth_pincode" value="<?=set_value('birth_pincode',$student->birth_pincode)?>" >
                            
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('birth_pincode'); ?>
                        </span>
                    </div> -->
                    <?php
                        if(form_error('birth_certificate_no'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="dob" class="col-sm-4 control-label">
                        Birth Certificate No 
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="birth_certificate_no" name="birth_certificate_no" value="<?=set_value('birth_certificate_no',$student->birth_certificate_no)?>" >
                            
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('birth_certificate_no'); ?>
                        </span>
                    </div>
                    <!-- <?php
                        if(form_error('birth_certificate_date'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="dob" class="col-sm-4 control-label">
                        Birth Certificate Date
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="birth_certificate_date" name="birth_certificate_date" value="<?=set_value('birth_certificate_date',date('d-m-Y',strtotime($student->birth_certificate_date)))?>" >
                            
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('birth_certificate_date'); ?>
                        </span>
                    </div> -->
                    <?php
                        if(form_error('rashan_card'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="dob" class="col-sm-4 control-label">
                        Rashan card
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="rashan_card" name="rashan_card" value="<?=set_value('rashan_card',$student->rashan_card)?>" >
                            
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('rashan_card'); ?>
                        </span>
                    </div>
                    <?php 
                        if(form_error('sex')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="sex" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_sex")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <?php 
                                echo form_dropdown("sex", array($this->lang->line('student_sex_male') => $this->lang->line('student_sex_male'), $this->lang->line('student_sex_female') => $this->lang->line('student_sex_female')), set_value("sex", $student->sex), "id='sex' class='form-control'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('sex'); ?>
                        </span>

                    </div>

                    <?php 
                        if(form_error('bloodgroup')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="bloodgroup" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_bloodgroup")?>
                        </label>
                        <div class="col-sm-6">
                            <?php 
                                $bloodArray = array(
                                    '0' => $this->lang->line('student_select_bloodgroup'),
                                    'A+' => 'A+',
                                    'A-' => 'A-',
                                    'B+' => 'B+',
                                    'B-' => 'B-',
                                    'O+' => 'O+',
                                    'O-' => 'O-',
                                    'AB+' => 'AB+',
                                    'AB-' => 'AB-'
                                );
                                echo form_dropdown("bloodgroup", $bloodArray, set_value("bloodgroup", $student->bloodgroup), "id='bloodgroup' class='form-control select2'"); 
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('bloodgroup'); ?>
                        </span>
                    </div>

                   
                    <?php 
                        if(form_error('religion')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="religion" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_religion")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="religion" name="religion" value="<?=set_value('religion', $student->religion)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('religion'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('email')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="email" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_email")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="email" name="email" value="<?=set_value('email', $student->email)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('email'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('phone')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="phone" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_phone")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="phone" name="phone" value="<?=set_value('phone', $student->phone)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('phone'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('address')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="address" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_address")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="address" name="address" value="<?=set_value('address', $student->address)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('address'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('state')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="state" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_state")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="state" name="state" value="<?=set_value('state', $student->state)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('state'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('country')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="country" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_country")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <?php
                                $country['0'] = $this->lang->line('student_select_country');  
                                foreach ($allcountry as $allcountryKey => $allcountryit) {
                                    $country[$allcountryKey] = $allcountryit;
                                }
                            ?>
                            <?php 
                                echo form_dropdown("country", $country, set_value("country", $student->country), "id='country' class='form-control select2'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('country'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('mother_tongue'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="mother_tongue" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_mother_tongue")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="mother_tongue" name="mother_tongue" value="<?=set_value('mother_tongue',$student->mother_tongue)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('mother_tongue'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('category'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="category" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_category")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                        <?php
                                $categoryArray = array(
                                    '0' => $this->lang->line('student_select_category'),
                                    'OPEN' => 'OPEN',
                                    'OBC' => 'OBC',
                                    'ST' => 'ST',
                                    'SC' => 'SC',
                                    'VJ' => 'VJ',
                                    'NT' => 'NT',
                                    'NT-B' => 'NT-B'
                                );
                                echo form_dropdown("category", $categoryArray, set_value("category",$student->category), "id='category' class='form-control select2'");
                            ?>
                            
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('category'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('caste'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="caste" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_caste")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="caste" name="caste" value="<?=set_value('caste',$student->caste)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('caste'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('subcaste'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="subcaste" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_subcaste")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="subcaste" name="subcaste" value="<?=set_value('subcaste',$student->subcaste)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('subcaste'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('last_school_attendant'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="state" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_last_school_attendant")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="last_school_attendant" name="last_school_attendant" value="<?=set_value('last_school_attendant',$student->last_school_attendant)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('last_school_attendant'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('last_school_attendant_address'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="state" class="col-sm-4 control-label">
                        Last school attendant Address
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="last_school_attendant_address" name="last_school_attendant_address" value="<?=set_value('last_school_attendant_address',$student->last_school_attendant_address)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('last_school_attendant_address'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('reason'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="reason" class="col-sm-4 control-label">
                        Reason
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="reason" name="reason" value="<?=set_value('reason',$student->reason)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('reason'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('last_class'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="last_class" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_last_class")?>
                        </label>
                        <div class="col-sm-6">
                        <?php
                                $classArray = array(0 => $this->lang->line("student_select_class"));
                                foreach ($classes as $classa) {
                                    $classArray[$classa->classesID] = $classa->classes;
                                }
                                echo form_dropdown("last_class", $classArray, set_value("last_class",$student->last_class), "id='last_class' class='form-control select2'");
                            ?>
                            
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('last_class'); ?>
                        </span>
                    </div>
                    
                    <!-- <?php
                        if(form_error('local_address'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="local_address" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_local_address")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="local_address" name="local_address" value="<?=set_value('local_address',$student->local_address)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('local_address'); ?>
                        </span>
                    </div> -->
                    

                    <!-- <div class="form-group <?=form_error('studentGroupID') ? ' has-error' : ''  ?>">
                        <label for="studentGroupID" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_studentgroup")?>
                        </label>
                        <div class="col-sm-6">
                            <?php
                            $groupArray = array(0 => $this->lang->line("student_select_studentgroup"));
                            if(customCompute($studentgroups)) {
                                foreach ($studentgroups as $studentgroup) {
                                    $groupArray[$studentgroup->studentgroupID] = $studentgroup->group;
                                }
                            }
                            echo form_dropdown("studentGroupID", $groupArray, set_value("studentGroupID", $student->srstudentgroupID), "id='studentGroupID' class='form-control select2'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('studentGroupID'); ?>
                        </span>
                    </div> -->

                    <div class="form-group <?=form_error('optionalSubjectID') ? ' has-error' : ''  ?>">
                        <label for="optionalSubjectID" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_optionalsubject")?>
                        </label>
                        <div class="col-sm-6">
                            <?php
                            $optionalSubjectArray = array(0 => $this->lang->line("student_select_optionalsubject"));
                            if($optionalSubjects != "empty") {
                                foreach ($optionalSubjects as $optionalSubject) {
                                    $optionalSubjectArray[$optionalSubject->subjectID] = $optionalSubject->subject;
                                }
                            }

                            echo form_dropdown("optionalSubjectID", $optionalSubjectArray, set_value("optionalSubjectID", $student->sroptionalsubjectID), "id='optionalSubjectID' class='form-control select2'");
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('optionalSubjectID'); ?>
                        </span>
                    </div>

                    

                   

                    <!-- <div class="form-group <?=form_error('extraCurricularActivities') ? ' has-error' : ''  ?>">
                        <label for="extraCurricularActivities" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_extracurricularactivities")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="extraCurricularActivities" name="extraCurricularActivities" value="<?=set_value('extraCurricularActivities', $student->extracurricularactivities)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('extraCurricularActivities'); ?>
                        </span>
                    </div>

                    <div class="form-group <?=form_error('remarks') ? ' has-error' : ''  ?>">
                        <label for="remarks" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_remarks")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="remarks" name="remarks" value="<?=set_value('remarks', $student->remarks)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('remarks'); ?>
                        </span>
                    </div> -->

                    <!-- <?php 
                        if(form_error('username')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="username" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_username")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="username" name="username" value="<?=set_value('username', $student->username)?>" >
                        </div>
                         <span class="col-sm-4 control-label">
                            <?php echo form_error('username'); ?>
                        </span>
                    </div> -->
                    <?php
                        if(form_error('handicap'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="handicap" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_handicap")?>
                        </label>
                        
                        <div class="col-sm-6" style="display: flex;">
                        <input type="checkbox" class="handicap_enable" <?= ($student->handicap && $student->handicap!="")?"checked":"" ?> name="handicap_enable" style="margin-right:1rem">
                            <div class="handicap_div">
                                <input type="text" class="form-control" id="handicap" name="handicap" value="<?=set_value('handicap', $student->handicap)?>" >
                            </div>
                            <!-- <input type="text" class="form-control" id="handicap" name="handicap" value="<?=set_value('handicap')?>" > -->
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('handicap'); ?>
                        </span>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("update_student")?>" >
                            <a style="padding-left:1rem;" href="<?= base_url() ?>/student/edit/<?= $student->studentID ?>/<?= $student->classesID ?>/?tab=parents"><input type="button" class="btn btn-success" value="Next" ></a>
                        </div>
                    </div>

                

            </div> <!-- col-sm-8 -->
            <div class="col-sm-5">

<?php
if(form_error('photo'))
    echo "<div class='form-group has-error'>";
else
    echo "<div class='form-group'>";
?>

<label for="photo" class="col-sm-2 control-label">
    <?=$this->lang->line("student_photo")?> <span class="text-red">*</span>
</label>

<div class="col-sm-8">

    <!-- Existing Photo -->
    <img 
        id="preview"
        src="<?= base_url('uploads/images/'.$student->photo) ?>"
        style="width:150px;height:180px;border:1px solid #ccc;padding:5px;margin-bottom:10px;"
    >

    <!-- Hidden Webcam Base64 -->
    <input type="hidden" name="photo_base64" id="photo_base64">

    <!-- File Upload -->
    <input type="file" name="photo" id="photo" class="form-control" accept="image/*">

    <br>

    <!-- Webcam Buttons -->
    <button type="button" class="btn btn-primary" onclick="startCamera()">Open Camera</button>
    <button type="button" class="btn btn-success" onclick="takeSnapshot()">Capture</button>

    <br><br>

    <!-- Webcam Video -->
    <video id="video" width="220" height="180" autoplay style="display:none;border:1px solid #ccc;"></video>

    <!-- Canvas -->
    <canvas id="canvas" width="220" height="180" style="display:none;"></canvas>

</div>

<span class="col-sm-4">
    <?php echo form_error('photo'); ?>
</span>

</div>

<script>
let stream;

function startCamera() {
    navigator.mediaDevices.getUserMedia({ video: true })
    .then(function(s) {
        stream = s;
        document.getElementById('video').style.display = 'block';
        document.getElementById('video').srcObject = stream;
    });
}

function takeSnapshot() {
    let video = document.getElementById("video");
    let canvas = document.getElementById("canvas");

    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;

    let ctx = canvas.getContext("2d");
    ctx.drawImage(video, 0, 0);

    let imageData = canvas.toDataURL("image/jpeg", 0.9);

    document.getElementById("photo_base64").value = imageData;
    document.getElementById("preview").src = imageData;
}

// File preview
document.getElementById('photo').addEventListener('change', function(e){
    const file = e.target.files[0];
    if(file){
        document.getElementById('preview').src = URL.createObjectURL(file);
        document.getElementById('photo_base64').value = '';
    }
});
</script>
</div>
            </form>
        </div><!-- row -->
        </div><!-- panel-body -->
        </div><!-- tab-pane -->
        
			              	<div class="<?= ($tab == 'parents') ? 'active' : ''; ?> tab-pane" id="parents">
			              		<div class="panel-body profile-view-dis">
                                  <div class="row">
            <div class="col-sm-10">
            <?php if(customCompute($parents)) { ?>
                <form class="form-horizontal" action="<?= base_url('parents/edittostudent/'.$parents->parentsID) ?>" id="edittostudent" 3role="form" method="post" enctype="multipart/form-data">

                    <!-- <?php 
                        if(form_error('name')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="name_id" class="col-sm-2 control-label">
                            <?=$this->lang->line("parents_guargian_name")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="name_id" name="name" value="<?=set_value('name', $parents->name)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('name'); ?>
                        </span>
                    </div> -->

                    <?php 
                        if(form_error('father_name')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="father_name" class="col-sm-2 control-label">
                            <?=$this->lang->line("parents_father_name")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="father_name" name="father_name" value="<?=set_value('father_name', $parents->father_name)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('father_name'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('father_profession')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="father_profession" class="col-sm-2 control-label">
                            <?=$this->lang->line("parents_father_profession")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="father_profession" name="father_profession" value="<?=set_value('father_profession', $parents->father_profession)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('father_profession'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('father_education')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="father_education" class="col-sm-2 control-label">
                            <?=$this->lang->line("parents_father_education")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="father_education" name="father_education" value="<?=set_value('father_education', $parents->father_education)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('father_education'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('mother_name')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="mother_name" class="col-sm-2 control-label">
                            <?=$this->lang->line("parents_mother_name")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="mother_name" name="mother_name" value="<?=set_value('mother_name', $parents->mother_name)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('mother_name'); ?>
                        </span>
                    </div>

                   

                    <?php 
                        if(form_error('mother_profession')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="mother_profession" class="col-sm-2 control-label">
                            <?=$this->lang->line("parents_mother_profession")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="mother_profession" name="mother_profession" value="<?=set_value('mother_profession', $parents->mother_profession)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('mother_profession'); ?>
                        </span>
                    </div>
                    

                    <?php 
                        if(form_error('mother_education')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="mother_education" class="col-sm-2 control-label">
                            <?=$this->lang->line("parents_mother_education")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="mother_education" name="mother_education" value="<?=set_value('mother_education', $parents->mother_education)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('mother_education'); ?>
                        </span>
                    </div>
                    <?php 
                        if(form_error('mother_phone_no')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="mother_education" class="col-sm-2 control-label">
                            <?=$this->lang->line("parent_mother_phone_no")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="mother_phone_no" name="mother_phone_no" value="<?=set_value('mother_phone_no', $parents->mother_phone_no)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('mother_phone_no'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('email')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="email" class="col-sm-2 control-label">
                            <?=$this->lang->line("parents_email")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="email" name="email" value="<?=set_value('email', $parents->email)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('email'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('phone')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="phone" class="col-sm-2 control-label">
                            <?=$this->lang->line("parents_phone")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="phone" name="phone" value="<?=set_value('phone', $parents->phone)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('phone'); ?>
                        </span>
                    </div>

                    <!-- <?php 
                        if(form_error('address')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="address" class="col-sm-2 control-label">
                            <?=$this->lang->line("parents_address")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="address" name="address" value="<?=set_value('address', $parents->address)?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('address'); ?>
                        </span>
                    </div> -->

                    <!-- <?php
                        if(form_error('photo'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="photo" class="col-sm-2 control-label">
                            <?=$this->lang->line("parents_photo")?>
                        </label>
                        <div class="col-sm-6">
                            <div class="input-group image-preview">
                                <input type="text" class="form-control image-preview-filename" disabled="disabled">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                        <span class="fa fa-remove"></span>
                                        <?=$this->lang->line('parents_clear')?>
                                    </button>
                                    <div class="btn btn-success image-preview-input">
                                        <span class="fa fa-repeat"></span>
                                        <span class="image-preview-input-title">
                                        <?=$this->lang->line('parents_file_browse')?></span>
                                        <input type="file" accept="image/png, image/jpeg, image/gif" name="photo"/>
                                    </div>
                                </span>
                            </div>
                        </div>

                        <span class="col-sm-4">
                            <?php echo form_error('photo'); ?>
                        </span>
                    </div>

                    <?php 
                        if(form_error('username')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="username" class="col-sm-2 control-label">
                            <?=$this->lang->line("parents_username")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="username" name="username" value="<?=set_value('username', $parents->username)?>" >
                        </div>
                         <span class="col-sm-4 control-label">
                            <?php echo form_error('username'); ?>
                        </span>
                    </div> -->

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("update_parents")?>" >
                            <a style="padding-left:1rem;"  href="<?= base_url() ?>/student/edit/<?= $student->studentID ?>/<?= $student->classesID ?>/?tab=document"><input type="button" class="btn btn-success" value="Next" ></a>
                        </div>
                    </div>

                </form>
                <?php }else{ ?>
                    <form class="form-horizontal" action="<?= base_url('/parents/addtostudent/'.$student->studentID) ?>" id="addtostudent" role="form" method="post" enctype="multipart/form-data">

<!-- <?php
    if(form_error('name'))
        echo "<div class='form-group has-error' >";
    else
        echo "<div class='form-group' >";
?>
    <label for="name_id" class="col-sm-2 control-label">
        <?=$this->lang->line("parents_guargian_name")?> <span class="text-red">*</span>
    </label>
    <div class="col-sm-6">
        <input type="text" class="form-control" id="name_id" name="name" value="<?=set_value('name')?>" >
    </div>
    <span class="col-sm-4 control-label">
        <?php echo form_error('name'); ?>
    </span>
</div> -->

<?php
    if(form_error('father_name'))
        echo "<div class='form-group has-error' >";
    else
        echo "<div class='form-group' >";
?>
    <label for="father_name" class="col-sm-2 control-label">
        <?=$this->lang->line("parents_father_name")?>
    </label>
    <div class="col-sm-6">
        <input type="text" class="form-control" id="father_name" name="father_name" value="<?=set_value('father_name')?>" >
    </div>
    <span class="col-sm-4 control-label">
        <?php echo form_error('father_name'); ?>
    </span>
</div>

<?php
    if(form_error('father_profession'))
        echo "<div class='form-group has-error' >";
    else
        echo "<div class='form-group' >";
?>
    <label for="father_profession" class="col-sm-2 control-label">
        <?=$this->lang->line("parents_father_profession")?>
    </label>
    <div class="col-sm-6">
        <input type="text" class="form-control" id="father_profession" name="father_profession" value="<?=set_value('father_profession')?>" >
    </div>
    <span class="col-sm-4 control-label">
        <?php echo form_error('father_profession'); ?>
    </span>
</div>


<?php
    if(form_error('father_education'))
        echo "<div class='form-group has-error' >";
    else
        echo "<div class='form-group' >";
?>
    <label for="father_education" class="col-sm-2 control-label">
        <?=$this->lang->line("parents_father_education")?>
    </label>
    <div class="col-sm-6">
        <input type="text" class="form-control" id="father_education" name="father_education" value="<?=set_value('father_education')?>" >
    </div>
    <span class="col-sm-4 control-label">
        <?php echo form_error('father_education'); ?>
    </span>
</div>


<?php
    if(form_error('mother_name'))
        echo "<div class='form-group has-error' >";
    else
        echo "<div class='form-group' >";
?>
    <label for="mother_name" class="col-sm-2 control-label">
        <?=$this->lang->line("parents_mother_name")?>
    </label>
    <div class="col-sm-6">
        <input type="text" class="form-control" id="mother_name" name="mother_name" value="<?=set_value('mother_name')?>" >
    </div>
    <span class="col-sm-4 control-label">
        <?php echo form_error('mother_name'); ?>
    </span>
</div>



<?php
    if(form_error('mother_profession'))
        echo "<div class='form-group has-error' >";
    else
        echo "<div class='form-group' >";
?>
    <label for="mother_profession" class="col-sm-2 control-label">
        <?=$this->lang->line("parents_mother_profession")?>
    </label>
    <div class="col-sm-6">
        <input type="text" class="form-control" id="mother_profession" name="mother_profession" value="<?=set_value('mother_profession')?>" >
    </div>
    <span class="col-sm-4 control-label">
        <?php echo form_error('mother_profession'); ?>
    </span>
</div>


<?php
    if(form_error('mother_education'))
        echo "<div class='form-group has-error' >";
    else
        echo "<div class='form-group' >";
?>
    <label for="mother_education" class="col-sm-2 control-label">
        <?=$this->lang->line("parents_mother_education")?>
    </label>
    <div class="col-sm-6">
        <input type="text" class="form-control" id="mother_education" name="mother_education" value="<?=set_value('mother_education')?>" >
    </div>
    <span class="col-sm-4 control-label">
        <?php echo form_error('mother_education'); ?>
    </span>
</div>

<?php
    if(form_error('email'))
        echo "<div class='form-group has-error' >";
    else
        echo "<div class='form-group' >";
?>
    <label for="email" class="col-sm-2 control-label">
        <?=$this->lang->line("parents_email")?>
    </label>
    <div class="col-sm-6">
        <input type="text" class="form-control" id="email" name="email" value="<?=set_value('email')?>" >
    </div>
    <span class="col-sm-4 control-label">
        <?php echo form_error('email'); ?>
    </span>
</div>

<?php
    if(form_error('phone'))
        echo "<div class='form-group has-error' >";
    else
        echo "<div class='form-group' >";
?>
    <label for="phone" class="col-sm-2 control-label">
        <?=$this->lang->line("parents_phone")?>
    </label>
    <div class="col-sm-6">
        <input type="text" class="form-control" id="phone" name="phone" value="<?=set_value('phone')?>" >
    </div>
    <span class="col-sm-4 control-label">
        <?php echo form_error('phone'); ?>
    </span>
</div>

<!-- <?php
    if(form_error('address'))
        echo "<div class='form-group has-error' >";
    else
        echo "<div class='form-group' >";
?>
    <label for="address" class="col-sm-2 control-label">
        <?=$this->lang->line("parents_address")?>
    </label>
    <div class="col-sm-6">
        <input type="text" class="form-control" id="address" name="address" value="<?=set_value('address')?>" >
    </div>
    <span class="col-sm-4 control-label">
        <?php echo form_error('address'); ?>
    </span>
</div>

<?php
    if(form_error('photo'))
        echo "<div class='form-group has-error' >";
    else
        echo "<div class='form-group' >";
?>
    <label for="photo" class="col-sm-2 control-label">
        <?=$this->lang->line("parents_photo")?>
    </label>
    <div class="col-sm-6">
        <div class="input-group image-preview">
            <input type="text" class="form-control image-preview-filename" disabled="disabled">
            <span class="input-group-btn">
                <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                    <span class="fa fa-remove"></span>
                    <?=$this->lang->line('parents_clear')?>
                </button>
                <div class="btn btn-success image-preview-input">
                    <span class="fa fa-repeat"></span>
                    <span class="image-preview-input-title">
                    <?=$this->lang->line('parents_file_browse')?></span>
                    <input type="file" accept="image/png, image/jpeg, image/gif" name="photo"/>
                </div>
            </span>
        </div>
    </div>

    <span class="col-sm-4">
        <?php echo form_error('photo'); ?>
    </span>
</div>

<?php
    if(form_error('username'))
        echo "<div class='form-group has-error' >";
    else
        echo "<div class='form-group' >";
?>
    <label for="username" class="col-sm-2 control-label">
        <?=$this->lang->line("parents_username")?> <span class="text-red">*</span>
    </label>
    <div class="col-sm-6">
        <input type="text" class="form-control" id="username" name="username" value="<?=set_value('username')?>" >
    </div>
     <span class="col-sm-4 control-label">
        <?php echo form_error('username'); ?>
    </span>
</div>

<?php
    if(form_error('password'))
        echo "<div class='form-group has-error' >";
    else
        echo "<div class='form-group' >";
?>
    <label for="password" class="col-sm-2 control-label">
        <?=$this->lang->line("parents_password")?> <span class="text-red">*</span>
    </label>
    <div class="col-sm-6">
        <input type="password" class="form-control" id="password" name="password" value="<?=set_value('password')?>" >
    </div>
     <span class="col-sm-4 control-label">
        <?php echo form_error('password'); ?>
    </span>
</div> -->

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-8">
        <input type="submit" class="btn btn-success" value="<?=$this->lang->line("add_parents")?>" >
        <a style="padding-left:1rem;"  href="<?= base_url() ?>/student/edit/<?= $student->studentID ?>/<?= $student->classesID ?>/?tab=document"><input type="button" class="btn btn-success" value="Next" ></a>
                        </div>
</div>

</form>
                    <?php } ?>
            </div> <!-- col-sm-8 -->
        </div><!-- row -->
				                </div>
			              	</div>
			            
        <div class="<?= ($tab == 'invoice') ? 'active' : ''; ?> tab-pane" id="invoice">
        <div class="row">
    <div class="col-sm-3">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><i class="fa icon-invoice"></i> <?=$this->lang->line('panel_title')?></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <form role="form" method="post" enctype="multipart/form-data" id="invoiceDataForm"> 

                    <input type="hidden" class="form-control" id="classesID" name="classesID" value="<?=set_value('classesID',$student->classesID)?>" >
                    <input type="hidden" class="form-control" id="studentID" name="studentID" value="<?=set_value('studentID',$student->studentID)?>" >
                    <div class="packageDiv form-group <?=form_error('invoice_packageID') ? 'has-error' : '' ?>" >
                        <label for="invoice_packageID">
                            <?=$this->lang->line("invoice_package")?> <span class="text-red">*</span>
                        </label>
                        <?php
                            $packagesArray = array('0' => $this->lang->line("invoice_select_package"));
                            if(customCompute($packages)) {
                                foreach ($packages as $package) {
                                    $packagesArray[$package->id] = $package->name;
                                }
                            }

                            echo form_dropdown("packageID", $packagesArray, set_value("packageID",$student->packageID), "id='invoice_packageID' class='form-control select2'");
                        ?>
                        <span class="text-red">
                            <?php echo form_error('packageID'); ?>
                        </span>
                    </div>
                    <div class="dateDiv form-group <?=form_error('date') ? 'has-error' : '' ?>" >
                        <label for="date">
                            <?=$this->lang->line("invoice_date")?> <span class="text-red">*</span>
                        </label>
                            <input type="text" class="form-control" id="invoice_date" name="date" value="<?=set_value('date')?>" >
                        <span class="text-red">
                            <?php echo form_error('date'); ?>
                        </span>
                    </div>

                    <div class="statusDiv form-group <?=form_error('statusID') ? 'has-error' : '' ?>" >
                        <label for="statusID">
                            <?=$this->lang->line("invoice_status")?> <span class="text-red">*</span>
                        </label>
                        <?php
                            $statusArray = array(
                                5 => $this->lang->line("invoice_select_paymentstatus"),
                                0 => $this->lang->line("invoice_notpaid"),
                                1 => $this->lang->line("invoice_partially_paid"),
                                2 => $this->lang->line("invoice_fully_paid")
                            );

                            echo form_dropdown("statusID", $statusArray, set_value("statusID"), "id='statusID' class='form-control select2'");
                        ?>
                        <span class="text-red">
                            <?php echo form_error('statusID'); ?>
                        </span>
                    </div>

                    <div class="paymentmethodDiv hide form-group <?=form_error('payment_method') ? 'has-error' : '' ?>" >
                        <label for="payment_method">
                            <?=$this->lang->line("invoice_paymentmethod")?> <span class="text-red">*</span>
                        </label>
                        <?php
                            $paymentmethodArray = array(
                                '0' => $this->lang->line("invoice_select_paymentmethod"),
                                'Cash' => $this->lang->line('Cash'),
                                'Cheque' => $this->lang->line('Cheque'),
                                'UPI' => $this->lang->line('UPI'),
                            );
                            echo form_dropdown("payment_method", $paymentmethodArray, set_value("payment_method"), "id='payment_method' class='form-control select2'");
                        ?>
                        <span class="text-red">
                            <?php echo form_error('payment_method'); ?>
                        </span>
                    </div>
                    <div class="transcationDiv form-group <?=form_error('rec_no') ? 'has-error' : '' ?>" >
                        <label for="rec_no">
                            Transcation Rec No <span class="text-red">*</span>
                        </label>
                            <input type="text" class="form-control" id="invoice_rec_no" name="rec_no" value="<?=set_value('rec_no')?>" >
                        <span class="text-red">
                            <?php echo form_error('rec_no'); ?>
                        </span>
                    </div>
                    <input id="addInvoiceButton" type="button" class="btn btn-success" value="<?=$this->lang->line("add_invoice")?>" >
                    
                </form>
            </div>
        </div>
    </div>


    <div class="col-sm-9">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><i class="fa icon-feetypes"></i> <?=$this->lang->line('invoice_feetype_list')?></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <form class="" role="form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group <?=form_error('feetypeID') ? 'has-error' : '' ?>" >
                                <label for="feetypeID" class="control-label">
                                    <?=$this->lang->line("invoice_feetype")?> <span class="text-red">*</span>
                                </label>
                                <?php
                                    $feetypeArray = array('0' => $this->lang->line("invoice_select_feetype"));
                                    foreach ($feetypesobj as $feetype) {
                                        $feetypeArray[$feetype->feetypesID] = $feetype->feetypes;
                                    }
                                    echo form_dropdown("feetypeID", $feetypeArray, set_value("feetypeID"), "id='feetypeID' class='form-control select2'");
                                ?>
                                <span class="control-label">
                                    <?php echo form_error('feetypeID'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered feetype-style" style="font-size: 16px;">
                        <thead>
                            <tr>
                                <th class="col-sm-1"><?=$this->lang->line('slno')?></th>
                                <th class="col-sm-3"><?=$this->lang->line('invoice_feetype')?></th>
                                <th class="col-sm-2" ><?=$this->lang->line('invoice_amount')?></th>
                                <th class="col-sm-1" ><?=$this->lang->line('invoice_discount')?>(%)</th>
                                <th class="col-sm-2" ><?=$this->lang->line('invoice_subtotal')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('invoice_paid_amount')?></th>
                                <th class="col-sm-1"><?=$this->lang->line('action')?></th>
                            </tr>
                        </thead>
                        <tbody id="feetypeList">
                        </tbody>

                        <tfoot id="feetypeListFooter">
                            <tr>
                                <td colspan="2" style="font-weight: bold"><?=$this->lang->line('invoice_total')?></td>
                                <td id="totalAmount" style="font-weight: bold">0.00</td>
                                <td id="totalDiscount" style="font-weight: bold">0.00</td>
                                <td id="totalSubtotal" style="font-weight: bold">0.00</td>
                                <td id="totalPaidAmount" style="font-weight: bold">0.00</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

			              		<div id="hide-table">
                                   
				                    <table class="table table-striped table-bordered table-hover">
				                        <thead>
				                            <tr>
				                                <th><?=$this->lang->line('slno')?></th>
				                                <th><?=$this->lang->line('student_feetype')?></th>
				                                <th><?=$this->lang->line('student_date')?></th>
				                                <th><?=$this->lang->line('student_status')?></th>
				                                <th><?=$this->lang->line('student_fees_amount')?></th>
				                                <th><?=$this->lang->line('student_discount')?></th>
				                                <th><?=$this->lang->line('student_paid')?></th>
				                                <th><?=$this->lang->line('student_weaver')?></th>
				                                <th><?=$this->lang->line('student_fine')?></th>
				                                <th><?=$this->lang->line('student_due')?></th>
                                                <th>Action</th>
											</tr>
				                        </thead>
				                        <tbody>
						              		<?php $totalInvoice = 0; $totalDiscount = 0; $totalPaid = 0; $totalWeaver = 0; $totalDue = 0; $totalFine = 0; if(customCompute($invoices)) { $i = 1; foreach ($invoices as $invoice) { ?>
						              			<tr>
				                                    <td data-title="<?=$this->lang->line('slno')?>">
				                                        <?php echo $i; ?>
				                                    </td>

				                                    <td data-title="<?=$this->lang->line('student_feetype')?>">
                                                        <?=isset($feetypes[$invoice->feetypeID]) ? $feetypes[$invoice->feetypeID] : '' ?>
				                                    </td>

				                                    <td data-title="<?=$this->lang->line('student_date')?>">
				                                        <?=!empty($invoice->date) ? date('d M Y', strtotime($invoice->date)) : ''?>
				                                    </td>

				                                    <td data-title="<?=$this->lang->line('student_status')?>">
				                                        <?php 
				                                            $status = $invoice->paidstatus;
				                                            $setButton = '';
				                                            if($status == 0) {
				                                                $status = $this->lang->line('student_notpaid');
				                                                $setButton = 'text-danger';
				                                            } elseif($status == 1) {
				                                                $status = $this->lang->line('student_partially_paid');
				                                                $setButton = 'text-warning';
				                                            } elseif($status == 2) {
				                                                $status = $this->lang->line('student_fully_paid');
				                                                $setButton = 'text-success';
				                                            }

				                                            echo "<span class='".$setButton."'>".$status."</span>";
				                                        ?>
				                                    </td>

				                                    <td data-title="<?=$this->lang->line('student_fees_amount')?>">
				                                        <?php $invoiceAmount = $invoice->amount;  echo number_format($invoiceAmount, 2); $totalInvoice += $invoiceAmount; ?>
				                                    </td>

				                                    <td data-title="<?=$this->lang->line('student_discount')?>">
				                                        <?php $discountAmount = 0; if($invoice->discount > 0) { $discountAmount = (($invoice->amount/100)*$invoice->discount); } echo number_format($discountAmount, 2); $totalDiscount += $discountAmount; ?>
				                                    </td>

				                                    <td data-title="<?=$this->lang->line('student_paid')?>">
				                                        <?php $paymentAmount = 0; if(isset($allpaymentbyinvoice[$invoice->invoiceID])) { $paymentAmount = $allpaymentbyinvoice[$invoice->invoiceID]; } echo number_format($paymentAmount, 2); $totalPaid += $paymentAmount; ?>
				                                    </td>

				                                    <td data-title="<?=$this->lang->line('student_weaver')?>">
				                                        <?php $weaverAmount = 0; if(isset($allweaverandpaymentbyinvoice[$invoice->invoiceID]['weaver'])) { $weaverAmount = $allweaverandpaymentbyinvoice[$invoice->invoiceID]['weaver']; } echo number_format($weaverAmount, 2); $totalWeaver += $weaverAmount; ?>
				                                    </td>

				                                    <td data-title="<?=$this->lang->line('student_fine')?>">
				                                        <?php $fineAmount = 0; if(isset($allweaverandpaymentbyinvoice[$invoice->invoiceID]['fine'])) { $fineAmount = $allweaverandpaymentbyinvoice[$invoice->invoiceID]['fine']; } echo number_format($fineAmount, 2); $totalFine += $fineAmount; ?>
				                                    </td>
				                                    
				                                    <td data-title="<?=$this->lang->line('student_due')?>">
				                                        <?php $dueAmount = ((($invoiceAmount-$discountAmount) - $paymentAmount) - $weaverAmount); echo number_format($dueAmount, 2); $totalDue += $dueAmount; ?> 
				                                    </td>
                                                    <?php if(permissionChecker('invoice_view') || permissionChecker('invoice_edit') || permissionChecker('invoice_delete')) { ?>
                                    <td data-title="<?=$this->lang->line('action')?>">
                                        <?php echo btn_view('invoice/view/'.$invoice->maininvoiceID, $this->lang->line('view')) ?>
                                    </td>
                                    <?php } ?>

				                                </tr>
						              			
						              		<?php $i++; } } ?>

						              		<tr>
				                                <td colspan="4" data-title="<?=$this->lang->line('student_total')?>">
				                                	<?php if($siteinfos->currency_code) { echo '<b>'. $this->lang->line('student_total').' ('.$siteinfos->currency_code.')'. '</b>'; } else { echo '<b>'. $this->lang->line('student_total') .'</b>'; }
				                                    ?>
				                                </td>
				                                <td data-title="<?=$this->lang->line('student_total')?> <?=$this->lang->line('student_fees_amount')?>">
				                                    <?=number_format($totalInvoice, 2)?>
				                                </td>
				                                <td data-title="<?=$this->lang->line('student_total')?> <?=$this->lang->line('student_discount')?>">
				                                    <?=number_format($totalDiscount, 2)?>
				                                </td> 
				                                <td data-title="<?=$this->lang->line('student_total')?> <?=$this->lang->line('student_paid')?>">
				                                    <?=number_format($totalPaid, 2)?>
				                                </td>
				                                <td data-title="<?=$this->lang->line('student_total')?> <?=$this->lang->line('student_weaver')?>">
				                                    <?=number_format($totalWeaver, 2)?>
				                                </td>
				                                <td data-title="<?=$this->lang->line('student_total')?> <?=$this->lang->line('student_fine')?>">
				                                    <?=number_format($totalFine, 2)?>
				                                </td>
				                                <td data-title="<?=$this->lang->line('student_total')?> <?=$this->lang->line('student_due')?>">
				                                    <?=number_format($totalDue, 2)?>
				                                </td>
                                                <td>

                                                </td>
				                            </tr>
						              	</tbody>
						            </table>
						        </div>
			              	</div>
        <div class="<?= ($tab == 'payment') ? 'active' : ''; ?> tab-pane" id="payment">
			              		<div id="hide-table">
				                    <table class="table table-striped table-bordered table-hover">
				                        <thead>
				                            <tr>
				                                <th><?=$this->lang->line('slno')?></th>
				                                <th><?=$this->lang->line('student_feetype')?></th>
				                                <th><?=$this->lang->line('student_date')?></th>
				                                <th><?=$this->lang->line('student_paid')?></th>
				                                <th><?=$this->lang->line('student_weaver')?></th>
				                                <th><?=$this->lang->line('student_fine')?></th>
											</tr>
				                        </thead>
				                        <tbody>
						              		<?php $totalPaymentPaid = 0; $totalPaymentWeaver = 0; $totalPaymentFine = 0; if(customCompute($payments)) { $i = 1; foreach ($payments as $payment) {  ?>
						              			<tr>
				                                    <td data-title="<?=$this->lang->line('slno')?>">
				                                        <?php echo $i; ?>
				                                    </td>

				                                    <td data-title="<?=$this->lang->line('student_feetype')?>">
				                                        <?=isset($feetypes[$payment->feetypeID]) ? $feetypes[$payment->feetypeID] : '' ?>
				                                    </td>

				                                    <td data-title="<?=$this->lang->line('student_date')?>">
				                                        <?=!empty($payment->paymentdate) ? date('d M Y', strtotime($payment->paymentdate)) : ''?>
				                                    </td>

				                                    <td data-title="<?=$this->lang->line('student_paid')?>">
				                                        <?php $paymentpaidAmount = $payment->paymentamount; echo number_format($paymentpaidAmount, 2); $totalPaymentPaid += $paymentpaidAmount; ?>
				                                    </td>

				                                    <td data-title="<?=$this->lang->line('student_weaver')?>">
				                                        <?php $paymentWeaverAmount = $payment->weaver; echo number_format($paymentWeaverAmount, 2); $totalPaymentWeaver += $paymentWeaverAmount; ?>
				                                    </td>

				                                    <td data-title="<?=$this->lang->line('student_fine')?>">
				                                        <?php $paymentFineAmount = $payment->fine; echo number_format($paymentFineAmount, 2); $totalPaymentFine += $paymentFineAmount; ?>
				                                    </td>
				                                </tr>
						              		<?php $i++; } } ?>

						              		<tr>
				                                <td colspan="3" data-title="<?=$this->lang->line('student_total')?>">
				                                	<?php if($siteinfos->currency_code) { echo '<b>'. $this->lang->line('student_total').' ('.$siteinfos->currency_code.')'. '</b>'; } else { echo '<b>'. $this->lang->line('student_total') . '</b>'; }
				                                    ?>
				                                </td>
				                                <td data-title="<?=$this->lang->line('student_total')?> <?=$this->lang->line('student_paid')?>">
				                                    <?=number_format($totalPaymentPaid, 2)?>
				                                </td>
				                                <td data-title="<?=$this->lang->line('student_total')?> <?=$this->lang->line('student_weaver')?>">
				                                    <?=number_format($totalPaymentWeaver, 2)?>
				                                </td>
				                                <td data-title="<?=$this->lang->line('student_total')?> <?=$this->lang->line('student_fine')?>">
				                                    <?=number_format($totalPaymentFine, 2)?>
				                                </td>
				                            </tr>
						              	</tbody>
						            </table>
						        </div>
			              	</div>
		              	
			              	<div class="<?= ($tab == 'document') ? 'active' : ''; ?> tab-pane" id="document">
			              		<?php if(permissionChecker('student_add')) { ?>
			              			<input class="btn btn-success btn-sm" style="margin-bottom: 10px" type="button" value="<?=$this->lang->line('student_add_document')?>" data-toggle="modal" data-target="#documentupload">
			              		<?php } ?>
			              		<div id="hide-table">
				                    <table class="table table-striped table-bordered table-hover">
				                        <thead>
				                            <tr>
				                                <th><?=$this->lang->line('slno')?></th>
				                                <th><?=$this->lang->line('student_title')?></th>
				                                <th><?=$this->lang->line('student_date')?></th>
				                                <th><?=$this->lang->line('action')?></th>
											</tr>
				                        </thead>
				                        <tbody>
						              		<?php if(customCompute($documents)) { $i = 1; foreach ($documents as $document) {  ?>
						              			<tr>
				                                    <td data-title="<?=$this->lang->line('slno')?>">
				                                        <?php echo $i; ?>
				                                    </td>

				                                    <td data-title="<?=$this->lang->line('student_title')?>">
				                                        <?=$document->title?>
				                                    </td>

				                                    <td data-title="<?=$this->lang->line('student_date')?>">
				                                        <?=date('d M Y', strtotime($document->create_date))?>
				                                    </td>

				                                    <td data-title="<?=$this->lang->line('action')?>">
				                                        <?php  
				                                        	if((permissionChecker('student_add') && permissionChecker('student_delete')) || ($this->session->userdata('usertypeID') == 3 && $this->session->userdata('loginuserID') == $profile->srstudentID)) {
				                                        		echo btn_download('student/download_document/'.$document->documentID.'/'.$profile->srstudentID.'/'.$profile->srclassesID, $this->lang->line('download'));
															}
				                                        	
				                                        	if(permissionChecker('student_add') && permissionChecker('student_delete')) {
				                                        		echo btn_delete_show('student/delete_document/'.$document->documentID.'/'.$profile->srstudentID."/".$profile->srclassesID, $this->lang->line('delete'));
				                                        	} 
				                                        ?>
				                                    </td>
				                                </tr>
				                            <?php $i++; } } ?>
						              	</tbody>
						            </table>
						        </div>
                                <a class="btn btn-success btn-sm" style="padding-left:1rem;padding-top:1rem;margin-bottom: 10px"  href="<?= base_url() ?>/student/edit/<?= $student->studentID ?>/<?= $student->classesID ?>/?tab=invoice"><input type="button" class="btn btn-success" value="Next" ></a>
			              	</div>
        </div><!-- tab-content -->
        </div><!-- nav-tabs-custom -->
    </div><!-- Body -->
</div><!-- /.box -->
<?php if(permissionChecker('student_add')) { ?>
		<form id="documentUploadDataForm" class="form-horizontal" enctype="multipart/form-data" role="form" action="<?=base_url('student/send_mail');?>" method="post">
		    <div class="modal fade" id="documentupload">
		      <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		                <h4 class="modal-title"><?=$this->lang->line('student_document_upload')?></h4>
		            </div>
		            <div class="modal-body">
		                <div class="form-group" >
		                    <label for="title" class="col-sm-2 control-label">
		                        <?=$this->lang->line("student_title")?> <span class="text-red">*</span>
		                    </label>
		                    <div class="col-sm-6">
		                        <input type="text" class="form-control" id="title" name="title" value="<?=set_value('title')?>" >
		                    </div>
		                    <span class="col-sm-4 control-label" id="title_error">
		                    </span>
		                </div>

		                <div class="form-group">
		                   <label for="file" class="col-sm-2 control-label">
		                        <?=$this->lang->line("student_file")?> <span class="text-red">*</span>
		                    </label>
		                    <div class="col-sm-6">
		                        <div class="input-group image-preview">
		                            <input type="text" class="form-control image-preview-filename" disabled="disabled">
		                            <span class="input-group-btn">
		                                <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
		                                    <span class="fa fa-remove"></span>
		                                    <?=$this->lang->line('student_clear')?>
		                                </button>
		                                <div class="btn btn-success image-preview-input">
		                                    <span class="fa fa-repeat"></span>
		                                    <span class="image-preview-input-title">
		                                    <?=$this->lang->line('student_file_browse')?></span>
		                                    <input type="file" id="file" name="file"/>
		                                </div>
		                            </span>
		                        </div>
		                    </div>
		                    <span class="col-sm-4 control-label" id="file_error">
		                    </span>
		                </div>
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" style="margin-bottom:0px;" data-dismiss="modal"><?=$this->lang->line('close')?></button>
		                <input type="button" id="uploadfile" class="btn btn-success" value="<?=$this->lang->line("student_upload")?>" />
		            </div>
		        </div>
		      </div>
		    </div>
		</form>

		<script type="text/javascript">
        var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('photo-view');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
			$(document).on('click', '#uploadfile', function() {
				var title = $('#title').val();
				var file = $('#file').val();
				var error = 0;

				if(title == '' || title == null) {
					error++;
					$('#title_error').html("<?=$this->lang->line('student_title_required')?>");
					$('#title_error').parent().addClass('has-error');
				} else {
					$('#title_error').html('');
					$('#title_error').parent().removeClass('has-error');
				}

				if(file == '' || file == null) {
					error++;
					$('#file_error').html("<?=$this->lang->line('student_file_required')?>");
					$('#file_error').parent().addClass('has-error');
				} else {
					$('#file_error').html('');
					$('#file_error').parent().removeClass('has-error');
				}

				if(error == 0) {
					var studentID = "<?=$student->srstudentID?>";
					var formData = new FormData($('#documentUploadDataForm')[0]);
					formData.append("studentID", studentID);
		            $.ajax({
		                type: 'POST',
		                dataType: "json",
		                url: "<?=base_url('student/documentUpload')?>",
		                data: formData,
		                async: false,
		                dataType: "html",
		                success: function(data) {
		                	var response = jQuery.parseJSON(data);
		                	if(response.status) {
		                		$('#title_error').html();
		                        $('#title_error').parent().removeClass('has-error');

		                        $('#file_error').html();
		                        $('#file_error').parent().removeClass('has-error');
		                        location.reload();
		                	} else {
								if(response.errors['title']) {
									$('#title_error').html(response.errors['title']);
		                            $('#title_error').parent().addClass('has-error');
								} else {
									$('#title_error').html();
		                        	$('#title_error').parent().removeClass('has-error');
								}
								
								if(response.errors['file']) {
									$('#file_error').html(response.errors['file']);
		                            $('#file_error').parent().addClass('has-error');
								} else {
									$('#file_error').html();
		                        	$('#file_error').parent().removeClass('has-error');
								}
		                	}
		                },
		                cache: false,
		                contentType: false,
		                processData: false
		            });
				}
			});		

			$(function() {
			    var closebtn = $('<button/>', {
			        type:"button",
			        text: 'x',
			        id: 'close-preview',
			        style: 'font-size: initial;',
			    });
			    closebtn.attr("class","close pull-right");
                $('#birth_certificate_date').datepicker({
                    autoclose: true,
                    format: 'dd-mm-yyyy',
                });
			    $('.image-preview').popover({
			        trigger:'manual',
			        html:true,
			        title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
			        content: "There's no image",
			        placement:'bottom'
			    });

			    $('.image-preview-clear').click(function(){
			        $('.image-preview').attr("data-content","").popover('hide');
			        $('.image-preview-filename').val("");
			        $('.image-preview-clear').hide();
                    var output = document.getElementById('photo-view');
                    output.src = "<?= base_url('uploads/images/default.png')?>";
			        $('.image-preview-input input:file').val("");
			        $(".image-preview-input-title").text("<?=$this->lang->line('student_file_browse')?>");
			    });

			    $(".image-preview-input input:file").change(function (){
			        var img = $('<img/>', {
			            id: 'dynamic',
			            width:250,
			            height:200,
			            overflow:'hidden'
			        });

			        var file = this.files[0];
			        var reader = new FileReader();
			        reader.onload = function (e) {
			            $(".image-preview-input-title").text("<?=$this->lang->line('student_file_browse')?>");
			            $(".image-preview-clear").show();
			            $(".image-preview-filename").val(file.name);
			        }
			        reader.readAsDataURL(file);
			    });
			});
		</script>
	<?php } ?>

<script type="text/javascript">
$( ".select2" ).select2();
$('#dob').datepicker({ startView: 2 });
$('#admission_date').datepicker({ startView: 2 });

$('#username').keyup(function() {
    $(this).val($(this).val().replace(/\s/g, ''));
});

$('#classesID').change(function(event) {
    var classesID = $(this).val();
    if(classesID === '0') {
        $('#classesID').val(0);
    } else {
        $.ajax({
            type: 'POST',
            url: "<?=base_url('student/sectioncall')?>",
            data: "id=" + classesID,
            dataType: "html",
            success: function(data) {
               $('#sectionID').html(data);
            }
        });

        $.ajax({
            type: 'POST',
            url: "<?=base_url('student/optionalsubjectcall')?>",
            data: "id=" + classesID,
            dataType: "html",
            success: function(data2) {
                $('#optionalSubjectID').html(data2);
            }
        });
    }
});

$(document).on('click', '#close-preview', function(){ 
    $('.image-preview').popover('hide');
    // Hover befor close the preview
    $('.image-preview').hover(
        function () {
           $('.image-preview').popover('show');
           $('.content').css('padding-bottom', '130px');
        }, 
         function () {
           $('.image-preview').popover('hide');
           $('.content').css('padding-bottom', '20px');
        }
    );    
});

$(function() {
    $('input.handicap_enable').change(function(){
                $(this).next()[ this.checked ? 'show' : 'hide'](); 
                $(this).next().find("input").val(this.checked ? $(this).next().find("input").val() : ''); 
    }).change();
    function getRandomInt() {
      return Math.floor(Math.random() * Math.floor(9999999999999999));
    }
    
    $('#invoice_packageID').change(function(event) {
        var packageID = $('#invoice_packageID').val();
        var classesID = $('#classesID').val();
        var randID = getRandomInt();
        if(studentID === '0') {
            
        } else {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('invoice/getfee')?>",
                data: {'classesID' : classesID,'package_id':packageID,'randID':randID},
                dataType: "html",
                success: function(data) {
                    $('#feetypeList').empty().append(data);
                    $('.change-amount').trigger('change');
                }
            });
        }
    });
    $('#invoice_packageID').trigger('change');
    // Create the close button
    $("#edittostudent").submit(function(e){
        e.preventDefault();
    $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "html",
            success: function() {
                
                window.location.href = '<?= base_url() ?>/student/edit/'+<?= $student->studentID ?>+'/'+<?= $student->classesID ?>+'/?tab=document';
            }
        });
    });
    $("#addtostudent").submit(function(e){
        e.preventDefault();
    $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "html",
            success: function() {
                window.location.href = '<?= base_url() ?>/student/edit/'+<?= $student->studentID ?>+'/'+<?= $student->classesID ?>+'/?tab=document';
            }
        });
    });
    var closebtn = $('<button/>', {
        type:"button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class","close pull-right");
    // Set the popover default content
    $('.image-preview').popover({
        trigger:'manual',
        html:true,
        title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
        content: "There's no image",
        placement:'bottom'
    });
    // Clear event
    $('.image-preview-clear').click(function(){
        $('.image-preview').attr("data-content","").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("<?=$this->lang->line('student_file_browse')?>"); 
    }); 
    // Create the preview image
    $(".image-preview-input input:file").change(function (){     
        var img = $('<img/>', {
            id: 'dynamic',
            width:250,
            height:200,
            overflow:'hidden'
        });      
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
            $(".image-preview-input-title").text("<?=$this->lang->line('student_file_browse')?>");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(file.name);            
            img.attr('src', e.target.result);
            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
            $('.content').css('padding-bottom', '130px');
        }        
        reader.readAsDataURL(file);
    });  
});


</script>
<script type="text/javascript">
    function dd(data) {
        console.log(data);
    }

    $('#invoice_date').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy',
        startDate:'<?=$schoolyearsessionobj->startingdate?>',
        endDate:'<?=$schoolyearsessionobj->endingdate?>',
    });
    


    function productItemDesign(feetypeID, productText) {
        var randID = getRandomInt();
        if($('#feetypeList tr:last').text() == '') {
            var lastTdNumber = 0;
        } else {
            var lastTdNumber = $("#feetypeList tr:last td:eq(0)").text();
        }

        lastTdNumber = parseInt(lastTdNumber);
        lastTdNumber++;

        var text = '<tr id="tr_'+randID+'" invoicefeetypeID="'+feetypeID+'">';
            text += '<td>';
                text += lastTdNumber;
            text += '</td>';

            text += '<td>';
                text += productText;
            text += '</td>';

            text += '<td>';
                text += ('<input type="text" class="form-control change-amount" id="td_amount_id_'+randID+'" data-amount-id="'+randID+'">');
            text += '</td>';

            text += '<td>';
                text += ('<input type="text" class="form-control change-discount" id="td_discount_id_'+randID+'" data-discount-id="'+randID+'">');
            text += '</td>';

            text += '<td>';
                text += '0.00';
            text += '</td>';

            text += '<td>';
                if($('#statusID').val() != 0 && $('#statusID').val() != 5) {
                    text += ('<input type="text" class="form-control change-paidamount" id="td_paidamount_id_'+randID+'" data-paidamount-id="'+randID+'">');
                } else {
                    text += ('<input type="text" class="form-control change-paidamount" id="td_paidamount_id_'+randID+'" data-paidamount-id="'+randID+'" readonly="readonly">');
                }
            text += '</td>';

            text += '<td>';
                text += ('<a style="margin-top:3px" href="#" class="btn btn-danger btn-sm deleteBtn" id="feetype_'+randID+'" data-feetype-id="'+randID+'"><i class="fa fa-trash-o"></i></a>');
            text += '</td>';
        text += '</tr>';

        return text; 
    }

    $('#feetypeID').change(function(e) {
        var feetypeID   = $(this).val();
        if(feetypeID != 0) {
            var feetypeText = $(this).find(":selected").text();
            var appendData  = productItemDesign(feetypeID, feetypeText);
            $('#feetypeList').append(appendData);
        }
    });

    function toFixedVal(x) {
      if (Math.abs(x) < 1.0) {
        var e = parseFloat(x.toString().split('e-')[1]);
        if (e) {
            x *= Math.pow(10,e-1);
            x = '0.' + (new Array(e)).join('0') + x.toString().substring(2);
        }
      } else {
        var e = parseFloat(x.toString().split('+')[1]);
        if (e > 20) {
            e -= 20;
            x /= Math.pow(10,e);
            x += (new Array(e+1)).join('0');
        }
      }
      return x;
    }

    function isNumeric(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }

    function dotAndNumber(data) {
        var retArray = [];
        var fltFlag = true;
        if(data.length > 0) {
            for(var i = 0; i <= (data.length-1); i++) {
                if(i == 0 && data.charAt(i) == '.') {
                    fltFlag = false;
                    retArray.push(true);
                } else {
                    if(data.charAt(i) == '.' && fltFlag == true) {
                        retArray.push(true);
                        fltFlag = false;
                    } else {
                        if(isNumeric(data.charAt(i))) {
                            retArray.push(true);
                        } else {
                            retArray.push(false);
                        }
                    }

                }
            }
        }

        if(jQuery.inArray(false, retArray) ==  -1) {
            return true;
        }
        return false;
    }

    function floatChecker(value) {
        var val = value;
        if(isNumeric(val)) {
            return true;
        } else {
            return false;
        }
    }

    function lenChecker(data, len) {
        var retdata = 0;
        var lencount = 0;
        data = toFixedVal(data);
        if(data.length > len) {
            lencount = (data.length - len);
            data = data.toString();
            data = data.slice(0, -lencount);
            retdata = parseFloat(data);
        } else {
            retdata = parseFloat(data);
        }

        return toFixedVal(retdata);
    }
    
    function parseSentenceForNumber(sentence) {
        var matches = sentence.replace(/,/g, '').match(/(\+|-)?((\d+(\.\d+)?)|(\.\d+))/);
        return matches && matches[0] || null;
    }

    function currencyConvert(data) {
        return data.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    }

    var globaltotalamount = 0;
    var globaltotaldiscount = 0;
    var globaltotalsubtotal = 0;
    var globaltotalpaidamount = 0;
    function totalInfo() {
        var i = 1;
        var j = 1;

        var totalAmount = 0;
        var totalDiscount = 0;
        var totalSubtotal = 0;
        var totalPaidAmount = 0;

        var discount = 0; 

        $('#feetypeList tr').each(function(index, value) {
            if($(this).children().eq(2).children().val() != '' && $(this).children().eq(2).children().val() != null && $(this).children().eq(2).children().val() != '.') {
                var amount = parseFloat($(this).children().eq(2).children().val());
                totalAmount += amount;
            } 
        });
        globaltotalamount = totalAmount;
        $('#totalAmount').text(currencyConvert(totalAmount));

        $('#feetypeList tr').each(function(index, value) {
            if($(this).children().eq(3).children().val() != '' && $(this).children().eq(3).children().val() != null && $(this).children().eq(3).children().val() != '.') {
                var discount = parseFloat($(this).children().eq(3).children().val());
                totalDiscount += discount;
            } 
        });
        globaltotaldiscount = totalDiscount;
        $('#totalDiscount').text(currencyConvert(totalDiscount));


        $('#feetypeList tr').each(function(index, value) {
            var amount = parseFloat($(this).children().eq(2).children().val());
            var discount = parseFloat($(this).children().eq(3).children().val());
            var subtotal = 0;
            if(amount > 0) {
                if(discount > 0) {
                    if(discount == 100) {
                        subtotal = 0;
                    } else {
                        subtotal = (amount - ((amount/100) * discount));
                    }
                } else {
                    subtotal = amount;
                }
            }

            $(this).children().eq(4).text(subtotal);
            totalSubtotal += subtotal;
        });
        globaltotalsubtotal = totalSubtotal;
        $('#totalSubtotal').text(currencyConvert(totalSubtotal));

        $('#feetypeList tr').each(function(index, value) {
            if($(this).children().eq(5).children().val() != '' && $(this).children().eq(5).children().val() != null && $(this).children().eq(5).children().val() != '.') {
                var paidamount = parseFloat($(this).children().eq(5).children().val());
                totalPaidAmount += paidamount;
            } 
        });
        globaltotalpaidamount = totalPaidAmount;
        $('#totalPaidAmount').text(currencyConvert(totalPaidAmount));

    }

    $(document).on('keyup', '.change-amount', function() {
        var amount =  toFixedVal($(this).val());
        var amountID = $(this).attr('data-amount-id'); 

        if(dotAndNumber(amount)) {
            if(amount.length > 15) {
                amount = lenChecker(amount, 15);
                $(this).val(amount);
            }
            
            if(amount != '' && amount != null) {
                $(this).val(amount);
                totalInfo();
            } else {
                totalInfo();
            }
        } else {
            var amount = parseSentenceForNumber(toFixedVal($(this).val()));
            $(this).val(amount);
        }

        removePaidAmount(amountID);
    });

    $(document).on('keyup', '.change-paidamount', function() {
        var trID = $(this).parent().parent().attr('id').replace('tr_','');
        var amount = $('#'+'td_amount_id_'+trID).val();
        var discount = $('#'+'td_discount_id_'+trID).val();

        if(discount != '' && discount != null) {
            amount = (amount - ((amount/100) * discount));
        }

        if(amount != '' && amount != null) {
            var paidamount =  toFixedVal($(this).val());
            var paidamountID = $(this).attr('data-paidamount-id'); 
            
            if(dotAndNumber(paidamount)) {
                if(paidamount.length > 15) {
                    paidamount = lenChecker(paidamount, 15);
                    if(parseFloat(paidamount) > parseFloat(amount)) {
                        $(this).val(amount);
                    } else {
                        $(this).val(paidamount);
                    }
                }
                
                if(paidamount != '' && paidamount != null) {
                    if(parseFloat(paidamount) > parseFloat(amount)) {
                        $(this).val(amount);
                    } else {
                        $(this).val(paidamount);
                    }
                    totalInfo();
                } else {
                    totalInfo();
                }
            } else {
                var paidamount = parseSentenceForNumber(toFixedVal($(this).val()));
                if(parseFloat(paidamount) > parseFloat(amount)) {
                    $(this).val(amount);
                } else {
                    $(this).val(paidamount);
                }
            }
        } else {
            $(this).val('');
        }
    });

    $(document).on('keyup', '.change-discount', function() {
        var trID = $(this).parent().parent().attr('id').replace('tr_','');
        var randID = $(this).attr('data-discount-id'); 
        var amount = $('#'+'td_amount_id_'+trID).val();

        if(amount != '' && amount != null) {
            var discount =  toFixedVal($(this).val());
            var discountID = $(this).attr('data-discount-id'); 
            
            if(dotAndNumber(discount)) {
                if(discount > 100) {
                    discount = 100;
                }
                $(this).val(discount);
                totalInfo();
            } else {
                var discount = parseSentenceForNumber(toFixedVal($(this).val()));
                $(this).val(discount);
            }
        } else {
            $(this).val('');
        }

        removePaidAmount(randID);
    });

    $(document).on('click', '.deleteBtn', function(er) {
        er.preventDefault();
        var feetypeID = $(this).attr('data-feetype-id');
        $('#tr_'+feetypeID).remove();
        
        var i = 1;
        $('#feetypeList tr').each(function(index, value) {
            $(this).children().eq(0).text(i);
            i++;
        });
        totalInfo();
    });

    function removePaidAmount(randID) {
        var ramount = $('#td_amount_id_'+randID).val();
        var rdiscount = $('#td_discount_id_'+randID).val();
        var rpaidamount = ($('#td_paidamount_id_'+randID).val());
        
        if(ramount == '' && ramount == null) {
            ramount = 0;
        }

        if(rdiscount == '' && rdiscount == null) {
            rdiscount = 0;
        }

        if(rpaidamount != '' && rpaidamount != null) {
            ramount = parseFloat((ramount - (ramount/100) * rdiscount)); 
            rpaidamount = parseFloat(rpaidamount);  
            if(rpaidamount > ramount) {
                $('#td_paidamount_id_'+randID).val('');
            }
        }
    }

</script>

<script type="text/javascript">
    $('#statusID').change(function() {
        
        if(($(this).val() != 0) && ($(this).val() != 5) && ($(this).val() != 2)) {
            $('.paymentmethodDiv').removeClass('hide');

            $('#feetypeList tr').each(function(index, value) {
                $(this).children().eq(5).children().removeAttr('readonly');
                $(this).children().eq(5).find('input').val('');
            });
        }
        else if(($(this).val() == 2)) {
            $('.paymentmethodDiv').removeClass('hide');

            $('#feetypeList tr').each(function(index, value) {
                //debugger; 
                $(this).children().eq(5).children().removeAttr('readonly');
                $(this).children().eq(5).find('input').val($(this).children().eq(2).find('input').val())
                $('.change-paidamount').trigger('keyup')
            });
        } else {
            $('.paymentmethodDiv').addClass('hide');

            $('#feetypeList tr').each(function(index, value) {
                $(this).children().eq(5).children().attr('readonly', 'readonly');
                $(this).children().eq(5).find('input').val('');
            });
        }
    });

    $(document).on('click', '#addInvoiceButton', function() {
        var error=0;;
        var field = {
            'classesID'           : $('#classesID').val(), 
            'studentID'           : $('#studentID').val(), 
            'date'                : $('#date').val(),
            'rec_no'                : $('#rec_no').val(),
            'statusID'            : $('#statusID').val(), 
            'payment_method'     : $('#payment_method').val(), 
        };
        
        if(field['classesID'] === '0') {
            $('.classesDiv').addClass('has-error');
            error++;
        } else {
            $('.classesDiv').removeClass('has-error');
        }

        if(field['date'] === '') {
            $('.dateDiv').addClass('has-error');
            error++;
        } else {
            $('.dateDiv').removeClass('has-error');
        }
        if(field['rec_no'] === '') {
            $('.transcationDiv').addClass('has-error');
            error++;
        } else {
            $('.transcationDiv').removeClass('has-error');
        }

        if(field['statusID'] === '5') {
            $('.statusDiv').addClass('has-error');
            error++;
        } else {
            $('.statusDiv').removeClass('has-error');
        }

        if(field['statusID'] != 0 && field['statusID'] != 5) {
            if(field['payment_method'] === '0') {
                $('.paymentmethodDiv').addClass('has-error');
                error++;
            } else {
                $('.paymentmethodDiv').removeClass('has-error');
            }
        }

        var totalsubtotal = 0;
        var totalpaidamount = 0;
        var feetypeitems = $('tr[id^=tr_]').map(function(){
            if($(this).children().eq(4).text() != '' && $(this).children().eq(4).text() != null) {
                totalsubtotal += parseFloat($(this).children().eq(4).text());
            }

            if($(this).children().eq(5).children().val() != '' && $(this).children().eq(5).children().val() != null) {
                totalpaidamount += parseFloat($(this).children().eq(5).children().val());
            }

            return { feetypeID : $(this).attr('invoicefeetypeid'), amount: $(this).children().eq(2).children().val(), discount : $(this).children().eq(3).children().val(), subtotal: $(this).children().eq(4).text() , paidamount: $(this).children().eq(5).children().val() };
        }).get();

        if (typeof feetypeitems == 'undefined' || feetypeitems.length <= 0) {
            error++;
            toastr["error"]('The fee type item is required.')
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

        feetypeitems = JSON.stringify(feetypeitems);

        if(error === 0) {
            $(this).attr('disabled', 'disabled');
            var formData = new FormData($('#invoiceDataForm')[0]);
            formData.append("feetypeitems", feetypeitems);
            formData.append("totalsubtotal", totalsubtotal);
            formData.append("totalpaidamount", totalpaidamount);
            formData.append("editID", 0);
            makingPostDataPreviousofAjaxCall(formData);
        }
    });

    function makingPostDataPreviousofAjaxCall(field) {
        passData = field;
        ajaxCall(passData);
    }

    function ajaxCall(passData) {
        $.ajax({
            type: 'POST',
            url: "<?=base_url('invoice/saveinvoice')?>",
            data: passData,
            async: true,
            dataType: "html",
            success: function(data) {
                var response = JSON.parse(data);
                errrorLoader(response);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }

    function errrorLoader(response) {
        if(response.status) {
            window.location = "<?=base_url("student/edit/".$student->studentID."/".$student->classesID."?tab=invoice")?>";
        } else {
            $('#addInvoiceButton').removeAttr('disabled');
            $.each(response.error, function(index, val) {
                toastr["error"](val)
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
            });
        }
    }

</script>
