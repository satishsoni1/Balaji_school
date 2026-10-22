<!DOCTYPE html>
<html>

<head></head>

<body>
    <table width="100%" style="border: 2px solid #000;">
        <tbody>
            <tr>
                <td style="text-align: center;">
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
                                <td width="200px">ORIGINAL</td>
                                <td colspan=2 class="pull-right" style="padding-right: 10rem;">CERTIFICATE NO:</td>
                            </tr>
                        <tr>
                                <td width="200px">GENERAL REGISTER NUMBER</td>
                                <td colspan=2><?= $student->registerNo ?></td>
                            </tr>
                        <tr>
                                <td width="200px">STUDENT ID NO</td>
                                <td colspan=2><?= $student->student_id ?></td>
                            </tr>
                            <tr>
                                <td width="200px">UID NO (AADHAR NO)</td>
                                <td colspan=2><?= $parents->aadhar_card ?></td>
                            </tr>
                            <tr>
                                <td width="200px">NAME OF STUDENT IN FULL</td>
                                <td colspan=2><?= $student->srname ?></td>
                            </tr>
                            <tr>
                                <td width="200px">MOTHER's NAME</td>
                                <td colspan=2><?= $parents->mother_name ?></td>
                            </tr>
                            <tr>
                                <td width="200px">NATIONLITY</td>
                                <td colspan=2>INDIAN</td>
                            </tr>
                            <tr>
                                <td width="200px">MOTHER TONGUE</td>
                                <td colspan=2><?= $student->mother_tongue ?></td>
                            </tr>
                            <tr>
                                <td width="200px">RELIGION</td>
                                <td colspan=2><?= $student->student_religion ?></td>
                            </tr>
                            <tr>
                                <td width="200px">Caste & Sub Caste</td>
                                <td colspan=2><?= $student->caste ?> <?= isset($student->subcaste) ? "& " . $student->subcaste : '' ?></td>
                            </tr>
                            <tr>
                                <td width="200px">PLACE OF BIRTH</td>
                                <td><?= $student->birth_place ?></td>
                                <td>TALUKA <?= $student->birth_city ?></td>
                            </tr>
                            <tr>
                                <td width="200px"></td>
                                <td>DISTRICT: <?= $student->district ?></td>
                                <td>STATE: <?= $student->state ?></td>
                            </tr>
                            <tr>
                                <td width="200px"></td>
                                <td colspan=2>COUNTRY: <?= $student->country ?></td>
                            </tr>
                            <tr>
                                <td>DATE OF BIRTH (IN FIGURES)</td>
                                <td colspan=2><?= date('d-m-Y', strtotime($student->dob)) ?></td>
                            </tr>
                            <tr>
                                <td width="200px">DATE OF BIRTH (IN WORDS)</td>
                                <td colspan=2><?= dobinword($student->dob) ?></td>
                            </tr>
                            <tr>
                                <td width="200px">LAST SCHOOL ATTENDED</td>
                                <td colspan=2><?= $student->last_school ?></td>
                            </tr>
                            <tr>
                                <td width="200px">STANDRED IN WHICH ADMISSION</td>
                                <td colspan=2><?= $student->class ?></td>
                            </tr>
                            <tr>
                                <td width="200px">DATE OF ADMISSION</td>
                                <td colspan=2><?= date('d-m-Y', strtotime($student->admission_date)) ?></td>
                            </tr>
                            <tr>
                                <td width="200px">PROGRESS</td>
                                <td colspan=2>Good</td>
                            </tr>
                            <tr>
                                <td width="200px">CONDUCT</td>
                                <td colspan=2>Good</td>
                            </tr>
                            <tr>
                                <td width="200px">DATE OF LEAVING SCHOOL</td>
                                <td colspan=2><? date('d-m-Y') ?></td>
                            </tr>
                            <tr>
                                <td width="200px">STANDRED IN WHICH STUDYING AND SINCE WHEN</td>
                                <td colspan=2><?= $student->class ?> <?= date('d-m-Y', strtotime($student->admission_date)) ?></td>
                            </tr>
                            <tr>
                                <td width="200px">REASON OF LEAVING</td>
                                <td colspan=2>Parent request</td>
                            </tr>
                            <tr>
                                <td width="200px">REMARKS</td>
                                <td colspan=2>OK</td>
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
                                <td class="pull-center"><b>Class teacher</b></td>
                                <td class="pull-center"><b>Clerk</b></td>
                                <td class="pull-center"><b>HM / Principal</b></td>
                            </tr>


                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>