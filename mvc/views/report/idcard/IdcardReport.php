<div class="row">
    <div class="col-sm-12" style="margin:10px 0px">
        <?php
            $pdf_preview_uri = base_url('idcardreport/pdf/'.$usertypeID.'/'.$classesID.'/'.$sectionID.'/'.$userID.'/'.$type.'/'.$background);
            echo btn_printReport('idcardreport', $this->lang->line('idcardreport_print'), 'printablediv');
            // echo btn_pdfPreviewReport('idcardreport',$pdf_preview_uri, $this->lang->line('idcardreport_pdf_preview'));
            // echo btn_sentToMailReport('idcardreport', $this->lang->line('idcardreport_mail'));
        ?>
    </div>
</div>
<div class="box">
    <div class="box-header bg-gray">
        <h3 class="box-title text-navy"><i class="fa fa-clipboard"></i> 
            <?=$this->lang->line('idcardreport_report_for')?> -
            <?=isset($usertypes[$usertypeID]) ? $usertypes[$usertypeID]: ' ';?>
        </h3>
    </div><!-- /.box-header -->
    <div id="printablediv">
        <style>
            .idcardreport {
                font-family: arial;    
                max-width:794px;
                max-height: 1123px;
                margin-left: auto;
                margin-right: auto;
                -webkit-print-color-adjust: exact;
            }
            /*IDcard Front Part Css Code*/
            .idcardreport-frontend{
                margin: 3px;
                float: left;
                border: 1px solid #000;
                padding: 10px;
                
                text-align: center;
                
                <?php if($background == 1) { ?>
                    <?php if($usertypeID == 3) { ?>
                        height:156px;
                        width: 250px;
                        background:url("<?=base_url('uploads/default/STUDINTDESIGN.JPG')?>")!important;
                    <?php } ?>
                    <?php if($usertypeID == 2) { ?>
                        height:455px;
                        width: 285px;
                        background:url("<?=base_url('uploads/default/TEACHERDESIGN.JPG')?>")!important;
                    <?php } ?>
                background-size: 100% 100% !important;
                <?php } ?>
            }
            
            .idcardreport-frontend h3{
                font-size: 20px;
                color: #1A2229;
            }
            
            .idcardreport-frontend img{
                width:100%;
                height:100%;
                border: 1px solid #ddd;
                margin-bottom: 5px;
            }

            .idcardreport-frontend span{
                display: inline-table;
                text-align: left;
                font-size: 12px;
                margin-bottom: 0px;
                color: #1A2229;
            }

            /*ID Card Back Part Css Code*/
            .idcardreport-backend{
                margin: 3px;
                /*float: left;*/
                float: right;
                border: 1px solid #1A2229;
                padding: 10px;
                width: 257px;
                text-align: center;
                height:161px;
                <?php if($background == 1) { ?>
                background:url("<?=base_url('uploads/default/STUDINTDESIGN.JPG')?>")!important;
                background-size: 100% 100% !important;
                <?php } ?>
            }

            .idcardreport-backend h3{
                background-color: #1A2229;
                color: #fff;
                font-size: 13px;
                padding: 5px 0px;
                margin:5px;
                margin-top: 13px;
            }

            .idcardreport-backend h4{
                font-size: 11px;
                color: #1A2229;
                font-weight: bold;
                padding: 5px 0px;
            }

            .idcardreport-backend p{
                display: inline-table;
                font-size: 17px;
                color: #1A2229;
                font-weight: 500;
                line-height: 17px;
            }

            .idcardreport-schooladdress {
                color: #1A2229 !important;
                font-weight: 500;
            }

            .idcardreport-bottom {
                text-align: center;
                padding-top: 5px
            }

            .idcardreport-qrcode{
                float: left;
                width: 50%;
            }

            .idcardreport-qrcode img{
                width: 80px;
                height: 80px;
            }

            .idcardreport-session{
                float: right;
                width: 50%;
            }
            
            .idcardreport-session span{
                color: #1A2229;
                font-weight: bold;
                margin-top: 35px;
                overflow: hidden;
                float: left;
            }

            @media print {
                .idcardreport {
                    max-width:794px;
                    max-height: 1123px;
                    margin-left: auto;
                    margin-right: auto;
                    -webkit-print-color-adjust: exact;
                    margin:0px auto;    
                }

                /*ID Card Front Part Css Code*/
                .idcardreport-frontend{
                    margin: 1px;
                    float: left;
                    border: 1px solid #000;
                    padding: 10px;
                    width: 250px;
                }

                h3{
                    color: #1A2229 !important;
                }

                .idcardreport-frontend .profile-view-dis .profile-view-tab {
                    width: 100%;
                    display: inline-table;
                    float: left;
                    margin-bottom: 0px;
                    padding: 0 15px;
                    font-size: 14px;
                    margin-top: 5px;
                }

                /*ID Card Back Part Css Code*/
                .idcardreport-backend {
                    margin: 1px;
                    float: right;
                    border: 1px solid #1A2229;
                    padding: 10px;
                    width: 250px;
                }

                .idcardreport-backend h3{
                    background-color: #1A2229 !important;
                    font-size: 12px;
                    color: #fff !important;
                    overflow: hidden;
                    display: block;
                }
            }

            .idcardreport-frontend .profile-view-dis .profile-view-tab {
                display: inline-table;
                width: 100%;
                float: left;
                margin-bottom: 0px;
                padding: 0 15px;
                font-size: 14px;
                margin-top: 5px;
            }
            .jtextfill{
                text-align:left;
                width:100%;
                padding: 0 0 0 15px;
                height: 17px;
            }
            .jtextfill span{
                font-weight: bold;
            }
        </style>

        <div class="box-body" style="margin-bottom: 50px;">
            <div class="row">
                <div class="col-sm-12">
                    <?php if (customCompute($idcards)) { ?>
                    <table class="idcardreport">
                        <tr>
                            <?php $j= 0; $i=0; $c = customCompute($idcards); foreach($idcards as $idcard) {
                            //TYPE 1 == Front Part
                            //TYPE 2 == Back Part
                                if ($type == 1) {
                                    if ($usertypeID == 3) { ?>
                                <td class="idcardreport-frontend">
                                    <table style="width:100%">
                                        <tr><td style="height:45px" colspan=2>&nbsp;</td></tr>
                                        <tr><td style="width: 27%;height:86px; padding-top: 4%; vertical-align: top;"><img src="<?= imagelink($idcard->photo) ?>" alt=""></td><td>
                                            <div class="profile-view-dis" style="padding-left: 33px;padding-top:4px;">
                                        
                                            <div class="jtextfill" style="height:18px;">
                                                <span><?= $idcard->srname ?></span>
                                            </div>
                                            <div class="jtextfill"  style="height:17px;">
                                                <span><?= $idcard->srregisterNO ?></span>
                                            </div>
                                            <div class="jtextfill "  style="height:15px;">
                                                <span><?= date('d M Y', strtotime($idcard->dob)) ?></span>
                                            </div>
                                            <div class="jtextfill"  style="height:15px;">
                                                <span><?= $idcard->phone ?></span>
                                            </div>
                                            <div class="jtextfill"  style="height:30px;">
                                                <span><?= $idcard->address ?></span>
                                            </div>
                                            <!-- <div class="profile-view-tab">
                                                <p><?= isset($classes[$idcard->srclassesID]) ? $classes[$idcard->srclassesID] : '' ?></p>
                                            </div>
                                            <div class="profile-view-tab">
                                                <p><?= isset($sections[$idcard->srsectionID]) ? $sections[$idcard->srsectionID] : '' ?></p>
                                            </div>
                                            <div class="profile-view-tab">
                                                <p><?= $idcard->srroll ?></p>
                                            </div>
                                            <div class="profile-view-tab">
                                                <p><?= $idcard->bloodgroup ?></p>
                                            </div> -->
                                       
                                    </div></td></tr>
                                    </table>
                                    
                                    
                                </td>
                                <?php
                                $i++;
                                if ($i == 2) {
                                    $j++;
                                    $k = $c / 2;
                                    $k = ceil($k);
                                    if ($k == $j) {
                                        echo "";
                                    } else {
                                        echo "</tr><tr>";
                                    }
                                    $i = 0;
                                }
                                    } else if ($usertypeID == 2) { ?>
                                    <td class="idcardreport-frontend">
                                    <table style="width:97%">
                                        <tr><td style="height:12rem">&nbsp;</td></tr>
                                        <tr>
                                            <td style="display:flex;justify-content:center">
                                            <div  style="padding-top: 2%; vertical-align: top;width:39%;height:13.5rem;">
                                                <img src="<?= imagelink($idcard->photo) ?>" alt="">
                                            </div>
                                            </td>
                                    </tr>
                                        <tr>
                                            <td style="height:32px;">
                                            <div class="jtextfill" style="height:17px;text-align:center">
                                                <span><?= $idcard->name ?></span>
                                            </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            <div class="jtextfill"  style="height:23px;padding-left:8rem;">
                                                <span><?=$idcard->designation?></span>
                                            </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            <div class="jtextfill "  style="height:22px;padding-left:8rem;">
                                                <span><?= date('d M Y', strtotime($idcard->dob)) ?></span>
                                            </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            <div class="jtextfill"  style="height:39px;padding-left:8rem;">
                                                <span><?= $idcard->phone ?></span>
                                            </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            <div class="jtextfill"  style="height:45px;">
                                                <span><?= $idcard->address ?></span>
                                            </div>
                                          </td></tr>
                                    </table>
                                    
                                    
                                </td>
                                     <?php
                                     $i++;
                                     if ($i == 2) {
                                         $j++;
                                         $k = $c / 2;
                                         $k = ceil($k);
                                         if ($k == $j) {
                                             echo "";
                                         } else {
                                             echo "</tr><tr>";
                                         }
                                         $i = 0;
                                     }
                                    }
                                }else { $i++;?>
                                <?php 
                                    if($usertypeID == 1) {
                                        $filename = $idcard->usertypeID.'-'.$idcard->systemadminID;
                                        $text = $this->lang->line('idcardreport_type')." : ".'1'.',';
                                        $text.= $this->lang->line('idcardreport_id')." : ".$idcard->systemadminID;
                                    } elseif($usertypeID == 2) {
                                        $filename = $idcard->usertypeID.'-'.$idcard->teacherID;
                                        $text = $this->lang->line('idcardreport_type')." : ".'2'.',';
                                        $text.= $this->lang->line('idcardreport_id')." : ".$idcard->teacherID;
                                    } elseif($usertypeID == 3) {
                                        $filename = $idcard->usertypeID.'-'.$idcard->studentID;
                                        $text = $this->lang->line('idcardreport_type')." : ".'3'.',';
                                        $text.= $this->lang->line('idcardreport_id')." : ".$idcard->srstudentID;
                                    } elseif($usertypeID == 4) {
                                        $filename = $idcard->usertypeID.'-'.$idcard->parentsID;
                                        $text = "invalid";
                                    } else {
                                        $filename = $idcard->usertypeID.'-'.$idcard->userID;
                                        $text = $this->lang->line('idcardreport_type')." : ".$idcard->usertypeID.',';
                                        $text.= $this->lang->line('idcardreport_id')." : ".$idcard->userID;
                                    }

                                    $filepath = FCPATH.'uploads/idQRcode/'.$filename.'.png';
                                    if(!file_exists($filepath)) {
                                        generate_qrcode($text,$filename);
                                    }
                                ?>
                                <td class="idcardreport-backend">
                                    <h3><?=$this->lang->line('idcardreport_valid_up')?> <?=date('F Y',strtotime($schoolyear->endingdate))?></h3>
                                    <h4><?=$this->lang->line('idcardreport_please_return')?> : </h4>
                                    <p><?=$siteinfos->sname?></p>
                                    <div class="idcardreport-schooladdress">
                                        <?=$siteinfos->address?>
                                    </div>
                                    <div class="idcardreport-bottom">
                                        <div class="idcardreport-qrcode">
                                            <img src="<?=base_url('uploads/idQRcode/'.$filename.'.png')?>" alt="">
                                        </div>
                                        <div class="idcardreport-session">
                                            <span><?=$this->lang->line('idcardreport_session')?> : <?=$schoolyear->schoolyear?></span>
                                        </div>
                                    </div>
                                </td>
                            <?php } } ?>
                        </tr>
                    </table>
                    <?php } else { ?>   
                        <div class="callout callout-danger">
                            <p><b class="text-info"><?=$this->lang->line('idcardreport_data_not_found')?></b></p>
                        </div>
                    <?php } ?>
                </div>
            </div><!-- row -->
        </div><!-- Body -->
    </div>
</div>


<!-- email modal starts here -->
<form class="form-horizontal" role="form" action="<?=base_url('idcardreport/send_pdf_to_mail');?>" method="post">
    <div class="modal fade" id="mail">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?=$this->lang->line('idcardreport_close')?></span></button>
                <h4 class="modal-title"><?=$this->lang->line('idcardreport_mail')?></h4>
            </div>
            <div class="modal-body">

                <?php
                    if(form_error('to'))
                        echo "<div class='form-group has-error' >";
                    else
                        echo "<div class='form-group' >";
                ?>
                    <label for="to" class="col-sm-2 control-label">
                        <?=$this->lang->line("idcardreport_to")?> <span class="text-red">*</span>
                    </label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control" id="to" name="to" value="<?=set_value('to')?>" >
                    </div>
                    <span class="col-sm-4 control-label" id="to_error">
                    </span>
                </div>

                <?php
                    if(form_error('subject'))
                        echo "<div class='form-group has-error' >";
                    else
                        echo "<div class='form-group' >";
                ?>
                    <label for="subject" class="col-sm-2 control-label">
                        <?=$this->lang->line("idcardreport_subject")?> <span class="text-red">*</span>
                    </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="subject" name="subject" value="<?=set_value('subject')?>" >
                    </div>
                    <span class="col-sm-4 control-label" id="subject_error">
                    </span>

                </div>

                <?php
                    if(form_error('message'))
                        echo "<div class='form-group has-error' >";
                    else
                        echo "<div class='form-group' >";
                ?>
                    <label for="message" class="col-sm-2 control-label">
                        <?=$this->lang->line("idcardreport_message")?>
                    </label>
                    <div class="col-sm-6">
                        <textarea class="form-control" id="message" style="resize: vertical;" name="message" value="<?=set_value('message')?>" ></textarea>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" style="margin-bottom:0px;" data-dismiss="modal"><?=$this->lang->line('close')?></button>
                <input type="button" id="send_pdf" class="btn btn-success" value="<?=$this->lang->line("idcardreport_send")?>" />
            </div>
        </div>
      </div>
    </div>
</form>
<!-- email end here -->

<script type="text/javascript">
    
    function check_email(email) {
        var status = false;
        var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
        if (email.search(emailRegEx) == -1) {
            $("#to_error").html('');
            $("#to_error").html("<?=$this->lang->line('idcardreport_mail_valid')?>").css("text-align", "left").css("color", 'red');
        } else {
            status = true;
        }
        return status;
    }


    $('#send_pdf').click(function() {
        var field = {
            'to'         : $('#to').val(), 
            'subject'    : $('#subject').val(), 
            'message'    : $('#message').val(),
            'usertypeID' : '<?=$usertypeID?>',
            'classesID'  : '<?=$classesID?>',
            'sectionID'  : '<?=$sectionID?>',
            'userID'     : '<?=$userID?>',
            'type'       : '<?=$type?>',
            'background' : '<?=$background?>',
        };

        var to = $('#to').val();
        var subject = $('#subject').val();
        var error = 0;

        $("#to_error").html("");
        $("#subject_error").html("");

        if(to == "" || to == null) {
            error++;
            $("#to_error").html("<?=$this->lang->line('idcardreport_mail_to')?>").css("text-align", "left").css("color", 'red');
        } else {
            if(check_email(to) == false) {
                error++
            }
        }

        if(subject == "" || subject == null) {
            error++;
            $("#subject_error").html("<?=$this->lang->line('idcardreport_mail_subject')?>").css("text-align", "left").css("color", 'red');
        } else {
            $("#subject_error").html("");
        }

        if(error == 0) {
            $('#send_pdf').attr('disabled','disabled');
            $.ajax({
                type: 'POST',
                url: "<?=base_url('idcardreport/send_pdf_to_mail')?>",
                data: field,
                dataType: "html",
                success: function(data) {
                    var response = JSON.parse(data);
                    if (response.status == false) {
                        $('#send_pdf').removeAttr('disabled');
                        if( response.to) {
                            $("#to_error").html("<?=$this->lang->line('idcardreport_mail_to')?>").css("text-align", "left").css("color", 'red');
                        } 
                        if( response.subject) {
                            $("#subject_error").html("<?=$this->lang->line('idcardreport_mail_subject')?>").css("text-align", "left").css("color", 'red');
                        }
                        if(response.message) {
                            toastr["error"](response.message)
                            toastr.options = {
                              "closeButton": true,
                              "debug": false,
                              "newestOnTop": false,
                              "progressBar": false,
                              "positionClass": "toast-top-right",
                              "preventDuplicates": false,
                              "onclick": null,
                              "showDuration": "500",
                              "hideDuration": "500",
                              "timeOut": "5000",
                              "extendedTimeOut": "1000",
                              "showEasing": "swing",
                              "hideEasing": "linear",
                              "showMethod": "fadeIn",
                              "hideMethod": "fadeOut"
                            }
                        }
                    } else {
                        location.reload();
                    }
                }
            });
        }
    });
    ;(function($) {
    $.fn.textfill = function(options) {
        var fontSize = options.maxFontPixels;
        var ourText = $('span:visible:first', this);
        var maxHeight = $(this).height()-7;
        var maxWidth = $(this).width()-7;
        var textHeight;
        var textWidth;
        do {
            ourText.css('font-size', fontSize);
            textHeight = ourText.height();
            textWidth = ourText.width();
            fontSize = fontSize - 1;
        } while ((textHeight > maxHeight || textWidth > maxWidth));
        return this;
    }
})(jQuery);

$(document).ready(function() {
    $('.jtextfill').textfill({ maxFontPixels: 10 });
});
</script>