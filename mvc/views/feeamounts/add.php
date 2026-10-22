
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-feeamounts"></i> <?=$this->lang->line('panel_title')?></h3>

        <ol class="breadcrumb">
            <li><a href="<?=base_url("home/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("feeamounts/index")?>"><?=$this->lang->line('menu_feeamounts')?></a></li>
            <li class="active"><?=$this->lang->line('menu_add')?> <?=$this->lang->line('menu_feeamounts')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-10">
                <form class="form-horizontal" role="form" method="post">

                    <?php 
                        if(form_error('packageID')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="packageID" class="col-sm-2 control-label">
                            <?=$this->lang->line("feeamounts_packageID")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                        <?php
                                    $array = array('0' => $this->lang->line('select_feeamounts_packageID'));
                                    foreach ($packageIDs as $packageID) {
                                        $array[$packageID->id] = $packageID->name;
                                    }
                                    echo form_dropdown("packageID", $array, set_value("packageID"), "id='packageID' class='form-control packageID select2'");
                                ?>
                            
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('packageID'); ?>
                        </span>
                    </div>
                    <?php 
                        if(form_error('feetypes')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="feetypes" class="col-sm-2 control-label">
                            <?=$this->lang->line("feeamounts_feetype")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                        <?php
                                    $array = array('0' => $this->lang->line('select_feeamounts_feetypes'));
                                    foreach ($feetypes as $feetype) {
                                        $array[$feetype->feetypesID] = $feetype->feetypes;
                                    }
                                    echo form_dropdown("feetypes", $array, set_value("feetypes"), "id='feetypes' class='form-control feetypes select2'");
                                ?>
                            
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('feetypes'); ?>
                        </span>
                    </div>
                    <?php 
                        if(form_error('classesID')) 
                            echo "<div class='form-group has-error' >";
                        else     
                            echo "<div class='form-group' >";
                    ?>
                        <label for="classesID" class="col-sm-2 control-label">
                            <?=$this->lang->line("feeamounts_classes")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                        <?php
                                    $array = array('0' => $this->lang->line('select_feeamounts_classesID'));
                                    foreach ($classesIDs as $classesID) {
                                        $array[$classesID->classesID] = $classesID->classes;
                                    }
                                    echo form_dropdown("classesID[]", $array, set_value("classesID"), "multiple id='classesID' class='form-control classesID select2'");
                                ?>
                            
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('classesID'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('amount'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="amount" class="col-sm-2 control-label">
                            <?=$this->lang->line("feeamounts_amount")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="amount" name="amount" value="<?=set_value('amount')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('amount'); ?>
                        </span>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("add_feeamount")?>" >
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
            $(".select2").select2();
})
</script>