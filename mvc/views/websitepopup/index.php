<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-clone"></i> <?=$this->lang->line('panel_title')?></h3>
        <ol class="breadcrumb">
            <li><a href="<?=base_url("home/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"><?=$this->lang->line('menu_websitepopup')?></li>
        </ol>
    </div>
    <div class="box-body">
        <?php if(permissionChecker('websitepopup_add')) { ?>
            <h5 class="page-header">
                <a href="<?=base_url('websitepopup/add')?>"><i class="fa fa-plus"></i> <?=$this->lang->line('add_title')?></a>
            </h5>
        <?php } ?>

        <div class="popup-live <?=customCompute($livepopup) ? '' : 'popup-live--none'?>">
            <i class="fa <?=customCompute($livepopup) ? 'fa-globe' : 'fa-eye-slash'?>"></i>
            <div>
                <?php if(customCompute($livepopup)) { ?>
                    <strong>Showing on the website now: <?=htmlspecialchars($livepopup->title)?></strong>
                <?php } else { ?>
                    <strong>No popup is showing on the website right now.</strong>
                <?php } ?>
                <small><?=$this->lang->line('websitepopup_help_live')?> <a href="<?=base_url('web/')?>" target="_blank">Open website <i class="fa fa-external-link"></i></a></small>
            </div>
        </div>

        <div id="hide-table">
            <table class="table table-striped table-bordered table-hover no-footer">
                <thead>
                    <tr>
                        <th class="col-sm-1"><?=$this->lang->line('slno')?></th>
                        <th class="col-sm-1"><?=$this->lang->line('websitepopup_image')?></th>
                        <th class="col-sm-3"><?=$this->lang->line('websitepopup_title')?></th>
                        <th class="col-sm-2"><?=$this->lang->line('websitepopup_schedule')?></th>
                        <th class="col-sm-2"><?=$this->lang->line('websitepopup_frequency')?></th>
                        <th class="col-sm-1"><?=$this->lang->line('websitepopup_status')?></th>
                        <?php if(permissionChecker('websitepopup_edit') || permissionChecker('websitepopup_delete')) { ?>
                            <th class="col-sm-2"><?=$this->lang->line('action')?></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if(customCompute($websitepopups)) { $i = 1; $today = date('Y-m-d'); foreach($websitepopups as $popup) {
                        if (!$popup->status) {
                            $state = array('label-default', $this->lang->line('websitepopup_inactive'));
                        } elseif ($popup->end_date && $popup->end_date < $today) {
                            $state = array('label-danger', $this->lang->line('websitepopup_expired'));
                        } elseif ($popup->start_date && $popup->start_date > $today) {
                            $state = array('label-info', $this->lang->line('websitepopup_scheduled'));
                        } elseif (customCompute($livepopup) && $livepopup->websitepopupID == $popup->websitepopupID) {
                            $state = array('label-success', $this->lang->line('websitepopup_live'));
                        } else {
                            $state = array('label-warning', $this->lang->line('websitepopup_active'));
                        }
                    ?>
                        <tr>
                            <td data-title="<?=$this->lang->line('slno')?>"><?=$i++?></td>
                            <td data-title="<?=$this->lang->line('websitepopup_image')?>">
                                <?php if($popup->image) { ?>
                                    <img class="popup-thumb" src="<?=base_url('uploads/images/'.$popup->image)?>" alt="">
                                <?php } else { ?>
                                    <span class="popup-thumb popup-thumb--empty"><i class="fa fa-picture-o"></i></span>
                                <?php } ?>
                            </td>
                            <td data-title="<?=$this->lang->line('websitepopup_title')?>">
                                <?php if($popup->badge) { ?><small class="popup-badge"><?=htmlspecialchars($popup->badge)?></small><br><?php } ?>
                                <strong><?=htmlspecialchars($popup->title)?></strong>
                            </td>
                            <td data-title="<?=$this->lang->line('websitepopup_schedule')?>">
                                <?=$popup->start_date ? date('d M Y', strtotime($popup->start_date)) : 'Now'?>
                                &rarr;
                                <?=$popup->end_date ? date('d M Y', strtotime($popup->end_date)) : $this->lang->line('websitepopup_no_end')?>
                            </td>
                            <td data-title="<?=$this->lang->line('websitepopup_frequency')?>">
                                <?=$this->lang->line('websitepopup_frequency_'.$popup->frequency)?><br>
                                <small class="text-muted"><?=$this->lang->line('websitepopup_show_on_'.$popup->show_on)?></small>
                            </td>
                            <td data-title="<?=$this->lang->line('websitepopup_status')?>"><span class="label <?=$state[0]?>"><?=$state[1]?></span></td>
                            <?php if(permissionChecker('websitepopup_edit') || permissionChecker('websitepopup_delete')) { ?>
                                <td data-title="<?=$this->lang->line('action')?>">
                                    <?php if(permissionChecker('websitepopup_edit')) { ?>
                                        <a href="<?=base_url('websitepopup/status/'.$popup->websitepopupID)?>" class="btn btn-default btn-xs mrg" data-placement="top" data-toggle="tooltip" data-original-title="<?=$popup->status ? 'Turn off' : 'Turn on'?>"><i class="fa <?=$popup->status ? 'fa-toggle-on text-green' : 'fa-toggle-off'?>"></i></a>
                                    <?php } ?>
                                    <?=btn_edit('websitepopup/edit/'.$popup->websitepopupID, $this->lang->line('edit'))?>
                                    <?=btn_delete('websitepopup/delete/'.$popup->websitepopupID, $this->lang->line('delete'))?>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } } else { ?>
                        <tr><td colspan="7" class="text-center text-muted" style="padding:32px">No popups yet. Create one to show an announcement on the website.</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
