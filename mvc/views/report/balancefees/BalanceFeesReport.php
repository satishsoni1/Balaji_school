<div class="row">
    <div class="col-sm-12" style="margin:10px 0px">
        <?php
            
            $pdf_preview_uri = base_url('balancefeesreport/pdf/'.$classesID.'/'.$sectionID.'/'.$studentID.'/'.$minfeeValue.'/'.$maxfeeValue);
            $xml_preview_uri = base_url('balancefeesreport/xlsx/'.$classesID.'/'.$sectionID.'/'.$studentID);

            // echo btn_printReport('balancefeesreport', $this->lang->line('report_print'), 'printablediv');
            echo btn_pdfPreviewReport('balancefeesreport',$pdf_preview_uri, $this->lang->line('report_pdf_preview'));
            // echo btn_xmlReport('balancefeesreport',$xml_preview_uri, $this->lang->line('report_xlsx'));
            // echo btn_sentToMailReport('balancefeesreport', $this->lang->line('report_send_pdf_to_mail'));
        ?>
    </div>
</div>

<div class="box">
    <div class="box-header bg-gray">
        <h3 class="box-title text-navy"><i class="fa fa-clipboard"></i>
            <?=$this->lang->line('balancefeesreport_report_for')?> - 
            <?=$this->lang->line('balancefeesreport_balancefees');?>
        </h3>
    </div><!-- /.box-header -->
    <div id="printablediv">
    <!-- form start -->
        <div class="box-body" style="margin-bottom: 50px;">
            <div class="row">
                <div class="col-sm-12">
                    <?=reportheader($siteinfos, $schoolyearsessionobj)?>
                </div>
                <?php if($classesID >= 0 || $sectionID >= 0 ) { ?>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="pull-left">
                                    <?php 
                                        echo $this->lang->line('balancefeesreport_class')." : ";
                                        echo isset($classes[$classesID]) ? $classes[$classesID] : $this->lang->line('balancefeesreport_all_class');
                                    ?>
                                </h5>                         
                                <h5 class="pull-right">
                                    <?php
                                       echo $this->lang->line('balancefeesreport_section')." : ";
                                       echo isset($sections[$sectionID]) ? $sections[$sectionID] : $this->lang->line('balancefeesreport_all_section');
                                    ?>
                                </h5>                        
                            </div>
                        </div>
                    </div>
                <?php }  else { ?>
                    <div class="col-sm-12" style="margin-top: 15px;"></div>
                <?php } 
                if(customCompute($students)) { ?>
                    <div class="col-sm-12">
                        <div id="hide-table">
                            <table class="table table-bordered" id="example4">
                                <thead>
                                    <tr>
                                        <th><?=$this->lang->line('slno')?></th>
                                        <th><?=$this->lang->line('balancefeesreport_name')?></th>
                                        <th>Phone</th>
                                        <th><?=$this->lang->line('balancefeesreport_registerNO')?></th>
                                        <?php //if($classesID == 0) { ?>
                                          <th><?=$this->lang->line('balancefeesreport_class')?></th>
                                        <?php //} ?>
                                        <?php //if($sectionID == 0) { ?>
                                          <th><?=$this->lang->line('balancefeesreport_section')?></th>
                                        <?php //} ?>
                                        <th><?=$this->lang->line('balancefeesreport_roll')?></th>
                                        <th><?=$this->lang->line('balancefeesreport_fees_amount')?></th>
                                        <th><?=$this->lang->line('balancefeesreport_discount')?> </th>
                                        <th><?=$this->lang->line('balancefeesreport_paid')?> </th>
                                        <!-- <th><?=$this->lang->line('balancefeesreport_weaver')?> </th> -->
                                        <th><?=$this->lang->line('balancefeesreport_balance') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $totalAmount = 0;
                                        $totalDiscount = 0;
                                        $totalPayments = 0;
                                        $totalWeaver = 0;
                                        $totalBalance = 0;
                                        $i=1;
                                        foreach($students as $student) {
                                            if($student_info[$student->srstudentID]->active==1){  
                                            //$i++; 
                                            $flag = 0;
                                            //var_dump($totalAmountAndDiscount[$student->srstudentID]['amount']);die;
                                            
                                            $Amount = 0;
                                            $Discount = 0;
                                            $Payment = 0;
                                            $Weaver = 0;

                                            if(isset($totalAmountAndDiscount[$student->srstudentID]['amount'])) {
                                                $Amount = $totalAmountAndDiscount[$student->srstudentID]['amount'];
                                                //$totalAmount += $Amount;
                                            }

                                            if(isset($totalAmountAndDiscount[$student->srstudentID]['discount'])) {
                                               // $Discount = $totalAmountAndDiscount[$student->srstudentID]['discount'];
                                                //$totalDiscount += $Discount;
                                            }

                                            if(isset($totalPayment[$student->srstudentID]['payment'])) {
                                                $Payment = $totalPayment[$student->srstudentID]['payment'];
                                                //$totalPayments += $Payment;
                                            }

                                            if(isset($totalweavar[$student->srstudentID]['weaver'])) {
                                                $Weaver = $totalweavar[$student->srstudentID]['weaver'];
                                              //  $totalWeaver += $Weaver;
                                            }

                                            $Balance = ($Amount - $Discount) - ($Payment+$Weaver);

                                          
                                            if(isset($totalAmountAndDiscount[$student->srstudentID]['amount']) && $totalAmountAndDiscount[$student->srstudentID]['amount']){
                                                if( $Balance>=$minfeeValue && $Balance<=$maxfeeValue){
                                                    $flag = 0;
                                                }else{
                                                    $flag = 1;
                                                }
                                            }else{
                                                $flag = 1;
                                            }
                                            if($flag == 0){
                                            ?>
                                            <tr>
                                                <td data-title="<?=$this->lang->line('slno')?>"><?=$i++?></td>
                                                <td data-title="<?=$this->lang->line('balancefeesreport_name')?>">
                                                    <?=$student->srname?>
                                                </td>
                                                <td data-title="Phone">
                                                    <?=$student_info[$student->srstudentID]->phone?>
                                                </td>
                                                <td data-title="<?=$this->lang->line('balancefeesreport_registerNO')?>">
                                                    <?=$student->srregisterNO?>
                                                </td>
                                                <?php //if($classesID == 0) { ?>
                                                    <td data-title="<?=$this->lang->line('balancefeesreport_class')?>">
                                                        <?=isset($classes[$student->srclassesID]) ? $classes[$student->srclassesID] : ''?>
                                                    </td>
                                                <?php //} ?>

                                                <?php //if($sectionID == 0) { ?>
                                                    <td data-title="<?=$this->lang->line('balancefeesreport_section')?>">
                                                        <?=isset($sections[$student->srsectionID]) ? $sections[$student->srsectionID] : ''?>
                                                    </td>
                                                <?php //} ?>

                                                <td data-title="<?=$this->lang->line('balancefeesreport_roll')?>">
                                                    <?=$student->srroll?>
                                                </td>
                                                <td data-title="<?=$this->lang->line('balancefeesreport_fees_amount')?>">
                                                    <?=isset($totalAmountAndDiscount[$student->srstudentID]['amount']) ? number_format($totalAmountAndDiscount[$student->srstudentID]['amount'],2) : number_format(0, 2)?>
                                                </td>
                                                <td data-title="<?=$this->lang->line('balancefeesreport_discount')?>">
                                                    <!--<?=isset($totalAmountAndDiscount[$student->srstudentID]['discount']) ? number_format($totalAmountAndDiscount[$student->srstudentID]['discount'],2) : number_format(0, 2)?>-->
                                                    <?=isset($totalweavar[$student->srstudentID]['weaver']) ? number_format($totalweavar[$student->srstudentID]['weaver'],2) : number_format(0, 2)?>
                                                </td>
                                                <td data-title="<?=$this->lang->line('balancefeesreport_paid')?>">
                                                    <?=isset($totalPayment[$student->srstudentID]['payment']) ? number_format($totalPayment[$student->srstudentID]['payment'],2) : number_format(0, 2)?>
                                                </td>
                                                <!-- <td data-title="<?=$this->lang->line('balancefeesreport_weaver')?>">
                                                    <?=isset($totalweavar[$student->srstudentID]['weaver']) ? number_format($totalweavar[$student->srstudentID]['weaver'],2) : number_format(0, 2)?>
                                                </td> -->
                                                <td data-title="<?=$this->lang->line('balancefeesreport_balance')?>">
                                                    <?php 
                                                        $Amount = 0;
                                                        $Discount = 0;
                                                        $Payment = 0;
                                                        $Weaver = 0;

                                                        if(isset($totalAmountAndDiscount[$student->srstudentID]['amount'])) {
                                                            $Amount = $totalAmountAndDiscount[$student->srstudentID]['amount'];
                                                            $totalAmount += $Amount;
                                                        }

                                                        if(isset($totalAmountAndDiscount[$student->srstudentID]['discount'])) {
                                                            $Discount = $totalAmountAndDiscount[$student->srstudentID]['discount'];
                                                            $totalDiscount += $Discount;
                                                        }

                                                        if(isset($totalPayment[$student->srstudentID]['payment'])) {
                                                            $Payment = $totalPayment[$student->srstudentID]['payment'];
                                                            $totalPayments += $Payment;
                                                        }

                                                        if(isset($totalweavar[$student->srstudentID]['weaver'])) {
                                                            $Weaver = $totalweavar[$student->srstudentID]['weaver'];
                                                            $totalWeaver += $Weaver;
                                                        }

                                                        $Balance = ($Amount - $Discount) - ($Payment+$Weaver);

                                                        $totalBalance += $Balance;

                                                        echo number_format($Balance,2);
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                }
                                    ?>       
                                </tbody>
                                <tfooter>
                            <!-- </table>
                            <table class="table table-bordered">
                                <tbody> -->
                                    <tr>
                                        <?php 
                                            $colspan = 6;
                                            $str = '
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>';
                                            // if($classesID == 0) {
                                            //     $colspan = 6;
                                            //     $str = '
                                            //     <td></td>
                                            //     <td></td>
                                            //     <td></td>
                                            //     <td></td>
                                            //     <td></td>';
                                            // }

                                            // if($sectionID == 0) {
                                            //     $colspan = 6;
                                            //     $str = '
                                            //     <td></td>
                                            //     <td></td>
                                            //     <td></td>
                                            //     <td></td>
                                            //     <td></td>';
                                            // }

                                            // if($classesID == 0 && $sectionID == 0) {
                                            //     $colspan = 7;
                                            //     $str = '
                                            //     <td></td>
                                            //     <td></td>
                                            //     <td></td>
                                            //     <td></td>
                                            //     <td></td>
                                            //     <td></td>';
                                            // }
                                        ?>
                                        <td data-title="<?=$this->lang->line('balancefeesreport_grand_total')?>" class="text-right text-bold"><?=$this->lang->line('balancefeesreport_grand_total')?> <?=!empty($siteinfos->currency_code) ? '('.$siteinfos->currency_code.')' : ''?> </td>
                                        <?= $str ?>
                                        <td data-title="<?=$this->lang->line('balancefeesreport_total_fees_amount')?>" class="text-bold"><?=number_format($totalAmount,2)?></td>
                                        <td data-title="<?=$this->lang->line('balancefeesreport_total_discount')?>" class="text-bold"><?=number_format($totalDiscount+$totalWeaver,2)?></td>
                                        <td data-title="<?=$this->lang->line('balancefeesreport_total_paid')?>" class="text-bold"><?=number_format($totalPayments,2)?></td>
                                        <td data-title="<?=$this->lang->line('balancefeesreport_total_balance')?>" class="text-bold"><?=number_format($totalBalance,2)?></td>
                                    </tr>                             
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } else { ?>
                    <br/>
                    <div class="col-sm-12">
                        <div class="callout callout-danger">
                            <p><b class="text-info"><?=$this->lang->line('report_data_not_found')?></b></p>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-sm-12 text-center footerAll">
                    <?=reportfooter($siteinfos, $schoolyearsessionobj)?>
                </div>
            </div><!-- row -->
        </div><!-- Body -->
    </div>
</div>



<script type="text/javascript">
        
        $(document).ready(function () {
            $('#example4').DataTable({
              dom : 'Bfrtip',
              order: [[10, 'desc']],
              buttons : [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
              ],
              customize: function (doc) {
            var col = doc.content[1].table.body;
            for (i = 1; i < col.length; i++) {
              col[i][0]["text"] = i;
            }
                },
              "pageLength": 100,
              "fnRowCallback" : function(nRow, aData, iDisplayIndex){
                    $("td:first", nRow).html(iDisplayIndex +1);
                        return nRow;
            }
            });
        });
    function check_email(email) {
        var status = false;
        var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
        if (email.search(emailRegEx) == -1) {
            $("#to_error").html('');
            $("#to_error").html("<?=$this->lang->line('balancefeesreport_mail_valid')?>").css("text-align", "left").css("color", 'red');
        } else {
            status = true;
        }
        return status;
    }

    $("#send_pdf").click(function() {
        var field = {
            'to'         : $('#to').val(), 
            'subject'    : $('#subject').val(), 
            'message'    : $('#message').val(),
            'classesID'  : '<?=$classesID?>',
            'sectionID'  : '<?=$sectionID?>',
            'studentID'  : '<?=$studentID?>',
        };

        var to = $('#to').val();
        var subject = $('#subject').val();
        var error = 0;

        $("#to_error").html("");
        $("#subject_error").html("");

        if(to == "" || to == null) {
            error++;
            $("#to_error").html("<?=$this->lang->line('balancefeesreport_mail_to')?>").css("text-align", "left").css("color", 'red');
        } else {
            if(check_email(to) == false) {
                error++
            }
        }

        if(subject == "" || subject == null) {
            error++;
            $("#subject_error").html("<?=$this->lang->line('balancefeesreport_mail_subject')?>").css("text-align", "left").css("color", 'red');
        } else {
            $("#subject_error").html("");
        }

        if(error == 0) {
            $('#send_pdf').attr('disabled','disabled');
            $.ajax({
                type: 'POST',
                url: "<?=base_url('balancefeesreport/send_pdf_to_mail')?>",
                data: field,
                dataType: "html",
                success: function(data) {
                    var response = JSON.parse(data);
                    if(response.status == false) {
                        $('#send_pdf').removeAttr('disabled');
                        $.each(response, function(index, value) {
                            if(index != 'status') {
                                toastr["error"](value)
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
                        });
                    } else {
                        location.reload();
                    }
                }
            });
        }
    });
</script>
