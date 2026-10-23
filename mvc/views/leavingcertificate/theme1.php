<!DOCTYPE html>
<html>

<head>
    
</head>

<body>
    <table width="100%" style="border: 2px solid #000;">
        <tbody>
            <tr>
                <td style="text-align: center;font-size: 85px;">
                    <?= $top_heading_title ?>
                </td>
            </tr>
            <tr>
                <td style="text-align: left;">
                    <?= $top_heading_middle ?>
                </td>
            </tr>
            <tr>
                <td style="border-bottom: 1px solid #ddd;font-weight: bold;font-size: 18px;text-align:center">
                LEAVING CERTIFICATE
                </td>
            </tr>
            <tr style="border-top: 1px #ddd solid;">
                <td style="border-top: 1px #ddd solid;"><b>Note:- No change in any entry in this certificate shall be made except by the authority issuing it and any infringement of this requirement is liable to invoice the imposition of penalty such as the rustication.</b></td>
            </tr>
            <tr>
                <td>
                    <table width="100%" class="table table-bordered">
                        <tbody>
                        <tr>
                                <td width="250px">ORIGINAL</td>
                                <td colspan=2 class="pull-right">CERTIFICATE NO: <?= $student->lc_no ?></td>
                            </tr>
                        <tr>
                                <td width="250px">GENERAL REGISTER NUMBER</td>
                                <td colspan=2><?= $student->registerNO ?></td>
                            </tr>
                        <tr>
                                <td width="250px">PEN NO</td>
                                <td colspan=2><?= isset($student->pen_no) ? htmlspecialchars($student->pen_no) : '' ?></td>
                            </tr>
                            <tr>
                                <td width="250px">UID NO (AADHAR NO)</td>
                                <td colspan=2><?= $student->aadhar_card ?></td>
                            </tr>
                            <tr>
                                <td width="250px">NAME OF STUDENT IN FULL</td>
                                <td colspan=2><?= $student->srname ?></td>
                            </tr>
                            <tr>
                                <td width="250px">MOTHER's NAME</td>
                                <td colspan=2><?= $parents->mother_name ?></td>
                            </tr>
                            <tr>
                                <td width="250px">NATIONLITY</td>
                                <td colspan=2>INDIAN</td>
                            </tr>
                            <tr>
                                <td width="250px">MOTHER TONGUE</td>
                                <td colspan=2><?= $student->mother_tongue ?></td>
                            </tr>
                            <tr>
                                <td width="250px">RELIGION</td>
                                <td colspan=2><?= $student->religion ?></td>
                            </tr>
                            <tr>
                                <td width="250px">CASTE & SUB CASTE</td>
                                <td colspan=2><?= $student->caste ?> <?= isset($student->subcaste) && ($student->subcaste != "") ? "& " . $student->subcaste : '' ?></td>
                            </tr>
                            <tr>
                                <td width="250px">PLACE OF BIRTH</td>
                                <td><?= $student->birth_place ?></td>
                                <td>TALUKA <?= $student->birth_taluka ?></td>
                            </tr>
                            <tr>
                                <td width="250px"></td>
                                <td>DISTRICT: <?= $student->birth_district ?></td>
                                <td>STATE: <?= $student->state ?></td>
                            </tr>
                            <tr>
                                <td width="250px"></td>
                                <td colspan=2>COUNTRY: <?= $student->country ?></td>
                            </tr>
                            <tr>
                                <td>DATE OF BIRTH (IN FIGURES)</td>
                                <td colspan=2><?= date('d-m-Y', strtotime($student->dob)) ?></td>
                            </tr>
                            <tr>
                                <td width="250px">DATE OF BIRTH (IN WORDS)</td>
                                <td colspan=2><?= dobinword($student->dob) ?></td>
                            </tr>
                            <tr>
                                <td width="250px">LAST SCHOOL ATTENDED</td>
                                <td colspan=2><?= $student->last_school_attendant ?></td>
                            </tr>
                            <tr>
                                <td width="250px">STANDRED IN WHICH ADMISSION</td>
                                <td colspan=2><?= $student->standred_in_which_admission ?></td>
                            </tr>
                            <tr>
                                <td width="250px">DATE OF ADMISSION</td>
                                <td colspan=2><?= ($student->date_of_admission && $student->date_of_admission!=null)?date('d-m-Y', strtotime($student->date_of_admission)):"" ?></td>
                            </tr>
                            <tr>
                                <td width="250px">PROGRESS</td>
                                <td colspan=2><?= $student->progress ?></td>
                            </tr>
                            <tr>
                                <td width="250px">CONDUCT</td>
                                <td colspan=2><?= $student->conduct ?></td>
                            </tr>
                            <tr>
                                <td width="250px">DATE OF LEAVING SCHOOL</td>
                                <td colspan=2><?= date('d-m-Y', strtotime($student->date_of_leaving_school)) ?></td>
                            </tr>
                            <tr>
                                <td width="250px">STANDRED IN WHICH STUDYING AND SINCE WHEN</td>
                                <td colspan=2><?= $student->standred_in_which_studing ?> <?= ($student->since_when != "-" && $student->since_when && $student->since_when!=null)?" AND ".date('d-m-Y', strtotime($student->since_when)):"" ?></td>
                            </tr>
                            <tr>
                                <td width="250px">REASON OF LEAVING</td>
                                <td colspan=2><?= $student->reason_of_leaving ?></td>
                            </tr>
                            <tr>
                                <td width="250px">REMARKS</td>
                                <td colspan=2><?= $student->certificate_remarks ?></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="pull-left" colspan=3>Certified that all the above information is according to General Register No 1 & as per previous school record.</td>
            </tr>
            <tr>
                <td colspan=3><b>Date : <?= date('d-m-Y') ?></b></td>
            </tr>
            <tr>
                <td colspan=3>&nbsp;</td>
            </tr>
            <tr>
                <td colspan=3>
                    <table width="100%">
                        <tbody>
                            <tr>
                                <!-- <td class="pull-center"><b>Class teacher</b></td> -->
                                <td class="pull-left"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Clerk</b></td>
                                <td class="pull-center"><b></b></td>
                                <td class="pull-right"><b>HM / Principal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                            </tr>


                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>