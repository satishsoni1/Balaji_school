<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body style="color:#000 !important">
    <div style="margin-bottom: 50px;">
            <div class="row">
                
                <div class="col-sm-12">
                    <div class="reportPage-header">
                        <span class="header" id="headerImage"><p class="bannerLogo"><img width="10%" src="<?=base_url('uploads/images/'.$siteinfos->photo)?>"></p></span>
                        <p class="title"><?=$siteinfos->sname?></p>
                        <p class="title-desc"><?=$siteinfos->address?></p>
                        <p class="title-desc"><?=$this->lang->line('topbar_academic_year'). ' : '. $schoolyearName?></p>
                    </div> 
                </div>
                <div class="col-sm-12 accountledgerreport" style="margin-top: 15px"  id="accountledgerreport">
                    
                            <table class="table table-bordered">
                                <!-- <tr>
                                    <td class="text-center" colspan="17">SHRI BALAJI ENGLISH PRIMARY & SECONDARY SCHOOL WADEGAON</td>
                                </tr> -->
                                <tr>
                                    <td class="text-center" colspan="17">CASH BOOK <?= $schoolyearName ?> </td>
                                </tr>
                                <tr>
                                    <td class="text-center" colspan="8">Receipt</td>
                                    <td class="text-center">Available Balance</td>
                                    <td class="text-center" colspan="8">Payments</td>
                                </tr>
                                <tr>
                                    <td class="text-center" colspan="7">Cash Total</td>
                                    <td class="text-right"><?= $accounts[9]+$income_sum[9] ?></td>
                                    <td class="text-right"><?= $accounts[9]+$income_sum[9]-$expense_sum[9] ?></td>
                                    <td class="text-center" colspan="7">Cash Total</td>
                                    <td class="text-right"><?= $expense_sum[9] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-center" colspan="7">Bank 4918 Total</td>
                                    <td class="text-right"><?= $accounts[3]+$income_sum[3] ?></td>
                                    <td class="text-right"><?= $accounts[3]+$income_sum[3]-$expense_sum[3] ?></td>
                                    <td class="text-center" colspan="7">Bank 4918 Total</td>
                                    <td class="text-right"><?= $expense_sum[3] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-center" colspan="7">Bank 4312 Total</td>
                                    <td class="text-right"><?= $accounts[1]+$income_sum[1] ?></td>
                                    <td class="text-right"><?= $accounts[1]+$income_sum[1]-$expense_sum[1] ?></td>
                                    <td class="text-center" colspan="7">Bank 4312 Total</td>
                                    <td class="text-right"><?= $expense_sum[1] ?></td>
                                </tr>
                                <!-- <tr>
                                    <td class="text-center" colspan="7">Bank 2050 Total</td>
                                    <td class="text-right"><?= $accounts[7]+$income_sum[7] ?></td>
                                    <td class="text-right"><?= $accounts[7]+$income_sum[7]-$expense_sum[7] ?></td>
                                    <td class="text-center" colspan="7">Bank 2050 Total</td>
                                    <td class="text-right"><?= $expense_sum[7] ?></td>
                                </tr> -->
                                
                                <tr>
                                    <td class="text-center" colspan="7">Grand Total</td>
                                    <td class="text-right"><?= $accounts[9]+$accounts[1]+$accounts[3]+$income_sum[9]+$income_sum[1]+$income_sum[3] ?></td>
                                    <td class="text-right"><?= $accounts[9]+$accounts[1]+$accounts[3]+$income_sum[9]+$income_sum[1]+$income_sum[3]-$expense_sum[9]-$expense_sum[1]-$expense_sum[3] ?></td>
                                    <td class="text-center" colspan="7">Grand Total</td>
                                    <td class="text-right"><?= $expense_sum[9]+$expense_sum[1]+$expense_sum[3] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-left" colspan="16">Closing Balance</td>
                                    <td class="text-right"><?= $accounts[9]+$accounts[1]+$accounts[3]+$income_sum[9]+$income_sum[1]+$income_sum[3]-$expense_sum[9]-$expense_sum[1]-$expense_sum[3] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-center" colspan="8">Receipts ( Income ) </td>
                                    <td></td>
                                    <td class="text-center" colspan="8">Payments ( Expenses )</td>
                                </tr>
                                <tr>
                                    <td class="text-bold" colspan="2">Date</td>	
                                    <td class="text-bold">Particulars</td>	
                                    <td class="text-bold">Rec. No</td>	
                                    <td class="text-bold">Cheque No</td>	
                                    <td class="text-bold">Cash</td>	
                                    <td class="text-bold">Bank 4918</td>	
                                    <td class="text-bold">Bank 4312</td>	
                                    <td></td>
                                    <td class="text-bold" colspan="2">Date</td>	
                                    <td class="text-bold">Particulars</td>	
                                    <td class="text-bold">Rec. No</td>	
                                    <td class="text-bold">Cheque No</td>	
                                    <td class="text-bold">Cash</td>	
                                    <td class="text-bold">Bank 4918</td>	
                                    <td class="text-bold">Bank 4312</td>	
                                </tr>
                                <?php
                                $large = 0;
                                if(count($incomes)>count($expenses))
                                    $large = count($incomes);
                                else
                                    $large = count($expenses);
                                    if (date('m') <= 6) {//Upto June 2014-2015
                                        $financial_year = date('01-04-'.date('Y')-1);
                                    } else {//After June 2015-2016
                                        $financial_year = date('01-04-Y');
                                    }
                                ?>
                                    <tr>
                                        <td class="text-left" colspan="2"><?= $financial_year ?></td>	
                                        <td class="text-left">Opening Balance</td>	
                                        <td class="text-left">-</td>	
                                        <td class="text-left">-</td>	
                                        <td class="text-left"><?= $accounts[9] ?></td>	
                                        <td class="text-left"><?= $accounts[3] ?></td>	
                                        <td class="text-left"><?= $accounts[1] ?></td>	
                                    <td></td>
                                        <td class="text-left" colspan="2"></td>
                                        <td class="text-left"></td>
                                        <td class="text-left"></td>
                                        <td class="text-left"></td>
                                        <td class="text-left"></td>
                                        <td class="text-left"></td>
                                        <td class="text-left"></td>
                                </tr>
                                <?php
                                for($i=0;$i<$large;$i++){
                                ?>
                                <tr>
                                    <?php if(isset($incomes[$i])){ ?>
                                        <td class="text-left" colspan="2"><?= date('d-m-Y',strtotime($incomes[$i]->date)) ?></td>	
                                        <td class="text-left"><?= $incomes[$i]->name ?></td>	
                                        <td class="text-left">-</td>	
                                        <td class="text-left">-</td>	
                                        <td class="text-left"><?= ($incomes[$i]->bankaccountID==9)?$incomes[$i]->amount:"-" ?></td>	
                                        <td class="text-left"><?= ($incomes[$i]->bankaccountID==3)?$incomes[$i]->amount:"-" ?></td>	
                                        <td class="text-left"><?= ($incomes[$i]->bankaccountID==1)?$incomes[$i]->amount:"-" ?></td>
                                    <?php }else{ ?>
                                        <td class="text-left" colspan="2"></td>
                                        <td class="text-left"></td>
                                        <td class="text-left"></td>
                                        <td class="text-left"></td>
                                        <td class="text-left"></td>
                                        <td class="text-left"></td>
                                        <td class="text-left"></td>
                                    <?php } ?>
                                    <td></td>
                                    <?php if(isset($expenses[$i])){ ?>
                                        <td class="text-left" colspan="2"><?= date('d-m-Y',strtotime($expenses[$i]->date)) ?></td>	
                                        <td class="text-left"><?= $expenses[$i]->expense ?></td>	
                                        <td class="text-left">-</td>	
                                        <td class="text-left">-</td>	
                                        <td class="text-left"><?= ($expenses[$i]->bankaccountID==9)?$expenses[$i]->amount:"-" ?></td>	
                                        <td class="text-left"><?= ($expenses[$i]->bankaccountID==3)?$expenses[$i]->amount:"-" ?></td>	
                                        <td class="text-left"><?= ($expenses[$i]->bankaccountID==1)?$expenses[$i]->amount:"-" ?></td>
                                        <?php }else{ ?>
                                        <td class="text-left" colspan="2"></td>
                                        <td class="text-left"></td>
                                        <td class="text-left"></td>
                                        <td class="text-left"></td>
                                        <td class="text-left"></td>
                                        <td class="text-left"></td>
                                        <td class="text-left"></td>
                                    <?php } ?>
                                </tr>
                                <?php } ?>
                            </table>
                </div>
                
                <div class="col-sm-12 text-center footerAll">
                    <?=reportfooter($siteinfos, $schoolyearsessionobj)?>
                </div>
            </div><!-- row -->
    </div><!-- Body -->
</body>
</html>