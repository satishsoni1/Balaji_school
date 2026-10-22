<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
</head>

<body>
    <div>
       
        <table style="width:100%">
            <tr>
                <td>


                    <table width="100%" class="table table-bordered" style="text-align:left">

                        <tr>
                            <td colspan="5" width="100%">

                                <table width="100%">
                                    <tr>
                                        <td width="100%" style="border:0px solid;text-align:right">
                                            Student Copy
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="100%" style="border:0px solid">
                                            <b>
                                                <?php echo $this->lang->line("productsale_from"); ?>
                                            </b>
                                            Shri Balaji English Primary & Secondary School, Wadegaon<br />Tg. Balapur, Dist. Akola Office Mob. No. 7058262032, 9763757391(H.M.)

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>

                            <td colspan=3>
                                <table width="100%">

                                    <?php if (customCompute($user)) { ?>
                                        <?php if (isset($user->name)) { ?>
                                            <tr>
                                                <td style="border:0px solid;">
                                                    <b class="site-header-title-float">
                                                        <?php echo $this->lang->line("productsale_to"); ?></b> Student Name : <?= $user->name ?>
                                                        <br/>Class : <?= isset($classes[$user->classesID]) ? $classes[$user->classesID] : '' ?></td>
                                            </tr>

                                        <?php } else { ?>
                                            <tr>
                                                <td><?= $user->srname ?></td>
                                            </tr>
                                            <tr>
                                                <td><?= $this->lang->line("productsale_role") ?> : <?= isset($usertypes[3]) ? $usertypes[3] : '' ?></td>
                                            </tr>

                                        <?php } ?>
                                    <?php } ?>

                                </table>
                            </td>
                            <td colspan=2 style="vertical-align: text-top;">
                                <table width="100%">
                                    <tr>
                                        <td style="border:0px solid">
                                            <?php echo $this->lang->line("productsale_referenceno") . " : #INC0" . $productsale->productsaleID; ?>
                                            <br/><?php echo $this->lang->line("productsale_create_date") . " : " . date("d M Y"); ?>
                                            <br/><?php
                                            $status = $productsale->productsalestatus;
                                            $setButton = '';
                                            if ($status == 1) {
                                                $status = $this->lang->line('productsale_pending');
                                                $setButton = 'text-red';
                                            } elseif ($status == 3) {
                                                $status = $this->lang->line('productsale_partial_paid');
                                                $setButton = 'text-yellow';
                                            } elseif ($status == 3) {
                                                $status = $this->lang->line('productsale_fully_paid');
                                                $setButton = 'text-green';
                                            }
                                            echo $this->lang->line('productsale_payment_status') . " : " . $status;
                                            ?>

                                            <?php if ($productsale->productsalerefund == 1) { ?>
                                                <p class="refund"><?= $this->lang->line('productsale_refund') ?></p>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <th width="10%"><?= $this->lang->line('slno') ?></th>
                            <th width="30%"><?= $this->lang->line('productsale_description') ?></th>
                            <th width="20%"><?= $this->lang->line('productsale_unit_price') ?></th>
                            <th width="20%"><?= $this->lang->line('productsale_quantity') ?></th>
                            <th width="20%"><?= $this->lang->line('productsale_subtotal') ?></th>
                        </tr>
                        <?php $subtotal = 0;
                        $totalsubtotal = 0;
                        if (customCompute($productsaleitems)) {
                            $i = 1;
                            foreach ($productsaleitems as $productsaleitem) {
                                $subtotal = ($productsaleitem->productsaleunitprice * $productsaleitem->productsalequantity);
                                $totalsubtotal += $subtotal; ?>
                                <tr>
                                    <td data-title="<?= $this->lang->line('slno') ?>">
                                        <?php echo $i; ?>
                                    </td>

                                    <td data-title="<?= $this->lang->line('productsale_description') ?>">
                                        <?= isset($products[$productsaleitem->productID]) ? $products[$productsaleitem->productID] : '' ?>
                                    </td>

                                    <td data-title="<?= $this->lang->line('productsale_unit_price') ?>">
                                        <?= number_format($productsaleitem->productsaleunitprice, 2) ?>
                                    </td>

                                    <td data-title="<?= $this->lang->line('productsale_quantity') ?>">
                                        <?= number_format($productsaleitem->productsalequantity, 2) ?>
                                    </td>
                                    <td data-title="<?= $this->lang->line('productsale_subtotal') ?>">
                                        <?= number_format($subtotal, 2) ?>
                                    </td>
                                </tr>
                        <?php $i++;
                            }
                        } ?>
                        <tr>
                            <td class="pull-right" colspan="4"><b><?= $this->lang->line('productsale_total_amount') ?> <?= !empty($siteinfos->currency_code) ? '(' . $siteinfos->currency_code . ')' : '' ?></b></td>
                            <td><b><?= number_format($totalsubtotal, 2) ?></b></td>
                        </tr>
                        <tr>
                            <td class="pull-right" colspan="4"><b><?= ($productsale->discount > 0) ? ("(" . ($productsale->discount * 100 / $totalsubtotal) . "%)") : "" ?> Discount <?= !empty($siteinfos->currency_code) ? '(' . $siteinfos->currency_code . ')' : '' ?></b></td>
                            <td><b><?= number_format($productsale->discount, 2) ?></b></td>
                        </tr>
                        <tr>
                            <td class="pull-right" colspan="4"><b><?= $this->lang->line('productsale_paid') ?> <?= !empty($siteinfos->currency_code) ? '(' . $siteinfos->currency_code . ')' : '' ?></b></td>
                            <td><b><?= number_format($productsalepaid->productsalepaidamount, 2) ?></b></td>
                        </tr>
                        <tr>
                            <td class="pull-right" colspan="4"><b><?= $this->lang->line('productsale_balance'); ?> <?= !empty($siteinfos->currency_code) ? '(' . $siteinfos->currency_code . ')' : '' ?></b></td>
                            <td><b><?= number_format(($totalsubtotal - $productsalepaid->productsalepaidamount - $productsale->discount), 2) ?></b></td>
                        </tr>
                    </table>
                </td>
                <td style="width:2px">&nbsp;
                </td>
                <td>

                    <table width="100%" class="table table-bordered" style="text-align:left">
                        <tr>
                            <td colspan="5" width="100%">

                                <table width="100%">
                                    <tr>
                                        <td width="100%" style="border:0px solid;text-align:right">
                                            Office Copy
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="100%" style="border:0px solid">
                                            <b>
                                                <?php echo $this->lang->line("productsale_from"); ?>
                                            </b>
                                            Shri Balaji English Primary & Secondary School, Wadegaon<br />Tg. Balapur, Dist. Akola Office Mob. No. 7058262032, 9763757391(H.M.)

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>

                            <td colspan=3>
                                <table width="100%">

                                    <?php if (customCompute($user)) { ?>
                                        <?php if (isset($user->name)) { ?>
                                            <tr style="height:5px;">
                                                <td style="border:0px solid;height:5px;"><b class="site-header-title-float"><?php echo $this->lang->line("productsale_to"); ?></b> Student Name : <?= $user->name ?></td>
                                            </tr>
                                            <tr>
                                                <td style="border:0px solid">Class : <?= isset($classes[$user->classesID]) ? $classes[$user->classesID] : '' ?></td>
                                            </tr>

                                        <?php } else { ?>
                                            <tr>
                                                <td><?= $user->srname ?></td>
                                            </tr>
                                            <tr>
                                                <td><?= $this->lang->line("productsale_role") ?> : <?= isset($usertypes[3]) ? $usertypes[3] : '' ?></td>
                                            </tr>

                                        <?php } ?>
                                    <?php } ?>

                                </table>
                            </td>
                            <td colspan=2 style="vertical-align: text-top;">
                                <table width="100%">
                                    <tr>
                                        <td style="border:0px solid"><?php echo $this->lang->line("productsale_referenceno") . " : #INC0" . $productsale->productsaleID; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="border:0px solid">
                                            <?php echo $this->lang->line("productsale_create_date") . " : " . date("d M Y"); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border:0px solid">
                                            <?php
                                            $status = $productsale->productsalestatus;
                                            $setButton = '';
                                            if ($status == 1) {
                                                $status = $this->lang->line('productsale_pending');
                                                $setButton = 'text-red';
                                            } elseif ($status == 3) {
                                                $status = $this->lang->line('productsale_partial_paid');
                                                $setButton = 'text-yellow';
                                            } elseif ($status == 3) {
                                                $status = $this->lang->line('productsale_fully_paid');
                                                $setButton = 'text-green';
                                            }
                                            echo $this->lang->line('productsale_payment_status') . " : " . $status;
                                            ?>

                                            <?php if ($productsale->productsalerefund == 1) { ?>
                                                <p class="refund"><?= $this->lang->line('productsale_refund') ?></p>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        
                        <tr>
                            
                            <th style="width:10%;"><?= $this->lang->line('slno') ?></th>
                            <th style="width:30%;"><?= $this->lang->line('productsale_description') ?></th>
                            <th style="width:20%;"><?= $this->lang->line('productsale_unit_price') ?></th>
                            <th style="width:20%;"><?= $this->lang->line('productsale_quantity') ?></th>
                            <th style="width:20%;"><?= $this->lang->line('productsale_subtotal') ?></th>
                        </tr>
                        <?php $subtotal = 0;
                        $totalsubtotal = 0;
                        if (customCompute($productsaleitems)) {
                            $i = 1;
                            foreach ($productsaleitems as $productsaleitem) {
                                $subtotal = ($productsaleitem->productsaleunitprice * $productsaleitem->productsalequantity);
                                $totalsubtotal += $subtotal; ?>
                                <tr>
                                    <td data-title="<?= $this->lang->line('slno') ?>">
                                        <?php echo $i; ?>
                                    </td>

                                    <td data-title="<?= $this->lang->line('productsale_description') ?>">
                                        <?= isset($products[$productsaleitem->productID]) ? $products[$productsaleitem->productID] : '' ?>
                                    </td>

                                    <td data-title="<?= $this->lang->line('productsale_unit_price') ?>">
                                        <?= number_format($productsaleitem->productsaleunitprice, 2) ?>
                                    </td>

                                    <td data-title="<?= $this->lang->line('productsale_quantity') ?>">
                                        <?= number_format($productsaleitem->productsalequantity, 2) ?>
                                    </td>
                                    <td data-title="<?= $this->lang->line('productsale_subtotal') ?>">
                                        <?= number_format($subtotal, 2) ?>
                                    </td>
                                </tr>
                        <?php $i++;
                            }
                        } ?>
                        <tr>
                            <td class="pull-right" colspan="4"><b><?= $this->lang->line('productsale_total_amount') ?> <?= !empty($siteinfos->currency_code) ? '(' . $siteinfos->currency_code . ')' : '' ?></b></td>
                            <td><b><?= number_format($totalsubtotal, 2) ?></b></td>
                        </tr>
                        <tr>
                            <td class="pull-right" colspan="4"><b><?= ($productsale->discount > 0) ? ("(" . ($productsale->discount * 100 / $totalsubtotal) . "%)") : "" ?> Discount <?= !empty($siteinfos->currency_code) ? '(' . $siteinfos->currency_code . ')' : '' ?></b></td>
                            <td><b><?= number_format($productsale->discount, 2) ?></b></td>
                        </tr>
                        <tr>
                            <td class="pull-right" colspan="4"><b><?= $this->lang->line('productsale_paid') ?> <?= !empty($siteinfos->currency_code) ? '(' . $siteinfos->currency_code . ')' : '' ?></b></td>
                            <td><b><?= number_format($productsalepaid->productsalepaidamount, 2) ?></b></td>
                        </tr>
                        <tr>
                            <td class="pull-right" colspan="4"><b><?= $this->lang->line('productsale_balance'); ?> <?= !empty($siteinfos->currency_code) ? '(' . $siteinfos->currency_code . ')' : '' ?></b></td>
                            <td><b><?= number_format(($totalsubtotal - $productsalepaid->productsalepaidamount - $productsale->discount), 2) ?></b></td>
                        </tr>
                    
                    </table>
                    
                </td>
            </tr>
        </table>

    </div>
</body>

</html>