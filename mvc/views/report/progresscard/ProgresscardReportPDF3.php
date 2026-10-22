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

<table width="100%" border="0" cellpadding="0" cellspacing="0"
       style="border: 3pt double #008080;">
<tr><td style="padding: 5pt;">

<table width="100%" border="0" cellpadding="0" cellspacing="0"
       style="border: 1pt solid #00aaaa;">
<tr><td style="padding: 6pt;" >

  <table width="100%" border="0" cellpadding="2" cellspacing="0" style="margin-bottom:4pt;">
    <tr><td colspan="3" class="reg-line">Shri Balaji Yuvak Krida Mandal, Wadegaon (Reg. No. F2451)</td></tr>
    <tr>
      <td width="80" align="center" valign="middle">
        <img src="<?= base_url("uploads/images/$siteinfos->photo") ?>"
             width="110px" alt="" />
      </td>
      <td align="center" valign="middle">
        <table><tr><td>
        <div class="school-name">
          <?= ($student->classesID <= 12)
              ? "Shri Balaji English Higher Primary School, Wadegaon"
              : "Shri Balaji ENGRAJI MADHYAMIK VIDHYALAY, Wadegaon" ?>
        </div>
        </td>
    </tr>
    <tr>
        <td>
        <div class="school-address">Tamshi - Chincholi Road Balaji Nagar Wadegaon</div>
        </td>
        </tr>
    <tr>
        <td>
        <div class="school-address" style="padding-bottom:2px !important;">Tq. Balapur , Dist.Akola<br/></div>
        </td>
        </tr>
    <tr>
        <td>
        <div class="report-badge">Progress Report</div>
        </td>
        </tr>
    <tr>
        <td>
        <div class="session-line" style="padding-top:2px;">ACADEMIC SESSION: <?= $schoolyearsessionobj->schoolyear ?></div>
        </td>
        </tr>
    <tr>
        <td>
        <div class="class-line">CLASS: <?= isset($sections[$student->srsectionID]) ? $sections[$student->srsectionID] : '' ?></div>
        </td>
    </tr>
        </table>
      </td>
      <td width="65" align="center" valign="middle">
        <img src="<?= imagelink($student->photo) ?>"
             width="90px" alt="Photo"
             style="border: 1.5pt solid #008080;" />
      </td>
    </tr>
  </table>

  <table class="info-box" cellpadding="0" cellspacing="0"
         style="margin-bottom:5pt;">
    <tr>
      <td class="info-label">Student's Name</td>
      <td style="width:4pt;">:&nbsp;</td>
      <td class="info-value" width="38%"><?= $student->srname ?></td>
      <td class="info-label">Gen.Reg.No</td>
      <td style="width:4pt;">:&nbsp;</td>
      <td class="info-value"><?= $student->srregisterNO ?></td>
    </tr>
    <tr>
      <td class="info-label">Mother's Name</td>
      <td>:&nbsp;</td>
      <td class="info-value"><?= $parents->mother_name ?></td>
      <td class="info-label">Date of Birth</td>
      <td>:&nbsp;</td>
      <td class="info-value"><?= date('d/m/Y', strtotime($student->dob)) ?></td>
    </tr>
    <tr>
      <td class="info-label">Father's Name</td>
      <td>:&nbsp;</td>
      <td class="info-value"><?= $parents->father_name ?></td>
      <td class="info-label">Roll No</td>
      <td>:&nbsp;</td>
      <td class="info-value"><?= $student->srroll ?></td>
    </tr>
    <tr>
      <td class="info-label">SARAL No</td>
      <td>:&nbsp;</td>
      <td class="info-value"><?= $student->student_id ?></td>
      <td class="info-label">PEN No</td>
      <td>:&nbsp;</td>
      <td class="info-value" colspan="3"><?= $student->pen_no ?></td>
    </tr>
    <tr>
      <td class="info-label">Admission Date</td>
      <td>:&nbsp;</td>
      <td class="info-value"><?= date('d/m/Y', strtotime($student->admission_date)) ?></td>
      <td class="info-label">Aadhar No.</td>
      <td>:&nbsp;</td>
      <td class="info-value"><?= $student->aadhar_card ?></td>
    </tr>
  </table>

  <?php
  $term1GradeLabel = '';
  $term2GradeLabel = '';

  // Helper: compute grade mark total for one exam across all subjects
  if ( !function_exists('getExamGradeLabel') ) {
      function getExamGradeLabel($settingExam, $examIdx, $mandatorySubjects,
                               $markpercentagesclassArr, $settingmarktypeID,
                               $markArray, $percentageArr, $student, $grades) {
          if (!customCompute($settingExam[$examIdx])) return '';
          $examID   = $settingExam[$examIdx];
          $totalMark = 0; $totalFinal = 0; $totalPct = 0;
          foreach ($mandatorySubjects as $ms) {
              $uniqueArr = isset($markpercentagesclassArr[$examID][$ms->subjectID])
                           ? $markpercentagesclassArr[$examID][$ms->subjectID] : [];
              $mps = [];
              if (customCompute($uniqueArr)) {
                  $mps = $uniqueArr[(($settingmarktypeID==4)||($settingmarktypeID==6)) ? 'unique' : 'own'];
              }
              $pct = 0; $examTotal = 0;
              if (customCompute($mps)) {
                  foreach ($mps as $mpID) {
                      if (isset($uniqueArr['own']) && in_array($mpID, $uniqueArr['own'])) {
                          $pct += isset($percentageArr[$mpID]) ? $percentageArr[$mpID]->percentage : 0;
                      }
                      $m = isset($markArray[$examID][$student->srstudentID]['markpercentageMark'][$ms->subjectID][$mpID])
                           ? $markArray[$examID][$student->srstudentID]['markpercentageMark'][$ms->subjectID][$mpID] : 0;
                      
                      // Safely add only numeric values to the grand total
                      if (is_numeric($m)) {
                          $examTotal += (float)$m;
                      }
                  }
              }
              $totalMark  += $examTotal;
              $totalFinal += $ms->finalmark;
              $totalPct   += $pct;
          }
          $gradeMark = markCalculationView($totalMark, $totalFinal, $totalPct);
          if (customCompute($grades)) {
              foreach ($grades as $g) {
                  if (($g->gradefrom <= floor($gradeMark)) && ($g->gradeupto >= floor($gradeMark))) {
                      return $g->grade;
                  }
              }
          }
          return '';
      }
  }
  if ( !function_exists('getExamGradeMark') ) {
    function getExamGradeMark($settingExam, $examIdx, $mandatorySubjects,
                             $markpercentagesclassArr, $settingmarktypeID,
                             $markArray, $percentageArr, $student, $grades) {
        if (!customCompute($settingExam[$examIdx])) return '';
        $examID   = $settingExam[$examIdx];
        $totalMark = 0; $totalFinal = 0; $totalPct = 0;
        foreach ($mandatorySubjects as $ms) {
            $uniqueArr = isset($markpercentagesclassArr[$examID][$ms->subjectID])
                         ? $markpercentagesclassArr[$examID][$ms->subjectID] : [];
            $mps = [];
            if (customCompute($uniqueArr)) {
                $mps = $uniqueArr[(($settingmarktypeID==4)||($settingmarktypeID==6)) ? 'unique' : 'own'];
            }
            $pct = 0; $examTotal = 0;
            if (customCompute($mps)) {
                foreach ($mps as $mpID) {
                    if (isset($uniqueArr['own']) && in_array($mpID, $uniqueArr['own'])) {
                        $pct += isset($percentageArr[$mpID]) ? $percentageArr[$mpID]->percentage : 0;
                    }
                    $m = isset($markArray[$examID][$student->srstudentID]['markpercentageMark'][$ms->subjectID][$mpID])
                         ? $markArray[$examID][$student->srstudentID]['markpercentageMark'][$ms->subjectID][$mpID] : 0;
                    
                    // Safely add only numeric values to the grand total
                    if (is_numeric($m)) {
                        $examTotal += (float)$m;
                    }
                }
            }
            $totalMark  += $examTotal;
            $totalFinal += $ms->finalmark;
            $totalPct   += $pct;
        }
        $gradeMark = markCalculationView($totalMark, $totalFinal, $totalPct);
        // if (customCompute($grades)) {
        //     foreach ($grades as $g) {
        //         if (($g->gradefrom <= floor($gradeMark)) && ($g->gradeupto >= floor($gradeMark))) {
        //             return $g->grade;
        //         }
        //     }
        // }
        return [$totalMark,number_format(($totalMark*100)/$totalPct).'%'];
    }
}
  ?>
<table width="100%" border="0" cellpadding="0" cellspacing="4"
         style="margin-top:4pt; margin-bottom:4pt;">
    <tr>
      <td width="48%" valign="top">
  <table class="data-table" cellpadding="0" cellspacing="0"
         style="margin-bottom:4pt;">
    <thead>
      <tr>
        <th class="th-main" rowspan="2" width="25">Sr.No.</th>
        <th class="th-main" rowspan="2" style="text-align:left; width:120pt;">SUBJECTS</th>
        <th class="th-main">1st Term</th>
      </tr>
      <tr>
        <th class="th-sub">Marks</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (customCompute($mandatorySubjects)) {
          $rowNum = 1;
          foreach ($mandatorySubjects as $mandatorySubject) {

              // ── Per-subject Term 1 grade ──
              $term1Grade = '';
              $term1Mark = '';
              if (customCompute($settingExam[0])) {
                  $examID = $settingExam[0];
                  $examTotalSubjectMark = 0;
                  $uniquepercentageArr = isset($markpercentagesclassArr[$examID][$mandatorySubject->subjectID])
                                         ? $markpercentagesclassArr[$examID][$mandatorySubject->subjectID] : [];
                  $markpercentages = [];
                  if (customCompute($uniquepercentageArr)) {
                      $markpercentages = $uniquepercentageArr[(($settingmarktypeID==4)||($settingmarktypeID==6)) ? 'unique' : 'own'];
                  }
                  $percentageMark = 0;
                  if (customCompute($markpercentages)) {
                      foreach ($markpercentages as $markpercentageID) {
                          if (isset($uniquepercentageArr['own']) && in_array($markpercentageID, $uniquepercentageArr['own'])) {
                              $percentageMark += isset($percentageArr[$markpercentageID]) ? $percentageArr[$markpercentageID]->percentage : 0;
                          }
                          $mark = isset($markArray[$examID][$student->srstudentID]['markpercentageMark'][$mandatorySubject->subjectID][$markpercentageID])
                                  ? $markArray[$examID][$student->srstudentID]['markpercentageMark'][$mandatorySubject->subjectID][$markpercentageID] : 0;
                          
                          // Check if the mark is a direct letter grade
                          if (!is_numeric($mark) && trim($mark) !== '') {
                              $term1Grade = $mark;
                              $examTotalSubjectMark = -1; // Flag to skip numeric calculation
                          } else {
                              $examTotalSubjectMark += (float)$mark;
                          }
                      }
                  }
                  
                  // Only calculate a numeric grade if we didn't capture a direct letter grade
                  if ($examTotalSubjectMark >= 0) {
                      $sgm = markCalculationView($examTotalSubjectMark, $mandatorySubject->finalmark, $percentageMark);
                      if (customCompute($grades)) {
                          foreach ($grades as $grade) {
                              if (($grade->gradefrom <= floor($sgm)) && ($grade->gradeupto >= floor($sgm))) {
                                  $term1Grade = $grade->grade;
                                  $term1Mark = $sgm;
                              }
                          }
                      }
                  }
              }

              // ── Per-subject Term 2 grade ──
              $term2Grade = '';
              $term2Mark = '';
              if (customCompute($settingExam[1])) {
                  $examID = $settingExam[1];
                  $examTotalSubjectMark = 0;
                  $uniquepercentageArr = isset($markpercentagesclassArr[$examID][$mandatorySubject->subjectID])
                                         ? $markpercentagesclassArr[$examID][$mandatorySubject->subjectID] : [];
                  $markpercentages = [];
                  if (customCompute($uniquepercentageArr)) {
                      $markpercentages = $uniquepercentageArr[(($settingmarktypeID==4)||($settingmarktypeID==6)) ? 'unique' : 'own'];
                  }
                  $percentageMark = 0;
                  if (customCompute($markpercentages)) {
                      foreach ($markpercentages as $markpercentageID) {
                          if (isset($uniquepercentageArr['own']) && in_array($markpercentageID, $uniquepercentageArr['own'])) {
                              $percentageMark += isset($percentageArr[$markpercentageID]) ? $percentageArr[$markpercentageID]->percentage : 0;
                          }
                          $mark = isset($markArray[$examID][$student->srstudentID]['markpercentageMark'][$mandatorySubject->subjectID][$markpercentageID])
                                  ? $markArray[$examID][$student->srstudentID]['markpercentageMark'][$mandatorySubject->subjectID][$markpercentageID] : 0;
                          
                          if (!is_numeric($mark) && trim($mark) !== '') {
                              $term2Grade = $mark;
                              $examTotalSubjectMark = -1;
                          } else {
                              $examTotalSubjectMark += (float)$mark;
                          }
                      }
                  }
                  
                  if ($examTotalSubjectMark >= 0) {
                      $sgm = markCalculationView($examTotalSubjectMark, $mandatorySubject->finalmark, $percentageMark);
                      if (customCompute($grades)) {
                          foreach ($grades as $grade) {
                              if (($grade->gradefrom <= floor($sgm)) && ($grade->gradeupto >= floor($sgm))) {
                                  $term2Grade = $grade->grade;
                                  $term2Mark = $sgm;

                              }
                          }
                      }
                  }
              }

              $rowClass = ($rowNum % 2 == 0) ? 'tr-even' : 'tr-odd';
      ?>
      <tr class="<?= $rowClass ?>">
        <td><?= $rowNum++ ?></td>
        <td class="subject-col"><?= $mandatorySubject->subject ?></td>
        <td class="grade-cell"><?= $term1Mark ?></td>
      </tr>
      <?php
          } // end foreach mandatorySubjects

          // ── Overall grand grade per term ──
          $term1GradeLabel = getExamGradeLabel($settingExam, 0, $mandatorySubjects,
              $markpercentagesclassArr, $settingmarktypeID, $markArray, $percentageArr, $student, $grades);
          $term2GradeLabel = getExamGradeLabel($settingExam, 1, $mandatorySubjects,
              $markpercentagesclassArr, $settingmarktypeID, $markArray, $percentageArr, $student, $grades);
          $term1Array = getExamGradeMark($settingExam, 0, $mandatorySubjects,
              $markpercentagesclassArr, $settingmarktypeID, $markArray, $percentageArr, $student, $grades);
          $term2Array = getExamGradeMark($settingExam, 1, $mandatorySubjects,
              $markpercentagesclassArr, $settingmarktypeID, $markArray, $percentageArr, $student, $grades);
          $term1TotalMark = $term1Array[0];
          $term1Totalper = $term1Array[1];
          $term2TotalMark = $term2Array[0];
          $term2Totalper = $term2Array[1];
              
      } // end if mandatorySubjects
      ?>
      <tr>
        <td colspan="2" class="td-grand-label">Grand Total & Percentage</td>
        <td class="td-grand-val"><?= $term1TotalMark ?> & <?= $term1Totalper ?></td>
      </tr>
    </tbody>
  </table>
      </td>
      <td width="48%" valign="top">
  <table class="data-table" cellpadding="0" cellspacing="0"
         style="margin-bottom:4pt;">
    <thead>
      <tr>
        <th class="th-main" rowspan="2" width="25">Sr.No.</th>
        <th class="th-main" rowspan="2" style="text-align:left; width:120pt;">SUBJECTS</th>
        <th class="th-main">2nd Term</th>
      </tr>
      <tr>
        <th class="th-sub">Marks</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (customCompute($mandatorySubjects)) {
          $rowNum = 1;
          foreach ($mandatorySubjects as $mandatorySubject) {

              // ── Per-subject Term 2 grade (repeated for the second table) ──
              $term2Grade = '';
              if (customCompute($settingExam[1])) {
                  $examID = $settingExam[1];
                  $examTotalSubjectMark = 0;
                  $uniquepercentageArr = isset($markpercentagesclassArr[$examID][$mandatorySubject->subjectID])
                                         ? $markpercentagesclassArr[$examID][$mandatorySubject->subjectID] : [];
                  $markpercentages = [];
                  if (customCompute($uniquepercentageArr)) {
                      $markpercentages = $uniquepercentageArr[(($settingmarktypeID==4)||($settingmarktypeID==6)) ? 'unique' : 'own'];
                  }
                  $percentageMark = 0;
                  if (customCompute($markpercentages)) {
                      foreach ($markpercentages as $markpercentageID) {
                          if (isset($uniquepercentageArr['own']) && in_array($markpercentageID, $uniquepercentageArr['own'])) {
                              $percentageMark += isset($percentageArr[$markpercentageID]) ? $percentageArr[$markpercentageID]->percentage : 0;
                          }
                          $mark = isset($markArray[$examID][$student->srstudentID]['markpercentageMark'][$mandatorySubject->subjectID][$markpercentageID])
                                  ? $markArray[$examID][$student->srstudentID]['markpercentageMark'][$mandatorySubject->subjectID][$markpercentageID] : 0;
                          
                          if (!is_numeric($mark) && trim($mark) !== '') {
                              $term2Grade = $mark;
                              $examTotalSubjectMark = -1;
                          } else {
                              $examTotalSubjectMark += (float)$mark;
                          }
                      }
                  }
                  
                  if ($examTotalSubjectMark >= 0) {
                      $sgm = markCalculationView($examTotalSubjectMark, $mandatorySubject->finalmark, $percentageMark);
                      if (customCompute($grades)) {
                          foreach ($grades as $grade) {
                              if (($grade->gradefrom <= floor($sgm)) && ($grade->gradeupto >= floor($sgm))) {
                                  $term2Grade = $grade->grade;
                                    $term2Mark = $sgm;
                              }
                          }
                      }
                  }
              }

              $rowClass = ($rowNum % 2 == 0) ? 'tr-even' : 'tr-odd';
      ?>
      <tr class="<?= $rowClass ?>">
        <td><?= $rowNum++ ?></td>
        <td class="subject-col"><?= $mandatorySubject->subject ?></td>
        <td class="grade-cell"><?= $term2Mark ?></td>
      </tr>
      <?php
          } // end foreach mandatorySubjects
      } // end if mandatorySubjects
      ?>
      <tr>
        <td colspan="2" class="td-grand-label">Grand Total & Percentage</td>
        <td class="td-grand-val"><?= $term2TotalMark ?> & <?= $term2Totalper ?></td>
      </tr>
    </tbody>
  </table>
      </td>
    </tr>
</table>

<div class="section-header">CO-SCHOLASTIC AREA</div>
  <table class="data-table" cellpadding="0" cellspacing="0"
         style="margin-bottom:4pt;">
    <thead>
      <tr>
        <th class="th-main" style="text-align:left; width:60%;">Subject</th>
        <th class="th-main">Term - 1</th>
        <th class="th-main">Term - 2</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (customCompute($optionalSubjects)) {
          $optRowNum = 1;
          foreach ($optionalSubjects as $optionalSubject) {
              if (stripos(trim($optionalSubject->subject), 'Discipline') !== false) {
                continue;
              }
              // ── Per-subject Term 1 grade ──
              $term1OptGrade = '';
              if (customCompute($settingExam[0])) {
                  $examID = $settingExam[0];
                  $examTotalSubjectMark = 0;
                  $uniquepercentageArr = isset($markpercentagesclassArr[$examID][$optionalSubject->subjectID])
                                         ? $markpercentagesclassArr[$examID][$optionalSubject->subjectID] : [];
                  $markpercentages = [];
                  if (customCompute($uniquepercentageArr)) {
                      $markpercentages = $uniquepercentageArr[(($settingmarktypeID==4)||($settingmarktypeID==6)) ? 'unique' : 'own'];
                  }
                  $percentageMark = 0;
                  if (customCompute($markpercentages)) {
                      foreach ($markpercentages as $markpercentageID) {
                          if (isset($uniquepercentageArr['own']) && in_array($markpercentageID, $uniquepercentageArr['own'])) {
                              $percentageMark += isset($percentageArr[$markpercentageID]) ? $percentageArr[$markpercentageID]->percentage : 0;
                          }
                          $mark = isset($markArray[$examID][$student->srstudentID]['markpercentageMark'][$optionalSubject->subjectID][$markpercentageID])
                                  ? $markArray[$examID][$student->srstudentID]['markpercentageMark'][$optionalSubject->subjectID][$markpercentageID] : 0;
                          
                          if (!is_numeric($mark) && trim($mark) !== '') {
                              $term1OptGrade = $mark;
                              $examTotalSubjectMark = -1; 
                          } else {
                              $examTotalSubjectMark += (float)$mark;
                          }
                      }
                  }
                  
                  if ($examTotalSubjectMark >= 0) {
                      $sgm = markCalculationView($examTotalSubjectMark, $optionalSubject->finalmark, $percentageMark);
                      if (customCompute($grades)) {
                          foreach ($grades as $grade) {
                              if (($grade->gradefrom <= floor($sgm)) && ($grade->gradeupto >= floor($sgm))) {
                                  $term1OptGrade = $grade->grade;
                              }
                          }
                      }
                  }
              }

              // ── Per-subject Term 2 grade ──
              $term2OptGrade = '';
              if (customCompute($settingExam[1])) {
                  $examID = $settingExam[1];
                  $examTotalSubjectMark = 0;
                  $uniquepercentageArr = isset($markpercentagesclassArr[$examID][$optionalSubject->subjectID])
                                         ? $markpercentagesclassArr[$examID][$optionalSubject->subjectID] : [];
                  $markpercentages = [];
                  if (customCompute($uniquepercentageArr)) {
                      $markpercentages = $uniquepercentageArr[(($settingmarktypeID==4)||($settingmarktypeID==6)) ? 'unique' : 'own'];
                  }
                  $percentageMark = 0;
                  if (customCompute($markpercentages)) {
                      foreach ($markpercentages as $markpercentageID) {
                          if (isset($uniquepercentageArr['own']) && in_array($markpercentageID, $uniquepercentageArr['own'])) {
                              $percentageMark += isset($percentageArr[$markpercentageID]) ? $percentageArr[$markpercentageID]->percentage : 0;
                          }
                          $mark = isset($markArray[$examID][$student->srstudentID]['markpercentageMark'][$optionalSubject->subjectID][$markpercentageID])
                                  ? $markArray[$examID][$student->srstudentID]['markpercentageMark'][$optionalSubject->subjectID][$markpercentageID] : 0;
                          
                          if (!is_numeric($mark) && trim($mark) !== '') {
                              $term2OptGrade = $mark;
                              $examTotalSubjectMark = -1;
                          } else {
                              $examTotalSubjectMark += (float)$mark;
                          }
                      }
                  }
                  
                  if ($examTotalSubjectMark >= 0) {
                      $sgm = markCalculationView($examTotalSubjectMark, $optionalSubject->finalmark, $percentageMark);
                      if (customCompute($grades)) {
                          foreach ($grades as $grade) {
                              if (($grade->gradefrom <= floor($sgm)) && ($grade->gradeupto >= floor($sgm))) {
                                  $term2OptGrade = $grade->grade;
                              }
                          }
                      }
                  }
              }

              $rowClass = ($optRowNum % 2 == 0) ? 'tr-even' : 'tr-odd';
      ?>
      <tr class="<?= $rowClass ?>">
        <td class="subject-col"><?= $optionalSubject->subject ?></td>
        <td><?= $term1OptGrade ?></td>
        <td><?= $term2OptGrade ?></td>
      </tr>
      <?php
              $optRowNum++;
          } // end foreach optionalSubjects
      } else {
      ?>
        <tr>
            <td colspan="3" style="text-align:center; color:#999; padding: 5px;">No Optional Subjects Assigned</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

  <?php
    // Set default values to 0
    $term1_total = 0; $term1_present = 0;
    $term2_total = 0; $term2_present = 0;

    // Check if attendance data exists for this specific student
    if(isset($term_attendances[$student->srstudentID])) {
        $att = $term_attendances[$student->srstudentID];
        $term1_total   = $att->term1_total_days;
        $term1_present = $att->term1_present_days;
        $term2_total   = $att->term2_total_days;
        $term2_present = $att->term2_present_days;
        $attendancePct = number_format((($term1_present+$term2_present)*100)/($term1_total+$term2_total))."%";
    }
  ?>
  <table width="100%" border="0" cellpadding="0" cellspacing="4"
         style="margin-top:4pt; margin-bottom:4pt;">
    <tr>
    <!-- <td width="48%" valign="top">
        <table width="100%" border="0" cellpadding="0" cellspacing="0"
               style="border: 1.5pt solid #008080;">
          <tr>
            <td class="da-title" colspan="3">DISCIPLINE</td></tr>
          <tr>
            <th class="da-th">Subject</th>
            <th class="da-th">Term - 1</th>
            <th class="da-th">Term - 2</th>
          </tr>
          <?php
          $disciplineFound = false;
        
          if (customCompute($optionalSubjects)) {
              foreach ($optionalSubjects as $optSubj) {
                  // Check if the subject name contains the word 'discipline' (case-insensitive)
                  if (stripos(trim($optSubj->subject), 'Discipline') !== false) {
                      $disciplineFound = true;
                      
                      // ── Term 1 Discipline grade ──
                      $term1DiscGrade = '';
                      if (customCompute($settingExam[0])) {
                          $examID = $settingExam[0];
                          $examTotalSubjectMark = 0;
                          $uniquepercentageArr = isset($markpercentagesclassArr[$examID][$optSubj->subjectID]) ? $markpercentagesclassArr[$examID][$optSubj->subjectID] : [];
                          $markpercentages = [];
                          if (customCompute($uniquepercentageArr)) {
                              $markpercentages = $uniquepercentageArr[(($settingmarktypeID==4)||($settingmarktypeID==6)) ? 'unique' : 'own'];
                          }
                          $percentageMark = 0;
                          if (customCompute($markpercentages)) {
                              foreach ($markpercentages as $markpercentageID) {
                                  if (isset($uniquepercentageArr['own']) && in_array($markpercentageID, $uniquepercentageArr['own'])) {
                                      $percentageMark += isset($percentageArr[$markpercentageID]) ? $percentageArr[$markpercentageID]->percentage : 0;
                                  }
                                  $mark = isset($markArray[$examID][$student->srstudentID]['markpercentageMark'][$optSubj->subjectID][$markpercentageID]) ? $markArray[$examID][$student->srstudentID]['markpercentageMark'][$optSubj->subjectID][$markpercentageID] : 0;
                                  
                                  if (!is_numeric($mark) && trim($mark) !== '') {
                                      $term1DiscGrade = $mark;
                                      $examTotalSubjectMark = -1;
                                  } else {
                                      $examTotalSubjectMark += (float)$mark;
                                  }
                              }
                          }
                          if ($examTotalSubjectMark >= 0) {
                              $sgm = markCalculationView($examTotalSubjectMark, $optSubj->finalmark, $percentageMark);
                              if (customCompute($grades)) {
                                  foreach ($grades as $grade) {
                                      if (($grade->gradefrom <= floor($sgm)) && ($grade->gradeupto >= floor($sgm))) {
                                          $term1DiscGrade = $grade->grade;
                                      }
                                  }
                              }
                          }
                      }

                      // ── Term 2 Discipline grade ──
                      $term2DiscGrade = '';
                      if (customCompute($settingExam[1])) {
                          $examID = $settingExam[1];
                          $examTotalSubjectMark = 0;
                          $uniquepercentageArr = isset($markpercentagesclassArr[$examID][$optSubj->subjectID]) ? $markpercentagesclassArr[$examID][$optSubj->subjectID] : [];
                          $markpercentages = [];
                          if (customCompute($uniquepercentageArr)) {
                              $markpercentages = $uniquepercentageArr[(($settingmarktypeID==4)||($settingmarktypeID==6)) ? 'unique' : 'own'];
                          }
                          $percentageMark = 0;
                          if (customCompute($markpercentages)) {
                              foreach ($markpercentages as $markpercentageID) {
                                  if (isset($uniquepercentageArr['own']) && in_array($markpercentageID, $uniquepercentageArr['own'])) {
                                      $percentageMark += isset($percentageArr[$markpercentageID]) ? $percentageArr[$markpercentageID]->percentage : 0;
                                  }
                                  $mark = isset($markArray[$examID][$student->srstudentID]['markpercentageMark'][$optSubj->subjectID][$markpercentageID]) ? $markArray[$examID][$student->srstudentID]['markpercentageMark'][$optSubj->subjectID][$markpercentageID] : 0;
                                  
                                  if (!is_numeric($mark) && trim($mark) !== '') {
                                      $term2DiscGrade = $mark;
                                      $examTotalSubjectMark = -1;
                                  } else {
                                      $examTotalSubjectMark += (float)$mark;
                                  }
                              }
                          }
                          if ($examTotalSubjectMark >= 0) {
                              $sgm = markCalculationView($examTotalSubjectMark, $optSubj->finalmark, $percentageMark);
                              if (customCompute($grades)) {
                                  foreach ($grades as $grade) {
                                      if (($grade->gradefrom <= floor($sgm)) && ($grade->gradeupto >= floor($sgm))) {
                                          $term2DiscGrade = $grade->grade;
                                      }
                                  }
                              }
                          }
                      }

                      echo '<tr>';
                      echo '<td class="da-td">' . $optSubj->subject . '</td>';
                      echo '<td class="da-td">' . ($term1DiscGrade ? $term1DiscGrade : '-') . '</td>';
                      echo '<td class="da-td">' . ($term2DiscGrade ? $term2DiscGrade : '-') . '</td>';
                      echo '</tr>';
                  }
              }
          }

          // Fallback if no Discipline subject is found in the database for this student
          if (!$disciplineFound) {
          ?>
              <tr>
                <td class="da-td">Discipline</td>
                <td class="da-td">-</td>
                <td class="da-td">-</td>
              </tr>
          <?php } ?>
        </table>
      </td>
      <td width="4">&nbsp;</td> -->
      <td width="48%" valign="top">
        <table width="100%" border="0" cellpadding="0" cellspacing="0"
               style="border: 1.5pt solid #008080;">
          <tr><td class="da-title" colspan="4">ATTENDANCE</td></tr>
          <tr>
            <th class="da-th"></th>
            <th class="da-th">Term - 1</th>
            <th class="da-th">Term - 2</th>
            <th class="da-th">Total</th>
          </tr>
          <tr>
            <td class="da-td">Attendance</td>
            <td class="da-td"><?= $term1_present ?> / <?= $term1_total ?></td>
            <td class="da-td"><?= $term2_present ?> / <?= $term2_total ?></td>
            <td class="da-td"><?= ($term1_present+$term2_present)?> / <?= ($term1_total+$term2_total) ?></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>

  <div class="grading-title">Instructions</div>
  <div class="grading-sub">Grading Scale for Scholastic Areas : Grades are awarded on a 8 point grading scale as follows</div>
  <table width="100%" border="0" cellpadding="0" cellspacing="4"
         style="margin-bottom:4pt;">
    <tr>
      <td width="48%" valign="top">
        <table width="100%" border="0" cellpadding="0" cellspacing="0"
               style="border: 1.5pt solid #008080;">
          <tr>
            <th class="grading-th">Marks Range</th>
            <th class="grading-th">Grade</th>
          </tr>
          <tr><td class="grading-td grading-td-odd">91 – 100</td><td class="grading-td grading-td-odd">A1</td></tr>
          <tr><td class="grading-td grading-td-even">81 – 90</td><td class="grading-td grading-td-even">A2</td></tr>
          <tr><td class="grading-td grading-td-odd">71 – 80</td><td class="grading-td grading-td-odd">B1</td></tr>
          <tr><td class="grading-td grading-td-even">61 – 70</td><td class="grading-td grading-td-even">B2</td></tr>
        </table>
      </td>
      <td width="4">&nbsp;</td>
      <td width="48%" valign="top">
        <table width="100%" border="0" cellpadding="0" cellspacing="0"
               style="border: 1.5pt solid #008080;">
          <tr>
            <th class="grading-th">Marks Range</th>
            <th class="grading-th">Grade</th>
          </tr>
          <tr><td class="grading-td grading-td-odd">51 – 60</td><td class="grading-td grading-td-odd">C1</td></tr>
          <tr><td class="grading-td grading-td-even">41 – 50</td><td class="grading-td grading-td-even">C2</td></tr>
          <tr><td class="grading-td grading-td-odd">33 – 40</td><td class="grading-td grading-td-odd">D</td></tr>
          <tr><td class="grading-td grading-td-even">32 &amp; Below</td><td class="grading-td grading-td-even">E (Needs Improvement)</td></tr>
        </table>
      </td>
    </tr>
  </table>

  <table width="100%" border="0" cellpadding="3" cellspacing="0"
         style="border: 0.5pt solid #009999; background:#f0fafa; margin-bottom:3pt;">
    <tr>
      <td style="font-size:8.5pt; font-weight:bold; width:50%;">
        Class Teacher's Remarks :
        <span class="remarks-val">
        <?php
      // 1. Decide which grade to base the remark on (Prioritize Term 2, fallback to Term 1)
      $overallGradeForRemark = $term2GradeLabel ? $term2GradeLabel : $term1GradeLabel;
      $finalRemark = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; // Default blank line
        $term1Totalper = rtrim($term1Totalper, '%');
        $term2Totalper = rtrim($term2Totalper, '%');
        if(is_numeric($term1Totalper) && is_numeric($term2Totalper)) {
            $overallPercentage = ($term1Totalper + $term2Totalper) / 2;
            if ($overallPercentage >= 91) {
                $finalRemark = "&nbsp;Excellent&nbsp;";
            } elseif ($overallPercentage >= 81) {
                $finalRemark = "&nbsp;Very Good&nbsp;";
            } elseif ($overallPercentage >= 71) {
                $finalRemark = "&nbsp;Good&nbsp;";
            } elseif ($overallPercentage >= 61) {
                $finalRemark = "&nbsp;Average&nbsp;";
            } else {
                $finalRemark = " Needs Improvement";
            }
        }
      // 2. Assign the remark based on the grade
    //   switch (strtoupper(trim($overallGradeForRemark))) {
    //       case 'A1':
    //       case 'A2':
    //       case 'A-1':
    //       case 'A-2':
    //           $finalRemark = "&nbsp;Excellent&nbsp;";
    //           break;
    //       case 'B1':
    //       case 'B-1':
    //           $finalRemark = "&nbsp;Very Good&nbsp;";
    //           break;
    //       case 'B2':
    //       case 'C1': 
    //       case 'C2':
    //       case 'B-2':
    //       case 'C-1': 
    //       case 'C-2':
    //           $finalRemark = "&nbsp;Good&nbsp;";
    //           break;
    //       case 'D':
    //           $finalRemark = "&nbsp;Average&nbsp;";
    //           break;
    //       case 'E':
    //       case 'E-2':
    //           $finalRemark = " Needs Improvement";
    //           break;
    //   }
  ?>
          <?=  $finalRemark ?>
        </span>
      </td>
      <td style="font-size:8.5pt; font-weight:bold; width:25%; text-align:center;">
        Attendance :
        <span class="remarks-val">&nbsp;<?= $attendancePct ?>&nbsp;</span>
      </td>
      <td style="font-size:8.5pt; font-weight:bold; width:25%; text-align:right;">
        Result :
        <span class="remarks-val">&nbsp;Pass&nbsp;</span>
      </td>
    </tr>
  </table>

  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td class="issue-reopen">
        Term-1 Result Date : <?= date('d-m-Y', strtotime($resultdate->termonedate)) ?>
      </td>
      <td class="issue-reopen" align="center">
        Term-2 Result Date : <?= date('d-m-Y', strtotime($resultdate->termtwodate)) ?>
      </td>
      <td class="issue-reopen" align="right">
        School Reopen On : <?= date('d-m-Y', strtotime($resultdate->school_opening_date)) ?>
      </td>
    </tr>
  </table>

  <div class="teal-divider"></div>

  <table width="100%" border="0" cellpadding="0" cellspacing="0"
         style="margin-top:10pt;margin-bottom:50pt; border-top: 1.5pt solid #008080; padding-top:4pt;">
    <tr>
      <td width="33%" align="center" class="sig-line-top"><br/><br/><br/>Class Teacher</td>
      <td width="33%" align="center" class="sig-line-top"><img src="./assets/6.jpg" width="14%"/><br/>Principal</td>
      <td width="33%" align="center" class="sig-line-top"><br/><br/><br/>Parent / Guardian</td>
    </tr>
  </table>

</td></tr>
</table></td></tr>
</table><?php
    } // end foreach students
} else { ?>
    <p style="text-align:center; padding:20pt; color:#666;">
        <?= $this->lang->line('progresscardreport_data_not_found') ?>
    </p>
<?php } ?>

</body>
</html>