<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
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
                                <tr>
                                    <td class="text-center" colspan="7">Ledger Book <?= $schoolyearName ?></td>
                                </tr>
                                </table>
                                <table class="table table-bordered">
                                <tr>
                                    <td class="text-bold text-center" colspan="5" rowspan="2"><?= $account->bankaccountbankname ?></td>
                                    <td class="text-bold">Credit</td>
                                    <td class="text-bold">Debit</td>
                                    <td class="text-bold">Closing balance</td>
                                </tr>
                                <tr>
                                    <?php
                                    $income_sum = (int)$account->bankaccountopeningbalance;
                                    $expense_sum = 0;
                                    foreach($transcations as $value) {
                                        if($value->transaction_type == 'income'){
                                            $income_sum += $value->amount;
                                        }else if($value->transaction_type == 'expense'){
                                            $expense_sum += $value->amount;
                                        }
                                    }
                                    ?>
                                    <td class="text-bold"><?= $income_sum ?></td>
                                    <td class="text-bold"><?= $expense_sum ?></td>
                                    <td class="text-bold"><?= $income_sum-$expense_sum ?></td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Sr.No</td>	
                                    <td class="text-bold">Date</td>	
                                    
                                    <td class="text-bold">Ledgers</td>	
                                    <td class="text-bold">Particulars</td>	
                                    <td class="text-bold">Cheque No</td>	
                                    <td class="text-bold">Debit</td>	
                                    <td class="text-bold">Credit</td>	
                                    <td class="text-bold">Balance</td>
                                </tr>
                                <?php
                                $i=1;
                                $balance = (int)$account->bankaccountopeningbalance;
                                if (date('m') <= 6) {//Upto June 2014-2015
                                    $financial_year = date('01-04-'.date('Y')-1);
                                } else {//After June 2015-2016
                                    $financial_year = date('01-04-Y');
                                }
                                ?>
                                <tr>
                                    <td><?= $i++ ?></td>	
                                    <td><?= $financial_year ?></td>	
                                    <td>Opening Balance</td>	
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><?= $balance ?></td>  
                                    <td><?= $balance ?></td>
                                </tr>
                                <?php
                                foreach($transcations as $value) {
                                    ?>
                                    <tr>
                                    <td><?= $i++ ?></td>	
                                    <td><?= date('d-m-Y',strtotime($value->date)) ?></td>	
                                    <td><?= $value->ledger ?></td>
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
                                }
                                ?>
                            </table>
                            
                </div>
            </div><!-- row -->

</div>
</body>
</html>