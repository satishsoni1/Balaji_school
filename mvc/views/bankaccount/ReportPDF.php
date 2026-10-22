<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
</head>

<body>
    <div style="margin-bottom: 50px;">
        <div class="row">
            <div class="reportPage-header">
                <span class="header"><img class="logo" src="<?= base_url('uploads/images/' . $siteinfos->photo) ?>"></span>
                <p class="title"><?= $siteinfos->sname ?></p>
                <p class="title-desc"><?= $siteinfos->address ?></p>
            </div>
            <div style="margin-bottom: -5px">
                <h3><?= $this->lang->line('bankaccount_report_for') ?> - <?= $this->lang->line('bankaccount_accountledger') ?> -> <?= $bankaccount->bankaccountbankname ?></h3>
            </div>
            <div class="bankaccount">

                <div class="singleaccountledger">
                    <table class="ledgertable">
                        <tr>
                            <td class="text-bold" colspan="2"><?= $this->lang->line('bankaccount_income') ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?= $this->lang->line('bankaccount_income_des') ?></td>
                        </tr>
                        <tr>
                            <td><?= $this->lang->line('bankaccount_total') ?> <span class="text-bold"><?= !empty($siteinfos->currency_code) ? "(" . $siteinfos->currency_code . ")" : '' ?></span></td>
                            <td><?= number_format($totalincome, 2) ?></td>
                        </tr>
                    </table>

                    <table class="ledgertable">
                        <tr>
                            <td class="text-bold" colspan="2"><?= $this->lang->line('bankaccount_total_balance') ?></td>
                        </tr>
                        <tr>
                            <td><?= $this->lang->line('bankaccount_openingbalance') ?> (+)</td>
                            <td><?= number_format($bankaccount->bankaccountopeningbalance, 2) ?></td>
                        </tr>
                        <tr>
                            <td><?= $this->lang->line('bankaccount_income') ?> (+)</td>
                            <td><?= number_format($totalincome, 2) ?></td>
                        </tr>

                        <tr>
                            <td><?= $this->lang->line('bankaccount_expense') ?> (-)</td>
                            <td><?= number_format($totalexpense, 2) ?></td>
                        </tr>
                        <tr>
                            <td><?= $this->lang->line('bankaccount_grand_total') ?> <span class="text-bold"><?= !empty($siteinfos->currency_code) ? "(" . $siteinfos->currency_code . ")" : '' ?></span></td>
                            <td>
                                <?php
                                $mainincome  = ($totalincome + $bankaccount->bankaccountopeningbalance);
                                $mainexpense = ($totalexpense);
                                $mainbalance  = ($mainincome - $mainexpense);
                                echo number_format($mainbalance, 2);
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="singleaccountledger marginledger">




                    <table class="ledgertable">
                        <tr>
                            <td class="text-bold" colspan="2"><?= $this->lang->line('bankaccount_expense') ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?= $this->lang->line('bankaccount_expense_des') ?></td>
                        </tr>
                        <tr>
                            <td><?= $this->lang->line('bankaccount_total') ?> <span class="text-bold"><?= !empty($siteinfos->currency_code) ? "(" . $siteinfos->currency_code . ")" : '' ?></span></td>
                            <td><?= number_format($totalexpense, 2) ?></td>
                        </tr>
                    </table>


                </div>
            </div>
            <div class="col-sm-12">


                <table id="exampletable" class="table table-striped table-bordered table-hover dataTable no-footer">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Date</th>
                            <th>Account</th>
                            <th>Description</th>
                            <th>Credit</th>
                            <th>Debit</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php
                        $totalincome = 0;
                        $totalexpense = 0;
                        $incomecount = 1;
                        $totalrows = count($income_expenses);
                        foreach ($income_expenses as $income_expense) {
                            if ($income_expense->debit_amount != null)
                                $totalexpense += $income_expense->debit_amount;
                            if ($income_expense->credit_amount != null)
                                $totalincome += $income_expense->credit_amount;
                        ?>
                            <tr>
                                <td><?= $incomecount++ ?></td>
                                <td><?= date('d-m-Y', strtotime($income_expense->date)) ?></td>
                                <td><?= $income_expense->name ?></td>
                                <td><?= $income_expense->note ?></td>
                                <?php if ($income_expense->credit_amount != "null") {
                                ?>
                                    <td><?= number_format($income_expense->credit_amount) ?></td>
                                    <td></td>
                                <?php } ?>
                                <?php if ($income_expense->debit_amount != "null") {
                                ?>
                                    <td></td>
                                    <td><?= number_format($income_expense->debit_amount) ?></td>
                                <?php } ?>

                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>

                            <th>Total</th>
                            <th><?= number_format($totalincome) ?></th>
                            <th><?= number_format($totalexpense) ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="text-center footerAll">
                <?= reportfooter($siteinfos, $schoolyearsessionobj, true) ?>
            </div>
        </div><!-- row -->
    </div><!-- Body -->
</body>

</html>