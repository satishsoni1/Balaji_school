<?php
    $p = isset($websitepopup) ? $websitepopup : NULL;
    $val = function ($field, $default = '') use ($p) {
        return set_value($field, $p ? $p->$field : $default);
    };
    $fieldError = function ($field) {
        return form_error($field) ? ' has-error' : '';
    };
    $frequency = $val('frequency', 'daily');
    $showOn    = $val('show_on', 'home');
    $active    = $_POST ? (bool) $this->input->post('status') : ($p ? (bool) $p->status : TRUE);
?>
<div class="row">
    <div class="col-md-7">
        <form class="form-horizontal popup-form" role="form" method="post" enctype="multipart/form-data" data-popup-form>
            <div class="form-group<?=$fieldError('title')?>">
                <label for="title" class="col-sm-3 control-label"><?=$this->lang->line('websitepopup_title')?> <span class="text-red">*</span></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="title" name="title" maxlength="150" value="<?=$val('title')?>" placeholder="e.g. Admissions are open">
                    <?=form_error('title', '<span class="help-block">', '</span>')?>
                </div>
            </div>

            <div class="form-group<?=$fieldError('badge')?>">
                <label for="badge" class="col-sm-3 control-label"><?=$this->lang->line('websitepopup_badge')?></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="badge" name="badge" maxlength="60" value="<?=$val('badge')?>">
                    <span class="help-block"><?=$this->lang->line('websitepopup_help_badge')?></span>
                    <?=form_error('badge', '<span class="help-block">', '</span>')?>
                </div>
            </div>

            <div class="form-group<?=$fieldError('message')?>">
                <label for="message" class="col-sm-3 control-label"><?=$this->lang->line('websitepopup_message')?></label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="message" name="message" rows="5" maxlength="2000"><?=$val('message')?></textarea>
                    <?=form_error('message', '<span class="help-block">', '</span>')?>
                </div>
            </div>

            <div class="form-group<?=$fieldError('image')?>">
                <label for="image" class="col-sm-3 control-label"><?=$this->lang->line('websitepopup_image')?></label>
                <div class="col-sm-9">
                    <?php if($p && $p->image) { ?>
                        <div class="popup-current-image">
                            <img src="<?=base_url('uploads/images/'.$p->image)?>" alt="">
                            <label><input type="checkbox" name="remove_image" value="1" data-remove-image> <?=$this->lang->line('websitepopup_remove_image')?></label>
                        </div>
                    <?php } ?>
                    <input type="file" class="form-control" id="image" name="image" accept="image/png,image/jpeg,image/gif,image/webp">
                    <span class="help-block"><?=$this->lang->line('websitepopup_help_image')?></span>
                    <?=form_error('image', '<span class="help-block">', '</span>')?>
                </div>
            </div>

            <div class="form-group<?=$fieldError('button_text').$fieldError('button_link')?>">
                <label for="button_text" class="col-sm-3 control-label"><?=$this->lang->line('websitepopup_button_text')?></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="button_text" name="button_text" maxlength="60" value="<?=$val('button_text')?>" placeholder="e.g. Enquire now">
                    <?=form_error('button_text', '<span class="help-block">', '</span>')?>
                </div>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="button_link" name="button_link" maxlength="500" value="<?=$val('button_link')?>" placeholder="contact-us.php" aria-label="<?=$this->lang->line('websitepopup_button_link')?>">
                    <span class="help-block"><?=$this->lang->line('websitepopup_help_link')?></span>
                    <?=form_error('button_link', '<span class="help-block">', '</span>')?>
                </div>
            </div>

            <div class="form-group<?=$fieldError('start_date').$fieldError('end_date')?>">
                <label for="start_date" class="col-sm-3 control-label"><?=$this->lang->line('websitepopup_schedule')?></label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="start_date" name="start_date" value="<?=$val('start_date')?>" aria-label="<?=$this->lang->line('websitepopup_start_date')?>">
                    <span class="help-block"><?=$this->lang->line('websitepopup_start_date')?> (blank = now)</span>
                </div>
                <div class="col-sm-5">
                    <input type="date" class="form-control" id="end_date" name="end_date" value="<?=$val('end_date')?>" aria-label="<?=$this->lang->line('websitepopup_end_date')?>">
                    <span class="help-block"><?=$this->lang->line('websitepopup_end_date')?> (blank = <?=strtolower($this->lang->line('websitepopup_no_end'))?>)</span>
                    <?=form_error('start_date', '<span class="help-block">', '</span>')?>
                    <?=form_error('end_date', '<span class="help-block">', '</span>')?>
                </div>
            </div>

            <div class="form-group">
                <label for="frequency" class="col-sm-3 control-label"><?=$this->lang->line('websitepopup_frequency')?></label>
                <div class="col-sm-4">
                    <select class="form-control" id="frequency" name="frequency">
                        <?php foreach (array('daily', 'session', 'always') as $f) { ?>
                            <option value="<?=$f?>" <?=$frequency == $f ? 'selected' : ''?>><?=$this->lang->line('websitepopup_frequency_'.$f)?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-5">
                    <select class="form-control" id="show_on" name="show_on" aria-label="<?=$this->lang->line('websitepopup_show_on')?>">
                        <?php foreach (array('home', 'all') as $s) { ?>
                            <option value="<?=$s?>" <?=$showOn == $s ? 'selected' : ''?>><?=$this->lang->line('websitepopup_show_on_'.$s)?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <label class="popup-switch">
                        <input type="checkbox" name="status" value="1" <?=$active ? 'checked' : ''?>>
                        <span></span> <?=$this->lang->line('websitepopup_active')?> &mdash; show this popup on the website
                    </label>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <input type="submit" class="btn btn-success" value="<?=$p ? $this->lang->line('update_websitepopup') : $this->lang->line('add_websitepopup')?>">
                    <a class="btn btn-default" href="<?=base_url('websitepopup/index')?>">Cancel</a>
                </div>
            </div>
        </form>
    </div>

    <div class="col-md-5">
        <div class="popup-preview-wrap">
            <p class="popup-preview-label"><i class="fa fa-eye"></i> Preview</p>
            <div class="popup-preview" data-popup-preview>
                <div class="popup-preview__media" data-preview-media <?=($p && $p->image) ? '' : 'hidden'?>>
                    <img src="<?=($p && $p->image) ? base_url('uploads/images/'.$p->image) : ''?>" alt="" data-preview-img>
                </div>
                <div class="popup-preview__body">
                    <span class="popup-preview__badge" data-preview-badge></span>
                    <h4 data-preview-title></h4>
                    <p data-preview-message></p>
                    <span class="popup-preview__btn" data-preview-btn></span>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    (function () {
        var form = document.querySelector('[data-popup-form]');
        var $ = function (sel) { return document.querySelector(sel); };
        var media = $('[data-preview-media]'), img = $('[data-preview-img]');
        var existing = img.getAttribute('src');
        function text(el, value) { el.textContent = value; el.style.display = value ? '' : 'none'; }
        function update() {
            text($('[data-preview-badge]'), form.badge.value.trim());
            text($('[data-preview-title]'), form.title.value.trim() || 'Popup title');
            text($('[data-preview-message]'), form.message.value.trim());
            text($('[data-preview-btn]'), form.button_text.value.trim());
            var remove = form.remove_image && form.remove_image.checked;
            if (form.image.files && form.image.files[0]) {
                img.src = URL.createObjectURL(form.image.files[0]);
                media.hidden = false;
            } else {
                img.src = existing && !remove ? existing : '';
                media.hidden = !(existing && !remove);
            }
        }
        form.addEventListener('input', update);
        form.addEventListener('change', update);
        update();
    })();
</script>
