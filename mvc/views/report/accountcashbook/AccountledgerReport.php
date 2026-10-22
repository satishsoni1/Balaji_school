
<div class="box">
    <div class="box-header bg-gray">
        <h3 class="box-title text-navy"><i class="fa fa-clipboard"></i> 
            Ledger
        </h3>
    </div><!-- /.box-header -->
    <div id="printablediv">
        <style>
            .accountledgerreport {
                width: 100%;
                overflow: hidden;
            }

            .singleaccountledger {
                width: 48%;
                margin-left: 15px;
                float: left;
                overflow: hidden;
            }

            .marginledgerreport { margin-bottom: 20px !important }

            @media print {
                .singleaccountledger {
                    width: 47%;
                    margin-left: 15px;
                    float: left;
                    overflow: hidden;
                }
            }

        </style>
    <!-- form start -->
        <div class="box-body" style="margin-bottom: 50px;">
            <div class="row">
                <div class="col-sm-1">
                    <button id="dwnldBtn" class="btn btn-success"> Export</button>
                </div>
                
                <div class="col-sm-12">
                    <div class="reportPage-header">
                        <span class="header" id="headerImage"><p class="bannerLogo"><img src="<?=base_url('uploads/images/'.$siteinfos->photo)?>"></p></span>
                        <p class="title"><?=$siteinfos->sname?></p>
                        <p class="title-desc"><?=$siteinfos->address?></p>
                        <p class="title-desc"><?=$this->lang->line('topbar_academic_year'). ' : '. $schoolyearName?></p>
                    </div> 
                </div>
                <div class="col-sm-12 accountledgerreport" style="margin-top: 15px"  id="accountledgerreport">
                    
                            <table class="table table-bordered">
                                <!-- <tr>
                                    <td class="text-center" colspan="7">SHRI BALAJI ENGLISH PRIMARY & SECONDARY SCHOOL WADEGAON</td>
                                </tr> -->
                                <tr>
                                    <td class="text-center" colspan="7">Ledger Book <?= $schoolyearName ?></td>
                                </tr>
                                <!-- <tr>
                                    <td class="text-center" colspan="3">Receipt</td>
                                    <td class="text-center">Available Balance</td>
                                    <td class="text-center" colspan="3">Payments</td>
                                </tr>
                                <tr>
                                    <td class="text-center" colspan="2">Cash Total</td>
                                    <td class="text-right"><?= (int)$income_sum[9] ?></td>
                                    <td class="text-right"><?= (int)$accounts[9]+$income_sum[9]-$expense_sum[9] ?></td>
                                    <td class="text-center" colspan="2">Cash Total</td>
                                    <td class="text-right"><?= (int)$expense_sum[9] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-center" colspan="2">Bank 4918 Total</td>
                                    <td class="text-right"><?= (int)$income_sum[3] ?></td>
                                    <td class="text-right"><?= (int)$accounts[3]+$income_sum[3]-$expense_sum[3] ?></td>
                                    <td class="text-center" colspan="2">Bank 4918 Total</td>
                                    <td class="text-right"><?= (int)$expense_sum[3] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-center" colspan="2">Bank 4312 Total</td>
                                    <td class="text-right"><?= (int)$income_sum[1] ?></td>
                                    <td class="text-right"><?= (int)$accounts[1]+$income_sum[1]-$expense_sum[3] ?></td>
                                    <td class="text-center" colspan="2">Bank 4312 Total</td>
                                    <td class="text-right"><?= (int)$expense_sum[1] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-center" colspan="2">Bank 2050 Total</td>
                                    <td class="text-right"><?= (int)$income_sum[7] ?></td>
                                    <td class="text-right"><?= (int)$accounts[7]+$income_sum[7]-$expense_sum[7] ?></td>
                                    <td class="text-center" colspan="2">Bank 2050 Total</td>
                                    <td class="text-right"><?= (int)$expense_sum[7] ?></td>
                                </tr>
                                
                                <tr>
                                    <td class="text-center" colspan="2">Grand Total</td>
                                    <td class="text-right"><?= $income_sum[9]+$income_sum[1]+$income_sum[3]+$income_sum[7] ?></td>
                                    <td class="text-right"><?= (int)$accounts[9]+(int)$accounts[1]+(int)$accounts[3]+(int)$accounts[7]+$income_sum[9]+$income_sum[1]+$income_sum[3]+$income_sum[7]-$expense_sum[9]-$expense_sum[1]-$expense_sum[3]-$expense_sum[7] ?></td>
                                    <td class="text-center" colspan="2">Grand Total</td>
                                    <td class="text-right"><?= $expense_sum[9]+$expense_sum[1]+$expense_sum[3]+$expense_sum[7] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-left" colspan="6">Closing Balance</td>
                                    <td class="text-right"><?= (int)$accounts[9]+(int)$accounts[1]+(int)$accounts[3]+(int)$accounts[7]+$income_sum[9]+$income_sum[1]+$income_sum[3]+$income_sum[7]-$expense_sum[9]-$expense_sum[1]-$expense_sum[3]-$expense_sum[7] ?></td>
                                </tr> -->
                                </table>
                                <?php if($income_sum[1]>0 || $expense_sum[1]>0) { ?>
                                <table class="table table-bordered">
                                <tr>
                                    <td class="text-bold text-center" colspan="4" rowspan="2">Bank 4312</td>
                                    <td class="text-bold">Credit</td>
                                    <td class="text-bold">Debit</td>
                                    <td class="text-bold">Closing balance</td>
                                </tr>
                                <tr>
                                    <td class="text-bold"><?= (int)$income_sum[1] ?></td>
                                    <td class="text-bold"><?= (int)$expense_sum[1] ?></td>
                                    <td class="text-bold"><?= (int)$accounts[1]+$income_sum[1]-$income_sum[1] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Sr.No</td>	
                                    <td class="text-bold">Date</td>	
                                    <td class="text-bold">Ledgers</td>	
                                    <td class="text-bold">Cheque No</td>	
                                    <td class="text-bold">Debit</td>	
                                    <td class="text-bold">Credit</td>	
                                    <td class="text-bold">Balance</td>
                                </tr>
                                <?php
                                $i=1;
                                $balance = (int)$accounts[1];
                                foreach($transcations as $value) {
                                    if($value->bankaccountID==1){
                                    ?>
                                    <tr>
                                    <td><?= $i++ ?></td>	
                                    <td><?= date('d-m-Y',strtotime($value->date)) ?></td>	
                                    <td><?= $value->name ?></td>	
                                    <td><?= $value->cheque ?></td>
                                    <?php if($value->transaction_type == 'income'){
                                        $balance += $value->amount;
                                    ?>
                                        <td></td>
                                        <td><?= $value->amount ?></td>  
                                    <?php
                                    }else if($value->transaction_type == 'expense'){
                                        $balance -= $value->amount;
                                    ?>
                                        <td><?= $value->amount ?></td>
                                        <td></td>
                                    <?php
                                    }
                                    ?>
                                    <td><?= $balance ?></td>
                                </tr>
                                    <?php
                                }}
                                ?>
                            </table>
                            <?php } ?>
                            <?php if($income_sum[3]>0 || $expense_sum[3]>0) { ?>
                                <table class="table table-bordered">
                                <tr>
                                    <td class="text-bold text-center" colspan="4" rowspan="2">Bank 4918</td>
                                    <td class="text-bold">Credit</td>
                                    <td class="text-bold">Debit</td>
                                    <td class="text-bold">Closing balance</td>
                                </tr>
                                <tr>
                                    <td class="text-bold"><?= (int)$income_sum[3] ?></td>
                                    <td class="text-bold"><?= (int)$expense_sum[3] ?></td>
                                    <td class="text-bold"><?= (int)$accounts[3]+$income_sum[3]-$income_sum[3] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Sr.No</td>	
                                    <td class="text-bold">Date</td>	
                                    <td class="text-bold">Ledgers</td>	
                                    <td class="text-bold">Cheque No</td>	
                                    <td class="text-bold">Debit</td>	
                                    <td class="text-bold">Credit</td>	
                                    <td class="text-bold">Balance</td>
                                </tr>
                                <?php
                                $i=1;
                                $balance = (int)$accounts[3];
                                foreach($transcations as $value) {
                                    if($value->bankaccountID==3){
                                    ?>
                                    <tr>
                                    <td><?= $i++ ?></td>	
                                    <td><?= date('d-m-Y',strtotime($value->date)) ?></td>	
                                    <td><?= $value->name ?></td>	
                                    <td><?= $value->cheque ?></td>
                                    <?php if($value->transaction_type == 'income'){
                                        $balance += $value->amount;
                                    ?>
                                        <td></td>
                                        <td><?= $value->amount ?></td>  
                                    <?php
                                    }else if($value->transaction_type == 'expense'){
                                        $balance -= $value->amount;
                                    ?>
                                        <td><?= $value->amount ?></td>
                                        <td></td>
                                    <?php
                                    }
                                    ?>
                                    <td><?= $balance ?></td>
                                </tr>
                                    <?php
                                }}
                                ?>
                            </table>
                            <?php } ?>
                            <?php if($income_sum[7]>0 || $expense_sum[7]>0) { ?>
                                <table class="table table-bordered">
                                <tr>
                                    <td class="text-bold text-center" colspan="4" rowspan="2">Bank 2050</td>
                                    <td class="text-bold">Credit</td>
                                    <td class="text-bold">Debit</td>
                                    <td class="text-bold">Closing balance</td>
                                </tr>
                                <tr>
                                    <td class="text-bold"><?= (int)$income_sum[7] ?></td>
                                    <td class="text-bold"><?= (int)$expense_sum[7] ?></td>
                                    <td class="text-bold"><?= (int)$accounts[7]+$income_sum[7]-$income_sum[7] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Sr.No</td>	
                                    <td class="text-bold">Date</td>	
                                    <td class="text-bold">Ledgers</td>	
                                    <td class="text-bold">Cheque No</td>	
                                    <td class="text-bold">Debit</td>	
                                    <td class="text-bold">Credit</td>	
                                    <td class="text-bold">Balance</td>
                                </tr>
                                <?php
                                $i=1;
                                $balance = (int)$accounts[7];
                                foreach($transcations as $value) {
                                    if($value->bankaccountID==7){
                                    ?>
                                    <tr>
                                    <td><?= $i++ ?></td>	
                                    <td><?= date('d-m-Y',strtotime($value->date)) ?></td>	
                                    <td><?= $value->name ?></td>	
                                    <td><?= $value->cheque ?></td>
                                    <?php if($value->transaction_type == 'income'){
                                        $balance += $value->amount;
                                    ?>
                                        <td></td>
                                        <td><?= $value->amount ?></td>  
                                    <?php
                                    }else if($value->transaction_type == 'expense'){
                                        $balance -= $value->amount;
                                    ?>
                                        <td><?= $value->amount ?></td>
                                        <td></td>
                                    <?php
                                    }
                                    ?>
                                    <td><?= $balance ?></td>
                                </tr>
                                    <?php
                                }}
                                ?>
                            </table>
                            <?php } ?>
                            <?php if($income_sum[9]>0 || $expense_sum[9]>0) { ?>
                                <table class="table table-bordered">
                                <tr>
                                    <td class="text-bold text-center" colspan="4" rowspan="2">Cash</td>
                                    <td class="text-bold">Credit</td>
                                    <td class="text-bold">Debit</td>
                                    <td class="text-bold">Closing balance</td>
                                </tr>
                                <tr>
                                    <td class="text-bold"><?= (int)$income_sum[9] ?></td>
                                    <td class="text-bold"><?= (int)$expense_sum[9] ?></td>
                                    <td class="text-bold"><?= (int)$accounts[9]+$income_sum[9]-$income_sum[9] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Sr.No</td>	
                                    <td class="text-bold">Date</td>	
                                    <td class="text-bold">Ledgers</td>	
                                    <td class="text-bold">Cheque No</td>	
                                    <td class="text-bold">Debit</td>	
                                    <td class="text-bold">Credit</td>	
                                    <td class="text-bold">Balance</td>
                                </tr>
                                <?php
                                $i=1;
                                $balance = (int)$accounts[9];
                                foreach($transcations as $value) {
                                    if($value->bankaccountID==9){
                                    ?>
                                    <tr>
                                    <td><?= $i++ ?></td>	
                                    <td><?= date('d-m-Y',strtotime($value->date)) ?></td>	
                                    <td><?= $value->name ?></td>	
                                    <td><?= $value->cheque ?></td>
                                    <?php if($value->transaction_type == 'income'){
                                        $balance += $value->amount;
                                    ?>
                                        <td></td>
                                        <td><?= $value->amount ?></td>  
                                    <?php
                                    }else if($value->transaction_type == 'expense'){
                                        $balance -= $value->amount;
                                    ?>
                                        <td><?= $value->amount ?></td>
                                        <td></td>
                                    <?php
                                    }
                                    ?>
                                    <td><?= $balance ?></td>
                                </tr>
                                    <?php
                                }}
                                ?>
                            </table>
                            <?php } ?>
                </div>
                
                <div class="col-sm-12 text-center footerAll">
                    <?=reportfooter($siteinfos, $schoolyearsessionobj)?>
                </div>
            </div><!-- row -->
        </div><!-- Body -->
    </div>
</div>
