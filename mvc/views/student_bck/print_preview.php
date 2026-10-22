<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
</head>
<body>


  <table  width="100%" style="border: 2px solid #000;">
	<tbody>
		<tr>
			<td colspan="4" style="text-align: center;" >
				<table width="100%">
					<tbody>
						<tr>
							<td rowspan="2">
                <img style="width:10%" src="<?= base_url('uploads/images/' . $siteinfos->photo) ?>" alt="">
            </td>
							<td style="font-size: 21px;"><b><i><?= schoolname($class->classesID) ?></i></b></td>
						</tr>
						<tr>
							<td style="font-size: 20px;"><b><i>Admission Form <?= $schoolyears->schoolyear ?></b></i></td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="4" style="border: 2px solid #000;border-left:none;border-right:none">
				<table width="100%">
					<tbody>
						<tr>
							<td style="text-align: center;" class="high_text" colspan="4">For Office Use Only</td>
						</tr>
						<tr>
							<td class="high_text">Admitted to class </td>
							<td  class="high_text">:-&nbsp;&nbsp;&nbsp; <?=customCompute($class) ? $class->classes : ''?></td>
							<td>On Date </td>
							<td>:-&nbsp;&nbsp;&nbsp; <?php if($student->dob) { echo date("d-m-Y", strtotime($student->admission_date)); } ?></td>
						</tr>
						<tr>
							<td>Register No. </td>
							<td>:-&nbsp;&nbsp;&nbsp; <?=$student->srregisterNO?></td>
							<td>Admission Type </td>
							<td>:-&nbsp;&nbsp;&nbsp; <?=$student->student_type?></td>
						</tr>
						<tr>
							<td>Students ID </td>
							<td>:-&nbsp;&nbsp;&nbsp; <?=$student->student_id?></td>
							<td>Aadhar Card No </td>
							<td>:-&nbsp;&nbsp;&nbsp; <?=$student->aadhar_card?></td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td>1 ) Student&rsquo;s Name </td>
			<td colspan=2>:-&nbsp;&nbsp;&nbsp; <?=$student->srname?></td>
			<td rowspan="5">
			<?= studentimageinform($student->photo) ?></td>
		</tr>
		<tr>
			<td>2 ) Father&rsquo;s Name </td>
			<td  colspan=2>:-&nbsp;&nbsp;&nbsp; <?=$parents->father_name?></td>
		</tr>
		<tr>
			<td>3 ) Surname </td>
			<td  colspan=2>:-&nbsp;&nbsp;&nbsp; <?= strrchr($student->name, ' ') ?></td>
		</tr>
		<tr>
			<td>4 ) Mother&rsquo;s Name </td>
			<td  colspan=2>:-&nbsp;&nbsp;&nbsp;<?=$parents->mother_name?></td>
		</tr>
		<tr>
			<td>5 ) Gender </td>
			<td  colspan=2>:-&nbsp;&nbsp;&nbsp; <?=$student->sex?></td>
		</tr>
		<tr>
			<td>6 ) Date of Birth </td>
			<td colspan=3>:-&nbsp;&nbsp;&nbsp; <?php if($student->dob) { echo date("d-m-Y", strtotime($student->dob)); } ?></td>
		</tr>
		<tr>
			<td>7 ) Place of Birth </td>
			<td>:-&nbsp;&nbsp;&nbsp; <?=$student->birth_place?></td>
			<td>Tq. <?=$student->birth_taluka?></td>
			<td>Dist. <?=$student->birth_district?></td>
		</tr>
    <!-- <tr>
							<td style="text-align: center;" colspan="4">&nbsp;</td>
						</tr> -->
		<tr>
			<td colspan="4" style="text-align: center;" class="high_text" >( Admission Information )</td>
		</tr>
		<tr>
			<td style="text-align: center;" class="high_text" >Standard </td>
			<td class="high_text">:-&nbsp;&nbsp;&nbsp; <?=$class->classes?></td>
			<td style="text-align: center;" class="high_text" >Academic Year </td>
			<td class="high_text">:-&nbsp;&nbsp;&nbsp; <?= $schoolyears->schoolyear ?></td>
		</tr>
		<tr>
			<td style="text-align: center;" >Section </td>
			<td>:-&nbsp;&nbsp;&nbsp; <?=$section->section?></td>
			<td style="text-align: center;" >Admission Date </td>
			<td>:-&nbsp;&nbsp;&nbsp; <?php if($student->admission_date) { echo date("d-m-Y", strtotime($student->admission_date)); } ?></td>
		</tr>
		<tr>
			<td>8) Nationality </td>
			<td>:-&nbsp;&nbsp;&nbsp; INDIAN</td>
			<td>Rashan Card </td>
			<td>:-&nbsp;&nbsp;&nbsp; <?= $student->rashan_card ?></td>
		</tr>
		<tr>
			<td>9) Category </td>
			<td>:-&nbsp;&nbsp;&nbsp; <?=$student->category?></td>
			<td>Caste </td>
			<td>:-&nbsp;&nbsp;&nbsp; <?=$student->caste?></td>
		</tr>
		<tr>
			<td>10 ) Religion </td>
			<td>:-&nbsp;&nbsp;&nbsp; <?=$student->religion?></td>
			<td>Mobile No </td>
			<td>:-&nbsp;&nbsp;&nbsp; <?=$student->phone?></td>
		</tr>
		<tr>
			<td>11 ) Permanent Address </td>
			<td  colspan=3>:-&nbsp;&nbsp;&nbsp; <?=$student->address?></td>
		</tr>
		<tr>
			<td>12 ) Mother Tongue </td>
			<td  colspan=3>:-&nbsp;&nbsp;&nbsp; <?=$student->mother_tongue?></td>
		</tr>
		<tr>
			<td width="35%">13 ) Birth Certificate No. </td>
			<td  colspan=3>:-&nbsp;&nbsp;&nbsp; <?=$student->birth_certificate_no?></td>
		</tr>
    <tr>
							<td style="text-align: center;" colspan="4">&nbsp;</td>
						</tr>
		<tr>
			<td colspan="4" style="text-align: center;" class="high_text">( Previous School Information )</td>
		</tr>
		<tr>
			<td>14 ) School Name </td>
			<td  colspan=3>:-&nbsp;&nbsp;&nbsp; <?=$student->last_school_attendant?></td>
		</tr>
		<tr>
			<td>15 ) Last School Address </td>
			<td  colspan=3>:-&nbsp;&nbsp;&nbsp; <?=$student->last_school_attendant_address?></td>
		</tr>
		<tr>
			<td>16 ) Last Class</td>
			<td colspan=3>:-&nbsp;&nbsp;&nbsp; <?=customCompute($classes) ? $classes[$student->last_class] : ''?></td>
		</tr>
		<!-- <tr>
			<td>16 ) Reason School </td>
			<td colspan=3>:-&nbsp;&nbsp;&nbsp; <?=$student->reason?></td>
		</tr> -->
		
		
    <tr>
							<td style="text-align: center;" colspan="4">&nbsp;</td>
						</tr>
		<tr>
			<td colspan="4" style="text-align: center;" class="high_text" >( Parent&rsquo;s Information )</td>
		</tr>
		<tr>
			<td>17 ) Father Full Name </td>
			<td  colspan=3>:-&nbsp;&nbsp;&nbsp; <?=$parents->father_name?></td>
		</tr>
		<tr>
			<td>18 ) Qualification </td>
			<td  colspan=3>:-&nbsp;&nbsp;&nbsp; <?=$parents->father_education?></td>
		</tr>
		<tr>
			<td>19) Occupation </td>
			<td  colspan=3>:-&nbsp;&nbsp;&nbsp; <?=$parents->father_profession?></td>
		</tr>
    <tr>
							<td style="text-align: center;" colspan="4">&nbsp;</td>
						</tr>
</table>
<table  width="100%" style="border: 2px solid #000;">
<tbody>
		<tr>
			<td colspan="4" style="text-align: center;" class="high_text">( Mother&rsquo;s Information )</td>
		</tr>
		<tr>
			<td>20 ) Mother Full Name </td>
			<td  colspan=3>:-&nbsp;&nbsp;&nbsp; <?=$parents->mother_name?></td>
		</tr>
		<tr>
			<td>21 ) Qualification </td>
			<td  colspan=3>:-&nbsp;&nbsp;&nbsp; <?=$parents->mother_education?></td>
		</tr>
		<tr>
			<td>22 ) Occupation </td>
			<td  colspan=3>:-&nbsp;&nbsp;&nbsp; <?=$parents->mother_profession?></td>
		</tr>
		<tr>
			<td>23 ) Mother Mobile No </td>
			<td  colspan=3>:-&nbsp;&nbsp;&nbsp; <?=$parents->mother_phone_no?></td>
		</tr>
		<tr>
			<td colspan="4">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="4" style="text-align: right;"><b>Father&rsquo;s / Parent&rsquo;s Signature</b></td>
		</tr>
    <tr>
							<td style="text-align: center;" colspan="4">&nbsp;</td>
						</tr>
		<tr>
			<td colspan="4"><b><i>Undertaking :-&nbsp;&nbsp;&nbsp;</i></b></td>
		</tr>
		<tr>
			<td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I , as a parent / Guardian am fully aware that <b><?= schoolname($class->classesID) ?></b> is an unaided school , therefore , I hereby agree to pay the school fees as and when it is raised by the Management and I shall abide by the rules and regulations of the school .</td>
		</tr>
    <tr>
							<td style="text-align: center;" colspan="4">&nbsp;</td>
						</tr>
		<tr>
			<td colspan="4"><b><i>Place :-&nbsp;&nbsp;&nbsp; Wadegaon</i></b></td>
		</tr>
		<tr>
			<td colspan="3"><i><b>Date :-&nbsp;&nbsp;&nbsp; <?= date('d-M-Y') ?></b></i></td>
			<td class="pull-right"><i><b>Principal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></i></td>
		</tr>
	</tbody>
</table>
</body>
</html>