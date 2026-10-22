<style>
.table-bordered > thead > tr > th, .table-bordered > tbody > tr > td {
    font-size: 14px !important;
}
.table-responsive {
min-height: .01%;
overflow-x: auto;
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

                
                

                <?php if(customCompute($students) > 0 ) { ?>

                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#all" aria-expanded="true"><?=$this->lang->line("student_all_students")?></a></li>
                            <?php foreach ($sections as $key => $section) {
                                echo '<li class=""><a data-toggle="tab" href="#tab'.$section->classesID.$section->sectionID .'" aria-expanded="false">'. $this->lang->line("student_section")." ".$section->section. " ( ". $section->category." )".'</a></li>';
                            } ?>
                        </ul>



                        <div class="tab-content">
                            <div id="all" class="tab-pane active table-responsive">
                                <div id="hide-table" class="table-responsive">
                                    <table class=" overflow-auto example4 table table-striped table-bordered dataTable no-footer">
                                        <thead>
                                            <tr>
                                                <th class="col-sm-1"><?=$this->lang->line('slno')?></th>
                                                <th class="col-sm-2">GR No</th>
                                                <th class="col-sm-2"><?=$this->lang->line('student_name')?></th>
                                                <th class="col-sm-2">DOB</th>
                                                <th class="col-sm-2">Admission Date</th>
                                                <th class="col-sm-2">Sex</th>
                                                <th class="col-sm-2">Religion</th>
                                                <th class="col-sm-2">Email</th>
                                                <th class="col-sm-2">Phone</th>
                                                <th class="col-sm-2">Address</th>

                                                
                                                <th class="col-sm-1"><?=$this->lang->line('student_classes')?></th>
                                                <th class="col-sm-1"><?=$this->lang->line('student_section')?></th>
                                                
                                                <th class="col-sm-1"><?=$this->lang->line('student_roll')?></th>
                                                <th class="col-sm-2">State</th>
                                                <th class="col-sm-2">Birth Place</th>
                                                <th class="col-sm-2">Birth Tq</th>
                                                <th class="col-sm-2">Birth District</th>
                                                <th class="col-sm-2">Mother Tongue</th>
                                                <th class="col-sm-2">Category</th>
                                                <th class="col-sm-2">Caste</th>
                                                <th class="col-sm-2">Last School Attendant</th>
                                                <th class="col-sm-2">Last Class</th>
                                                <th class="col-sm-2">Aadhar Card</th>
                                                <th class="col-sm-2">Local address</th>
                                                <th class="col-sm-2">Student ID</th>
                                                <th class="col-sm-2">rashan_card</th>
                                                <th class="col-sm-2">Birth certificate no</th>
                                                <th class="col-sm-2">Birth certificate date</th>
                                                <th class="col-sm-2">Last school attendant address</th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(customCompute($students)) {$i = 1; foreach($students as $student) { ?>
                                                <tr>
                                                    <td data-title="<?=$this->lang->line('slno')?>">
                                                        <?php echo $i; ?>
                                                    </td>

                                                    <td data-title="GR No">
                                                    <?php echo $student->registerNO; ?>
                                                    </td>
                                                    <td data-title="<?=$this->lang->line('student_name')?>">
                                                        <?php echo $student->srname; ?>
                                                    </td>
                                                    <td data-title="DOB"><?php echo $student->dob; ?></td>
                                                <td data-title="Admission Date"><?php echo ($student->student_admission_date=="" || $student->student_admission_date==null)?date('d-M-Y',strtotime($student->admission_date)):date('d-M-Y',strtotime($student->student_admission_date)); ?></td>
                                                <td data-title="Sex"><?php echo $student->sex; ?></td>
                                                <td data-title="Religion"><?php echo $student->religion; ?></td>
                                                <td data-title="Email"><?php echo $student->email; ?></td>
                                                <td data-title="<?=$this->lang->line('student_phone')?>">
                                                        <?php echo $student->phone; ?>
                                                    </td>
                                                <td data-title="Address"><?php echo $student->address; ?></td>

                                                <td data-title="<?=$this->lang->line('student_classes')?>">
                                                        <?php echo $student->srclasses; ?>
                                                    </td>
                                                    <td data-title="<?=$this->lang->line('student_section')?>">
                                                        <?php echo $student->srsection; ?>
                                                    </td>
                                                    
                                                    <td data-title="<?=$this->lang->line('student_roll')?>">
                                                        <?php echo $student->srroll; ?>
                                                    </td>
                                                
                                                <td data-title="State"><?php echo $student->state; ?></td>
                                                <td data-title="Birth Place"><?php echo $student->birth_place; ?></td>
                                                <td data-title="Birth City"><?php echo $student->birth_taluka; ?></td>
                                                <td data-title="Birth District"><?php echo $student->birth_district; ?></td>
                                                
                                                <td data-title="Mother Tongue"><?php echo $student->mother_tongue; ?></td>
                                                <td data-title="Category"><?php echo $student->category; ?></td>
                                                <td data-title="Caste"><?php echo $student->caste; ?></td>
                                                <td data-title="Last School Attendant"><?php echo $student->last_school_attendant; ?></td>
                                                <td data-title="Last Class"><?php echo $student->last_class; ?></td>
                                                <td data-title="Aadhar Card"><?php echo $student->aadhar_card; ?></td>
                                                <td data-title="Local address"><?php echo $student->local_address; ?></td>
                                                <td data-title="Student ID"><?php echo $student->student_id; ?></td>
                                                <td data-title="rashan_card"><?php echo $student->rashan_card; ?></td>
                                                <td data-title="Birth certificate no"><?php echo $student->birth_certificate_no; ?></td>
                                                <td data-title="Birth certificate date"><?php echo $student->birth_certificate_date; ?></td>
                                                <td data-title="Last school attendant address"><?php echo $student->last_school_attendant_address; ?></td>

                                                   
                                                    
                                                   
                                               </tr>
                                            <?php $i++; }} ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <?php foreach ($sections as $key => $section) { ?>
                                    <div id="tab<?=$section->classesID.$section->sectionID?>" class="tab-pane">
                                        <div id="hide-table">
                                            <table class="table example4 table-striped table-bordered table-hover dataTable no-footer">
                                                <thead>
                                                    <tr>
                                                    <th class="col-sm-1"><?=$this->lang->line('slno')?></th>
                                                <th class="col-sm-2">GR No</th>
                                                <th class="col-sm-2"><?=$this->lang->line('student_name')?></th>
                                                <th class="col-sm-2">DOB</th>
                                                <th class="col-sm-2">Admission Date</th>
                                                <th class="col-sm-2">Sex</th>
                                                <th class="col-sm-2">Religion</th>
                                                <th class="col-sm-2">Email</th>
                                                <th class="col-sm-2">Phone</th>
                                                <th class="col-sm-2">Address</th>

                                                
                                                <th class="col-sm-1"><?=$this->lang->line('student_classes')?></th>
                                                <th class="col-sm-1"><?=$this->lang->line('student_section')?></th>
                                                
                                                <th class="col-sm-1"><?=$this->lang->line('student_roll')?></th>
                                                <th class="col-sm-2">State</th>
                                                <th class="col-sm-2">Birth Place</th>
                                                <th class="col-sm-2">Birth District</th>
                                                <th class="col-sm-2">Birth City</th>
                                                <th class="col-sm-2">Birth State</th>
                                                <th class="col-sm-2">Birth Pincode</th>
                                                <th class="col-sm-2">Mother Tongue</th>
                                                <th class="col-sm-2">Category</th>
                                                <th class="col-sm-2">Caste</th>
                                                <th class="col-sm-2">Last School Attendant</th>
                                                <th class="col-sm-2">Last Class</th>
                                                <th class="col-sm-2">Aadhar Card</th>
                                                <th class="col-sm-2">Local address</th>
                                                <th class="col-sm-2">Student ID</th>
                                                <th class="col-sm-2">rashan_card</th>
                                                <th class="col-sm-2">Birth certificate no</th>
                                                <th class="col-sm-2">Birth certificate date</th>
                                                <th class="col-sm-2">Last school attendant address</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(customCompute($allsection[$section->sectionID])) { $i = 1; foreach($allsection[$section->sectionID] as $student) { if($section->sectionID === $student->srsectionID) { ?>
                                                        <tr>
                                                    <td data-title="<?=$this->lang->line('slno')?>">
                                                        <?php echo $i; ?>
                                                    </td>

                                                    <td data-title="GR No">
                                                    <?php echo $student->registerNO; ?>
                                                    </td>
                                                    <td data-title="<?=$this->lang->line('student_name')?>">
                                                        <?php echo $student->srname; ?>
                                                    </td>
                                                    <td data-title="DOB"><?php echo $student->dob; ?></td>
                                                <td data-title="Admission Date"><?php echo $student->student_admission_date; ?></td>
                                                <td data-title="Sex"><?php echo $student->sex; ?></td>
                                                <td data-title="Religion"><?php echo $student->religion; ?></td>
                                                <td data-title="Email"><?php echo $student->email; ?></td>
                                                <td data-title="<?=$this->lang->line('student_phone')?>">
                                                        <?php echo $student->phone; ?>
                                                    </td>
                                                <td data-title="Address"><?php echo $student->address; ?></td>

                                                <td data-title="<?=$this->lang->line('student_classes')?>">
                                                        <?php echo $student->srclasses; ?>
                                                    </td>
                                                    <td data-title="<?=$this->lang->line('student_section')?>">
                                                        <?php echo $student->srsection; ?>
                                                    </td>
                                                    
                                                    <td data-title="<?=$this->lang->line('student_roll')?>">
                                                        <?php echo $student->srroll; ?>
                                                    </td>
                                                
                                                <td data-title="State"><?php echo $student->state; ?></td>
                                                <td data-title="Birth Place"><?php echo $student->birth_place; ?></td>
                                                <td data-title="Birth District"><?php echo $student->birth_district; ?></td>
                                                <td data-title="Birth City"><?php echo $student->birth_city; ?></td>
                                                <td data-title="Birth State"><?php echo $student->birth_state; ?></td>
                                                <th td data-title="Birth Pincode"><?php echo $student->birth_pincode; ?></td>
                                                <td data-title="Mother Tongue"><?php echo $student->mother_tongue; ?></td>
                                                <td data-title="Category"><?php echo $student->category; ?></td>
                                                <td data-title="Caste"><?php echo $student->caste; ?></td>
                                                <td data-title="Last School Attendant"><?php echo $student->last_school_attendant; ?></td>
                                                <td data-title="Last Class"><?php echo $student->last_class; ?></td>
                                                <td data-title="Aadhar Card"><?php echo $student->aadhar_card; ?></td>
                                                <td data-title="Local address"><?php echo $student->local_address; ?></td>
                                                <td data-title="Student ID"><?php echo $student->student_id; ?></td>
                                                <td data-title="rashan_card"><?php echo $student->rashan_card; ?></td>
                                                <td data-title="Birth certificate no"><?php echo $student->birth_certificate_no; ?></td>
                                                <td data-title="Birth certificate date"><?php echo $student->birth_certificate_date; ?></td>
                                                <td data-title="Last school attendant address"><?php echo $student->last_school_attendant_address; ?></td>

                                                   
                                                    
                                                   
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
                                                <th class="col-sm-2"><?=$this->lang->line('slno')?></th>
                                                <th class="col-sm-2"><?=$this->lang->line('student_photo')?></th>
                                                <th class="col-sm-2"><?=$this->lang->line('student_name')?></th>
                                                <th class="col-sm-2"><?=$this->lang->line('student_roll')?></th>
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
$(document).ready(function () {
            $('.example4').DataTable({
              dom : 'Bfrtip',
              buttons : [
                {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
                },
                'colvis'
              ],
              responsive: true
            });
        });

</script>