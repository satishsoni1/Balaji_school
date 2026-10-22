<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
</head>

<body>
    <?php 
    ini_set("pcre.backtrack_limit", "5000000");
    if (customCompute($students)) {

        foreach ($students as $student) {
            $parents = $controller->parentInfo($student);
        ?>
            <table width="100%">
                <tbody>
                    <tr>
                        <td colspan="4">
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td colspan="3" class="f-title"><?= ($student->classesID<=12)?"Shri Balaji English Primary & Secondary School":"Shri Balaji ENGRAJI MADHYAMIK VIDHYALAY" ?></td>
                                    </tr>
                                    <tr>
                                        <td rowspan="5"><img src="<?= base_url("uploads/images/$siteinfos->photo") ?>" alt=""></td>
                                        <td class="f-title">Wadegaon</td>
                                        <td rowspan="5"><img src="<?= base_url("uploads/images/$siteinfos->photo") ?>" alt=""></td>
                                    </tr>
                                    <tr>
                                        <td class="f-address">Tamshi - Chincholi Road Balaji Nagar Wadegaon</td>
                                    </tr>
                                    <tr>
                                        <td class="f-address">Tq. Balapur , Dist.Akola</td>
                                    </tr>
                                    <tr>
                                        <td class="f-title-2">Progress Report</td>
                                    </tr>
                                    <tr>
                                        <td class="f-year"><?= $schoolyearsessionobj->schoolyear; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td width="25%">
                            <table width="80%">
                                <tbody>
                                    <tr>
                                        <td><img class="profileimg" style="border: 2px solid #000;" src="<?= imagelink($student->photo) ?>" alt=""></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td colspan="3">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td style="width:25%">Name</td>
                                        <td style="font-size:10px"><b><?= $student->srname ?></b></td>
                                        <td style="width:25%">Gen.Reg.No</td>
                                        <td><b><?= $student->srregisterNO ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Std</td>
                                        <td><b><?= isset($classes[$student->srclassesID]) ? $classes[$student->srclassesID] : '' ?></b></td>
                                        <td>Roll No</td>
                                        <td><b><?= $student->srroll ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Father's Name</td>
                                        <td style="font-size:10px"><b><?= $parents->father_name ?></b></td>
                                        <td>DOB</td>
                                        <td><b><?= date('d-m-Y', strtotime($student->dob)) ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td style="font-size:10px" colspan="3"><b><?= $student->address ?></b></td>

                                    </tr>
                                    <tr>
                                        <td>Height (cm)</td>
                                        <td><?= $attendance[$student->studentID]->height ?></td>
                                        <td>Weight (kg)</td>
                                        <td><?= $attendance[$student->studentID]->weight ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table class="table">
                                <?php 
                                        $allexamtotalGradeSubjectMarkFinal = 0;
                                        if(customCompute($settingExam[0])) {
                                            $examID = $settingExam[0];

                                        $markpercentagesArr  = isset($markpercentagesclassArr[$examID]) ? $markpercentagesclassArr[$examID] : [];
                                        reset($markpercentagesArr);
                                        $firstindex          = key($markpercentagesArr);
                                        $uniquepercentageArr = isset($markpercentagesArr[$firstindex]) ? $markpercentagesArr[$firstindex] : [];
                                        $markpercentages     = $uniquepercentageArr[(($settingmarktypeID == 4) || ($settingmarktypeID == 6)) ? 'unique' : 'own'];
                                ?>
                                <?php }
                                
                                $i = 0;
                                $totalColumn = 4;
                                $leftColumn  = 0;

                                        if(customCompute($settingExam[0])) {
                                            $examID = $settingExam[0];

                                        $i++;
                                        $markpercentagesArr  = isset($markpercentagesclassArr[$examID]) ? $markpercentagesclassArr[$examID] : [];
                                        reset($markpercentagesArr);
                                        $firstindex          = key($markpercentagesArr);
                                        $uniquepercentageArr = isset($markpercentagesArr[$firstindex]) ? $markpercentagesArr[$firstindex] : [];
                                        $markpercentages     = $uniquepercentageArr[(($settingmarktypeID == 4) || ($settingmarktypeID == 6)) ? 'unique' : 'own'];

                                        if ($i == 1) {
                                            $leftColumn  = customCompute($markpercentages) + 1;
                                        }
                                    }
                                 ?>
                                <thead>
                                    <tr>
                                        <th rowspan="2">Sr.No</th>
                                        <th rowspan="2">Subjects</th>
                                        <th>Grade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th style="color:#F00">First Term</th>
                                    </tr>
                                    <?php
                                    $totalAllSubjectMark      = 0;
                                    $totalAllSubjectFinalMark = 0;
                                    $TotalexamTotalSubjectMark      = 0;
                                    $totalfinalmark = 0;
                                    $totalpercentageMark = 0;
                                    $total_gpa_point = 0;
                                    if (customCompute($mandatorySubjects)) {
                                        $i=1;
                                        foreach ($mandatorySubjects  as $mandatorySubject) {
                                            $totalSubjectMark = 0;
                                            $totalGradeSubjectMark = 0 ?>
                                            <tr>
                                                <td style="text-align: center;"><?= $i++ ?></td>
                                                <td><?= $mandatorySubject->subject ?></td>
                                                <?php 
                                                
                            if(customCompute($settingExam[0])) {
                                $examID = $settingExam[0];
                                $examTotalSubjectMark = 0;

                                $uniquepercentageArr = isset($markpercentagesclassArr[$examID][$mandatorySubject->subjectID]) ? $markpercentagesclassArr[$examID][$mandatorySubject->subjectID] : [];
                                $markpercentages     = [];
                                if(customCompute($uniquepercentageArr)) {
                                    $markpercentages = $uniquepercentageArr[(($settingmarktypeID==4) || ($settingmarktypeID==6)) ? 'unique' : 'own'];
                                }

                                $percentageMark      = 0;
                                if(customCompute($markpercentages)) { foreach($markpercentages as $markpercentageID) {
                                    
                                    if(isset($uniquepercentageArr['own']) && in_array($markpercentageID, $uniquepercentageArr['own'])) {
                                        $percentageMark   += isset($percentageArr[$markpercentageID]) ? $percentageArr[$markpercentageID]->percentage : 0;
                                    }

                                ?>
                                    <?php
                                        $mark = 0;
                                        if(isset($markArray[$examID][$student->srstudentID]['markpercentageMark'][$mandatorySubject->subjectID][$markpercentageID])) {
                                            $mark = $markArray[$examID][$student->srstudentID]['markpercentageMark'][$mandatorySubject->subjectID][$markpercentageID];
                                        }
                                        
                                        $totalSubjectMark     += $mark;
                                        $examTotalSubjectMark += $mark;
                                    ?>
                            <?php } }
                            $totalGradeSubjectMark += markCalculationView($examTotalSubjectMark, $mandatorySubject->finalmark, $percentageMark);
                            $TotalexamTotalSubjectMark      += $examTotalSubjectMark;
                            $totalfinalmark += $mandatorySubject->finalmark;
                            $totalpercentageMark += $percentageMar;
                             } ?>
                            <?php
                            
                            $totalAllSubjectMark      += $totalSubjectMark;
                            $subjectGradeMark          = $totalGradeSubjectMark;

                            if(customCompute($grades)) { foreach($grades as $grade) {
                                if(($grade->gradefrom <= floor($subjectGradeMark)) && ($grade->gradeupto >= floor($subjectGradeMark))) { ?>
                                    <td style="text-align:center"><?=$grade->grade?></td>
                                    
                            <?php } } } ?>
                                            </tr>
                                    <?php }
                                    } ?>
                                    <tr>
                                        <td></td>
                                        <th>Grade</th>
                                        <?php
                                        $totalGradeSubjectMarkFinal = markCalculationView($TotalexamTotalSubjectMark, $totalfinalmark, $totalpercentageMark);
                                        $allexamtotalGradeSubjectMarkFinal += $totalGradeSubjectMarkFinal;
                                        if(customCompute($grades)) { foreach($grades as $grade) {
                                if(($grade->gradefrom <= floor($totalGradeSubjectMarkFinal)) && ($grade->gradeupto >= floor($totalGradeSubjectMarkFinal))) { ?>
                                    <th style="text-align:center"><?=$grade->grade?></th>
                                    
                            <?php } } } ?>
                                    </tr>
                                </tbody>
                            </table>
                            </td>
                            <td colspan="2">
                            <table class="table">
                                <?php if(customCompute($settingExam[1])) {
                                $examID = $settingExam[1];

                                        $markpercentagesArr  = isset($markpercentagesclassArr[$examID]) ? $markpercentagesclassArr[$examID] : [];
                                        reset($markpercentagesArr);
                                        $firstindex          = key($markpercentagesArr);
                                        $uniquepercentageArr = isset($markpercentagesArr[$firstindex]) ? $markpercentagesArr[$firstindex] : [];
                                        $markpercentages     = $uniquepercentageArr[(($settingmarktypeID == 4) || ($settingmarktypeID == 6)) ? 'unique' : 'own'];
                                ?>
                                <?php 
                                }
                                $i = 0;
                                $totalColumn = 4;
                                $leftColumn  = 0;
                                if(customCompute($settingExam[1])) {
                                    $examID = $settingExam[1];
                                        $i++;
                                        $markpercentagesArr  = isset($markpercentagesclassArr[$examID]) ? $markpercentagesclassArr[$examID] : [];
                                        reset($markpercentagesArr);
                                        $firstindex          = key($markpercentagesArr);
                                        $uniquepercentageArr = isset($markpercentagesArr[$firstindex]) ? $markpercentagesArr[$firstindex] : [];
                                        $markpercentages     = $uniquepercentageArr[(($settingmarktypeID == 4) || ($settingmarktypeID == 6)) ? 'unique' : 'own'];

                                        if ($i == 1) {
                                            $leftColumn  = customCompute($markpercentages) + 1;
                                        }
                                    
                                } ?>
                                <thead>
                                    <tr>
                                        <th rowspan="2">Sr.No</th>
                                        <th rowspan="2">Subjects</th>
                                        <th>Grade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th style="color:#F00">Second Term</th>
                                    </tr>
                                    <?php
                                    $totalAllSubjectMark      = 0;
                                    $totalAllSubjectFinalMark = 0;
                                    $TotalexamTotalSubjectMark      = 0;
                                    $totalfinalmark = 0;
                                    $totalpercentageMark = 0;
                                    $total_gpa_point = 0;
                                    if (customCompute($mandatorySubjects)) {
                                        $i=1;
                                        foreach ($mandatorySubjects  as $mandatorySubject) {
                                            $totalSubjectMark = 0;
                                            $totalGradeSubjectMark = 0 ?>
                                            <tr>
                                                <td style="text-align: center;"><?= $i++ ?></td>
                                                <td><?= $mandatorySubject->subject ?></td>
                                                <?php 
                                                
                            if(customCompute($settingExam[1])) {
                                $examID = $settingExam[1];
                                $examTotalSubjectMark = 0;

                                $uniquepercentageArr = isset($markpercentagesclassArr[$examID][$mandatorySubject->subjectID]) ? $markpercentagesclassArr[$examID][$mandatorySubject->subjectID] : [];
                                $markpercentages     = [];
                                if(customCompute($uniquepercentageArr)) {
                                    $markpercentages = $uniquepercentageArr[(($settingmarktypeID==4) || ($settingmarktypeID==6)) ? 'unique' : 'own'];
                                }

                                $percentageMark      = 0;
                                if(customCompute($markpercentages)) { foreach($markpercentages as $markpercentageID) {
                                    
                                    if(isset($uniquepercentageArr['own']) && in_array($markpercentageID, $uniquepercentageArr['own'])) {
                                        $percentageMark   += isset($percentageArr[$markpercentageID]) ? $percentageArr[$markpercentageID]->percentage : 0;
                                    }

                                ?>
                                    <?php
                                        $mark = 0;
                                        if(isset($markArray[$examID][$student->srstudentID]['markpercentageMark'][$mandatorySubject->subjectID][$markpercentageID])) {
                                            $mark = $markArray[$examID][$student->srstudentID]['markpercentageMark'][$mandatorySubject->subjectID][$markpercentageID];
                                        }
                                        
                                        $totalSubjectMark     += $mark;
                                        $examTotalSubjectMark += $mark;
                                    ?>
                            <?php } }
                            $totalGradeSubjectMark += markCalculationView($examTotalSubjectMark, $mandatorySubject->finalmark, $percentageMark);
                            $TotalexamTotalSubjectMark      += $examTotalSubjectMark;
                            $totalfinalmark += $mandatorySubject->finalmark;
                            $totalpercentageMark += $percentageMar;
                             } ?>
                            <?php
                            
                            $totalAllSubjectMark      += $totalSubjectMark;
                            $subjectGradeMark          = $totalGradeSubjectMark;

                            if(customCompute($grades)) { foreach($grades as $grade) {
                                if(($grade->gradefrom <= floor($subjectGradeMark)) && ($grade->gradeupto >= floor($subjectGradeMark))) { ?>
                                    <td style="text-align:center"><?=$grade->grade?></td>
                                    
                            <?php } } } ?>
                                            </tr>
                                    <?php }
                                    } ?>
                                    <tr>
                                        <td></td>
                                        <th>Grade</th>
                                        <?php
                                        $totalGradeSubjectMarkFinal = markCalculationView($TotalexamTotalSubjectMark, $totalfinalmark, $totalpercentageMark);
                                        $allexamtotalGradeSubjectMarkFinal += $totalGradeSubjectMarkFinal;
                                        if(customCompute($grades)) { foreach($grades as $grade) {
                                if(($grade->gradefrom <= floor($totalGradeSubjectMarkFinal)) && ($grade->gradeupto >= floor($totalGradeSubjectMarkFinal))) { ?>
                                    <th style="text-align:center"><?=$grade->grade?></th>
                                    
                            <?php } } } ?>
                                    </tr>
                                </tbody>
                            </table>
                            </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th width="50%">Grand Total / Grade</th>
                                        <?php
                                        $gradevalue = $totalGradeSubjectMarkFinal/2;
                                        if(customCompute($grades)) { foreach($grades as $grade) {
                                if(($grade->gradefrom <= floor($gradevalue)) && ($grade->gradeupto >= floor($gradevalue))) { ?>
                                    <th style="text-align:center" width="50%"><?=$grade->grade?></th>
                                    
                            <?php } } } ?>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table class="table">
                            <thead>
                                    <tr>
                                        <th colspan=2>Term-1 Result Date</th>                                       
                                        <th><?= date('d-m-Y',strtotime($resultdate->termonedate)) ?></th>
                                    </tr>
                                </thead>
                            </table>
                        </td>
                        <td colspan="2">
                            <table class="table">
                            <thead>
                                    <tr>
                                        <th colspan=2>Term-2 Result Date</th>
                                        <th><?= date('d-m-Y',strtotime($resultdate->termtwodate)) ?></th>
                                    </tr>
                                </thead>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">

                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="width:19%;text-align:left;font-size:10px;" class="f10">Percentage</th>
                                        <td style="width:9%;text-align:center;font-size:10px;" class="f10">91-100</td>
                                        <td style="width:9%;text-align:center;font-size:10px;" class="f10">81-90</td>
                                        <td style="width:9%;text-align:center;font-size:10px;" class="f10">71-80</td>
                                        <td style="width:9%;text-align:center;font-size:10px;" class="f10">61-70</td>
                                        <td style="width:9%;text-align:center;font-size:10px;" class="f10">51-60</td>
                                        <td style="width:9%;text-align:center;font-size:10px;" class="f10">41-50</td>
                                        <td style="width:9%;text-align:center;font-size:10px;" class="f10">33-40</td>
                                        <td style="width:9%;text-align:center;font-size:10px;" class="f10">21-32</td>
                                        <td style="width:9%;text-align:center;font-size:10px;" class="f10">0-20</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:left;font-size:10px;" class="f10">Grade</th>
                                        <td style="text-align:center;font-size:10px;" class="f10">A1</td>
                                        <td style="text-align:center;font-size:10px;" class="f10">A2</td>
                                        <td style="text-align:center;font-size:10px;" class="f10">B1</td>
                                        <td style="text-align:center;font-size:10px;" class="f10">B2</td>
                                        <td style="text-align:center;font-size:10px;" class="f10">C1</td>
                                        <td style="text-align:center;font-size:10px;" class="f10">C2</td>
                                        <td style="text-align:center;font-size:10px;" class="f10">D</td>
                                        <td style="text-align:center;font-size:10px;" class="f10">E1</td>
                                        <td style="text-align:center;font-size:10px;" class="f10">E2</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:left;font-size:10px;" class="f10">Remarks</th>
                                        <td style="text-align:center;font-size:10px;" class="f10">Excellent</td>
                                        <td style="text-align:center;font-size:10px;" class="f10">Excellent</td>
                                        <td style="text-align:center;font-size:10px;" class="f10">Very Good</td>
                                        <td style="text-align:center;font-size:10px;" class="f10">Very Good</td>
                                        <td style="text-align:center;font-size:10px;" class="f10">Good</td>
                                        <td style="text-align:center;font-size:10px;" class="f10">Good</td>
                                        <td style="text-align:center;font-size:10px;" class="f10">Satisfactory</td>
                                        <td style="text-align:center;font-size:8px;" class="f10">Unsatisfactory</td>
                                        <td style="text-align:center;font-size:10px;" class="f10">Poor</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th colspan="13" style="font-size:13    px;color:#F0F">Attendence Report</th>
                                    </tr>
                                    <tr>
                                        <th style="width:20%;text-align:left;font-size:10px;" class="f10">Month</th>
                                        <td style="width:6%;text-align:center;font-size:10px;" class="f10">June</td>
                                        <td style="width:6%;text-align:center;font-size:10px;" class="f10">July</td>
                                        <td style="width:6%;text-align:center;font-size:10px;" class="f10">Aug</td>
                                        <td style="width:6%;text-align:center;font-size:10px;" class="f10">Sept</td>
                                        <td style="width:6%;text-align:center;font-size:10px;" class="f10">Oct</td>
                                        <td style="width:6%;text-align:center;font-size:10px;" class="f10">Nov</td>
                                        <td style="width:6%;text-align:center;font-size:10px;" class="f10">Dec</td>
                                        <td style="width:6%;text-align:center;font-size:10px;" class="f10">Jan</td>
                                        <td style="width:6%;text-align:center;font-size:10px;" class="f10">Feb</td>
                                        <td style="width:6%;text-align:center;font-size:10px;" class="f10">March</td>
                                        <td style="width:6%;text-align:center;font-size:10px;" class="f10">April</td>
                                        <td style="width:12%;text-align:center;font-size:10px;" class="f10">Total</td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:left;font-size:10px;" class="f10">Working Days</th>
                                        <td><?= $resultdate->working_days_june ?></td>
                                        <td><?= $resultdate->working_days_july ?></td>
                                        <td><?= $resultdate->working_days_aug ?></td>
                                        <td><?= $resultdate->working_days_sept ?></td>
                                        <td><?= $resultdate->working_days_oct ?></td>
                                        <td><?= $resultdate->working_days_nov ?></td>
                                        <td><?= $resultdate->working_days_dec ?></td>
                                        <td><?= $resultdate->working_days_jan ?></td>
                                        <td><?= $resultdate->working_days_feb ?></td>
                                        <td><?= $resultdate->working_days_march ?></td>
                                        <td><?= $resultdate->working_days_apr ?></td>
                                        <td><?= $resultdate->working_days_june+$resultdate->working_days_july+$resultdate->working_days_aug+$resultdate->working_days_sept+$resultdate->working_days_oct+$resultdate->working_days_nov+$resultdate->working_days_dec+$resultdate->working_days_jan+$resultdate->working_days_feb+$resultdate->working_days_march+$resultdate->working_days_apr+$resultdate->working_days_may ?></td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:left;font-size:10px;" class="f10">Present Days</th>
                                       
                                        <td><?= $attendance[$student->studentID]->working_days_june ?></td>
                                        <td><?= $attendance[$student->studentID]->working_days_july ?></td>
                                        <td><?= $attendance[$student->studentID]->working_days_aug ?></td>
                                        <td><?= $attendance[$student->studentID]->working_days_sept ?></td>
                                        <td><?= $attendance[$student->studentID]->working_days_oct ?></td>
                                        <td><?= $attendance[$student->studentID]->working_days_nov ?></td>
                                        <td><?= $attendance[$student->studentID]->working_days_dec ?></td>
                                        <td><?= $attendance[$student->studentID]->working_days_jan ?></td>
                                        <td><?= $attendance[$student->studentID]->working_days_feb ?></td>
                                        <td><?= $attendance[$student->studentID]->working_days_march ?></td>
                                        <td><?= $attendance[$student->studentID]->working_days_apr ?></td>
                                        <td><?= $attendance[$student->studentID]->working_days_june+$attendance[$student->studentID]->working_days_july+$attendance[$student->studentID]->working_days_aug+$attendance[$student->studentID]->working_days_sept+$attendance[$student->studentID]->working_days_oct+$attendance[$student->studentID]->working_days_nov+$attendance[$student->studentID]->working_days_dec+$attendance[$student->studentID]->working_days_jan+$attendance[$student->studentID]->working_days_feb+$attendance[$student->studentID]->working_days_march+$attendance[$student->studentID]->working_days_apr+$attendance[$student->studentID]->working_days_may ?></td>
                                    </tr>
                                </tbody>
                            </table>

                        </td>
                    </tr>
                    <?php
                        $total_rows = 12;
                        $remaining_rows = 12-$i;
                        for($j=0;$j<(int)($remaining_rows/2);$j++){
                            echo '<tr><td colspan="4" >&nbsp;</td></tr>';
                        }
                    ?>
                    <tr>
                        <td colspan="4">
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td style="color:#C00000;font-size:14px;text-align:center;">Remarks - __________________</td>
                                        <td style="color:#C00000;font-size:14px;text-align:center;">Progress - __________________</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="color:#C00000;font-size:14px;text-align:center;">Congratulations</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align:center"><b><?= $student->name?></b> moves a step forward from Class <b><?=isset($classes[$student->srclassesID]) ? $classes[$student->srclassesID] : ''?></b> to <b><?=isset($classes[$student->srclassesID+1]) ? $classes[$student->srclassesID+1] : ''?></b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align:center">School Reopens On :- <?= date('d-m-Y',strtotime($resultdate->school_opening_date)) ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align:center">Attendance On The</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align:center"><b>Re - Opening Day Is Compulsory</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <?php
                        $total_rows = 12;
                        $remaining_rows = 12-$i;
                        for($j=0;$j<(int)($remaining_rows/2);$j++){
                            echo '<tr><td colspan="4">&nbsp;</td></tr>';
                        }
                    ?>
                    <tr>
                        <td colspan="4">
                            <table width="100%">
                                <tr>
                                    <td colspan="3">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="3">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="3">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;width:33%;">Parents / Guardians Sign</td>
                                    <td style="text-align:center;width:33%;">Class Teacher Sign</td>
                                    <td style="text-align:center;width:33%;">Principal Sign</td>
                                    
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p style="page-break-after: always;">&nbsp;</p>
        <?php }
    } else { ?>
        <div class="notfound">
            <p><?= $this->lang->line('progresscardreport_data_not_found') ?></p>
        </div>
    <?php } ?>
</body>

</html>