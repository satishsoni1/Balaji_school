<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa iniicon-income"></i> <?=$this->lang->line('panel_title')?></h3>
        <ol class="breadcrumb">
            <li><a href="<?=base_url("home/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_income')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">

                <?php if(($siteinfos->school_year == $this->session->userdata('defaultschoolyearID')) || ($this->session->userdata('usertypeID') == 1) || $this->session->userdata('usertypeID') == 5) { ?>
                    <?php if(permissionChecker('income_add')) { ?>
                        <!-- <h5 class="page-header">
                            <a href="<?php echo base_url('income/add') ?>">
                                <i class="fa fa-plus"></i> 
                                <?=$this->lang->line('add_income')?>
                            </a>
                        </h5> -->
                    <?php } ?>
                <?php } ?>

                <div id="hide-table">
                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th class="col-sm-1"><?=$this->lang->line('income_slno')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('income_name')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('income_date')?></th>
                                <!-- <th class="col-sm-2"><?=$this->lang->line('income_user')?></th> -->
                                <th class="col-sm-1"><?=$this->lang->line('income_amount')?></th>
                                <th class="col-sm-2">Bank account (Deposit)</th>
                                <th class="col-sm-2">Ledger</th>
                                <?php if(($siteinfos->school_year == $this->session->userdata('defaultschoolyearID')) || ($this->session->userdata('usertypeID') == 1) || $this->session->userdata('usertypeID') == 5) { ?>
                                    <?php if(permissionChecker('income_edit') || permissionChecker('income_delete')) { ?>
                                        <th class="col-sm-1"><?=$this->lang->line('action')?></th>
                                    <?php } ?>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(customCompute($incomes)) {$i = 1; foreach($incomes as $income) { ?>
                                <tr>
                                    <td data-title="<?=$this->lang->line('income_slno')?>">
                                        <?php echo $i; ?>
                                    </td>

                                    <td data-title="<?=$this->lang->line('income_name')?>">
                                        <?php echo $income->name; ?>
                                    </td>

                                    <td data-title="<?=$this->lang->line('income_date')?>">
                                        <?=date('d M Y',strtotime($income->date))?>
                                    </td>

                                    <!-- <td data-title="<?=$this->lang->line('income_user')?>">
                                        <?=isset($alluser[$income->usertypeID][$income->userID]) ? $alluser[$income->usertypeID][$income->userID]->name : '' ?>
                                    </td> -->
                                    

                                    <td data-title="<?=$this->lang->line('income_amount')?>">
                                        <?=number_format($income->amount, 2)?>
                                    </td>
                                    <td data-title="Bank account (Deposit)">
                                        <?=isset($bankaccount[$income->bankaccountID]) ? $bankaccount[$income->bankaccountID] : ''?>
                                    </td>
                                    
                                    <td data-title="ledger">
                                        <?=isset($ledger[$income->ledgersID]) ? $ledger[$income->ledgersID] : ''?>
                                    </td>
                                    <?php if(($siteinfos->school_year == $this->session->userdata('defaultschoolyearID')) || ($this->session->userdata('usertypeID') == 1) || $this->session->userdata('usertypeID') == 5) { ?>
                                        <?php if(permissionChecker('income_edit') || permissionChecker('income_delete')) { ?>
                                            <td data-title="<?=$this->lang->line('action')?>">
                                                <?php echo btn_edit('income/edit/'.$income->incomeID, $this->lang->line('income_edit')) ?>
                                                <?php echo btn_delete('income/delete/'.$income->incomeID, $this->lang->line('income_delete')) ?>
                                            </td>
                                        <?php } ?>
                                    <?php } ?>
                                </tr>
                            <?php $i++; }} ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
