<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <div class="col-sm-12">
        <?=reportheader($siteinfos, $schoolyearsessionobj, true)?>
    </div>
    <div class="box-header bg-gray">
        <h3> <?=$this->lang->line('studentreport_report_for')?> - Category</h3>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="pull-left">
                    <?=$this->lang->line('studentreport_class')?> : <?=isset($classes[$classesID]) ? $classes[$classesID]->classes : $this->lang->line('studentreport_select_all_class')?>
                </h5>  
                <h5 class="pull-right">
                    <?=$this->lang->line('studentreport_section')?> : <?=isset($sections[$sectionID]) ? $sections[$sectionID]->section : $this->lang->line('studentreport_select_all_section')?>
                </h5>  
            </div>
            <div class="col-sm-12">
                <?php if(customCompute($students)) { ?>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                            <tr>
                            <th rowspan="2">S.No.</th>
                                        <th rowspan="2">Class Teacher Name</th>
                                        <th rowspan="2">Class</th>
                                        <th colspan=2>SC</th>
                                        <th colspan=2>ST</th>
                                        <th colspan=2>OBC</th>
                                        <th colspan=2>VJ</th>
                                        <th colspan=2>NT</th>
                                        <th colspan=2>MUSLIM</th>
                                        <th colspan=2>JAIN</th>
                                        <th colspan=2>OPEN</th>
                                        <th colspan=2>Total</th>
                                        <th rowspan="2">Total</th>
                                        <th rowspan="2">Classes Total</th>
                                    </tr>
                                    <tr>

                                    <th>Girls</th>
                                        <th>Boys</th>
                                        <th>Girls</th>
                                        <th>Boys</th>
                                        <th>Girls</th>
                                        <th>Boys</th>
                                        <th>Girls</th>
                                        <th>Boys</th>
                                        <th>Girls</th>
                                        <th>Boys</th>
                                        <th>Girls</th>
                                        <th>Boys</th>
                                        <th>Girls</th>
                                        <th>Boys</th>
                                        <th>Girls</th>
                                        <th>Boys</th>
                                        <th>Girls</th>
                                        <th>Boys</th>
                                    </tr>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 1;
                                $flag = 0;
                                $sc_male = 0;
                                $sc_female = 0;

                                $st_male = 0;
                                $st_female = 0;

                                $obc_male = 0;
                                $obc_female = 0;

                                $vj_male = 0;
                                $vj_female = 0;

                                $nt_male = 0;
                                $nt_female = 0;

                                $muslim_male = 0;
                                $muslim_female = 0;

                                $jain_male = 0;
                                $jain_female = 0;

                                $open_male = 0;
                                $open_female = 0;
                                foreach($students as $student) { 
                                    $category = $student['row'];
                                    $sc_male += $category['SC']['male'];
                                        $sc_female += $category['SC']['female'];
    
                                        $st_male += $category['ST']['male'];
                                        $st_female += $category['ST']['female'];
    
                                        $obc_male += $category['OBC']['male'];
                                        $obc_female += $category['OBC']['female'];
    
                                        $vj_male += $category['VJ']['male'];
                                        $vj_female += $category['VJ']['female'];
    
                                        $nt_male += $category['NT']['male'];
                                        $nt_female += $category['NT']['female'];
    
                                        $muslim_male += $category['MUSLIM']['male'];
                                        $muslim_female += $category['MUSLIM']['female'];
    
                                        $jain_male += $category['JAIN']['male'];
                                        $jain_female += $category['JAIN']['female'];
    
                                        $open_male += $category['OPEN']['male'];
                                        $open_female += $category['OPEN']['female'];
                                        ?>
                                        <tr>
                                            <td data-title="S.No."><?= $i ?></td>

                                            <td data-title=""><?= $student['teacher_name'] ?></td>

                                            <td data-title=""><?= $student['section'] ?></td>
                                            
                                            <td data-title=""><?= $category['SC']['female'] ?></td>
                                            <td data-title=""><?= $category['SC']['male'] ?></td>

                                            <td data-title=""><?= $category['ST']['female'] ?></td>
                                            <td data-title=""><?= $category['ST']['male'] ?></td>

                                            <td data-title=""><?= $category['OBC']['female'] ?></td>
                                            <td data-title=""><?= $category['OBC']['male'] ?></td>
                                            

                                            <td data-title=""><?= $category['VJ']['female'] ?></td>
                                            <td data-title=""><?= $category['VJ']['male'] ?></td>
                                            
                                            <td data-title=""><?= $category['NT']['female'] ?></td>
                                            <td data-title=""><?= $category['NT']['male'] ?></td>

                                            <td data-title=""><?= $category['MUSLIM']['female'] ?></td>
                                            <td data-title=""><?= $category['MUSLIM']['male'] ?></td>

                                            <td data-title=""><?= $category['JAIN']['female'] ?></td>
                                            <td data-title=""><?= $category['JAIN']['male'] ?></td>

                                            <td data-title=""><?= $category['OPEN']['female'] ?></td>
                                            <td data-title=""><?= $category['OPEN']['male'] ?></td>

                                            
                                            
                                            
                                            <td data-title=""><?= $category['JAIN']['female']+$category['MUSLIM']['female']+$category['NT']['female']+$category['VJ']['female']+$category['SC']['female']+$category['ST']['female']+$category['OBC']['female']+$category['OPEN']['female'] ?></td>
                                            <td data-title=""><?= $category['JAIN']['male']+$category['MUSLIM']['male']+$category['NT']['male']+$category['VJ']['male']+$category['SC']['male']+$category['ST']['male']+$category['OBC']['male']+$category['OPEN']['male'] ?></td>

                                            <td data-title=""><?= $category['JAIN']['female']+$category['MUSLIM']['female']+$category['NT']['female']+$category['VJ']['female']+$category['SC']['female']+$category['ST']['female']+$category['OBC']['female']+$category['OPEN']['female']+$category['JAIN']['male']+$category['MUSLIM']['male']+$category['NT']['male']+$category['VJ']['male']+$category['SC']['male']+$category['ST']['male']+$category['OBC']['male']+$category['OPEN']['male'] ?></td>
                                            <td data-title=""><?= $category['JAIN']['female']+$category['MUSLIM']['female']+$category['NT']['female']+$category['VJ']['female']+$category['SC']['female']+$category['ST']['female']+$category['OBC']['female']+$category['OPEN']['female']+$category['JAIN']['male']+$category['MUSLIM']['male']+$category['NT']['male']+$category['VJ']['male']+$category['SC']['male']+$category['ST']['male']+$category['OBC']['male']+$category['OPEN']['male'] ?></td>
                                            
                                        </tr>

                            <?php $i++; } ?>
                        </tbody>
                        <tfooter>
                                <tr>
                                <th colspan="3">Total</th>
                                <th><?= $sc_female ?></th>
                                <th><?= $sc_male ?></th>
                                <th><?= $st_female ?></th>
                                <th><?= $st_male ?></th>
                                <th><?= $obc_female ?></th>
                                <th><?= $obc_male ?></th>
                                <th><?= $vj_female ?></th>
                                <th><?= $vj_male ?></th>
                                <th><?= $nt_female ?></th>
                                <th><?= $nt_male ?></th>
                                <th><?= $muslim_female ?></th>
                                <th><?= $musilm_male ?></th>
                                <th><?= $jain_female ?></th>
                                <th><?= $jain_male ?></th>
                                <th><?= $open_female ?></th>
                                <th><?= $open_male ?></th>
                                <th><?= $muslim_female+$open_female+$jain_female+$nt_female+$vj_female+$obc_female+$st_female+$sc_female ?></th>
                                <th><?= $muslim_male+$open_male+$jain_male+$nt_male+$vj_male+$obc_male+$st_male+$sc_male ?></th>
                                <th><?= $muslim_male+$open_male+$jain_male+$nt_male+$vj_male+$obc_male+$st_male+$sc_male+$muslim_female+$open_female+$jain_female+$nt_female+$vj_female+$obc_female+$st_female+$sc_female ?></th>
                                <th><?= $muslim_male+$open_male+$jain_male+$nt_male+$vj_male+$obc_male+$st_male+$sc_male+$muslim_female+$open_female+$jain_female+$nt_female+$vj_female+$obc_female+$st_female+$sc_female ?></th>
                                
                                
                                </tr>
                                </tfooter>
                    </table>
                <?php } else {  ?>
                    <div class="notfound">
                        <?php echo $this->lang->line('studentreport_student_not_found'); ?>
                    </div>
                <?php } ?>
            </div>
            <div class="col-sm-12" style="height: 10px;">
            </div>
            <div class="col-sm-12">
            <table border="0">
            <tr>
            <td>Date: <?= date('d-m-Y') ?></td>
            <td style="text-align:right">Principal Sign</td>
            </tr>
            </table>
            </div>
            <div class="col-sm-12">
                <?=reportfooter($siteinfos, $schoolyearsessionobj, true)?>
            </div>
        </div><!-- row -->
    </div><!-- Body -->
</body>
</html>