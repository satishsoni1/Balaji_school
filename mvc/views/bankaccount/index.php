<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa iniicon-bankaccount"></i> <?=$this->lang->line('panel_title')?></h3>


        <ol class="breadcrumb">
            <li><a href="<?=base_url("home/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('panel_title')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <?php if(permissionChecker('bankaccount_add')) { ?>
                    <h5 class="page-header">
                        <a href="<?php echo base_url('bankaccount/add') ?>">
                            <i class="fa fa-plus"></i>
                            <?=$this->lang->line('add_title')?>
                        </a>
                    </h5>
                <?php } ?>
                <div id="hide-table">
                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th><?=$this->lang->line('slno')?></th>
                                <th><?=$this->lang->line('bankaccount_bankname')?></th>
                                <th><?=$this->lang->line('bankaccount_accountno')?></th>
                                <th><?=$this->lang->line('bankaccount_openingbalance')?></th>
                                <th><?=$this->lang->line('bankaccount_phone')?></th>
                                <th><?=$this->lang->line('bankaccount_address')?></th>
                                <?php if(permissionChecker('bankaccount_edit') || permissionChecker('bankaccount_delete')) { ?>
                                    <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(customCompute($suppliers)) {$i = 1; foreach($suppliers as $supplier) { ?>
                                <tr>
                                    <td data-title="<?=$this->lang->line('slno')?>">
                                        <?php echo $i; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('bankaccount_bankname')?>">
                                        <?=$supplier->bankaccountbankname;?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('bankaccount_accountno')?>">
                                        <?=$supplier->bankaccountno;?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('bankaccount_openingbalance')?>">
                                        <?=$supplier->bankaccountopeningbalance;?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('bankaccount_phone')?>">
                                        <?=$supplier->bankaccountphone;?>
                                    </td> 
                                    <td data-title="<?=$this->lang->line('bankaccount_address')?>">
                                        <?=$supplier->bankaccountaddress;?>
                                    </td>
                                    <?php if(permissionChecker('bankaccount_edit') || permissionChecker('bankaccount_delete')) { ?>
                                        <td data-title="<?=$this->lang->line('action')?>">
                                            <?php echo btn_view('bankaccount/view/'.$supplier->bankaccountID, $this->lang->line('view')) ?> 
                                            <?php echo btn_edit('bankaccount/edit/'.$supplier->bankaccountID, $this->lang->line('edit')) ?>
                                            <?php echo btn_delete('bankaccount/delete/'.$supplier->bankaccountID, $this->lang->line('delete')) ?>
                                        </td>
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