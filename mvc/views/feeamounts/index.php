
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-feeamounts"></i> <?=$this->lang->line('panel_title')?></h3>

       
        <ol class="breadcrumb">
            <li><a href="<?=base_url("home/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_feeamounts')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">

                <?php if(permissionChecker('feeamounts_add')) { ?>
                    <h5 class="page-header">
                        <a href="<?php echo base_url('feeamounts/add') ?>">
                            <i class="fa fa-plus"></i> 
                            <?=$this->lang->line('add_title')?>
                        </a>
                    </h5>
                <?php } ?>

                <div id="hide-table">
                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th class="col-sm-2"><?=$this->lang->line('slno')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('feeamounts_feetype')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('feeamounts_classes')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('feeamounts_amount')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('feeamounts_packageID')?></th>
                                <?php if(permissionChecker('feeamounts_edit') || permissionChecker('feeamounts_delete')) { ?>
                                <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(customCompute($feeamounts)) {$i = 1; foreach($feeamounts as $feetype) { ?>
                                <tr>
                                    <td data-title="<?=$this->lang->line('slno')?>">
                                        <?php echo $i; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('feeamounts_feetype')?>">
                                        <?php echo $feetype->feetypes; ?>
                                    </td>
                  
                                    <td data-title="<?=$this->lang->line('feeamounts_classes')?>">
                                        <?php echo $feetype->classes; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('feeamounts_amount')?>">
                                        <?php echo $feetype->amount; ?>
                                    </td>
                                    <td data-title="<?=$this->lang->line('feeamounts_packageID')?>">
                                        <?php echo $feetype->name; ?>
                                    </td>
                                    <?php if(permissionChecker('feeamounts_edit') || permissionChecker('feeamounts_delete')) { ?>
                                        <td data-title="<?=$this->lang->line('action')?>">
                                            <?php echo btn_edit('feeamounts/edit/'.$feetype->id, $this->lang->line('edit')) ?>
                                            <?php echo btn_delete('feeamounts/delete/'.$feetype->id, $this->lang->line('delete')) ?>
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