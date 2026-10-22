<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-clone"></i> <?=$this->lang->line('panel_title')?></h3>
        <ol class="breadcrumb">
            <li><a href="<?=base_url("home/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("websitepopup/index")?>"><?=$this->lang->line('menu_websitepopup')?></a></li>
            <li class="active"><?=$this->lang->line('menu_add')?> <?=$this->lang->line('menu_websitepopup')?></li>
        </ol>
    </div>
    <div class="box-body">
        <?php $this->load->view('websitepopup/_form'); ?>
    </div>
</div>
