
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-student"></i> <?=$this->lang->line('panel_title')?></h3>

        <ol class="breadcrumb">
            <li><a href="<?=base_url("home/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("student/index")?>"><?=$this->lang->line('menu_student')?></a></li>
            <li class="active"><?=$this->lang->line('menu_add')?> <?=$this->lang->line('menu_student')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
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
                                echo form_dropdown("student_type", $student_type_array, set_value("student_type"), "id='student_type' class='form-control select2'");
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
                            <input type="text" class="form-control" id="form_no" name="form_no" value="<?=set_value('form_no',$form_no)?>" readonly>
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
                                echo form_dropdown("classesID", $classArray, set_value("classesID"), "id='classesID' class='form-control select2'");
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
                                $sectionArray = array(0 => $this->lang->line("student_select_section"));
                                if($sections != "empty") {
                                    foreach ($sections as $section) {
                                        $sectionArray[$section->sectionID] = $section->section;
                                    }
                                }

                                $sID = 0;
                                if($sectionID == 0) {
                                    $sID = 0;
                                } else {
                                    $sID = $sectionID;
                                }

                                echo form_dropdown("sectionID", $sectionArray, set_value("sectionID", $sID), "id='sectionID' class='form-control select2'");
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
                            <input type="text" class="form-control" id="registerNO" name="registerNO" value="<?=set_value('registerNO')?>" >
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
                            <input type="text" class="form-control" id="student_id" name="student_id" value="<?=set_value('student_id')?>" >
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
                            <input type="text" class="form-control" id="roll" name="roll" value="<?=set_value('roll')?>" >
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
                            <input type="text" class="form-control" id="aadhar_card" name="aadhar_card" value="<?=set_value('aadhar_card')?>" >
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
                            <input type="text" class="form-control" id="pen_no" name="pen_no" value="<?=set_value('pen_no')?>" >
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

                            echo form_dropdown("packageID", $packagesArray, set_value("packageID"), "id='packageID' class='form-control select2'");
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
                            <input type="text" class="form-control" id="name_id" name="name" value="<?=set_value('name')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('name'); ?>
                        </span>
                    </div>


                    <!-- <?php
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
                                    foreach ($parents as $parent) {
                                        $parentsemail = '';
                                        if($parent->email) {
                                            $parentsemail = " (" . $parent->email ." )";
                                        }
                                        $array[$parent->parentsID] = $parent->name.$parentsemail;
                                    }
                                    echo form_dropdown("guargianID", $array, set_value("guargianID"), "id='guargianID' class='form-control guargianID select2'");
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
                            <input type="text" class="form-control" id="admission_date" name="admission_date" value="<?=set_value('admission_date')?>" >
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
                            <input type="text" class="form-control" id="dob" name="dob" value="<?=set_value('dob')?>" >
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
                            <input type="text" class="form-control" id="birth_place" name="birth_place" value="<?=set_value('birth_place')?>" >
                            
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
                            <input type="text" class="form-control" id="birth_taluka" name="birth_taluka" value="<?=set_value('birth_taluka')?>" >
                            
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
                            <input type="text" class="form-control" id="birth_district" name="birth_district" value="<?=set_value('birth_district')?>" >
                            
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
                            <input type="text" class="form-control" id="birth_city" name="birth_city" value="<?=set_value('birth_city')?>" >
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
                            <input type="text" class="form-control" id="birth_state" name="birth_state" value="<?=set_value('birth_state')?>" >
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
                            <?=$this->lang->line("student_birth_country")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                        <?php
                                $country['0'] = $this->lang->line('student_select_country');
                                foreach ($allcountry as $allcountryKey => $allcountryit) {
                                    $country[$allcountryKey] = $allcountryit;
                                }
                            ?>
                            <?php
                                echo form_dropdown("birth_country", $country, set_value("birth_country","IN"), "id='birth_country' class='form-control select2'");
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
                            <input type="pincode" class="form-control" id="birth_pincode" name="birth_pincode" value="<?=set_value('birth_pincode')?>" >
                            
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
                        <label for="birth_certificate_no" class="col-sm-4 control-label">
                            Birth Certificate No
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="birth_certificate_no" name="birth_certificate_no" value="<?= set_value('birth_certificate_no') ?>" >
                            
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('birth_certificate_no'); ?>
                        </span>
                    </div>
                    <!-- <?php
                        if(form_error('birth_cartificate_date'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="birth_cartificate_date" class="col-sm-4 control-label">
                            Birth Certificate Date
                        </label>
                        <div class="col-sm-6">
                            <input type="date" class="form-control" data-date-format="dd-mm-yyyy" id="birth_cartificate_date" name="birth_cartificate_date" value="<?=set_value('birth_cartificate_date')?>" >
                            
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('birth_cartificate_date'); ?>
                        </span>
                    </div> -->
                    <?php
                        if(form_error('rashan_card'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="rashan_card" class="col-sm-4 control-label">
                            Rashan Card
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="rashan_card" name="rashan_card" value="<?=set_value('rashan_card')?>" >
                            
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
                                echo form_dropdown("sex", array($this->lang->line('student_sex_male') => $this->lang->line('student_sex_male'), $this->lang->line('student_sex_female') => $this->lang->line('student_sex_female')), set_value("sex"), "id='sex' class='form-control'");
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
                                echo form_dropdown("bloodgroup", $bloodArray, set_value("bloodgroup"), "id='bloodgroup' class='form-control select2'");
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
                            <input type="text" class="form-control" id="religion" name="religion" value="<?=set_value('religion')?>" >
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
                        <label for="phone" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_phone")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="phone" name="phone" value="<?=set_value('phone')?>" >
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
                            <?=$this->lang->line("student_parmanent_address")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="address" name="address" value="<?=set_value('address')?>" >
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
                            <input type="text" class="form-control" id="state" name="state" value="<?=set_value('state')?>" >
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
                                echo form_dropdown("country", $country, set_value("country","IN"), "id='country' class='form-control select2'");
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
                            <input type="text" class="form-control" id="mother_tongue" name="mother_tongue" value="<?=set_value('mother_tongue')?>" >
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
                                echo form_dropdown("category", $categoryArray, set_value("category"), "id='category' class='form-control select2'");
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
                            <input type="text" class="form-control" id="caste" name="caste" value="<?=set_value('caste')?>" >
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
                            <input type="text" class="form-control" id="subcaste" name="subcaste" value="<?=set_value('subcaste')?>" >
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
                            <input type="text" class="form-control" id="last_school_attendant" name="last_school_attendant" value="<?=set_value('last_school_attendant')?>" >
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
                        <label for="last_school_attendant_address" class="col-sm-4 control-label">
                        Last school attend Address
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="last_school_attendant_address" name="last_school_attendant_address" value="<?=set_value('last_school_attendant_address')?>" >
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
                            <input type="text" class="form-control" id="reason" name="reason" value="<?=set_value('reason')?>" >
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
                                echo form_dropdown("last_class", $classArray, set_value("last_class"), "id='last_class' class='form-control select2'");
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
                            <input type="text" class="form-control" id="local_address" name="local_address" value="<?=set_value('local_address')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('local_address'); ?>
                        </span>
                    </div> -->
                    
                    
                    
                    

<!-- 
                    <div class="form-group <?=form_error('studentGroupID') ? ' has-error' : ''  ?>">
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
                                echo form_dropdown("studentGroupID", $groupArray, set_value("studentGroupID"), "id='studentGroupID' class='form-control select2'");
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

                            echo form_dropdown("optionalSubjectID", $optionalSubjectArray, set_value("optionalSubjectID", $optionalSubjectID), "id='optionalSubjectID' class='form-control select2'");
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
                            <input type="text" class="form-control" id="extraCurricularActivities" name="extraCurricularActivities" value="<?=set_value('extraCurricularActivities')?>" >
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
                            <input type="text" class="form-control" id="remarks" name="remarks" value="<?=set_value('remarks')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('remarks'); ?>
                        </span>
                    </div>

                    <?php
                        if(form_error('username'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="username" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_username")?> <span class="text-red">*</span>
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
                        <label for="password" class="col-sm-4 control-label">
                            <?=$this->lang->line("student_password")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="password" name="password" value="<?=set_value('password')?>" >
                        </div>
                         <span class="col-sm-4 control-label">
                            <?php echo form_error('password'); ?>
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
                        <input type="checkbox" class="handicap_enable" name="handicap_enable" style="margin-right:1rem">
                            <div class="handicap_div">
                                <input type="text" class="form-control" id="handicap" name="handicap" value="<?=set_value('handicap')?>" >
                            </div>
                            <!-- <input type="text" class="form-control" id="handicap" name="handicap" value="<?=set_value('handicap')?>" > -->
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('handicap'); ?>
                        </span>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("add_student")?>" >
                        </div>
                    </div>
                

                <?php if ($siteinfos->note==1) { ?>
                    <!-- <div class="callout callout-danger">
                        <p><b>Note:</b> Create teacher, class, section before create a new student.</p>
                    </div> -->
                <?php } ?>
            </div> <!-- col-sm-8 -->
            <div class="col-sm-5">
            
            <?php
                        if(form_error('photo'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="photo" class="col-sm-2 control-label">
                            <?=$this->lang->line("student_photo")?> <span class="text-red">*</span>
                        </label>
                        
<div class="col-sm-6">
    <?= studentimage(null) ?>

    <!-- Preview -->
    <!-- <img id="photo-view" src="<?= base_url('uploads/images/default.png')?>" style="width:150px;margin-bottom:10px;"> -->

    <div class="input-group image-preview">
        <input type="text" class="form-control image-preview-filename" disabled>

        <span class="input-group-btn">

            <!-- Clear -->
            <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                <span class="fa fa-remove"></span>
                <?=$this->lang->line('student_clear')?>
            </button>

            <!-- File Upload -->
            <div class="btn btn-success image-preview-input">
                <span class="fa fa-upload"></span>
                <span><?=$this->lang->line('student_file_browse')?></span>
                <input type="file" accept="image/*" name="photo" onchange="loadFile(event)">
            </div>

            <!-- Webcam -->
            <button type="button" class="btn btn-primary" onclick="openCamera()" style="margin-left:5px;">
                <span class="fa fa-camera"></span> Camera
            </button>

        </span>
    </div>

    <!-- Hidden Base64 -->
    <input type="hidden" name="photo_base64" id="photo_base64">
</div>
                                  
                        <span class="col-sm-4">
                            <?php echo form_error('photo'); ?>
                        </span>
                    </div>
                    </form>
                    </div>
        </div><!-- row -->
    </div><!-- Body -->
</div><!-- /.box -->
<div id="cameraModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.8); z-index:9999;">
    <div style="width:600px; max-width:95%; background:#fff; margin:40px auto; padding:20px; border-radius:10px; text-align:center;">
        
        <h3>Capture Photo</h3>

        <video id="video" width="100%" height="350" autoplay></video>
        <canvas id="canvas" style="display:none;"></canvas>

        <br><br>

        <button class="btn btn-success" onclick="capturePhoto()">Capture</button>
        <button class="btn btn-danger" onclick="closeCamera()">Close</button>
    </div>
</div>
<script type="text/javascript">
$( ".select2" ).select2();
let stream;

function openCamera() {
    document.getElementById("cameraModal").style.display = "block";

    navigator.mediaDevices.getUserMedia({ video: true })
    .then(function(s) {
        stream = s;
        document.getElementById("video").srcObject = stream;
    })
    .catch(function() {
        alert("Camera not accessible");
    });
}

function capturePhoto() {
    let video = document.getElementById("video");
    let canvas = document.getElementById("canvas");

    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;

    let ctx = canvas.getContext("2d");
    ctx.drawImage(video, 0, 0);

    let base64 = canvas.toDataURL("image/png");

    document.getElementById("photo_base64").value = base64;
    document.getElementById("photo-view").src = base64;

    closeCamera();
}

function closeCamera() {
    document.getElementById("cameraModal").style.display = "none";
    if(stream) {
        stream.getTracks().forEach(track => track.stop());
    }
}
function calcDate(date1,date2) {
    var diff = Math.floor(date1.getTime() - date2.getTime());
    var day = 1000 * 60 * 60 * 24;

    var days = Math.floor(diff/day);
    var months = Math.floor(days/31);
    var years = Math.floor(months/12);
    months = months-years*12;
    days = days-(months*31+((years*12)*31));

    var message = "";
    message += years + " years "
    message += months + " months "
    message += days + " days \n" 

    return message
    }
$('#dob').datepicker({ 
    startView: 2
 }).on('change',function(){
        var date = $(this).datepicker('getDate');
        var today = new Date();
        var dayDiff = calcDate(today,date);
        console.log(dayDiff);
        $('#dob').parent().find('span').text(dayDiff)
 });
$('#admission_date').datepicker({ startView: 2 });

$('#username').keyup(function() {
    $(this).val($(this).val().replace(/\s/g, ''));
});


$('#classesID').change(function(event) {
    var classesID = $(this).val();
    if(classesID === '0') {
        $('#sectionID').val(0);
    } else {
        $.ajax({
            async: false,
            type: 'POST',
            url: "<?=base_url('student/sectioncall')?>",
            data: "id=" + classesID,
            dataType: "html",
            success: function(data) {
               $('#sectionID').html(data);
            }
        });

        $.ajax({
            async: false,
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
           $('.content').css('padding-bottom', '100px');
        },
         function () {
           $('.image-preview').popover('hide');
           $('.content').css('padding-bottom', '20px');
        }
    );
});
var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('photo-view');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
$(function() {
    // Create the close button
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
        var output = document.getElementById('photo-view');
        output.src = "<?= base_url('uploads/images/default.png')?>";
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
            $('.content').css('padding-bottom', '100px');
        }
        reader.readAsDataURL(file);
    });
    $('input.handicap_enable').change(function(){
                $(this).next()[ this.checked ? 'show' : 'hide']();  
    }).change();
});


</script>
