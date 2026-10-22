
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa iniicon-bankaccount"></i> <?=$this->lang->line('panel_title')?></h3>
        <ol class="breadcrumb">
            <li><a href="<?=base_url("home/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("bankaccount/index")?>"><?=$this->lang->line('menu_bankaccount')?></a></li>
            <li class="active"><?=$this->lang->line('menu_add')?> <?=$this->lang->line('menu_bankaccount')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-10">
                <form class="form-horizontal" role="form" method="post">
                    <div class="form-group <?=form_error('bankaccountbankname') ? 'has-error' : '' ?>" >
                        <label for="bankaccountbankname" class="col-sm-2 control-label">
                            <?=$this->lang->line("bankaccount_bankname")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="bankaccountbankname" name="bankaccountbankname" value="<?=set_value('bankaccountbankname')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('bankaccountbankname'); ?>
                        </span>
                    </div>
                    
                    <div class="form-group <?=form_error('bankaccountno') ? 'has-error' : '' ?>" >
                        <label for="bankaccountname" class="col-sm-2 control-label">
                            <?=$this->lang->line("bankaccount_accountno")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="bankaccountno" name="bankaccountno" value="<?=set_value('bankaccountno')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('bankaccountno'); ?>
                        </span>
                    </div>

                    <div class="form-group <?=form_error('bankaccountopeningbalance') ? 'has-error' : '' ?>" >
                        <label for="bankaccountopeningbalance" class="col-sm-2 control-label">
                            <?=$this->lang->line("bankaccount_openingbalance")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="number" step="0.01" inputmode="decimal" placeholder="0.00" class="form-control" id="bankaccountopeningbalance" name="bankaccountopeningbalance" value="<?=set_value('bankaccountopeningbalance')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('bankaccountopeningbalance'); ?>
                        </span>
                    </div>

                    <div class="form-group <?=form_error('bankaccountphone') ? 'has-error' : '' ?>" >
                        <label for="bankaccountphone" class="col-sm-2 control-label">
                            <?=$this->lang->line("bankaccount_phone")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="bankaccountphone" name="bankaccountphone" value="<?=set_value('bankaccountphone')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('bankaccountphone'); ?>
                        </span>
                    </div>

                    <div class="form-group <?=form_error('bankaccountaddress') ? 'has-error' : '' ?>" >
                        <label for="bankaccountaddress" class="col-sm-2 control-label">
                            <?=$this->lang->line("bankaccount_address")?>
                        </label>
                        <div class="col-sm-6">
                            <textarea class="form-control" style="resize:none;" id="bankaccountaddress" name="bankaccountaddress"><?=set_value('bankaccountaddress')?></textarea>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('bankaccountaddress'); ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("add_bankaccount")?>" >
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>