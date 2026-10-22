<!DOCTYPE html>
<html>

<head>
</head>

<body>

    <table width="100%" class="testimonial">
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td rowspan="5">
                            <img width="200px" src="<?= base_url('uploads/images/' . $siteinfos->photo) ?>"></span>
                        </td>
                        <td class="center-text f-10">Shri Balaji Yuvak Krida Mandal, Wadegaon (Reg. No. F2451)
                        </td>
                        <td rowspan="5">
                            <?= studentimage($student->photo) ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="center-text f-20">
                            <b>Shri Balaji English Primary & Secondary School, Wadegaon</b>
                        </td>
                    </tr>
                    <tr>
                        <td class="center-text  f-10">
                            Tq. Balapur, Dist.Akola Pin Code - 444502
                        </td>
                    </tr>
                    <tr>
                            <td class="center-text  f-10">
                                Register No - शा. सा. आदेश .नमाशा -1004 / (407/04) दि. 21/07/2004
                            </td>
                        </tr>
                        <tr>
                            <td class="center-text  f-10">
                                Udise No - 27050308508 / 27050308509
                            </td>
                        </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%">
                    <tbody>
                        
                        
                        <tr>
                            <td class="left-text  f-10">
                                Office Mob No - 7058262082 , 9763757391 (H .M )
                            </td>
                            <td class="right-text f-10">Board - Amravati</td>
                        </tr>
                        <tr>
                            <td class="left-text f-10">Email - balajiconvent95@gmail.com</td>
                            <td class="right-text f-10">Medium - English</td>
                        </tr>
                        <tr>
                            <td class="left-text f-10" colspan="2">School Permission No. : V.L.S.-1004 (532/04) 12-08-2004</td>
                            
                        </tr>
                        
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td class="pull-center">
                <?= $main_middle_text ?>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%">
                    <tbody>
                        <tr>
                            <td>Certificate No : <?= $certificate_no ?></td>
                            <td class="right_text">Regd.No : <?= $student->registerNO ?> </td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This is to certify that <b><?= $student->name ?> - <?= $parents->mother_name ?></b> is a bonafide student of our school, studying in <b><?=customCompute($class) ? $class->classes : ''?></b> (Year : <b><?= $schoolyears->schoolyear ?></b>). His birthdate as recorded in our General Register is <b><?= ($student->dob && $student->dob!=null)?date('d-m-Y',strtotime($student->dob)):"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ?></b> (in words <?= dobinword($student->dob) ?>) his/ her birth place is <b><?= $student->birth_place ?></b> and belongs to <b><?= $student->caste ?></b> caste. To the best of my knowledge,He/She bears a good moral character as well as He/She has shown good progress.</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%">
                    <!-- <tr>
                        <td>
                        Reason : <b>Other</b>
                        </td>
                    </tr> -->
                    <tr>
                        <td>
                        <table width="100%"><tr><td class="pull-left">
                        <b>Place : WADEGAON</b>
                        </td></tr></table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <table width="100%"><tr><td class="pull-left"><b>DATE : <?= date('d M Y') ?></b></td><td class="pull-center"><b>CLERK'S SIGN</b></td><td class="pull-right"><b>PRINCIPAL'S SIGN</b></td></tr></table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    
    

</body>

</html>