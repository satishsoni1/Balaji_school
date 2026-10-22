<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
<?php if (customCompute($idcards)) { ?>
    <div class="idcardreport">
        <?php foreach($idcards as $idcard) { 
        if($type == 1) { ?>
            <div class="idcardreport-frontend" style="height:290px;<?=($background == 1) ? "background-image:url(".base_url('uploads/default/STUDINTDESIGN.JPG').") !important" : '' ?>">
               
            <table style="width:100%">
                                        <tr><td style="height:48px" colspan=2>&nbsp;</td></tr>
                                        <tr><td style="width: 27%; padding-top: 4%; vertical-align: top;"><img src="<?=imagelink($idcard->photo)?>" alt=""></td><td>

                
                
                    <div class="idcardreport-info"  style="padding-left: 33px;padding-top:4px;">
                        <div class="jtextfill" style="height:18px;">
                            <span><?=$idcard->srname?></span>
                        </div>
                        <div class="jtextfill"  style="height:17px;">
                            <span><?=$idcard->srregisterNO?></span>
                        </div>
                        <div class="jtextfill "  style="height:15px;">
                            <span><?= date('d M Y',strtotime($idcard->dob)) ?></span>
                        </div>
                        <div class="jtextfill"  style="height:15px;">
                            <span><?=$idcard->phone?></span>
                        </div>
                        <div class="jtextfill"  style="height:30px;">
                            <span><?=$idcard->address?></span>
                        </div>
                    </div>
                    </td></tr>
                                    </table>
            </div>
        <?php } elseif($type = 2) { 
                if($usertypeID == 1) {
                    $filename = $idcard->usertypeID.'-'.$idcard->systemadminID;
                    $text = $this->lang->line('idcardreport_type')." : ".'1'.',';
                    $text .= $this->lang->line('idcardreport_id')." : ".$idcard->systemadminID;
                } elseif($usertypeID == 2) {
                    $filename = $idcard->usertypeID.'-'.$idcard->teacherID;
                    $text = $this->lang->line('idcardreport_type')." : ".'2'.',';
                    $text .= $this->lang->line('idcardreport_id')." : ".$idcard->teacherID.',';
                } elseif($usertypeID == 3) {
                    $filename = $idcard->usertypeID.'-'.$idcard->studentID;
                    $text = $this->lang->line('idcardreport_type')." : ".'3'.',';
                    $text .= $this->lang->line('idcardreport_id')." : ".$idcard->srstudentID;
                } elseif($usertypeID == 4) {
                    $filename = $idcard->usertypeID.'-'.$idcard->parentsID;
                    $text = "invalid";
                } else {
                    $filename = $idcard->usertypeID.'-'.$idcard->userID;
                    $text = $this->lang->line('idcardreport_type')." : ".$idcard->usertypeID.',';
                    $text .= $this->lang->line('idcardreport_id')." : ".$idcard->userID;
                }

                $filepath = FCPATH.'uploads/idQRcode/'.$filename.'.png';
                if(!file_exists($filepath)) {
                    generate_qrcode($text,$filename);
                }
            ?>
            <div class="idcardreport-backend" style="height:290px;<?=($background == 1) ? "background-image:url(".base_url('uploads/default/idcard-border.png').") !important" : '' ?>">
                <h3><?=$this->lang->line('idcardreport_valid_up')?> <?=date('F Y',strtotime($schoolyear->endingdate))?></h3>
                <h4><?=$this->lang->line('idcardreport_please_return')?> : </h4>
                <p><?=$siteinfos->sname?></p>
                <div class="idcardreport-schooladdress">
                    <?=$siteinfos->address?>
                </div>
                <div class="idcardreport-bottom">
                    <div class="idcardreport-qrcode">
                        <img style="width:90px;height: 80px; padding-top: 12px" src="<?=base_url('uploads/idQRcode/'.$filename.'.png')?>" alt="">
                    </div>
                    <div class="idcardreport-session">
                        <span><?=$this->lang->line('idcardreport_session')?>: <?=$schoolyear->schoolyear?></span>
                    </div>
                </div>
            </div>
        <?php } } ?>
    </div>
<?php } ?>
</body>
</html>